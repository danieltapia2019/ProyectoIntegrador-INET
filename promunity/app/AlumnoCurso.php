<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumnoCurso extends Model
{
    //
    public $table = 'usuario_curso';

    // public $timestamps = false;

    public $guarded = [];

    public function alumno(){
     return $this->belongsTo(User::class,'user_id');
   }
   public function curso(){
     return $this->belongsTo(CursoModel::class,'curso_id');
  }

}
