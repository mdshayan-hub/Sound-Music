<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'album', 'year', 'genre', 'language', 'music_type', 'music_cover', 'music_file'];

    // Define relationship with Album
    public function album()
    {
        return $this->belongsTo(Album::class, 'album');
    }
}


