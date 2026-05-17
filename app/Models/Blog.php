<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'slug',
        'user_id',
        'title',
        'tag',
        'body'
    ];

    public function getTagArrayAttribute()
    {
        return $this->tag ? explode(',', $this->tag) : [];
    }

    public function getFirstTagAttribute()
    {
        return $this->tag_array[0] ?? 'Artikel';
    }

    public function getReadTimeAttribute()
    {
        return max(1, ceil(str_word_count(strip_tags($this->body)) / 200));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedViewsAttribute()
    {
        if ($this->views >= 1000) {
            return number_format($this->views / 1000, 1) . 'rb';
        }

        return $this->views;
    }
}
