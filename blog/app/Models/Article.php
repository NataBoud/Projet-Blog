<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'author', 'user_id', 'upload_file_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function uploadFile(): HasOne
    {
        return $this->hasOne(UploadFile::class, 'id', 'upload_file_id');
    }

}
