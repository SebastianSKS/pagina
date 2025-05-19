<?php include 'includes/header.php'; ?>
<section class="contenido">
    <h2>Miembros</h2>

    <?php
    $archivo = "data/miembros.json";
    if (!file_exists($archivo)) file_put_contents($archivo, "[]");

    $datos = json_decode(file_get_contents($archivo), true);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_FILES['imagen']['name'];
        $tmp = $_FILES['imagen']['tmp_name'];
        $ruta = "uploads/" . basename($imagen);

        // Crear carpeta si no existe
        if (!is_dir("uploads")) {
            mkdir("uploads", 0755, true);
        }

        // Validar y mover imagen
        if (move_uploaded_file($tmp, $ruta)) {
            $datos[] = [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'imagen' => $imagen
            ];
            file_put_contents($archivo, json_encode($datos, JSON_PRETTY_PRINT));
            header("Location: miembros.php");
            exit;
        } else {
            echo "<p style='color:red;'>Error al subir la imagen. Verifica los permisos de la carpeta.</p>";
        }
    }

    // Mostrar miembros
    foreach ($datos as $index => $item) {
        echo "<div class='tarjeta'>";
        echo "<a href='detalle.php?tipo=miembros&id=$index'>";
        echo "<img src='uploads/" . htmlspecialchars($item['imagen']) . "' alt='' style='width:150px;height:auto;'>";
        echo "<h2>" . htmlspecialchars($item['nombre']) . "</h2>";
        echo "</a></div>";
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <textarea name="descripcion" placeholder="Descripción" required></textarea>
        <input type="file" name="imagen" accept="image/*" required>
        <input type="submit" value="Agregar">
    </form>
</section>
<?php include 'includes/footer.php'; ?>


