<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * App\Models\Gallery
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property string|null $image_path  Path relatif file gambar (disimpan via storage)
 * @property string|null $caption
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read string|null $image_url  // accessor untuk URL publik gambar
 */
class Gallery extends Model
{
    use HasFactory;

    /**
     * Nama tabel secara eksplisit (opsional, default-nya juga 'galleries').
     */
    protected $table = 'galleries';

    /**
     * Kolom yang boleh diisi mass-assignment.
     */
    protected $fillable = [
        'title',
        'slug',
        'image_path',
        'caption',
        'published_at',
    ];

    /**
     * Casting kolom.
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Scope: hanya yang sudah terbit (published_at <= now).
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    /**
     * Scope sederhana untuk pencarian judul/keterangan.
     */
    public function scopeSearch($query, ?string $term)
    {
        if (!empty($term)) {
            $like = '%' . $term . '%';
            $query->where(function ($q) use ($like) {
                $q->where('title', 'like', $like)
                  ->orWhere('caption', 'like', $like);
            });
        }
        return $query;
    }

    /**
     * Accessor: URL publik untuk gambar (Storage::url).
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->image_path ? Storage::url($this->image_path) : null;
        });
    }

    /**
     * Auto-set slug ketika membuat data bila belum diisi.
     */
    protected static function booted(): void
    {
        static::creating(function (self $gallery) {
            if (empty($gallery->slug) && !empty($gallery->title)) {
                $gallery->slug = Str::slug($gallery->title);
            }
        });
    }
}
