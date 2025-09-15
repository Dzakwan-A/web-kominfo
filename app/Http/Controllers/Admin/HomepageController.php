<?php

namespace App\Http\Controllers\Admin;

use App\Models\Homepage;

class HomepageController extends BaseCrudController
{
    protected string $modelClass = Homepage::class;
    protected string $viewBase   = 'admin.homepages';
    protected array  $fields     = ['title_h','slug9','deskripsi'];
    protected ?string $titleField = 'title_h';
    protected ?string $slugField  = 'slug9';
}
