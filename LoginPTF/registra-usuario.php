<?php 
$host_db  = "localhost";
$user_db  = "root";
$pass_db  = "admin";
$db_name  = "BDPrueba";
$tbl_name = "Usuarios";

$form_pass = $_POST['password'];

$hash = password_hash($form_pass, PASSWORD_BCRYPT);

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if($conexion->connect_error){
	die("La conexión falló: ". $conexion->connect_error);
}

$buscarUsuario = "SELECT * FROM $tbl_name WHERE nombre_usuario = '$_POST[username]' ";

$result = $conexion->query($buscarUsuario);

$count = mysqli_num_rows($result);

if ($count == 1) {
	echo "<br>". "El nombre de usuario ya ha sido tomado.". "<br>";
	echo "<a href = 'index.html'> Por favor escoja otro nombre</a>";
	}else{
		$query = "INSERT INTO Usuarios (nombre_usuario, password)
		VALUES ('$_POST[username]','$hash')";

		if ($conexion->query($query)===TRUE) {
			echo "<br>". "<h2>". "Usuario creado exitosamente"."</h2>";
			echo "<h4>"."Bienvenido ". $_POST['username']."</h4>"."<br><br>";
			echo "<h5>". "Hacer login: ". "<a href = 'login.html'>Login</a>". "</h5>";
		}else{
			echo "Error al crear el usuario.". $query. "<br>". $conexion->error;
		}
	}
	mysqli_close($conexion);

?>