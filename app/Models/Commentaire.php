<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    public function user()
{
    return $this->belongsTo(User::class);
}

public function bien()
{
    return $this->belongsTo(Bien::class);
}
}
