<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $status
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property integer $view
 * @property string $thumbnail
 * @property string $created_at
 * @property string $updated_at
 * @property Status $status_id
 * @property User $user
 * @property ContentTag[] $contentTags
 */
class Content extends Model
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
    protected $fillable = ['user_id', 'status_id', 'title', 'slug', 'content', 'view', 'thumbnail', 'created_at', 'updated_at'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%' . $query . '%')
                ->orWhere('content', 'like', '%' . $query . '%')
                ->orWhere('created_at', 'like', '%' . $query . '%')
                ->orWhereHas('status', function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%');
                })->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                });

    }

    /**
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
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
    public function contentTags()
    {
        return $this->hasMany('App\Models\ContentTag');
    }
}
