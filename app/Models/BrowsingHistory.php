<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrowsingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'viewed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
