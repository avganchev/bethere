<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $title
 * @package App
 * @author Anatolii Ganchev <ganchclub@gmail.com>
 */
class Post extends Model
{

    const TYPE_EVENT = 0;

    const TYPE_ARTICLE = 1;

    const TYPE_NEWS = 2;

    const STATUS_ACTIVE = 'A';

    const STATUS_MODERATE = 'M';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'uri',
        'description',
        'city',
        'address',
        'phone',
        'email',
        'source_url',
        'status',
        'price',
        'currency',
        'e_free',
        'e_online',
        'type',
        'image',
        'comments_count',
        'likes_count',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
        'published_at',
    ];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = (float)$value ? : null;
    }

    /**
     * One article belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsToMany('App\Category');
    }

    public function delete()
    {
        # delete associated image
        if ($this->attributes['image']) {
            $file = $this->attributes['image'];
            if (\File::isFile($file)) {
                \File::delete($file);
            }
        }

        parent::delete();
    }
}
