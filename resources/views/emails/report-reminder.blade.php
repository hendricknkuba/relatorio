<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #653C8B;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Olá {{ $user->name }},</h2>
        <p>Estamos quase no fim do mês! Este é um lembrete para revisar ou finalizar o seu relatório de <strong>{{ \Carbon\Carbon::parse($report->month)->locale('pt_BR')->translatedFormat('F \d\e Y') }}</strong>.</p>

        <a class="btn" href="{{ route('reports.edit', $report) }}">Editar Relatório</a>

        <p style="margin-top: 40px; color: #777">Obrigado por usar nosso sistema!</p>
    </div>
</body>
</html>
