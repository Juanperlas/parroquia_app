<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Bautizo</title>
    <style>
        body {
            font-family: 'Cursive', cursive; /* Cambia 'Cursive' por el tipo de letra que prefieras */
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            text-decoration: underline;
            margin-bottom: 10px;
        }

        .content {
            text-align: center;
        }

        .name {
            font-size: 28px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 15px;
        }

        .details {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="header">
            <img src="https://c1.klipartz.com/pngpicture/508/902/sticker-png-church-christian-church-pastor-grace-in-christianity-baptists-logo-god-house-of-god.png" alt="Logo Izquierdo" class="logo">
            <img src="https://previews.123rf.com/images/dedegrphc/dedegrphc2005/dedegrphc200500784/147495703-iglesia-cristiana-dise%C3%B1o-de-logotipo-de-arte-de-l%C3%ADnea-s%C3%ADmbolos-cristianos.jpg" alt="Logo Derecho" class="logo">
        </div>
        <div class="title">
            CONSTANCIA DE BAUTIZO
        </div>
        <div class="content">
            <div class="name">
                {{ $registros->nombre }}
            </div>
            <div class="details">
                <p><strong>Otorgado por:</strong> Nombre de la Iglesia</p>
                <p><strong>Padre:</strong> {{ $registros->padre }}</p>
                <p><strong>Madre:</strong> {{ $registros->madre }}</p>
                <p><strong>Padrino:</strong> {{ $registros->padrino }}</p>
                <p><strong>Madrina:</strong> {{ $registros->madrina }}</p>
                <p><strong>Fecha de Bautizo:</strong> {{ $registros->fecha_bautizo }}</p>
                <p><strong>Lugar de Bautizo:</strong> {{ $registros->lugar_bautizo }}</p>
                <p><strong>Sacerdote:</strong> {{ $registros->sacerdote }}</p>
            </div>
        </div>
        <div class="footer">
            Esta constancia es válida solo con la firma y sello correspondientes.
        </div>
    </div>
</body>
</html>
