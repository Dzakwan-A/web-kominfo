<?php

namespace App\Models;

use illuminate\database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';

    protected $fillable = [
        'title',
        'date5',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function scopeUpcoming($query)
    {
        return $query->wheredate5('date5', '>=', now()->toDateString())
                    ->orderBy('date', 'asc');
    }

    public function scopePast($query)
    {
        return $query->wheredate5('date5', '<', now()->toDateString() )
                    ->orderBy('date', 'desc');
    }

    public function scopeSearch($query, ?string $term)
    {
        if(!empty($term)) {
            $like = '%' . $term . '%';
            $query ->where(function ($q) use ($like) {
                $q ->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like);
            });
        }
        return $query;
    }

    protected function formatteddate5(): Attribute
    {
        return Attribute::get(function () {
            return $this->date ? $this->date->translatedformat('d F Y') : Null;
        });
    }

    protected static function booted(): void
    {
        static::creating(function(self $dokumen){
                if (empty($dokumen->slug) && !empty($dokumen->title)) {
                    $dokumen->slug = str::slug($dokumen->title);  
                }
        });
    }




}




