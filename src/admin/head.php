<?php       
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/src/output.css">
</head>
<body class="bg-gray-100">
  <!-- Barra de navegación -->
  <nav class="flex justify-between items-center bg-blue-600 p-4 text-white text-2xl">
  
    <!-- Logo o imagen -->
    <div>
      <img src="/path/to/your/logo.png" alt="logo motoya" class="h-10">
    </div> 

    <!-- Usuario Logueado -->
    <div>
      <?php 
      if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
      ?>
      <p>Usuario: <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
      <?php 
      }
      ?>
    </div>

    <!-- Botón de Logout o Redirección -->
    <div>
      <?php 
      if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        if (isset($crud)) {
         
          echo '<a href="../main.php" class="text-white hover:text-gray-300 transition duration-300">';
          echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="60" height="60" stroke-width="2"> <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"></path> <path d="M15 14v-2a2 2 0 0 0 -2 -2h-4l2 -2m0 4l-2 -2"></path> </svg>';
          echo '</a>';
        } else {
         
          echo '<a href="./logout.php" class="text-white hover:text-gray-300 transition duration-300">';
          echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="60" height="60" stroke-width="2"> <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"></path> <path d="M15 14v-2a2 2 0 0 0 -2 -2h-4l2 -2m0 4l-2 -2"></path> </svg>';
          echo '</a>';
        }
      }
      ?>
    </div>

  </nav>

</body>
</html>
