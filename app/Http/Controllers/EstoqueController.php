<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Estoque;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Exeption;

class EstoqueController extends Controller
{

   private $model;
    
   public function __construct(Estoque $estoque){
      $this->model = $estoque;
   
   }

   public function CriarEstoque(Request $request){
     try{
         $novo_estoque = $request->all();
         
         $estoque = $this->model->create($novo_estoque);

         return response()->json($estoque, Response::HTTP_CREATED);
      } catch (\Throwable $e) {
               
         return response()->json([
            'error' => [
               'description' => $e->getMessage()
            ]
         ], 500); 
      }

   }

   public function EditarEstoque(Request $request){
      try{
         $estoque = $request->all();
         $novo_estoque = $this->model->find($estoque['id'])->update([
            'nome'=>$estoque['nome']
         ]);
         return response()->json($estoque, Response::HTTP_OK);
      } catch (\Throwable $e) {
            
         return response()->json([
             'error' => [
                 'description' => $e->getMessage()
             ]
         ], 500);
         
     }


   }

   public function ExcluirEstoque($id){
      
      try{
         $estoque = $this->model->where('id', $id)->delete();
         return response()->json(null, 201);
      } catch(QueryException $e) {
         if($e->errorInfo[1] == 1451) {
            return response()->json(["error" => "Erro ao excluir estoque, remova os itens relacionado a ele primeiro!"], 401);
         } else {
            return $e;
         }
      }

   }

   public function ListarEstoques(){
      try{
         $estoques = $this->model->all();

         return response()->json($estoques);
      } catch (\Throwable $e) {
            
         return response()->json([
             'error' => [
                 'description' => $e->getMessage()
             ]
         ], 500);
         
     }
   
   }
    
}
