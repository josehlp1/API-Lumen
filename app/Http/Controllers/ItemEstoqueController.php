<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Item;
use Mockery\Expectation;
use Illuminate\Database\QueryException;

class ItemEstoqueController extends Controller
{
   private $model;

   public function __construct(Item $item){
     $this->model = $item;
   }

   public function ListarItensEstoque($id){
      try{
         $itens =  $this->model->where('id_estoque', $id)->get();
         
         return response()->json($itens, Response::HTTP_OK);
      } catch (\Throwable $e) {
                  
         return response()->json([
            'error' => [
               'description' => $e->getMessage()
            ]
         ], 500); 
      }
   }

   public function BuscarItem($id){
      try{
         $item = $this->model->find($id);
   
         return response()->json($item, Response::HTTP_OK);
      } catch (\Throwable $e) {
               
         return response()->json([
            'error' => [
               'description' => $e->getMessage()
            ]
         ], 500); 
      }
 
   }

   public function AdicionarItem(Request $request){
   
      try{
         $novo_item = $request->all();
         $item = $this->model->create($novo_item);
         return response()->json($item, Response::HTTP_CREATED);
      } catch(QueryException $e) {
         if($e->errorInfo[1] == 1452) {
            return response()->json(["error" => "Erro ao inserir item, estoque provavelmente não criado!"], 401);
         } else {
            return $e;
         }
      }

   }

   public function RemoverItem($id){
      try{
         $item = $this->model->where('id', $id)->delete();

         return response()->json(null, Response::HTTP_OK);
      } catch (\Throwable $e) {
                  
         return response()->json([
            'error' => [
               'description' => $e->getMessage()
            ]
         ], 500); 
      }

   }

   public function EditarItem(Request $request){
      try{
      $item = $request->all();
      $novo_item = $this->model->find($item['id'])->update([
         'id_estoque'=>$item['id_estoque'],
         'nome'=>$item['nome'],
         'descricao'=> $item['descricao'],
         'valor'=> $item['valor'],
         'quantidade'=> $item['quantidade']
      ]);
      return response()->json($item, Response::HTTP_OK);
      } catch (\Throwable $e) {
                  
         return response()->json([
            'error' => [
               'description' => $e->getMessage()
            ]
         ], 500); 
      }
   }
}
