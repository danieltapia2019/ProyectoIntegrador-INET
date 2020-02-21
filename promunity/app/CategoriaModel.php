<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoriasModel extends Model
{
    public $table = 'cateorias';

    public $timestamps = false;

    public function curso(){
        return $this->hasMany(CursoModel::class,'categorias_id');
    }
}
