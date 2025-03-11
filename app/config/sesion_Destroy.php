<?php
session_start(); // Iniciar la sesión antes de destruirla

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la cookie de sesión si existe
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Destruir la sesión
session_destroy();

// Redireccionar al login con mensaje
echo "<script>
    alert('Sesión cerrada correctamente');
    window.location.href = '../../../index.php';
</script>";
?>