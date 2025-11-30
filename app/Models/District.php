<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model

{
    protected $fillable = ['name', 'regency_id'];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function user()
    {
        return $this->hasMany(User::class);  // Tambahkan foreign key spesifik untuk konsistensi
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function subDistricts()
    {
        return $this->hasMany(SubDistrict::class);
    }

    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }
}
