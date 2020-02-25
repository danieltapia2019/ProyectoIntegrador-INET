<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoriaModel;
use App\User;
class CursoModel extends Model
{
    public $table = 'cursos';

    public $timestamps = false;

    public function categoria(){
        return $this->belongsTo(CategoriaModel::class,'categorias_id');
    }
    public function creador(){
      return $this->belongsTo(User::class,'autor');
    }
    public function alumno(){
      return $this->belongsToMany(User::class,'usuario_curso','id_curso','id_usuario');
    }
}
