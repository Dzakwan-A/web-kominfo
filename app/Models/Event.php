<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'slug',
        'date',
        'description',
    ];

    protected $casts = [
        'date' => 'date', // otomatis jadi Carbon\Carbon
    ];

    /** Scope: event mendatang (>= hari ini) */
    public function scopeUpcoming($query)
    {
        return $query->whereDate('date', '>=', now()->toDateString())
                     ->orderBy('date', 'asc');
    }

    /** Scope: event lampau (< hari ini) */
    public function scopePast($query)
    {
        return $query->whereDate('date', '<', now()->toDateString())
                     ->orderBy('date', 'desc');
    }

    /** Scope: pencarian sederhana di judul / deskripsi */
    public function scopeSearch($query, ?string $term)
    {
        if (!empty($term)) {
            $like = '%' . $term . '%';
            $query->where(function ($q) use ($like) {
                $q->where('title', 'like', $like)
                  ->orWhere('description', 'like', $like);
            });
        }
        return $query;
    }

    /** Accessor ringkas untuk tanggal terformat (opsional untuk view) */
    protected function formattedDate(): Attribute
    {
        return Attribute::get(function () {
            return $this->date ? $this->date->translatedFormat('d F Y') : null;
        });
    }

    /** Auto set slug saat create bila kosong */
    protected static function booted(): void
    {
        static::creating(function (self $event) {
            if (empty($event->slug) && !empty($event->title)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }
}
