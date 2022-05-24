<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
//    use HasFactory;

    protected $guarded = [];


    public function offers(): hasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function owner(): belongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function city(): belongsTo
    {
        return $this->belongsTo(City::class,'city_id');
    }
}
