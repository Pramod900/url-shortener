<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function urls()
    {
        return $this->hasMany(ShortLink::class);
    }
}
