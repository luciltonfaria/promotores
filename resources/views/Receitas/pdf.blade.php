<!-- resources/views/receitas/pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receita</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
    </style>
</head>
<body>
    <h1>Receita Médica</h1>
    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($receita->data)->format('d/m/Y') }}</p>
    <p><strong>Nome do Paciente:</strong> {{ $receita->nome_paciente }}</p>
    <p><strong>Profissional:</strong> {{ $receita->profissional->nome }}</p>
    <p><strong>Tipo de Receita:</strong> {{ $receita->tipo_receita }}</p>

    <h2>Medicamentos</h2>
    <ul>
        @foreach ($receita->medicamentos as $medicamento)
            <li>
                <strong>Medicamento:</strong> {{ $medicamento->medicamento }} <br>
                <strong>Quantidade:</strong> {{ $medicamento->quantidade }} <br>
                <strong>Modo de Usar:</strong> {{ $medicamento->modo_usar }}
            </li>
        @endforeach
    </ul>
</body>
</html>
