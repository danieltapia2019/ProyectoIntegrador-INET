<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
    public $table = 'categorias';

    public $timestamps = false;

    public function curso(){
        return $this->hasMany(CursoModel::class,'categorias_id');
    }
}
