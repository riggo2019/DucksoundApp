<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'password',
        'image',
        'active_token',
        'remember_token',
        'upgrade_token',
        'forgot_token',
        'status_disable',
        'status_role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected static function booted()
    {
        static::retrieved(function ($user) {
            $now = Carbon::now();
            if ($user->upgrade_expires_at <= $now && $user->status_role == 3) {
                $user->status_role = 2;
                $user->save();
            }
        });
    }
}
