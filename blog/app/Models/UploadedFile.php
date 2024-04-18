<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UploadedFile extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'original_filename', 'file_path', "article_id"];

    public function article(): HasOne
    {
        return $this->hasOne(Article::class);
    }
}
