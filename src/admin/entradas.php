<?php 
$crud=true;
require './head.php';


// El resto de tu código PHP debe ir después de session_start()
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: ../login.php');
    exit(); // Aquí no debería haber problemas si no hay salida previa.
  }
  

  $alerta = [];

  $titulo = '';
  $parrafo = '';
  $contenido = '';
  $pieImagen='';
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
      require '../../conexion.php';
      $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
      $parrafo = mysqli_real_escape_string($conexion, $_POST['parrafo_entrada']);
      $contenido = mysqli_real_escape_string($conexion, $_POST['contenido']);
      $pieImagen= mysqli_real_escape_string($conexion, $_POST['pieImagen']);
      $imagen = $_FILES['imagen'];
     
      $autor=$_SESSION['nombre'];
      var_dump($autor);
  
  
      $medida = 1000 * 1000;
  
      if ($imagen['size'] > $medida) {
          $errores[] = 'La Imagen debe ser menor a ' . $medida . ' kb';
      }
  
      if (!$titulo) {
          $alerta[] = "falta añadir un titulo";
      }
      if (!$parrafo) {
          $alerta[] = "falta añadir parrafo de entrada";
      }
  
      if (!$contenido) {
          $alerta[] = 'aun no has creado el contenido del blog';
      }
  
      if (!$pieImagen) {
          $alerta[] = 'Debes añadir un pie de imagen';
      }
      if (!$imagen['name'] || $imagen['error']) {
          $alerta[] = 'La Imagen es Obligatoria';
      }
  
      $carpetaBlog = '../../blog/';
  
      if (!is_dir($carpetaBlog)) {
          mkdir($carpetaBlog);
      }
  
      $nombreImagen = md5(uniqid(rand(), true)) . ".webp";
  
      move_uploaded_file($imagen['tmp_name'], $carpetaBlog . $nombreImagen);
  
      if (empty($alerta)) {
          try {
  
  
              $sql = "INSERT INTO blog (titulo, parrafo, contenido, pieImagen, imagen, autor) VALUES('$titulo', '$parrafo','$contenido','$pieImagen', '$nombreImagen', '$autor');";
              $consulta = mysqli_query($conexion, $sql);
           
              if ($consulta) {
                  header('Location: ./main.php');
              }
          } catch (\Throwable $th) {
              echo $th;
          }
      }
  }
  
  
  ?>

<div class="container w-5/6 mx-auto">
    <?php foreach ($alerta as $error): ?>
        <div class="bg-red-600 text-white text-center">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="my-10 capitalize border-2 border-gray-600 bg-white py-5 px-10 border-solid" method="POST" action="" enctype="multipart/form-data">
        <legend class="text-center md:text-xl uppercase italic text-stone-600 mb-10">Escriba su blog</legend>
        <fieldset class="flex flex-col ">
            <label class="text-lg font-bold capitalize" for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" placeholder="titulo del blog" value="<?php echo $titulo ?>" class="border-b-2 border-solid border-gray-100 placeholder:text-gray-300 italic mt-1 p-2">

            <label class="text-lg font-bold capitalize mt-10" for="parrafo_entrada">Parrafo de Entrada</label>
            <textarea class="w-full min-h-36 bg-white border-2 rounded-sm text-xl text-gray-700 focus:outline-none p-2" name="parrafo_entrada" id="parrafo_entrada"><?php echo $parrafo ?></textarea>


            <label class="text-lg font-bold capitalize mt-10" for="contenido">Contenido del blog</label>
            <textarea class="w-full min-h-64 bg-white border-2 rounded-sm text-xl text-gray-700 focus:outline-none p-2" name="contenido" id="contenido"> <?php echo $contenido ?> </textarea>

            <label class="text-lg font-bold capitalize mt-10" for="pieImagen">Pie de Imagen</label>
            <input type="text" id="pieImagen" name="pieImagen" placeholder="agrega un pie de imagen" value="<?php echo $pieImagen ?>" class="border-b-2 border-solid border-gray-100 placeholder:text-gray-300 italic mt-1 p-2">

            <label class="text-lg font-bold capitalize mt-10" for="imagen">Cargar Imagen</label>
            <input type="file" name="imagen" id="imagen" accept="image/webp">
        </fieldset>

        <div class="my-10 flex justify-end gap-3">
            <a href="./main.php" class="bg-red-600 py-2 px-5 text-white uppercase font-bold rounded-lg">Cancelar</a>
            <input type="submit" value="Guardar" class="bg-blue-700 py-2 px-5 text-white uppercase font-bold rounded-lg">
        </div>
    </form>

</div>




<?php
