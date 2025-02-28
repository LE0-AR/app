<?php
// Incluir la conexión a la base de datos
include "../config/conexion.php";

if ($connect->connect_error) {
    die("Conexión fallida: " . $connect->connect_error);
}

// Consulta SQL solo con los datos de la tabla "productos"
$sql = "SELECT * FROM productos";
$result = $connect->query($sql);

// Definir la URL base para las imágenes y archivos
$base_url = "http://localhost/app/app/";
?>


<div class="container">
        <h1 class="titulo">Lista de Productos</h1>

        <div class="newProduct">
            <a type="button" class="btn btn-outline-primary" href="../Views/product.php">Nuevo Producto</a>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Sector</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Ficha Técnica</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['id']; ?></th>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['sector']; ?></td>
                        <td><?php echo $row['categoria']; ?></td>

                        <!-- Imagen principal -->
                        <td class="img">
                            <?php if (!empty($row['imagen_principal'])) { ?>
                                <img src="<?php echo $base_url . 'Control/' . $row['imagen_principal']; ?>" alt="Imagen Principal">
                            <?php } else { ?>
                                <span>Sin imagen</span>
                            <?php } ?>
                        </td>

                        <!-- Ficha técnica -->
                        <td>
                            <?php if (!empty($row['ficha_tecnica'])) { ?>
                                <a href="<?php echo $base_url . 'Control/' . $row['ficha_tecnica']; ?>" target="_blank" class="btn btn-outline-secondary">Ver Ficha</a>
                            <?php } else { ?>
                                <span>Sin ficha técnica</span>
                            <?php } ?>
                        </td>
                        <!-- Ver todos los detalles del producto -->
                        <td>
                            <a class="btn btn-outline-success">Detalles</a>
                        </td>
                        <!-- Acciones -->
                        <td>
                            <a href="../Views/EditarProduct.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-warning">Editar</a>
                            <a href="../Model/DeleteProduct.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>