<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'vet_name',
        'vet_province',
        'vet_city',
        'vet_area',
        'user_id',
    ];
    /**
     * Get the user associated with the user.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
    /**
     * Get the user associated with the user.
     */
    public function client()
    {
        return $this->hasMany(Client::class);
    }
}
