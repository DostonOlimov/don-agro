<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use App\Models\Traits\LogsActivity;

/**
 * Class Invoice
 * @package App\Models
 *
 * @property int $region_id
 * @property int $district_id
 * @property string $invoice_id
 *
 * @property int $category_id
 * @property int $type_id
 * @property int $tin
 *
 * @property int $amount
 *
 * @property int $state
 * @property bool $free
 * @property bool $notifiable
 * @property bool $notified
 *
 * @property-read ?Collection $merchants
 *
 * @property-read PaymentCategory $paymentCategory
 */
class Invoice extends Model
{
    use SoftDeletes, LogsActivity;

    protected $table = 'customer_invoices';

    protected $dates = ['created_at'];

    protected $appends = ['pretty_amount'];

    const STATE_DELETED = 0;
    const STATE_PENDING = 1;
    const STATE_PAID = 2;
    const STATE_USED = 3;
    const STATES = [
        self::STATE_PENDING,
        self::STATE_DELETED,
        self::STATE_PAID,
        self::STATE_USED,
    ];

    protected $fillable = [
        'region_id',
        'district_id',
        'category_id',
        'type_id',
        'amount',
        'tin',
        'customer_id',
        'user_id',
        'notifiable',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'district_id', 'list_id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id', 'list_id');
    }

    public function paymentCategory(): BelongsTo
    {
        return $this->belongsTo(PaymentCategory::class, 'category_id', 'id');
    }

    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class, 'type_id');
    }

    public function merchants(): BelongsTo
    {
        return $this->belongsTo(PaymentMerchant::class, 'type_id', 'type_id');
    }

    public function getMerchantAttribute()
    {
        return $this->merchants()
                    ->when($this->region_id === TASHKENT_LIST_ID,
                        function ($query) {
                            $query->when($this->region_id === TASHKENT_LIST_ID, function ($query) {
                                $query->where('region_id', $this->region_id);
                            });
                        },
                        function ($query) {
                            $query->where('district_id', $this->district_id);
                        }
                    )
                    ->first();
    }

    public function getUniqueIdAttribute()
    {
        return str_pad(strval($this->district_id), 4, '0', STR_PAD_LEFT)
            . str_pad(strval($this->type_id), 2, '0', STR_PAD_LEFT)
            . $this->invoice_id;
    }

    public function getPrettyAmountAttribute()
    {
        return prettyInt($this->amount / 100);
    }

    public function getBase64QRAttribute()
    {
        return 'data:image/png;base64, ' . base64_encode(
                \QrCode::format('png')->size(200)->generate(json_encode([
                    'qrv' => '1.0',
                    'details' => [
                        'amount' => $this->amount,
                        'invoice_id' => $this->unique_id,
                    ],
                    'click' => config('services.click.merchant_id'),
                    'payme' => config('services.payme.merchant_id'),
                ]))
            );
    }

    public function generateId(): string
    {
        $maxInvoiceId = static::where([
            ['district_id', $this->district_id],
            ['type_id', $this->type_id]
        ])->withTrashed()->max('invoice_id');

        return formatInvoiceId(intval($maxInvoiceId) + 1);
    }

    public function invoicable()
    {
        return $this->morphTo();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            /* @var static $model */
            $model->state = Invoice::STATE_PENDING;
            $model->invoice_id = $model->generateId();
        });

        static::deleted(function ($model) {
            /* @var static $model */
            $model->state = Invoice::STATE_DELETED;
            $model->save();
        });
    }
}
