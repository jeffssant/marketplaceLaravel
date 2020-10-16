<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/model', function () {

    //Active Record
    //$user = new \App\User(); // Para criar um novo usuario
    //$user = \App\User::find(1); // Busca pelo ID   
    //$user->name="Usuário Teste editado"; // Define ou atualiza
    //$user->email="emailteste@teste.com"; // Define ou atualiza
    //$user->password= bcrypt('12345678'); // Define ou atualiza
    //$user->save(); // Criar um novo ou atualiza    
    //return \App\User::all(); // Retorna todos os dados
    //return \App\User::where('id', '1')->get(); //busca com condição
    //return \App\User::where('id', '1')->first();  //Retorna o primeito resuldado
    //return \App\User::paginate(10);  //paginação ---- Retorna o link das paginas


    //Mass assignment 
    /*$user = \App\User::create([
        'name'=> "Usuario Mass",
        'email'=> "mass@teste.com",
        'password'=> bcrypt("12345678")
    ]);*/

    // Mass update
    /*$user = \App\User::find(1);
    $user->update([
        'name'=>"teste mass update"
    ]);*/




    // Pegar a loja de um usuario
    //$user = \App\User::find(4);
      //return $user->store;


    // Pegar produtos de uma loja
    //$loja = \App\Store::find(7);
    //return $loja->products;

    // Criar uma loja para um usuario
  /*   $user = \App\User::find(4);
    $store = $user->store()->create([
        'name'=> "Loja Teste",
        'description'=> "Loja Teste de produtos de informática",
        'mobile_phone'=> "11-11111-1111",
        'phone'=> "11-1111-1111",
        'slug'=> "loja-teste",
    ]);

    dd($store); */

    //Criar um produto em uma loja
   /*  $store = \App\Store::find(41);
    $product = $store->products()->create([
        'name'=> "Notebook Dell",
        'description'=>"Corel I5 10GB",
        'body'=>"Descrição geral do produto",
        'price'=>2999,99,
        'slug'=>'notebook-dell'
    ]);
    dd($product); */


/*     // Criar uma categoria
    \App\Category::create([
        'name' => "games",
        'description' => null,
        'slug' => 'games',
    ]);

    \App\Category::create([
        'name' => "Notebooks",
        'description' => null,
        'slug' => 'notebooks',
    ]);

    return \App\Category::all(); */

    //adicionar produto a uma categoria
    $product = \App\Product::find(41);

    //dd($product->categories()->attach([1])); // adiciona o id "1" da categoria ao produto
    dd($product->categories()->sync([2])); // sincroniza os id (exclui e adiciona baseado na lista)

});


Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){

    /*Route::prefix('stores')->name('stores.')->group(function(){
        Route::get('/' , 'StoreController@index')->name('index');
        Route::get('/create' , 'StoreController@create')->name('create');
        Route::post('/store' , 'StoreController@store')->name('store');
        Route::get('/{store}/edit' , 'StoreController@edit')->name('edit');
        Route::post('/update/{store}' , 'StoreController@update')->name('update');
        Route::get('/destroy/{store}' , 'StoreController@destroy')->name('destroy');
    }); */
    
    Route::resource('stores', 'StoreController');
    Route::resource('products', 'ProductController');

});