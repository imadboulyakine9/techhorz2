<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'theme_id',
        'image_url',
        'is_published',
        'status' 
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Add status constants
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }

    public function comments()
    {
        return $this->hasMany(Chat::class);
    }
    
    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rate::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
