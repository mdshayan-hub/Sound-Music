<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Song;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content_id', // Song or Video ID
        'content_type', // 'song' or 'video'
        'review_text',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

public function song()
{
    return $this->belongsTo(Song::class, 'content_id'); // content_id ko song se relate karna
}

}
