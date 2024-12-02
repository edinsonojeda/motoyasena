<?php


require "./head.php";

// El resto de tu código PHP debe ir después de session_start()
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
  header('Location: login.php');
  exit(); // Aquí no debería haber problemas si no hay salida previa.
}


?>
<h1 class="text-center uppercase text-3xl mb-5">administracion motoya</h1>

<div class="container lg:w-5/6 w-[95%] mx-auto mt-10 overflow-x-auto">
    <div class="justify-center flex md:justify-end ">
        <div class="bg-blue-800 mb-10 flex flex-col items-center text-white p-2 rounded-lg hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="2">
                <path d="M19 10h-14"></path>
                <path d="M5 6h14"></path>
                <path d="M14 14h-9"></path>
                <path d="M5 18h6"></path>
                <path d="M18 15v6"></path>
                <path d="M15 18h6"></path>
            </svg>
            <button id="btnPublicar" class="capitalize font-bold rounded-xl inline-block -mt-2 text-sm">crear publicacion</button>

            <ul id="listaDesplegable" class="mt-2 space-y-2 bg-white border border-gray-300 rounded shadow-lg hidden">
                <li><a href="./crud/crear.php" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Anuncio</a></li>
                <li><a href="./entradas.php" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Entrada de blog</a></li>

            </ul>
            <script>
                
                const btnPublicar = document.querySelector('#btnPublicar');
                const lista = document.querySelector('#listaDesplegable');

                
                btnPublicar.addEventListener('click', () => {
                    
                    lista.classList.toggle('hidden');
                });
            </script>
        </div>

    </div>
  <table class="w-full">
    <thead class="capitalize text-lg">
      <tr class="bg-stone-800 text-white ">
        <th class="py-2">ID</th>
        <th>MOTO</th>
        <th>MARCA</th>
        <th>MODELO</th>
        <th>PRECIO</th>
        <th>KM</th>
        <th>ESTADO</th>
        <th>color</th>
        <th>cilindraje</th>
        <th>acciones</th>
      </tr>
    </thead>

    <tbody class="border-x-2 border-stone-600 border-dashed">
      <?php 
      require '../../conexion.php';
      $sql = "SELECT * FROM publicacion";
      $result = mysqli_query( $conexion, $sql);
      if (mysqli_num_rows($result)>0) {
        while($row = mysqli_fetch_array($result)) {
          
      echo '<tr class="border-b-2 border-stone-600 border-dashed">';
        echo '<th>' . $row['id'] . '</th>';
        echo '<th>' . htmlspecialchars($row['nombre']) . '</th>';
        echo '<th>' . htmlspecialchars($row['marca']) . '</th>';
        echo '<th>' . htmlspecialchars($row['modelo']) . '</th>';
        echo '<th>' . number_format($row['precio']) . '</th>';
        echo '<th>' . htmlspecialchars($row['km']) . '</th>';
        echo '<th>' . htmlspecialchars($row['reseña']) . '</th>';
        echo '<th>' . htmlspecialchars($row['color']) . '</th>';
        echo '<th>' . htmlspecialchars($row['cilindraje']) . '</th>
        <th>
          <div class="flex flex-col text-white gap-2 w-2/3 mx-auto">
            <a href="./crud/actualizar.php?id=' . $row['id'] . ' " class="bg-blue-600 py-2 flex items-center justify-center rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="30" height="30" stroke-width="2">
  <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
  <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
</svg>
</a>

          <form action="./crud/eliminer.php" method="POST" style="display: inline;">
  <input type="hidden" name="id" value="' . $row['id'] . '">
  
  <!-- Botón con SVG -->
  <button class="bg-red-600 py-2 px-4 flex items-center justify-center space-x-2 text-white rounded-lg hover:bg-red-700 transition duration-200">
    <!-- SVG del ícono -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="30" height="30" stroke-width="2">
      <path d="M4 7l16 0"></path>
      <path d="M10 11l0 6"></path>
      <path d="M14 11l0 6"></path>
      <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
      <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
    </svg>
    <span></span>
  </button>
</form>

            
          </div>
        </th>';
      echo '</tr>';
        }
      } else {
        echo '<tr><th colspan="10" class="text-center border border-gray-300 px-4 py-2">No hay datos disponibles.</th></tr>';
      }
      mysqli_close($conexion);

      ?>
    </tbody>


  </table>
</div>
<?php
require "./footer.php";
?>
