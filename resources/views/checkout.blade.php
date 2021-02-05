@extends('layouts.front')

@section('content')
    <div class="container">
        <form action="" method="POST" class="w-50">
            <h2 class="mb-3">Dados para Pagamento</h2>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Número do cartão</label>
                    <input type="text" class="form-control" name="card_number">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Mês de expiração</label>
                    <input type="text" class="form-control" name="card_month">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Ano de expiração</label>
                    <input type="text" class="form-control" name="card_year">
                </div>
           

            
                <div class="form-group col-md-4">
                    <label for="">Código de segurança</label>
                    <input type="text" class="form-control" name="card_cvv">
                </div>

            </div>
           

            <input type="button" class="btn btn-success btn-lg" value="Efetuar Pagamento">
            
            
        </form>
    </div>
@endsection