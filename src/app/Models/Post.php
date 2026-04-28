<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id', // 追加：ユーザーIDも保存できるようにする
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
