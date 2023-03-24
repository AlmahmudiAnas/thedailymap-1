<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;
class Comment extends Model
{
    use HasFactory ,SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
