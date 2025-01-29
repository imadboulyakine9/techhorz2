<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'theme_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}

