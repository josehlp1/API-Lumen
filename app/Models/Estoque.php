<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Estoque extends Model
{
   protected $table = 'estoques';
   
   public $timestamps = false;

   protected $fillable = [
    'nome'
   ];
   

}
