@extends('layouts.front')

@section('content')
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-5">
                <div class="card ">
                    @if ($product->photos->count())
                        <img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="" srcset="" class="card-img-top">
                    @else
                    <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" srcset="" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{$product->name}}</h2>
                        <p class="card-text">
                            {{$product->description}}
                        </p>
                        <h3>R${{number_format($product->price, '2', ',', '.')}}</h3>
                    <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">Ver Produto</a>
                    </div>
                </div>    
            </div>
        @endforeach
    </div>
@endsection
