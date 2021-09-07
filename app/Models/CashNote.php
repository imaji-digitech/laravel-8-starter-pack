<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $product_type_id
 * @property integer $cash_book_id
 * @property integer $balance
 * @property string $created_at
 * @property string $updated_at
 * @property CashBook $cashBook
 * @property ProductType $productType
 */
class CashNote extends Model
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
    protected $fillable = ['product_type_id', 'cash_book_id', 'balance', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cashBook()
    {
        return $this->belongsTo('App\Models\CashBook');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType');
    }

    public static function search($query,$dataId)
    {
        return empty($query) ? static::query()->whereProductTypeId($dataId)
            : static::where('cash_book_id', 'like', '%' . $query . '%')
                ->where('created_at', 'like', '%' . $query . '%')
                ->where('updated_at', 'like', '%' . $query . '%')
                ->whereProductTypeId($dataId)
                ->orWhereHas('cash_book_id', function ($q) use ($query) {
                    $q->where('note', 'like', '%' . $query . '%');
                });
    }
}
