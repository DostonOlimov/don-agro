<?php

namespace App\Http\Services\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\ListPaymentType;
use App\Models\PaymentCategory;
use App\Models\PaymentTransaction;
use App\Models\PaymentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class InvoiceService
{
    static $bhm = null;

    public function create(Customer $customer, PaymentType $type, $notifiable = false): Invoice
    {
        header('test: ' . ($customer->id));
        return Invoice::create([
            'user_id' => auth()->id(),
            'customer_id' => $customer->id,
            'tin' => $customer->tax_id,

            'category_id' => $type->listPaymentType->paymentCategory->id,
            'type_id' => $type->id,

            'region_id' => optional($customer->area)->listArea->int01,
            'district_id' => optional($customer->area)->list_id,

            'amount' => static::BHM() * $type->payment,
            'notifiable' => $notifiable,
        ]);
    }

    public function servableInvoices(Customer $customer = null, $invoiceId = null, $categoryEnum = null, $with = ['paymentType'], array $typeIds = []): Collection
    {
        return Invoice::where('state', Invoice::STATE_PAID)
                      ->when($customer, function ($query, $customer) {
                          $query->where('customer_id', $customer->id);
                      })
                      ->when($invoiceId, function ($query, $invoiceId) {
                          $query->where('id', $invoiceId);
                      })
                      ->when($typeIds, function ($query, $typeIds) {
                          $query->whereIn('type_id', $typeIds);
                      })
                      ->when($categoryEnum, function ($query, $categoryEnum) {
                          $query->whereHas('paymentCategory', function ($query) use ($categoryEnum) {
                              $query->where('val01', $categoryEnum);
                          });
                      })
                      ->with($with)
                      ->get();
    }

    public function unpaidInvoices(): Collection
    {
        return Invoice::where('state', Invoice::STATE_PENDING)
                      ->with('customer')
                      ->get();
    }

    public static function BHM()
    {
        if (!static::$bhm) {
            static::$bhm = Cache::remember('bhm', 60 * 60, function () {
                return PaymentType::where('category', 'min')->value('payment');
            });
        }

        return static::$bhm;
    }

    public function markAsUsed(Invoice $invoice, Model $invoicable): bool
    {
        $invoice->state = Invoice::STATE_USED;
        $invoice->invoicable()->associate($invoicable);

        return $invoice->save();
    }

    public function markAsPaid(Invoice $invoice, Model $invoicable = null): bool
    {
        $invoice->state = Invoice::STATE_PAID;
        $invoice->invoicable()->dissociate();

        if ($invoice->free) {
            $invoice->state = Invoice::STATE_DELETED;
            return $invoice->delete();
        }

        return $invoice->save();
    }

    public function makeFreeService(Customer $customer, string $category): Invoice
    {
        return $this->makePaidService($customer, $category, null, 0);
    }

    public function makePaidService(Customer $customer, string $category, int $typeId = null, int $amount = null): Invoice
    {
        $cat = PaymentCategory::where('val01', $category)->first();
        $type = $cat->paymentTypes()
                    ->when($typeId, function ($query) use ($typeId) {
                        $query->where('id', $typeId);
                    })
                    ->first();

        $invoice = new Invoice;
        $invoice->category_id = $cat->id;
        $invoice->type_id = $type->id;

        $invoice->customer_id = $customer->id;
        $invoice->tin = $customer->pinfl ?: $customer->inn;
        $invoice->region_id = optional($customer->area)->listArea->int01;
        $invoice->district_id = $customer->area->list_id;
        $invoice->user_id = auth()->id();

        $invoice->state = Invoice::STATE_PAID;
        $invoice->amount = is_null($amount) ? self::BHM() * $type->payment : $amount;
        $invoice->free = $invoice->amount === 0;

        return tap($invoice)->save();
    }

    public function paymentTypes(string $category, Invoice $invoice = null): Collection
    {
        return ListPaymentType::whereHas('paymentCategory', function ($query) use ($category) {
                                  return $query->where('val01', $category);
                              })
                              ->when($invoice, function ($query) use ($invoice) {
                                  $query->where('int03', $invoice->type_id);
                              })
                              ->get();
    }

    public function pay(Invoice $invoice): bool
    {
        \DB::beginTransaction();
        try {
            throw_if($invoice->state === Invoice::STATE_PAID, new \Exception('Invoice ' . $invoice->id . ' already paid'));

            $payment = new PaymentTransaction;
            $payment->invoice_id = $invoice->id;
            $payment->invoice_code = $invoice->unique_id;
            $payment->region_id = $invoice->region_id;
            $payment->district_id = $invoice->district_id;
            $payment->category_id = $invoice->category_id;
            $payment->type_id = $invoice->type_id;
            $payment->tin = $invoice->tin ?: ($invoice->customer->pinfl ?: $invoice->customer->inn);
            $payment->amount = $invoice->amount;
            $payment->pay_time = now();
            $payment->perform_time = now();
            $payment->create_time = now();
            $payment->state = PaymentTransaction::STATE_COMPLETED;
            $payment->save();

            $this->markAsPaid($invoice);
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \Log::channel('invoices')->error($e->getMessage());
            \DB::rollback();
        }

        return false;
    }

    public function deleteInvoice(Invoice $invoice): bool
    {
        return $invoice->delete();
    }
}
