<?php
require_once 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID no especificado");
}
$user_id = intval($_GET['id']);

$sql = "SELECT * FROM user_info WHERE id = $user_id"; // Todos los campos del usuario
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("Usuario no encontrado");
}

$user = $result->fetch_assoc(); // Array asociativo (recupera una fila)

$sql = "SELECT * FROM experiencia WHERE user_id = $user_id"; 
$result = $conn->query($sql);
$experiencia = $result->fetch_all(MYSQLI_ASSOC); // Recupera todas las filas que coinciden con el ID

$sql = "SELECT * FROM formacion WHERE user_id = $user_id"; 
$result = $conn->query($sql);
$formacion = $result->fetch_all(MYSQLI_ASSOC); 

$sql = "SELECT * FROM idiomas WHERE user_id = $user_id"; 
$result = $conn->query($sql);
$idiomas = $result->fetch_all(MYSQLI_ASSOC); 

$conn->close(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - <?php echo $user['nombre_apellidos']; ?></title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="cv-container">
        <header>
            <div class="image-container">
                <img src="assets/perfil.jfif" alt="<?php echo $user['nombre_apellidos']; ?>">
            </div>
            <div class="header-text">
                <h1><?php echo $user['nombre_apellidos']; ?></h1>
                <p><?php echo $user['ocupacion']; ?></p>
            </div>
        </header>
        <main>
            <aside class="lateral">
                <section>
                    <h2>CONTACTO</h2>
                    <p><img src="assets/telefono.png" alt="Teléfono"> <?php echo $user['telefono']; ?></p>
                    <p><img src="assets/correo.png" alt="Email"> <?php echo $user['email']; ?></p>
                    <p><img src="assets/gps.png" alt="Nacionalidad"> <?php echo $user['nacionalidad']; ?></p>
                </section>
                <section>
                    <h2>IDIOMAS</h2>
                    <p>Español: Nativo</p>
                    <p>Inglés: <?php echo ucfirst($user['nivel_ingles']); ?></p>
                    <?php 
                    foreach ($idiomas as $idioma) {
                        echo '<p>' . ucfirst($idioma['idioma']) . ': ' . ucfirst($idioma['nivel']) . '</p>';
                    }
                    ?>
                </section>
                <section>
                    <h2>APTITUDES</h2>
                    <p><?php echo $user['aptitudes']; ?></p>
                </section>
                <section>
                    <h2>HABILIDADES</h2>
                    <ul>
                        <?php
                        $habilidades = explode(", ", $user['habilidades']);
                        foreach ($habilidades as $habilidad) {
                            echo "<li>$habilidad</li>";
                        }
                        ?>
                    </ul>
                </section>
            </aside>
            <div class="contenido">
                <section>
                    <h2>PERFIL</h2>
                    <p><?php echo $user['perfil']; ?></p>
                </section>
                <section>
                    <h2>EXPERIENCIA LABORAL</h2>
                    <?php 
                    foreach ($experiencia as $exp) {
                        // echo '<h3>' . $exp['titulo'] . ' | <span class="año">'. $exp['inicio'] .' - '. $exp['fin'].'</span></h3> '; 
                        echo '<h3>' . $exp['titulo'] . '</h3>';
                        echo '<p><b>' . $exp['lugar'] .'</b> | <span class="año">'. $exp['inicio'] .' - '. $exp['fin'].'</span></p> '; 
                        echo '<p>' . nl2br($exp['descripcion']) . '</p>';
                    }
                    ?>
                </section>
                <section>
                    <h2>FORMACIÓN</h2>
                    <?php 
                    foreach ($formacion as $form) {
                        // echo '<h3>' . $form['titulo'] . ' | '. $form['inicio'] .' - '. $form['fin'] . '</h3>';
                        echo '<h3>' . $form['titulo'] . '</h3>';
                        echo '<p><b>' . $form['lugar'] .'</b> | <span class="año">'. $form['inicio'] .' - '. $form['fin'].'</span></p> '; 
                        echo '<p>' . nl2br($form['descripcion']) . '</p>';
                    }
                    ?>
                </section>
                <section>
                    <h2>LENGUAJES DE PROGRAMACIÓN</h2>
                    <ul>
                    <?php
                        $lenguajes = explode(", ", $user['lenguajes_programacion']);
                        foreach ($lenguajes as $lenguaje) {
                            echo "<li>$lenguaje</li>";
                        }
                        ?>
                    </ul>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
