@extends('layouts.front')

@section('content')
    <div class="container">
        <form action="" method="POST" class="w-50">
            <h2 class="mb-3">Dados para Pagamento</h2>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Nome do cartão </label>
                    <input type="text" class="form-control" name="card_name">                    
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Número do cartão <span class="brand"></span></label>
                    <input type="text" class="form-control" name="card_number">
                    <input type="hidden" name="card_brand">
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
           

            <input type="button" class="btn btn-success btn-lg processCheckout" value="Efetuar Pagamento">
            
            
            
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="{{asset('assets/js/jQuery.ajax.js')}}"></script>

    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');
        let amountTransaction = '{{$cartItems}}';

        cardNumber.addEventListener('keyup', function(){
            if(cardNumber.value.length >= 6){

                PagSeguroDirectPayment.getBrand({
                    cardBin:cardNumber.value.substr(0,6),

                    success: function(res){
                        //console.log(res);
                        let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png" alt="Bandeira">`;
                        spanBrand.innerHTML = imgFlag;

                        document.querySelector('input[name=card_brand]').value = res.brand.name;

                        getInstallments(amountTransaction, res.brand.name);
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

        let submitButton = document.querySelector('input.processCheckout');

        submitButton.addEventListener('click', function(event){
            event.preventDefault();

            PagSeguroDirectPayment.createCardToken({

                cardNumber:     document.querySelector('input[name=card_number]').value,
                brand:          document.querySelector('input[name=card_brand]').value,
                cvv:            document.querySelector('input[name=card_cvv]').value,
                expirationMonth:document.querySelector('input[name=card_month]').value,
                expirationYear: document.querySelector('input[name=card_year]').value,

                success: function(res){
                    console.log(res);
                    processPayment(res.card.token);
                },

                error: function(err){
                    console.log(err);
                },

            })
        })

        function processPayment(token) {
            let data = {
                card_token: token,
                hash: PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('.select_installments').value, 
                card_name: document.querySelector('input[name=card_name]').value,
                _token: '{{csrf_token()}}'
            };


            $.ajax({
                type: 'Post',
                url: '{{route("checkout.proccess")}}',
                data: data,
                dataType: 'json',
                success: function(res){
                    console.log(res);
                },
                error: function(err){
                    console.log(err);
                },
            });
        }


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

            select += '<select class="form-control select_installments">';

            for(let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
            }

            select += '</select>';

            return select;
        }
    </script>
@endsection