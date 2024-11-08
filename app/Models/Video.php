<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'url', 'description', 'course_id', 'is_block'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = isset($value) ? $value : Str::slug($this->name);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
