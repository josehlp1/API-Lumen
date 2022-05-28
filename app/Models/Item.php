<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
   protected $table = 'itens';
   
   public $timestamps = false;

   protected $fillable = [
    'id',
    'id_estoque',
    'nome',
    'descricao',
    'valor'
   ];
   

}
