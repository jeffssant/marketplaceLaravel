<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Boleto;
use App\Payment\PagSeguro\Notification;
use App\Store;
use App\UserOrder;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller
{
	public function index()
    {
    	try {
		    if(!auth()->check()) {
			    return redirect()->route('login');
		    }

		    if(!session()->has('cart')) return redirect()->route('home');

		    $this->makePagSeguroSession();

		    $cartItems = array_map(function($line){
			    return $line['amount'] * $line['price'];
		    }, session()->get('cart'));

		    $cartItems = array_sum($cartItems);

		    return view('checkout', compact('cartItems'));

	    } catch (\Exception $e) {
			session()->forget('pagseguro_session_code');
			redirect()->route('checkout.index');
	    }
    }

    public function proccess(Request $request)
    {
    	try {
		    $dataPost = $request->all();
		    $user = auth()->user();
		    $cartItems = session()->get('cart');
		    $stores = array_unique(array_column($cartItems, 'store_id'));
		    $reference = Uuid::uuid4();

		    $Payment = $dataPost['paymentType'] == 'BOLETO' 
				? new Boleto($cartItems, $user, $reference, $dataPost['hash'])
				: new CreditCard($cartItems, $user, $dataPost, $reference);

				
		    $result = $Payment->doPayment();			


		    $userOrder = [
			    'reference' => $reference,
			    'pagseguro_code' => $result->getCode(),
			    'pagseguro_status' => $result->getStatus(),
			    'items' => serialize($cartItems)
		    ];

		    $userOrder = $user->orders()->create($userOrder);
		    $userOrder->stores()->sync($stores);
		
		    $store = (new Store())->notifyStoreOwners($stores);

		    session()->forget('cart');
		    session()->forget('pagseguro_session_code');

			$dataJson = [
				'status' => true,
				'message' => 'Pedido criado com sucesso!',
				'order'   => $reference
			];

			if($dataPost['paymentType'] == 'BOLETO') $dataJson['link_boleto'] = $result->getPaymentLink();

		    return response()->json([
			    'data' => $dataJson
		    ]);

			
	    } catch (\Exception $e) {
			dd($e);
			//$message = env('APP_DEBUG') ? simplexml_load_string($e->getMessage()) : 'Erro ao processar pedido!';
		
			//$message =  env('APP_DEBUG') ? (array)$message->error->message : $message;
			
    		return response()->json([
			    'data' => [
				    'status' => false,
				    'message' => $message['0'],
				    'order'   => $reference,
					'error' => 'Unauthorized'
			    ]
				], 401);
	    }
    }

    public function thanks()
    {
    	return view('thanks');
    }

    public function notification()
    {
    	try{
		    $notification = new Notification();
			
		    $notification = $notification->getTransaction();

			$reference = base64_decode($notification->getReference());

		    $userOrder = UserOrder::whereReference($reference);
		    $userOrder->update([
			    'pagseguro_status' => $notification->getStatus()
		    ]);

		    if($notification->getStatus() == 3) {
			    // Liberar o pedido do usuário..., atualizar o status do pedido para em separação
			    //Notificar o usuário que o pedido foi pago...
			    //Notificar a loja da confirmação do pedido...
		    }

		    return response()->json([], 204);

	    } catch (\Exception $e) {
			$message = env('APP_DEBUG') ? $e->getMessage() : '';

		    return response()->json(['error' => $message], 500);
	    }
    }

    private function makePagSeguroSession()
    {
		if(!session()->has('pagseguro_session_code')) {

			$sessionCode = \PagSeguro\Services\Session::create(
				\PagSeguro\Configuration\Configure::getAccountCredentials()
			);

			return session()->put('pagseguro_session_code', $sessionCode->getResult());
		}
    }
}