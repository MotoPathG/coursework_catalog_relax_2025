<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'password',
        //'place_id',
        'latitude',
        'longitude',
        'address',
        'city',
        'region',
        'country',
        'website',
        'phone',
        'email',
        'rating',
        'price_range',
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
            //'email_verified_at' => 'datetime',
            //'password' => 'hashed',
        ];
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function types()
    {
        return $this->belongsToMany(PlaceType::class, 'place_type_relation', 'place_id', 'type_id');
    }
    public function amenities()
    {
        return $this->belongsToMany(Amenities::class, 'place_amenities', 'place_id', 'amenity_id');
    }
}
