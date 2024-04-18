<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UploadFile extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'original_filename', 'file_path'];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'upload_file_id', 'id');
    }
    public function getFilePathAttribute($value): string
    {
        return 'public/uploads/' . $this->filename;
    }

}
