<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumentos extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipo_documentos';

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
    protected $fillable = ['nombre', 'estado', 'observaciones'];

    //Relacion uno a muchos

    public function empleados(){
        return $this->hasMany(Empleados::class);
    }

    public function clientes(){
        return $this->hasMany(Clientes::class);
    }

    public function getNameDocument($id){
        $tipoDocumento=TipoDocumentos::find($id);
        return $tipoDocumento->nombre;
    }

    public function getNameRol($id){
        if ($id == 1) {
            $rol = 'ADMINISTRADOR';
        } elseif($id == 2) {
            $rol = 'EMPLEADO';
        }else {
            $rol = 'CLIENTE';
        }

        return $rol;
    }



}
