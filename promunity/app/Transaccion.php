<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Transaccion extends Model{
    public $table = "transaccion";
    public $guarded = [];
    public function usuario(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function curso(){
        return $this->belongsTo(CursoModel::class,'curso_id');
    }
}
