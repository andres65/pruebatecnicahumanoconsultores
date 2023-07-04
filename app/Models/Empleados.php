<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empleados extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'empleados';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'apellido', 'tipo_documento_id','documento','email','fecha_nacimiento','rol'];

    //Relacion uno a muchos inversa
    public function tipodocumento(){
        return $this->belongsTo(TipoDocumentos::class);
    }

}
