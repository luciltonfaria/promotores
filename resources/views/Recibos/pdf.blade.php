<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recibo</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 50px;
        }
        .header img {
            max-width: 100px;
        }
        .details {
            margin-bottom: 30px;
        }
        .details .label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logomarca">
        <h1>Recibo</h1>
    </div>
    <div class="details">
        <p><span class="label">Nome:</span> {{ $recibo->nome }}</p>
        <p><span class="label">Valor:</span> R$ {{ number_format($recibo->valor, 2, ',', '.') }}</p>
        <p><span class="label">Referência:</span> {{ $recibo->referencia }}</p>
        <p><span class="label">Emitido:</span> {{ $recibo->emitido == 'S' ? 'Sim' : 'Não' }}</p>
        <p><span class="label">Data de Emissão:</span> {{ $recibo->dt_emissao ? \Carbon\Carbon::parse($recibo->dt_emissao)->format('d/m/Y') : '' }}</p>
    </div>
</body>

</html>
