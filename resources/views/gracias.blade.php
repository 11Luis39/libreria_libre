<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <img class="w-full" src="https://d1ih8jugeo2m5m.cloudfront.net/2024/01/gracias-por-tu-compra-minimalista.jpg"
            alt="">
        @if (session('niubiz'))
            @php
                $response = session('niubiz')['response'];
            @endphp
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <p>
                    {{ $response['dataMap']['ACTION_DESCRIPTION'] }}
                </p>
                <P>
                    <b>
                        Número de pedido: {{ session('pedido')['pedido_id'] }}
                    </b>
                </P>
                <p>
                    <b>
                        Fecha y hora del pedido :
                    </b>
                    {{ now()->createFromFormat('ymdHis', $response['dataMap']['TRANSACTION_DATE'])->format('d/m/Y H:i:s') }}
                </p>
                <p>
                    <b>
                        Tarjeta
                    </b>
                    {{ $response['dataMap']['CARD'] }} ( {{ $response['dataMap']['BRAND'] }}
                    )
                </p>
                <P>
                    <b>
                        Importe :
                    </b>
                    {{ $response['order']['amount'] }} {{ $response['order']['currency'] }}

                </P>
                @if (session('factura_id'))
                    <a href="{{ route('factura.show', session('factura_id')) }}" class="btn btn-primary">Descargar
                        Factura</a>
                @endif

            </div>
        @endif
    </div>
</x-app-layout>
