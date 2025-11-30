<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property int $district_id
 * @property string $role
 * @property bool $is_active
 * @property Carbon|null $email_verified_at
 * @property string $password
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'role', // Ditambahkan dari migration
        'name',
        'phone', // Ditambahkan dari migration
        'district_id', // Ditambahkan dari migration
        'is_active', // Ditambahkan dari migration
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'is_active' => 'boolean', // Casting untuk boolean
            'password' => 'hashed',
        ];
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // --- Relationships ---

    /**
     * Get the district (kecamatan) associated with the User.
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');

    }

    /**
     * Get the distributions made by the User (officer).
     * Sesuai dengan definisi kustom Anda menggunakan foreign key 'users_id'.
     */
    public function distributions(): HasMany
    {
        // Asumsi model Distribution ada
        return $this->hasMany(Distribution::class, 'users_id');
    }
}
