<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TipoModel;
use App\UsoModel;
use App\User;
class CursoModel extends Model
{
    public $table = 'cursos';

    public $timestamps = false;

    public $guarded = [];

    public function tipo(){
        return $this->belongsTo(TipoModel::class,'tipo_id');
    }
    public function uso(){
      return $this->belongsTo(UsoModel::class,'uso_id');
    }
    public function creador(){
      return $this->belongsTo(User::class,'autor');
    }
    public function alumno(){
       return $this->belongsToMany(User::class,'usuario_curso','id_curso','id_usuario');
    }
}
