<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album_info extends Model
{
    use HasFactory;
    protected $table = 'album_info';
    protected $fillable = [
        'album_id',
        'song_id',
    ];
}
