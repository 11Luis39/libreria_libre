<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
    }
    h1 {
        color: #333;
    }
    p {
        font-size: 16px;
        line-height: 1.5;
    }
    .total {
        font-weight: bold;
        font-size: 18px;
        color: #007bff;
    }
    .iva {
        color: #555;
    }
    .detalles {
        margin-top: 20px;
        padding: 10px;
        border: 1px dashed #ccc;
        background-color: #fff;
    }
</style>

<h1>Factura #{{ $factura->id }}</h1>
<p>Fecha: {{ $factura->fecha }}</p>
<p>Total: <span class="total">{{ number_format($factura->total, 2) }}</span></p>
<div>
    Incluidos con los impuesto del IVA
</div>



