<?php

namespace App\Http\Controllers\Admin;

use App\Models\dokumen;

class DokumenController extends BaseCrudController
{
    protected string $modelClass = dokumen::class;
    protected string $viewBase   = 'admin.dokumen';
    // Adjust fields to match your table; keeping generic here
    protected array  $fields     = ['title','slug','deskripsi','file_path','published_at'];
    protected ?string $titleField = 'title';
    protected ?string $slugField  = 'slug';
}
