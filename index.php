<?php
include("./cabecera.php");
include("conexion.php");

$sql = "SELECT * FROM proyectos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $proyectos = ($result->fetch_all());
} else {
    $proyectos = array();
}
?>

<div class="border my-3">
    <h3>Hola <?php echo $_SESSION['user'] ?>, estos son tus proyectos pendientes</h3>
</div>



<div class="row">
<?php
foreach ($proyectos as $proyecto) {
?>
    
        <div class="col-12 col-md-3">
            <div class="card m-2">
                <img  height="200rem" src="./images/<?php echo $proyecto[3]; ?>" class="card-img-top" alt="imagen del proyecto">
                <div class="card-body" style="background-color: <?php echo $proyecto[4]==0 ? '#F0BEC0' : '#A7FFEB'?>;">
                    <h5 class="card-title"><?php echo $proyecto[1]; ?></h5>
                    <p class="card-text"><?php echo $proyecto[2]; ?></p>
                    <h6><?php echo $proyecto[4]==0 ? 'No terminado...' : 'Terminado!'  ?></h6>
                </div>
            </div>
        </div>

<?php
}
?>
</div>

<?php
include("./pie.php");
?>