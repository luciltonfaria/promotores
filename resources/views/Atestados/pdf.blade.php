<!-- resources/views/atestados/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Atestado PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>
    <h1>Atestado</h1>
    <p><strong>Data:</strong> {{ $atestado->data }}</p>
    <p><strong>Tipo:</strong> {{ $atestado->tipo }}</p>
    <p><strong>Nome Paciente:</strong> {{ $atestado->nome_paciente }}</p>
    <p><strong>Código Paciente:</strong> {{ $atestado->codigo_paciente }}</p>
    <p><strong>Profissional:</strong> {{ $atestado->profissional->nome }}</p>
    <p><strong>Data Comparecimento:</strong> {{ $atestado->data_comparecimento }}</p>
    <p><strong>Hora Comparecimento:</strong> {{ $atestado->hora_comparecimento }}</p>
    <p><strong>Dias Afastamento:</strong> {{ $atestado->dias_afastamento }}</p>
    <p><strong>CID-10:</strong> {{ $atestado->cid10 }}</p>
    <p><strong>Descrição do Procedimento:</strong> {{ $atestado->procedimento_descricao }}</p>
    <p><strong>Data Impressão:</strong> {{ $atestado->data_impressao }}</p>
</body>
</html>
