<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;
   public function agence()
{
    return $this->belongsTo(Agence::class);
}
public function commentaires()
{
    return $this->hasMany(Commentaire::class);
} 
}
