<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'date'];

    public function convidados()
    {
        return $this->hasMany(Convidado::class);
    }

}
