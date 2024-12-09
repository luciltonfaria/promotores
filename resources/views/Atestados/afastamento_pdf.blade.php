<!-- resources/views/atestados/afastamento_pdf.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atestado de Afastamento</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .header, .footer {
            text-align: center;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .signature {
            margin-top: 50px;
        }
        .signature div {
            text-align: center;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td {
            vertical-align: middle;
        }
        .header-table .left {
            text-align: left;
        }
        .header-table .right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="left">
                    <img src="{{ public_path(config('company.logo')) }}" alt="Company Logo" width="300">
                </td>
                <td class="right">
                    <!-- <h1>{{ config('company.name') }}</h1> -->
                    <p>{{ config('company.email') }} | {{ config('company.phone') }}</p>
                </td>

            </tr>
        </table>
        <hr>
    </div>
    <h1 style='text-align: center;'>A T E S T A D O</h1>
    <p>Eu, {{ $atestado->profissional->nome }}, cirurgião dentista, CRO MG 18873, residente nesta cidade, atesto para fins trabalhistas e / ou escolares, que o / a paciente {{ $atestado->nome_paciente }}, esteve sob meus cuidados profissionais, tendo sido submetido (a) a tratamento odontológico para {{ $atestado->procedimento_descricao }} na data abaixo citada em meu consultório.</p>
    <p>Devendo portanto o / a paciente permanecer em repouso domiciliar por {{ $atestado->dias_afastamento }} ({{ $atestado->dias_afastamento }} dias) a partir da data abaixo citada.</p>
    <p>CID: {{ $atestado->cid10 }}</p>
    <p>Uberaba, {{ now()->format('d/m/Y') }}</p>
    <div class="signature">
        <div>____________________________________________</div>
        <div>{{ $atestado->profissional->nome }} - CRO {{ $atestado->profissional->nro_conselho }}</div>
    </div>
    <div class="footer">
        <p>{{ config('company.address') }}, {{ config('company.city') }}</p>
    </div>
</body>
</html>
