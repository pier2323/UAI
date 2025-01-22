<?php

namespace App\Models;

class User extends \Illuminate\Foundation\Auth\User
{
    use \Spatie\Permission\Traits\HasRoles;
    use \Laravel\Sanctum\HasApiTokens;
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    use \Laravel\Jetstream\HasProfilePhoto;
    use \Illuminate\Notifications\Notifiable;
    use \Laravel\Fortify\TwoFactorAuthenticatable;
    use \Illuminate\Database\Eloquent\SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
