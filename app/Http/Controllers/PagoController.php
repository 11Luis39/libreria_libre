<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Pedido;
use App\Models\PedidoProducto;
use App\Models\Producto;
use App\Services\CartServices;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagoController extends Controller
{
    protected $cartService;

    public function __construct(CartServices $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $total = $this->cartService->getTotal();
        $iva = 0.13;
        $totalWithTax = $total + ($total * $iva);

        $access_token = $this->generateAccessToken();
        $session_token = $this->generateSessionToken($access_token, $totalWithTax);

        return view('pago.index', compact('session_token', 'total', 'totalWithTax'));
    }

    public function generateAccessToken()
    {
        $url_api = config('services.niubiz.url_api') . '/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');
        $auth = base64_encode($user . ':' . $password);

        return Http::withHeaders([
            'Authorization' => 'Basic ' . $auth
        ])->get($url_api)->body();
    }

    public function generateSessionToken($access_token, $totalWithTax)
    {
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id}";
        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json'
        ])->post($url_api, [
            'channel' => 'web',
            'amount' => number_format($totalWithTax, 2, '.', ''),
            'antifraud' => [
                'client_ip' => request()->ip(),
                'merchantDefineData' => [
                    'MDD15' => 'value15',
                    'MDD20' => 'value20',
                    'MDD33' => 'value33'
                ]
            ],
        ])->json();

        return $response['sessionKey'];
    }

    public function pagado(Request $request)
    {
        $access_token = $this->generateAccessToken();
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.authorization/v3/authorization/ecommerce/{$merchant_id}";

        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json'
        ])->post($url_api, [
            "channel" => "web",
            "captureType" => "manual",
            "countable" => true,
            "order" => [
                "tokenId" => $request->transactionToken,
                "purchaseNumber" => $request->purchaseNumber,
                "amount" => $request->amount,
                "currency" => "USD",
            ]
        ])->json();

        session()->flash('niubiz', [
            'response' => $response,
            "purchaseNumber" => $request->purchaseNumber,
        ]);


        if (isset($response['dataMap']) && $response['dataMap']['ACTION_CODE'] == '00') {
            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'direccion' => auth()->user()->direccion,
                'estado' => 'pendiente',
                'fecha_pedido' => now(),
                'total' => $request->amount
            ]);
            $contenido = Cart::instance('shopping')->content();

            foreach ($contenido as $item) {
                PedidoProducto::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $item->id,
                    'cantidad' => $item->qty,
                    'precio' => $item->price,
                ]);
                $producto = Producto::find($item->id);
                $producto->stock -= $item->qty;
                $producto->save();
            }
            $estadoPago = $response['dataMap']['ACTION_DESCRIPTION'] ?? 'desconocido';

            $pagos = Pago::create([
                'pedido_id' => $pedido->id,
                'estado' => $estadoPago,
                'fecha' => now(),
                'metodo' =>'Tarjeta',
                'monto' => $request->amount
            ]);
            Cart::destroy();

            session()->flash('pedido', [
                'pedido_id' => $pedido->id,
                'purchaseNumber' => $request->purchaseNumber
            ]);
            return redirect()->route('gracias');
        }
        return redirect()->route('pago.index');
    }
}
