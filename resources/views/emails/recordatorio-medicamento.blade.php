<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recordatorio de medicamento</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f8; padding:30px;">

    <div style="max-width:600px; margin:auto; background:white; padding:30px; border-radius:8px;">

        <h2 style="color:#4db8a8;">
            Recordatorio de medicamento
        </h2>

        <p>
            Es momento de tomar tu medicamento:
        </p>

        <p style="font-size:18px;">
            <strong>{{ $medicamento->nombre }}</strong><br>
            Dosis: {{ $medicamento->dosis }}<br>
            Hora programada: {{ $medicamento->hora_toma }}
        </p>

        <div style="margin:30px 0;">
            <a href="{{ $confirmUrl }}"
               style="background:#4db8a8; color:white; padding:14px 24px; text-decoration:none; border-radius:6px; font-weight:bold;">
                Confirmar toma
            </a>
        </div>

        <p style="color:#888;">
            Si ya tomaste tu medicamento, puedes confirmar la toma haciendo clic en el botón.
        </p>

    </div>

</body>
</html>