<?php
// Iniciar la sesión
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="/src/output.css">
</head>

<body class="bg-gray-200 flex items-center justify-center min-h-screen">

  <!-- Fondo desenfocado -->
  <div class="absolute inset-0 bg-black opacity-40 z-0"></div>

  <!-- Contenedor principal -->
  <div class="bg-white p-8 rounded-lg shadow-lg w-96 mx-auto mt-20 z-10 relative">

    <!-- Título de la sección -->
    <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800 ">Iniciar Sesión</h2>

    <!-- Formulario de inicio de sesión -->
    <form action="login.php" method="POST">

      <!-- Campo de correo electrónico -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
        <input type="email" id="email" name="email" class="w-full px-4 py-2 mt-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300" placeholder="correo@gmail.com" required>
      </div>

      <!-- Campo de contraseña -->
      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
        <input type="password" id="password" name="password" class="w-full px-4 py-2 mt-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300" placeholder="**********" required>
      </div>

      <!-- Botón de inicio de sesión con animación -->
      <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-700 transform transition-all duration-300 hover:scale-105">
        Iniciar Sesión
      </button>

    </form>

    <!-- Enlace para recuperar contraseña -->
    <div class="mt-4 text-center">
      <p class="text-sm text-gray-600">¿Olvidaste tu contraseña? <a href="#" class="text-blue-500 hover:underline">Haz clic aquí</a></p>
    </div>

    <!-- Mensaje de error si la autenticación falla -->
    <?php  
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = '';
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            require '../../conexion.php';
            $sql = "SELECT * FROM usuarios WHERE correo='$email' ";
            $consulta = mysqli_query($conexion, $sql);
            $resul = mysqli_fetch_assoc($consulta);

            $usuario = $resul['correo'];
            $contra = $resul['contraseña'];
            $nombre = $resul['nombre'];
        } catch (\Throwable $th) {
            echo ($th);
        }

        // Verificar si el usuario y la contraseña coinciden
        if (isset($usuario) && $contra === $password) {
            $_SESSION['login'] = true;
            $_SESSION['nombre'] = $nombre;
            header('Location: ./main.php');
            exit();
        } else {
            $error = 'Correo o contraseña incorrectos';
            ?>
            <div class="bg-red-100 text-red-600 p-4 mb-4 border border-red-400 rounded w-1/3 mx-auto mt-4">
                <?php echo $error; ?>
            </div>
            <?php
        }
    }
    ?>

  </div>

</body>

</html>
