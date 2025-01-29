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
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'theme_id');
    }

    // Relationship with subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'theme_id');
    }

    // Check if the current user is subscribed to this theme
    public function isSubscribed($user_id)
    {
        return $this->subscriptions()->where('user_id', $user_id)->exists();
    }
}
