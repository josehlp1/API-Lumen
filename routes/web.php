<?php

/** @var \Laravel\Lumen\Routing\Router $router */

Route::group(['prefix' => '/api/demeter/'], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');

    //Autenticação 
    Route::group(['middleware' => 'auth:api'], function () {
        //Estoque
        Route::post("criar-estoque", "EstoqueController@CriarEstoque");
        Route::put("editar-estoque", "EstoqueController@EditarEstoque");
        Route::delete("remover-estoque/{id}", "EstoqueController@ExcluirEstoque");
        Route::get("listar-estoques", "EstoqueController@ListarEstoques");
        Route::get("listar-itens-estoque/{id}", "ItemEstoqueController@ListarItensEstoque");

        //Itens
        Route::get("buscar-item/{id}", "ItemEstoqueController@BuscarItem");
        Route::post("adicionar-item", "ItemEstoqueController@AdicionarItem");
        Route::delete("remover-item/{id}", "ItemEstoqueController@RemoverItem");
        Route::put("editar-item", "ItemEstoqueController@EditarItem");

    });

});