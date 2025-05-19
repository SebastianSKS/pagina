<?php include 'includes/header.php'; ?>
<?php
$tipo = $_GET['tipo'];
$id = $_GET['id'];
$archivo = "data/{$tipo}.json";
$datos = json_decode(file_get_contents($archivo), true);
$elemento = $datos[$id];
?> 
<div class="tarjeta">
    <img src="uploads/<?php echo $elemento['imagen']; ?>" alt="">
    <h2><?php echo htmlspecialchars($elemento['nombre']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($elemento['descripcion'])); ?></p>
</div>
<?php include 'includes/footer.php'; ?>
