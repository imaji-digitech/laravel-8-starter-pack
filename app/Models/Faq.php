<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property string $created_at
 * @property string $updated_at
 */
class Faq extends Model
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
    protected $fillable = ['question', 'answer', 'created_at', 'updated_at'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('answer', 'like', '%'.$query.'%')
                ->orWhere('question', 'like', '%'.$query.'%');
    }
}
