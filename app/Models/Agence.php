<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'adresse',
        'user_id',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}
public function biens()
{
    return $this->hasMany(Bien::class);
}
public function contacts()
{
    return $this->hasMany(Contact::class);
}
}
