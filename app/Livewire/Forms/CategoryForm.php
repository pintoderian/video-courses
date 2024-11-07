<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class CategoryForm extends Component
{
    public $category;
    public $name, $slug;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount($categoryId = null)
    {
        if ($categoryId) {
            $this->category = Category::findOrFail($categoryId);
            $this->name = $this->category->name;
            $this->slug = $this->category->slug;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();

        $data = [
            'name' => $validatedData['name'],
            'slug' => isset($validatedData['slug']) ? $validatedData['slug'] : Str::slug($validatedData['name']),
        ];

        if ($this->category) {
            $this->category->update($data);
        } else {
            Category::create($data);
        }

        session()->flash('message', $this->category ? 'Category updated successfully' : 'Category created successfully');

        return redirect()->route('categories.index');
    }

    public function render()
    {
        return view('livewire.pages.categories.category-form');
    }
}
