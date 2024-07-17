<x-app-layout>
    @php
        $purchaseNumber = rand(1000000000, 9999999999);
    @endphp
    <div class="text-gray-700" x-data="{ pago: 1 }">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-2xl font-bold mb-4">Pago</h1>
                    <div class="shadow rounded-lg overflow-hidden border border-gray-200">
                        <ul class="divide-y divide-gray-200">
                            <li class="hover:bg-gray-100 transition duration-150">
                                <label class="px-4 py-2 flex items-center cursor-pointer">
                                    <input type="radio" value="1" x-model="pago"
                                        class="form-radio text-indigo-600">
                                    <span class="ml-2 font-medium text-gray-900">
                                        Tarjeta de débito / crédito
                                    </span>
                                    <img class="h-6 ml-auto" src="https://codersfree.com/img/payments/credit-cards.png"
                                        alt="">
                                </label>
                            </li>
                            <li class="hover:bg-gray-100 transition duration-150">
                                <label class="px-4 py-2 flex items-center cursor-pointer">
                                    <input type="radio" value="2" x-model="pago"
                                        class="form-radio text-indigo-600">
                                    <span class="ml-2 font-medium text-gray-900">
                                        QR
                                    </span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-2xl font-bold mb-4">Resumen de Compra</h1>
                    <!-- Aquí puedes agregar contenido adicional para el resumen de compra -->
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <p class="text-gray-700">
                        <p>
                        <div class="flex justify-between mb-4 font-semibold">
                            <p>Total</p>
                            <p>Bs/{{ number_format($total, 2, '.', '') }}</p>
                        </div>
                        <div class="flex justify-between mb-4 font-semibold">
                            @php
                                $iva = 0.13;
                                $totalWithTax = $total + $total * $iva;
                            @endphp
                            <p>Total con IVA</p>
                            <p>Bs/{{ number_format($totalWithTax, 2, '.', '') }}</p>
                        </div>
                        <div>
                            <form
                                action="{{ route('pago.pagado') }}?amount={{ number_format($totalWithTax, 2, '.', '') }}&purchaseNumber={{ $purchaseNumber }}"
                                method="post">


                                <script type="text/javascript" src="{{ config('services.niubiz.url_js') }}" data-sessiontoken="{{ $session_token }}"
                                    data-channel="web" data-merchantid="{{ config('services.niubiz.merchant_id') }}"
                                    data-purchasenumber="{{ $purchaseNumber }}" data-amount="{{ number_format($totalWithTax, 2, '.', '') }}"
                                    data-expirationminutes="20" data-timeouturl="about:blank" data-merchantlogo="img/comercio.png"
                                    data-formbuttoncolor="#000000" ,></script>

                            </form>
                        </div>
                    </div>
                </div>
                @if (session('niubiz'))
                    @php
                        $niubiz = session('niubiz');
                        $response = $niubiz['response'];
                        $purchaseNumber = $niubiz['purchaseNumber'];
                        @endphp
                    @isset($response['data'])
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 mt-8"
                            role="alert">
                            <p>
                                {{$response['data']['ACTION_DESCRIPTION']}}
                            </p>
                            <p>
                                <b>
                                    numero de pedido : {{ $purchaseNumber }}
                                </b>    
                            </p>
                            <p>
                                <b>
                                    Fecha y hora del pedido :
                                </b>
                                {{ now()->createFromFormat('ymdHis', $response['data']['TRANSACTION_DATE'])->format('d/m/Y H:i:s') }}
                            </p>
                            <p>
                                <b>
                                    Tarjeta
                                </b>
                                {{ $response['data']['CARD'] }} ( {{ $response['data']['BRAND'] }})

                            </p>
                        </div>
                    @endisset
                @endif
            </div>
        </div>
    </div>


</x-app-layout>
