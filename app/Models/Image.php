<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'url',
        'alt_text',
        'place_id',
        'is_main',
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
            'is_main' => 'bool',
            //'password' => 'hashed',
        ];
    }
}
