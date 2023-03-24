<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory,SoftDeletes;

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
