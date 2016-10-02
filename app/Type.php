<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    const TYPE_FOR = 'for';
    const TYPE_TODO = 'todo';
    const TYPE_WHERE = 'where';
    const TYPE_CATEGORY = 'category';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    /**
     * Category type can have many categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany('App\Category');
    }
}
