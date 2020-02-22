<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoModel extends Model
{
    public $table = 'cursos';

    public $timestamps = false;

    public function categoria(){
        return $this->belongsTo(CategoriaModel::class,'categorias_id');
    }
    public function autor(){
      return $this->belongsTo(User::class,'autor');
    }
}
