<?php
include("./cabecera.php");
include("conexion.php");

$sql="SELECT * FROM proyectos";
$result= $conn->query($sql);

if($result->num_rows>0){
    $proyectos=($result->fetch_all());

}else{
    $proyectos=array();
}

if(isset($_POST['name'])){
    $nombre=$_POST['name'];
    $description=$_POST['descripcion'];
    $tmp_name=$_FILES['archivo']['tmp_name'];
    
    $fecha= new DateTime();
    $nombreimg=$fecha->getTimestamp()."_".$_FILES['archivo']['name'];

    $sql="INSERT INTO proyectos(name,description,imagen)values('$nombre','$description','$nombreimg')";
    if($conn->query($sql)===true){

        move_uploaded_file($tmp_name,"./images/".$nombreimg);
        echo 'the insertion was made it succesfully';
        $_POST['name']=null;
        $_FILES['archivo']['name']=null;
        header("location:./portafolio.php");
    }else{
        echo 'something went wrong';
        $_POST['name']=null;
        $_FILES['archivo']['name']=null;
    }

}


if($_GET){

    if (isset($_GET['borrar'])) {
        $id_borrar = $_GET['borrar'];
        $sql1 = "SELECT imagen from proyectos WHERE id_proyecto='$id_borrar'";

        $imgname = $conn->query($sql1);

        if ($imgname->num_rows > 0) {

            $element = $imgname->fetch_row();
            unlink("./images/" . $element[0]);
        }

        $sql = "DELETE FROM proyectos WHERE id_proyecto='$id_borrar'";
        if ($conn->query($sql) === true) {
            echo 'element deleted correctly';
            header("location:./portafolio.php");
        } else {
            echo 'an error ocurred';
        }
    } else{

        $id_editar=$_GET['editar'];
        $sql="UPDATE proyectos SET status=1 WHERE id_proyecto='$id_editar'";

        if($conn->query($sql)===true){
            echo 'the edition was made it succesfully';
            header("location: ./portafolio.php");
        }else{
            echo 'an error ocurred';
        }
    }
    

}
    



?>
<h3>Hola <?php echo $_SESSION['user'] ?> este sería el Portafolio</h3>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-body">
                <p class="card-text">Inserta la info del proyecto</p>
                <form action="portafolio.php" method="post" enctype="multipart/form-data">
                    <label for="nombre">Nombre del proyecto:</label>
                    <input type="text" required class="form-control" name="name" id="nombre">
                    <br />
                    <label for="ctdescription">Descripción:</label>
                    <textarea name="descripcion" id="ctdescription" class="form-control" cols="30" rows="5"></textarea>
                    <br />
                    <label for="arch">Archivo:</label>
                    <input type="file" required class="form-control" name="archivo" id="arch">
                    <br />
                    <button class="btn btn-success" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($proyectos as $proyecto){
                ?>
                    <tr>
                        <th><?php echo $proyecto[0]; ?></th>
                        <th><?php echo $proyecto[1]; ?></th>
                        <th><?php echo $proyecto[2]; ?></th>
                        <th><img width="80vw" src="./images/<?php echo $proyecto[3]; ?>" alt="image of the project"></th>
                        <th>
                            <a class="btn btn-danger" href="?borrar=<?php echo $proyecto[0]; ?>">Delete</a>
                            <a class="btn btn-success my-1" href="?editar=<?php echo $proyecto[0]; ?>">Terminada</a>
                        </th>
                        <th><?php echo $proyecto[4]==1 ? 'Terminada' : 'No terminada'; ?> </th>
                    </tr>
                <?php
                    }
                ?>
                
            </tbody>
        </table>
    </div>
</div>
<?php
include("./pie.php");
?>