<?php

namespace App\Models;

use App\Facades\ShortLinkFacade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ShortLink extends Model
{
    protected $fillable = [
        'original_url',
        'code',
        'checks',
        'user_id',
        'company_id'
    ];

    protected $appends = [
        'short_link'
    ];

    protected function shortLink(): Attribute
    {
        return Attribute::make(
            get: fn () => url('/c/' . $this->code)
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
