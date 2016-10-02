<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $title
 * @package App
 * @author Anatolii Ganchev <ganchclub@gmail.com>
 */
class Category extends Model
{

    protected $fillable = [
        'id',
        'name',
        'type_id',
        'description',
    ];

    /**
     * Category belongs to category types
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    /**
     * Get the post associated with the given category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

}
