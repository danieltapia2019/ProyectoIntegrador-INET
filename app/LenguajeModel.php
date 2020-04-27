<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CursoModel;


class LenguajeModel extends Model
{
    public $table = 'lenguajes';

    public $guarded = [];

    public function curso(){
      return $this->hasMany(CursoModel::class,'lenguaje_id');
    }
}
