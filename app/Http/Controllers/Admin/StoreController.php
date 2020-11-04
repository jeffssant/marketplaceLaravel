<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;


class StoreController extends Controller
{
    use UploadTrait;
    
    public function __construct()
    {
        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index()
    {
        //Lista todas a lojas --- página é somente uma 'view'
        $store = auth()->user()->store;
       
        return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
        // Apresenta um formulario de criação da loja --- faz umas listagem de todos os usuarios para vincular
        
        //$users = \App\User::all(['id' , 'name']); listava todos usuarios, eviava para view utilizando o compact  "compact('users')"

    

        return view('admin.stores.create');
    }

    public function store(StoreRequest $request)
    {
        //Criação da loja, vincula a loja ao usuario
        $data = $request->all();
        $user = auth()->user();
                
        if($request->hasFile('logo')){
            $data['logo'] = $this->imageUpload($request->file('logo'));        
            
        }


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

    public function update(StoreRequest $request, $store)
    {
        //Atualiza os dados da loja
        $data = $request->all();
        $store = \App\Store::find($store);

        if($request->hasFile('logo')){

            if(Storage::disk('public')->exists($store->logo)){
                Storage::disk('public')->delete($store->logo);
            }

            $data['logo'] = $this->imageUpload($request->file('logo'));                    
        }

        

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
