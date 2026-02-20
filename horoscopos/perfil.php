<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nombre = $_POST['nombre'] ?? '';
    $apellido_p = $_POST['apellido_p'] ?? '';
    $apellido_m = $_POST['apellido_m'] ?? '';
    $nick = $_POST['nick'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $paginas = $_POST['paginas'] ?? [];

    // Definir colores según género
    if($genero == "hombre"){
        $bgGradient = "linear-gradient(180deg, #000000 0%, #001f3f 40%, #000814 100%)";
        $cardColor = "rgba(0, 20, 40, 0.7)";
        $borderColor = "#0077b6";
        $accentColor = "#00b4d8";
        $titulo = "Perfil Cósmico Masculino 🚀";
    } else {
        $bgGradient = "linear-gradient(180deg, #000000 0%, #4c1a4f 40%, #0f001a 100%)";
        $cardColor = "rgba(60, 0, 80, 0.7)";
        $borderColor = "#c77dff";
        $accentColor = "#ff4d9d";
        $titulo = "Perfil Cósmico Femenino 🌙";
    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Perfil Registrado</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: <?php echo $bgGradient; ?>;
    color:white;
}

.card{
    width:100%;
    max-width:600px;
    padding:35px;
    border-radius:20px;
    background: <?php echo $cardColor; ?>;
    backdrop-filter: blur(10px);
    border:1px solid <?php echo $borderColor; ?>;
    box-shadow:0 20px 50px rgba(0,0,0,0.5);
}

h2{
    text-align:center;
    margin-bottom:25px;
    color: <?php echo $accentColor; ?>;
}

.info{
    margin:12px 0;
    padding:10px;
    border-bottom:1px solid rgba(255,255,255,0.1);
}

strong{
    color: <?php echo $accentColor; ?>;
}

.paginas{
    margin-top:15px;
}

button{
    display:block;
    margin:25px auto 0;
    padding:10px 20px;
    border:none;
    border-radius:25px;
    background: <?php echo $accentColor; ?>;
    color:white;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    transform:translateY(-3px);
    opacity:0.9;
}
</style>

</head>

<body>

<div class="card">
    <h2><?php echo $titulo; ?></h2>

    <div class="info"><strong>Nombre:</strong> <?php echo "$nombre $apellido_p $apellido_m"; ?></div>
    <div class="info"><strong>Nick:</strong> <?php echo $nick; ?></div>
    <div class="info"><strong>Correo:</strong> <?php echo $correo; ?></div>
    <div class="info"><strong>Género:</strong> <?php echo ucfirst($genero); ?></div>

    <div class="paginas">
        <strong>Páginas donde consulta su horóscopo:</strong><br>
        <?php
        if(!empty($paginas)){
            foreach($paginas as $pagina){
                echo "✨ " . $pagina . "<br>";
            }
        } else {
            echo "No seleccionó ninguna página.";
        }
        ?>
    </div>

    <button onclick="window.location.href='index.html'">Volver al inicio</button>
</div>

</body>
</html>
