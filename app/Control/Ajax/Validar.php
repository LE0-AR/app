<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    // Consulta solo el usuario para obtener el hash de la contraseña
    $sql = "SELECT * FROM usuario WHERE usuario = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hash_guardado = $user['password']; // Recuperamos el hash de la base de datos

        // Comparamos la contraseña ingresada con el hash almacenado
        if (password_verify($password, $hash_guardado)) {
            session_start();
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['rol'] = $user['rol'];

            // Validación de rol
            if ($_SESSION['rol'] == 'Admin') {
                echo "<script> 
                    swal({
                        title: 'Bienvenido Administrador',
                        text: 'Acceso correcto',
                        icon: 'success',
                        timer: 1000,
                        buttons: false
                    }).then(function() {
                        window.location.href = 'app/';
                    });
                </script>";
            } else if ($_SESSION['rol'] == 'User') {
                echo "<script> 
                    swal({
                        title: 'Bienvenido Usuario',
                        text: 'Acceso correcto',
                        icon: 'success',
                        timer: 1000,
                        buttons: false
                    }).then(function() {
                        window.location.href = 'app/Views/user/';
                    });
                </script>";
            }
        } else {
            echo "<script> 
                swal({
                    title: 'Error',
                    text: 'Contraseña incorrecta',
                    icon: 'error'
                });
            </script>";
        }
    } else {
        echo "<script> 
            swal({
                title: 'Error',
                text: 'Usuario no encontrado',
                icon: 'error'
            });
        </script>";
    }

    $stmt->close();
    $connect->close();
}
