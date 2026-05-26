<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\DocumentationMediaVersion;

class DocumentationMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'file_path',
        'storage_disk',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'documentation_media_tag');
    }

    public function versions()
    {
        return $this->hasMany(DocumentationMediaVersion::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
