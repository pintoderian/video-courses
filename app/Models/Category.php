<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = $value ?: Str::slug($this->title);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
