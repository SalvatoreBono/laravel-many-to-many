<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    //specificare come i dati dovrebbero essere trattati
    protected $casts = [
        "date" => "date",
    ];
    //controllare quali dati possono essere inseriti o aggiornati 
    protected $fillable = [
        "title",
        "slug",
        "description",
        "thumbnail",
        "link",
        "date",
        "type_id",
    ];

    // Questo metodo verrà utilizzato per accedere alla relazione tra il modello Project e il modello Type.
    public function type()
    {
        //Project appartiene a Type
        return $this->belongsTo(Type::class);
    }


    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
