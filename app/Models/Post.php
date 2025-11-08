<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','excerpt','body','thumbnail','published_at','user_id'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($post){
            if (empty($post->slug)) {
                $post->slug = Str::slug(Str::limit($post->title, 60, ''));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
