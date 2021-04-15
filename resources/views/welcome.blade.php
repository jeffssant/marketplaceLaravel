@extends('layouts.front')


@section('content')
<section class="hero pb-3 bg-cover bg-center d-flex align-items-center"
    style="background: url('https://via.placeholder.com/1900x600C/')">
    <div class="container py-5">
        <div class="row px-4 px-lg-5">
            <div class="col-lg-6">
                <p class="text-muted small text-uppercase mb-2">New Inspiration 2020</p>
                <h1 class="h2 text-uppercase mb-3">20% off on new season</h1><a class="btn btn-dark"
                    href="shop.html">Browse collections</a>
            </div>
        </div>
    </div>
</section>
<!-- CATEGORIES SECTION-->
<section class="pt-5">
    <header class="text-center">
      <p class="small text-muted small text-uppercase mb-1">Coleções cuidadosamente criadas</p>
      <h2 class="h5 text-uppercase mb-4">Navegue por nossas categorias</h2>
    </header>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4 mb-4 mb-md-0">
                <a class="category-item" href="{{route('category.single', ['slug' => $category->slug])}}">
                    <img class="img-fluid" src="https://via.placeholder.com/750x1050C/" alt="">
                    <strong class="category-item-title">{{$category->name}}</strong>
                </a>
            </div>
        @endforeach
    </div>
  </section>

<section class="py-5">
    <header>
        <p class="small text-muted small text-uppercase mb-1">Destaques</p>
        <h2 class="h5 text-uppercase mb-4">Artigos mais vendidos</h2>
    </header>
    <div class="row">
        
        <!-- PRODUCT-->
        @foreach($products as $key => $product)
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="product text-center">
                    <div class="position-relative mb-3">
                        <div class="badge text-white badge-"></div>
                            <a class="d-block" href="{{route('product.single', ['slug' => $product->slug])}}">
                                @if($product->photos->count())
                                <img src="{{asset('storage/' . $product->thumb)}}" alt="" class="img-fluid w-100">
                            @else
                                <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="img-fluid w-100">
                            @endif
                            </a>
                            <div class="product-overlay">
                                <ul class="mb-0 list-inline">                                    
                                    <li class="list-inline-item m-0 p-0">
                                        <a class="btn btn-sm btn-dark" href="{{route('product.single', ['slug' => $product->slug])}}">Ver Produto</a>
                                    </li>                                    
                                </ul>
                            </div>
                    </div>
                    <h6> <a class="reset-anchor" href="{{route('product.single', ['slug' => $product->slug])}}">{{$product->name}}</a></h6>
                    <p class="small text-muted">R$ {{number_format($product->price, '2', ',', '.')}}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>


<div class="row">
    <div class="col-12">
        <h2>Lojas Destaque</h2>
        <hr>
    </div>
    @foreach($stores as $store)
        <div class="col-4">
            @if($store->logo)
                <img src="{{asset('storage/' . $store->logo)}}" alt="Logo da Loja {{$store->name}}" class="img-fluid">
            @else
                <img src="https://via.placeholder.com/450x100.png?text=logo" alt="Loja sem logo..." class="img-fluid">
            @endif

            <h3>{{$store->name}}</h3>
            <p>
                {{$store->description}}
            </p>
            <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-sm btn-success">Ver Loja</a>
        </div>
    @endforeach
</div>
@endsection
