<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist_info extends Model
{
    use HasFactory;
    protected $table = 'playlist_info';
    protected $fillable = [
        'playlist_id',
        'song_id',
    ];
}
