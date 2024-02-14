<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'title',
        'content',
        'fontsize_id',
        'fontcolor_id',
        'background_id',
        'image_id',
        'shared_with_friends'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fontsize()
    {
        return $this->belongsTo(Option::class, 'fontsize_id');
    }

    public function fontcolor()
    {
        return $this->belongsTo(Option::class, 'fontcolor_id');
    }

    public function backgroundColor()
    {
        return $this->belongsTo(Option::class, 'background_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function hashtags()
    {
        return $this->hasMany(Hashtag::class, 'diary_id');
    }


}
