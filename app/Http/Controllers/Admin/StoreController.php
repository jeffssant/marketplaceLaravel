<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        //Lista todas a lojas --- página é somente uma 'view'
        $stores = \App\Store::paginate(10);
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        // Apresenta um formulario de criação da loja --- faz umas listagem de todos os usuarios para vincular
        
        //$users = \App\User::all(['id' , 'name']); listava todos usuarios, eviava para view utilizando o compact  "compact('users')"

        return view('admin.stores.create');
    }

    public function store(Request $request)
    {
        //Criação da loja, vincula a loja ao usuario
        $data = $request->all();
        $user = auth()->user();
                
        $store = $user->store()->create($data);

        flash('Loja criada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        // Apresenta formulario para editar os dados da loja
        $store = \App\Store::find($store);

        return view('admin.stores.edit' , compact('store'));
    }

    public function update(Request $request, $store)
    {
        //Atualiza os dados da loja
        $data = $request->all();

        $store = \App\Store::find($store);

        $store->update($data);
        flash('Loja atualizada com sucesso')->success();

        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);
        $store->delete();

        flash('Loja removida com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }
}
