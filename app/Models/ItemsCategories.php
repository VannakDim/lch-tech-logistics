<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class ItemsCategories extends Model
{

    protected $fillable = [
        'category_name',
        'photo',
        'description',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(Items::class, 'item_category_id');
    }
}

