<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'age_group', 'description', 'category_id'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = isset($value) ? $value : Str::slug($this->name);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }
}
