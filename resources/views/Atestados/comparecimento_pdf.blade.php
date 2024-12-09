<!-- resources/views/atestados/comparecimento_pdf.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atestado de Comparecimento</title>
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
                    <img src="{{ public_path(config('company.logo')) }}" alt="Company Logo" width="200">
                </td>
                <td class="right">
                    <h2>{{ config('company.name') }}</h2>
                    <p>{{ config('company.email') }} | {{ config('company.phone') }}</p>
                </td>

            </tr>
        </table>
        <hr>
    </div>
    <h2 style="text-align: center;">ATESTADO DE COMPARECIMENTO</h2>
    <p></p>
    <p>Nome: {{ $atestado->nome_paciente }}</p>
    <p>Atesto que a paciente acima esteve sob meus cuidados profissionais no horário: {{ $atestado->hora_comparecimento }}.</p>
    <p></p>
    <p style="text-align: center;">Uberaba, {{ now()->format('d/m/Y') }}</p>
    <div class="signature">
        <div>____________________________________________</div>
        <div>{{ $atestado->profissional->nome }} - CRO {{ $atestado->profissional->nro_conselho }}</div>
    </div>
    <div class="footer">
        <p>{{ config('company.address') }}, {{ config('company.city') }}</p>
    </div>
</body>
</html>
