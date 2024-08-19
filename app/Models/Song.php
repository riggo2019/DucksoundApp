<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\Song as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory,  Notifiable;
    protected $fillable = [
        'song_name',
        'nation',
        'lyrics',
        'song_image',
        'song_file',
        'type_id',
        'singer_id',
    ];
}
