<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'value'];

    public function fontsizeDiaries()
    {
        return $this->hasMany(Diary::class, 'fontsize_id');
    }

    public function fontcolorDiaries()
    {
        return $this->hasMany(Diary::class, 'fontcolor_id');
    }

    public function backgroundDiaries()
    {
        return $this->hasMany(Diary::class, 'background_id');
    }
    
}
