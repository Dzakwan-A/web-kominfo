<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

/**
 * Generic CRUD controller to speed up scaffolding for simple resources.
 * Child classes MUST set:
 *  - protected string $modelClass   Fully-qualified Model class name
 *  - protected string $viewBase     Blade base path (e.g. 'admin.categories')
 *  - protected array  $fields       List of fillable field names to accept
 *  - protected ?string $titleField  Field used to auto-generate slug (optional)
 *  - protected ?string $slugField   Slug column name (optional)
 *  - protected array  $rules        Validation rules (will be merged with inferred)
 */
abstract class BaseCrudController extends Controller
{
    /** @var class-string<Model> */
    protected string $modelClass;
    protected string $viewBase;
    protected array $fields = [];
    protected ?string $titleField = null;
    protected ?string $slugField = null;
    protected array $rules = [];

    public function index()
    {
        $model = $this->modelClass;
        $items = $model::latest()->paginate(10);
        return view($this->viewBase.'.index', ['items' => $items]);
    }

    public function create()
    {
        return view($this->viewBase.'.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        // Auto slug if configured and empty
        if ($this->slugField && $this->titleField) {
            if (empty($data[$this->slugField] ?? null) && !empty($data[$this->titleField] ?? null)) {
                $data[$this->slugField] = Str::slug($data[$this->titleField]);
            }
        }

        $model = $this->modelClass;
        /** @var Model $item */
        $item = $model::create($data);

        return redirect()->route($this->routeName().'.index')
            ->with('success', 'Data berhasil dibuat.');
    }

    public function edit($id)
    {
        $model = $this->modelClass;
        $item = $model::findOrFail($id);
        return view($this->viewBase.'.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $model = $this->modelClass;
        $item = $model::findOrFail($id);

        $data = $this->validateRequest($request, $item);

        // Auto slug if configured and empty
        if ($this->slugField && $this->titleField) {
            if (empty($data[$this->slugField] ?? null) && !empty($data[$this->titleField] ?? null)) {
                $data[$this->slugField] = Str::slug($data[$this->titleField]);
            }
        }

        $item->update($data);

        return redirect()->route($this->routeName().'.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $model = $this->modelClass;
        $item = $model::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }

    protected function routeName(): string
    {
        // e.g. 'admin.categories' from 'admin/categories'
        // Infer from viewBase's last segment
        $segments = explode('.', $this->viewBase);
        $res = end($segments);
        return 'admin.'. $res;
    }

    protected function validateRequest(Request $request, ?Model $item = null): array
    {
        $rules = $this->inferredRules($item);

        // Merge explicit rules (explicit wins)
        $rules = array_merge($rules, $this->rules);

        return $request->validate($rules);
    }

    protected function inferredRules(?Model $item = null): array
    {
        $rules = [];
        foreach ($this->fields as $field) {
            // sensible defaults
            $rule = 'nullable';

            $lname = strtolower($field);
            if ($lname === 'name' || str_starts_with($lname, 'title')) {
                $rule = 'required|string|max:255';
            } elseif ($lname === 'slug' || str_starts_with($lname, 'slug')) {
                // unique on target table
                $model = $this->modelClass;
                $table = (new $model)->getTable();
                $ignoreId = $item?->getKey();
                $rule = [
                    'nullable',
                    Rule::unique($table, $field)->ignore($ignoreId),
                ];
            } elseif ($lname === 'date' || str_contains($lname, 'date')) {
                $rule = 'nullable|date';
            } elseif (str_contains($lname, 'description') || str_contains($lname, 'deskripsi') || $lname === 'body') {
                $rule = 'nullable|string';
            }

            $rules[$field] = $rule;
        }

        return $rules;
    }
}
