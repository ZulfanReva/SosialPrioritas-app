<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['name', 'score_work', 'is_active'];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }
}
