<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'users';
    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope('role', function(Builder $builder) {
            $builder->where('role', 'Admin');
        });
        
    }
}
