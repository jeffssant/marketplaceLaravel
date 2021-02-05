@extends('layouts.front')

@section('content')
    <div class="row">
        <dic class="col-4">
                @if ($product->photos->count())
                    <img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="" srcset="" class="card-img-top">
                    <div class="row">
                        @foreach ($product->photos as $photo)
                            <div class="col-4">
                                <img src="{{asset('storage/'.$photo->image)}}" alt="" srcset="" class="img-fluid mt-3">
                            </div>
                        @endforeach
                    </div>
                @else
                    <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" srcset="" class="card-img-top">
                @endif
        </dic>
        <div class="col-8">
            <div class="col-md-12">
                <h2>{{$product->name}}</h2>
                <p>{{$product->description}}</p>
                <h3>R${{number_format($product->price, '2', ',', '.')}}</h3>
                <span>
                    Loja: {{$product->store->name}}
                </span>
            </div>
            <div class="product-add col-md-12">
                <hr>
            <form action="{{route('cart.add')}}" method="post">
                @csrf
                <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                    <div-form-group>
                        <label>Quantidade</label>
                        <input type="number" name="product[amount]" name="" id="" class="form-control col-md-2" value="1">
                    </div-form-group>
                    <button class="btn bt-lg btn-danger mt-3">Comprar</button>
                </form>
            </div>
            
        </div>
    </div>
    <hr>
    <div class="row">
     
        <div class="col-12">
            {{$product->name}}
        </div>
    </div>
@endsection
