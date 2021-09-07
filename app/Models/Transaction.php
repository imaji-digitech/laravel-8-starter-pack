<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $status_id
 * @property integer $payment_status_id
 * @property string $no_invoice
 * @property string $created_at
 * @property string $updated_at
 * @property PaymentStatus $paymentStatus
 * @property Status $status
 * @property User $user
 * @property TransactionCredit[] $transactionCredits
 * @property TransactionDetail[] $transactionDetails
 * @property TransactionPayment[] $transactionPayments
 * @property TransactionReturn[] $transactionReturns
 */
class Transaction extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'status_id', 'payment_status_id', 'no_invoice', 'created_at', 'updated_at'];

    public static function search($query, $status)
    {
        return empty($query) ? static::query()->whereIn('status_id', $status)
            : static::whereIn('status_id', $status)->where(function ($w) use ($query) {
                $w->orWhere('no_invoice', 'like', '%' . $query . '%')
                    ->orWhereHas('user', function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    })->orWhereHas('paymentStatus', function ($q) use ($query) {
                        $q->where('title', 'like', '%' . $query . '%');
                    })->orWhereHas('status', function ($q) use ($query) {
                        $q->where('title', 'like', '%' . $query . '%');
                    })->orWhereHas('transactionDetails', function ($q) use ($query) {
                        $q->whereHas('product', function ($q2) use ($query) {
                            $q2->where('title', 'like', '%' . $query . '%');
                        });
                    });
            });
    }

    /**
     * @return BelongsTo
     */
    public function paymentStatus()
    {
        return $this->belongsTo('App\Models\PaymentStatus');
    }

    /**
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return HasMany
     */
    public function transactionCredits()
    {
        return $this->hasMany('App\Models\TransactionCredit');
    }

    /**
     * @return HasMany
     */
    public function transactionDetails()
    {
        return $this->hasMany('App\Models\TransactionDetail');
    }

    /**
     * @return HasMany
     */
    public function transactionPayments()
    {
        return $this->hasMany('App\Models\TransactionPayment');
    }

    /**
     * @return HasMany
     */
    public function transactionReturns()
    {
        return $this->hasMany('App\Models\TransactionReturn');
    }
}
