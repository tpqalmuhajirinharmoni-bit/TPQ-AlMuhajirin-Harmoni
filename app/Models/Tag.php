<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function assets()
    {
        return $this->belongsToMany(DocumentationMedia::class, 'documentation_media_tag');
    }
}
