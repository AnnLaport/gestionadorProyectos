<?php

include("conexion.php");

if (isset($_POST['user'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM usuarios WHERE username='$user' AND contrasenia='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        session_start();
        $_SESSION['user']=$user;
        $_SESSION['password']=$password;
        header("location: ./index.php");    
    }else{
        echo "<script type='text/javascript'>alert('The user or password doesnt belong to an account');</script>"; 
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Inicio de sesión</title>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-12"></div>
            <div class="col-md-4 col-12">
                <div class="card my-3" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-text">Inicio de sesión</p>
                        <form action="./login.php" method="post">
                            <label for="user">Usuario:</label>
                            <input type="text" class="form-control" name="user" id="user">
                            <br />
                            <label for="password">Contrasenia:</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <button type="submit" class="btn btn-success mt-3">Press here</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12"></div>

        </div>
    </div>

</head>

<body>

</body>

</html>