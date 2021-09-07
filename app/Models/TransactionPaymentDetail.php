<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $transaction_payment_id
 * @property integer $product_id
 * @property int $quantity
 * @property int $total
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 * @property TransactionPayment $transactionPayment
 */
class TransactionPaymentDetail extends Model
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
    protected $fillable = ['transaction_payment_id', 'product_id', 'quantity', 'total', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transactionPayment()
    {
        return $this->belongsTo('App\Models\TransactionPayment');
    }
}
