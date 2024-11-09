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

    public function getEmbedUrlAttribute()
    {
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.+\?v=))([^&\n?#]+)/', $this->url, $matches)) {
            $videoId = $matches[1];
            return "https://www.youtube.com/embed/{$videoId}";
        }
        return $this->url;
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
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    public function userProgress()
    {
        return $this->hasMany(UserVideoProgress::class);
    }
}
