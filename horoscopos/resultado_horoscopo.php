<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // ===================== DATOS USUARIO =====================
    $hora = $_POST['hora'] ?? '';
    $dia = intval($_POST['dia'] ?? 1);
    $mes = intval($_POST['mes'] ?? 1);
    $anio = intval($_POST['anio'] ?? 2000);
    $finanzas = $_POST['finanzas'] ?? 'regular';
    $laboral = $_POST['laboral'] ?? 'empleado';
    $enfermedades = $_POST['enfermedades'] ?? '';
    $conexion = $_POST['conexion'] ?? 'almas';
    $genero = $_POST['genero'] ?? 'otro'; // Si quieres agregar opción de género


    // ===================== SIGNO ZODIACAL =====================
    function obtenerSigno($dia, $mes) {
        $signos = [
            ['Capricornio', 20, 1], ['Acuario', 19, 2], ['Piscis', 20, 3], 
            ['Aries', 20, 4], ['Tauro', 21, 5], ['Géminis', 21, 6],
            ['Cáncer', 22, 7], ['Leo', 23, 8], ['Virgo', 23, 9],
            ['Libra', 23, 10], ['Escorpio', 22, 11], ['Sagitario', 21, 12],
            ['Capricornio', 31, 12]
        ];
        foreach($signos as $index => $s){
            $nombre = $s[0];
            $fin_dia = $s[1];
            $fin_mes = $s[2];
            if($mes == $fin_mes && $dia <= $fin_dia){
                return $nombre;
            }
        }
        $mes_anterior = $mes - 1;
        if($mes_anterior < 1) $mes_anterior = 12;
        return $signos[$mes_anterior][0];
    }

    $signo = obtenerSigno($dia, $mes);

    // ===================== DATOS PAREJA =====================
    $tiene_pareja = $_POST['tiene_pareja'] ?? 'no';
    if($tiene_pareja == 'si'){
        $dia_p = intval($_POST['dia_pareja'] ?? 1);
        $mes_p = intval($_POST['mes_pareja'] ?? 1);
        $anio_p = intval($_POST['anio_pareja'] ?? 2000);
        $signo_pareja = obtenerSigno($dia_p, $mes_p);
    }

    // ===================== PREDICCIÓN =====================
    function prediccion($finanzas, $laboral, $enfermedades){
        $mensaje = "Este año ";

        // Finanzas
        switch($finanzas){
            case 'buena': $mensaje .= "tendrás buena suerte en el dinero, "; break;
            case 'regular': $mensaje .= "deberás cuidar tus finanzas, "; break;
            case 'mala': $mensaje .= "se recomienda prudencia con el dinero, "; break;
        }

        // Laboral
        switch($laboral){
            case 'desempleado': $mensaje .= "buscarás nuevas oportunidades laborales, "; break;
            case 'empleado': $mensaje .= "será un buen momento para consolidarte en tu trabajo, "; break;
            case 'empresario': $mensaje .= "tus proyectos pueden crecer, "; break;
        }

        // Salud
        if(!empty($enfermedades)){
            $mensaje .= "presta atención a tu salud, especialmente a: $enfermedades. ";
        } else {
            $mensaje .= "tu salud se mantendrá estable. ";
        }

        return $mensaje;
    }

    $mensaje = prediccion($finanzas, $laboral, $enfermedades);

    // ===================== MENSAJE SEGÚN CONEXIÓN =====================
    if($conexion == "almas"){
        $mensaje .= "La conexión con tu pareja será profunda y armoniosa.";
    } else if($conexion == "llamas"){
        $mensaje .= "Prepárate para una conexión intensa que traerá aprendizajes importantes.";
    }

} else {
    header("Location: index.html"); // Redirige si no es POST
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado Cosmos</title>
</head>

     <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <!-- CSS -->
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;   /* 👈 ya no la centra verticalmente */
    padding: 40px 20px;        /* espacio arriba y abajo */
    background: radial-gradient(circle at top, #2b1055, #000000 70%);
    color:white;
}

        
.card{
    width: 100%;
    max-width: 520px;          /* 👈 más chica y elegante */
    padding: 30px;             /* menos padding */
    border-radius: 18px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    box-shadow: 0 0 30px rgba(138,43,226,0.5);
    animation: fadeIn 1s ease-in-out;
}

          h2{
            text-align:center;
            margin-bottom:25px;
            font-weight:700;
            font-size:24px;
            color:#ffff;
        }
        
        h3{
            font-size: 18px;
            margin-bottom:10px;
            color:#e0b3ff;
        }

        p{
            margin-bottom:10px;
            line-height:1.6;
        }

        strong{
            color:#ff99ff;
}

        .section{
            margin-top:15px;
            padding:12px;
            border-radius:12px;
            background: rgba(255,255,255,0.05);
        }


        @keyframes fadeIn{
            from{
                opacity:0;
                transform: translateY(20px);
            }
            to{
                opacity:1;
                transform: translateY(0);
            }
        }

        .btn{
            display:block;
            margin-top:30px;
            padding:12px;
            text-align:center;
            border-radius:10px;
            background: linear-gradient(45deg,#a64bf4,#ff66cc);
            color:white;
            text-decoration:none;
            font-weight:500;
            transition:0.3s;
        }

        .btn:hover{
            transform:scale(1.05);
            box-shadow:0 0 20px #ff66cc;
        }


    </style>


<body>

<div class="card">
    <h2>✨ Tu Destino Cósmico ✨</h2>

    <div class="section">
        <p><strong>Fecha de nacimiento:</strong> <?php echo "$dia/$mes/$anio"; ?></p>
        <p><strong>Hora de nacimiento:</strong> <?php echo $hora; ?></p>
        <p><strong>Signo zodiacal:</strong> <?php echo $signo; ?></p>
    </div>

    <?php if($tiene_pareja == 'si'): ?>
        <div class="section">
            <h3>💞 Tu Pareja</h3>
            <p><strong>Signo:</strong> <?php echo $signo_pareja; ?></p>
            <p><strong>Fecha de nacimiento:</strong> <?php echo "$dia_p/$mes_p/$anio_p"; ?></p>
        </div>
    <?php endif; ?>

    <div class="section">
        <h3>🔮 Predicción</h3>
        <p><?php echo $mensaje; ?></p>
    </div>

    <a href="index.html" class="btn">Volver al inicio</a>

</div>

</body>
</html>
