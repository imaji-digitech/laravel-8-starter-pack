<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $product_type_id
 * @property integer $code_cash_book_id
 * @property string $note
 * @property int $income
 * @property int $outcome
 * @property string $created_at
 * @property string $updated_at
 * @property CodeCashBook $codeCashBook
 * @property ProductType $productType
 * @property CashNote[] $cashNotes
 * @property TransactionPaymentDetail[] $transactionPaymentDetails
 */
class CashBook extends Model
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
    protected $fillable = ['product_type_id', 'code_cash_book_id', 'note', 'income', 'outcome', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function codeCashBook()
    {
        return $this->belongsTo('App\Models\CodeCashBook');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cashNotes()
    {
        return $this->hasMany('App\Models\CashNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactionPaymentDetails()
    {
        return $this->hasMany('App\Models\TransactionPaymentDetail');
    }

    public static function search($dataId)
    {
        $cashNote = CashNote::whereProductTypeId($dataId)->orderByDesc('id')->first();
        return static::whereProductTypeId($dataId)->where('id', '>=', $cashNote->cash_book_id)->orderBy('id');
    }
}
