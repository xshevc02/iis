<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location'];


    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function devices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Device::class);
    }
}
