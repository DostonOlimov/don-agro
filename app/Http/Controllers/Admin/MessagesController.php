<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::when($request->input('phone'), function ($query, $phone) {
                                $query->where('phone', 'like', '%' . preg_replace("/[^0-9]/", '', $phone) . '%');
                            })
                            ->when($request->tax_id || $request->customer_name, function ($query) use ($request) {
                                $query->whereHas('inspection', function ($query) use ($request) {
                                    $query->whereHas('customer', function ($query) use ($request) {
                                        $query->when($request->customer_name, function (Builder $customerQuery, $customerName) {
                                                  $customerQuery->where('f_name', 'like', '%' . $customerName . '%');
                                              })
                                              ->when($request->tax_id, function (Builder $customerQuery, $taxId) {
                                                  $customerQuery->where('tax_id', $taxId);
                                              });
                                    });
                                });
                            })
                            ->when($request->tech_number, function ($query, $techNumber) {
                                return $query->whereHas('inspection', function ($inspQuery) use ($techNumber) {
                                    $inspQuery->whereHas('vehicle', function ($techQuery) use ($techNumber) {
                                        $techQuery->whereRaw($techNumber . ' in (factory_number, engineno)');
                                    });
                                });
                            })
                            ->when($request->input('date_from'), function ($query, $dateFrom) {
                                return $query->whereDate('created_at', '>=', Carbon::createFromFormat(USER_DATE_FORMAT, $dateFrom)->startOfDay());
                            })
                            ->when($request->input('date_to'), function ($query, $dateTo) {
                                return $query->whereDate('created_at', '<=', Carbon::createFromFormat(USER_DATE_FORMAT, $dateTo)->endOfDay());
                            })
                            ->latest()
                            ->with('inspection.customer.area.region')
                            ->paginate(50)
                            ->appends($request->query());


        return view('admin.messages.list', [
            'messages' => $messages,
        ]);
    }
}
