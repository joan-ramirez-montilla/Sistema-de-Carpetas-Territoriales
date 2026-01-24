<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Carpetas Territoriales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
            font-size: 12px;
        }

        .page {
            width: 100%;
            height: 100%;
            padding: 20px 30px;
            box-sizing: border-box;
        }

        .header {
            width: 100%;
            margin-bottom: 15px;
        }

        .logo {
            width: 90px;
            height: auto;
            display: block;
        }

        .header-center h2 {
            margin: 0;
            font-size: 14px;
            letter-spacing: 0.5px;
            line-height: 1.2;
            text-align: center;
        }

        .header-center h1 {
            margin: 5px 0 0 0;
            font-size: 20px;
            letter-spacing: 1px;
            font-weight: bold;
            line-height: 1.2;
            text-align: center;
        }

        .info-line {
            margin: 25px 0 15px 0;
            font-size: 14px;
            padding: 8px 0;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            text-align: center;
        }

        .info-line span {
            font-weight: bold;
        }

        .table-container {
            margin-top: 15px;
            width: 100%;
        }

        /* TABLA DEL HEADER (SIN BORDES) */
        .header-table th,
        .header-table td {
            border: none !important;
            background: none !important;
        }

        /* TABLA DEL LISTADO (CON BORDES) */
        .table-container table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            table-layout: fixed;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
        }

        .table-container th {
            background: #f2f2f2;
            font-weight: bold;
        }

        .table-container td {
            padding: 6px 8px;
        }

        .table-container th:nth-child(1),
        .table-container td:nth-child(1) {
            width: 25%;
        }

        .table-container th:nth-child(2),
        .table-container td:nth-child(2) {
            width: 50%;
        }

        .table-container th:nth-child(3),
        .table-container td:nth-child(3) {
            width: 25%;
        }

        tr {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <div class="page">

        <!-- HEADER -->
        <div class="header">
            <table class="header-table" width="100%">
                <tr>
                    <td width="15%" align="left">
                        <img class="logo" src="{{ public_path('prm.png') }}" alt="PRM Logo">
                    </td>

                    <td width="70%" align="center" class="header-center">
                        <h2>PARTIDO REVOLUCIONARIO MODERNO</h2>
                        <h2>COMISIÓN NACIONAL DE ELECCIONES INTERNAS</h2>
                        <h1>CARPETAS TERRITORIALES</h1>
                    </td>

                    <td width="15%" align="right">
                        <img class="logo" src="{{ public_path('cnei.png') }}" alt="CNE Logo">
                    </td>
                </tr>
            </table>
        </div>

        <!-- INFO LINE -->
        <div class="info-line">
            <span>PROVINCIA</span> {{ $filters['province'] }} &nbsp;&nbsp;&nbsp;
            <span>ESTRUCTURA</span> {{ $folder }}
        </div>

        <!-- TABLE -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Cargo</th>
                        <th>Nombre Completo</th>
                        <th>Cédula</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>{{ $member['position'] }}</td>
                            <td>{{ $member['full_name'] }}</td>
                            <td>{{ $member['national_id'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
