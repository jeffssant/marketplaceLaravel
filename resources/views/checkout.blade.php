@extends('layouts.front')

@section('content')
    <div class="container">
        <form action="" method="POST" class="w-50">
            <h2 class="mb-3">Dados para Pagamento</h2>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Número do cartão <span class="brand"></span></label>
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

                <div class="col-md-12 installments form-group"></div>

            </div>
           

            <input type="button" class="btn btn-success btn-lg" value="Efetuar Pagamento">
            
            
            
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    
    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');

        cardNumber.addEventListener('keyup', function(){
            if(cardNumber.value.length >= 6){

                PagSeguroDirectPayment.getBrand({
                    cardBin:cardNumber.value.substr(0,6),

                    success: function(res){
                        //console.log(res);
                        let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png" alt="Bandeira">`;
                        spanBrand.innerHTML = imgFlag;

                        getInstallments(40, res.brand.name);
                    },
                    error: function(err) {
                        //console.log(err);
                    },
                    complete: function(res){
                       // console.log('Complete:', res)
                    }

                });
            }
           
        })


        function getInstallments (amount, brand){
            PagSeguroDirectPayment.getInstallments({
                amount: amount,
                brand: brand,
                maxIstallmentNoIterest: 0,
                success: function(res){
                    let selectInstallments = drawSelectInstallments(res.installments[brand]);
                    document.querySelector('div.installments').innerHTML = selectInstallments;
                },
                complete: function(err){
                    //console.log(err);
                },
                error: function(res){

                },
            })
        }


        function drawSelectInstallments(installments) {
           
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class="form-control">';

            for(let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
            }

            select += '</select>';

            return select;
        }
    </script>
@endsection