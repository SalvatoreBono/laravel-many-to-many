<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // Questo metodo verrà utilizzato per accedere alla relazione tra il modello Type e il modello Project.
    public function projects()
    {
        //$this->hasMany(Project::class) = restituisce una relazione "hasMany" tra Type e il modello Project
        return $this->hasMany(Project::class);
    }
}
