<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Song_type extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'song_type';
    protected $fillable = ['type_name'];
}
