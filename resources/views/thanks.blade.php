@extends('layouts.front')


@section('content')
    <h2 class="alert alert-success">
        Muito obrigado por sua compra!
    </h2>
    <h3>
        Seu pedido foi processado, código do pedido: {{request()->get('order')}}.
        <br>
        @if (request()->has('b'))
            <a href="{{request()->get('b')}}" class="bt btn-lg btn-success" target="_blank">Imprimir Boleto</a>
        @endif
    </h3>
@endsection