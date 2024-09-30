<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_apellidos = $_POST['nombre_apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $ocupacion = $_POST['ocupacion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $nacionalidad = $_POST['nacionalidad'];
    $nivel_ingles = $_POST['nivel_ingles'];
    $lenguajes_programacion = implode(", ", $_POST['lenguajes_programacion']);
    $aptitudes = $_POST['aptitudes'];
    $habilidades = implode(", ", $_POST['habilidades']);
    $perfil = $_POST['perfil'];

    $sql = "INSERT INTO user_info (nombre_apellidos, fecha_nacimiento, ocupacion, telefono, email, nacionalidad, nivel_ingles, lenguajes_programacion, aptitudes, habilidades, perfil) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $nombre_apellidos, $fecha_nacimiento, $ocupacion, $telefono, $email, $nacionalidad, $nivel_ingles, $lenguajes_programacion, $aptitudes, $habilidades, $perfil);

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;

        if (isset($_POST['experiencia']) && is_array($_POST['experiencia'])) {
            $exp_sql = "INSERT INTO experiencia (user_id, titulo, descripcion) VALUES (?, ?, ?)";
            $exp_stmt = $conn->prepare($exp_sql);
            foreach ($_POST['experiencia'] as $exp) {
                $exp_stmt->bind_param("iss", $user_id, $exp['titulo'], $exp['descripcion']);
                $exp_stmt->execute();
            }
            $exp_stmt->close();
        }

        if (isset($_POST['formacion']) && is_array($_POST['formacion'])) {
            $form_sql = "INSERT INTO formacion (user_id, titulo, descripcion) VALUES (?, ?, ?)";
            $form_stmt = $conn->prepare($form_sql);
            foreach ($_POST['formacion'] as $form) {
                $form_stmt->bind_param("iss", $user_id, $form['titulo'], $form['descripcion']);
                $form_stmt->execute();
            }
            $form_stmt->close();
        }

        if (isset($_POST['idiomas']) && is_array($_POST['idiomas'])) {
            $idiom_sql = "INSERT INTO idiomas (user_id, idioma, nivel) VALUES (?, ?, ?)";
            $idiom_stmt = $conn->prepare($idiom_sql);
            foreach ($_POST['idiomas'] as $idiom) {
                $idiom_stmt->bind_param("iss", $user_id, $idiom['titulo'], $idiom['descripcion']);
                $idiom_stmt->execute();
            }
            $idiom_stmt->close();
        }

        echo "Datos guardados correctamente. <a href='display_cv.php?id=" . $user_id . "'>Ver CV</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>