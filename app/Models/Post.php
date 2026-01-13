<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','excerpt','body','thumbnail','published_at','views','user_id', 'category_id','tags'
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

     public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
