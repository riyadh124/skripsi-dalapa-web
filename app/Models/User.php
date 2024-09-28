<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function workorders(){
        return $this->hasMany(Workorder::class);
    }

    // Override boot method to set default NIK
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->nik = self::generateNik();
        });
    }

    // Method to generate unique NIK
    private static function generateNik()
    {
        $dateSuffix = date('md'); // Use current date in md format (4 digits)
        $latestUser = self::latest('id')->first();
        $newId = $latestUser ? $latestUser->id + 1 : 1; // Get the latest ID and increment by 1

        $idPrefix = str_pad($newId, 2, '0', STR_PAD_LEFT); // Pad the ID to ensure it is 3 digits

        return $idPrefix . $dateSuffix; // Combine prefix and suffix to form NIK
    }
}
