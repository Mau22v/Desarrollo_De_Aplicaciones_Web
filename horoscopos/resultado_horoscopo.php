<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // ===================== MODO =====================
    $modo = $_POST['modo'] ?? 'personal';

    // ===================== DATOS USUARIO =====================
    $nombre = $_POST['nombre'] ?? 'Viajero Cósmico';
    $hora = $_POST['hora'] ?? '';
    $dia = intval($_POST['dia'] ?? 1);
    $mes = intval($_POST['mes'] ?? 1);
    $anio = intval($_POST['anio'] ?? 2000);
    $emocion = $_POST['emocion'] ?? 'feliz';

    // Perfil personal
    $personalidad = $_POST['personalidad'] ?? 'equilibrado';
    $busqueda = $_POST['busqueda'] ?? 'amor';
    $estres = $_POST['estres'] ?? 'medio';
    $intuicion = $_POST['intuicion'] ?? 'a_veces';
    $elemento = $_POST['elemento'] ?? 'aire';

    // Contexto (solo modo personal)
    $finanzas = $_POST['finanzas'] ?? 'regular';
    $laboral = $_POST['laboral'] ?? 'empleado';
    $enfermedades = $_POST['enfermedades'] ?? '';
    $conexion = $_POST['conexion'] ?? 'ninguna';


    // ===================== SIGNO ZODIACAL =====================
    function obtenerSigno($dia, $mes) {
        $signos = [
            ['Capricornio', 20, 1], ['Acuario', 19, 2], ['Piscis', 20, 3],
            ['Aries', 20, 4], ['Tauro', 21, 5], ['Géminis', 21, 6],
            ['Cáncer', 22, 7], ['Leo', 23, 8], ['Virgo', 23, 9],
            ['Libra', 23, 10], ['Escorpio', 22, 11], ['Sagitario', 21, 12],
            ['Capricornio', 31, 12]
        ];

        foreach($signos as $s){
            if($mes == $s[2] && $dia <= $s[1]){
                return $s[0];
            }
        }

        $mes_anterior = $mes - 1;
        if($mes_anterior < 1) $mes_anterior = 12;

        return $signos[$mes_anterior][0];
    }

    $signo = obtenerSigno($dia, $mes);


    // ===================== DATOS PAREJA =====================
    $signo_pareja = null;

    if($modo == "compatibilidad"){
        $nombre_pareja = $_POST['nombre_pareja'] ?? '';
        $dia_p = intval($_POST['dia_pareja'] ?? 1);
        $mes_p = intval($_POST['mes_pareja'] ?? 1);
        $anio_p = intval($_POST['anio_pareja'] ?? 2000);

        $signo_pareja = obtenerSigno($dia_p, $mes_p);
    }


    // ===================== GENERADOR DE PREDICCIÓN =====================
    function generarPrediccion($finanzas, $laboral, $enfermedades,
                               $personalidad, $busqueda,
                               $estres, $intuicion, $elemento){

        $mensaje = "Las energías cósmicas revelan que ";

        // Personalidad
        if($personalidad == "introvertido")
            $mensaje .= "tu mundo interior será tu mayor guía. ";
        elseif($personalidad == "extrovertido")
            $mensaje .= "las conexiones sociales abrirán nuevos caminos. ";
        else
            $mensaje .= "el equilibrio será tu mayor fortaleza. ";

        // Búsqueda
        switch($busqueda){
            case "amor":
                $mensaje .= "el amor estará presente en decisiones importantes. ";
                break;
            case "estabilidad":
                $mensaje .= "buscarás seguridad y estabilidad emocional. ";
                break;
            case "crecimiento":
                $mensaje .= "vivirás un fuerte crecimiento personal. ";
                break;
            case "dinero":
                $mensaje .= "las oportunidades económicas aparecerán gradualmente. ";
                break;
        }

        // Estrés
        if($estres == "alto")
            $mensaje .= "deberás cuidar tu energía mental. ";
        elseif($estres == "bajo")
            $mensaje .= "tu tranquilidad atraerá buenas vibraciones. ";

        // Intuición
        if($intuicion == "siempre")
            $mensaje .= "tu intuición será sorprendentemente precisa. ";

        // Elemento
        $mensaje .= "El elemento $elemento influirá fuertemente en tu destino. ";

        // Finanzas
        if($finanzas == "mala")
            $mensaje .= "Evita riesgos financieros. ";
        elseif($finanzas == "buena")
            $mensaje .= "La prosperidad tocará tu puerta. ";

        // Trabajo
        if($laboral == "desempleado")
            $mensaje .= "Una nueva oportunidad laboral se aproxima. ";

        // Salud
        if(!empty($enfermedades))
            $mensaje .= "Presta atención a tu bienestar físico. ";

        return $mensaje;
    }


    $mensaje = generarPrediccion(
        $finanzas,
        $laboral,
        $enfermedades,
        $personalidad,
        $busqueda,
        $estres,
        $intuicion,
        $elemento
    );


    // ===================== COMPATIBILIDAD =====================
    if($modo == "compatibilidad" && $signo_pareja){
        $mensaje .= " La conexión entre $signo y $signo_pareja muestra una energía ";
        
        if($signo == $signo_pareja)
            $mensaje .= "muy intensa y espejo emocional.";
        else
            $mensaje .= "complementaria llena de aprendizajes.";
    }

} else {
    header("Location: index.html");
    exit();
}
?>