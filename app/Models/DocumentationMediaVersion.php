<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentationMediaVersion extends Model
{
    use HasFactory;

    protected $table = 'documentation_media_versions';

    protected $fillable = [
        'documentation_media_id',
        'file_path',
        'notes',
        'storage_disk',
    ];

    public function asset()
    {
        return $this->belongsTo(DocumentationMedia::class, 'documentation_media_id');
    }
}
