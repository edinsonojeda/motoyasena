<?php
$crud=true;
require "../head.php";

// El resto de tu código PHP debe ir después de session_start()
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
  header('Location: ../login.php');
  exit(); // Aquí no debería haber problemas si no hay salida previa.
}

try {
    require "../../../conexion.php";
    $sql = "SELECT * FROM marcas";
    $consulta = mysqli_query($conexion, $sql);
} catch (\Throwable $th) {
    echo $th;
}

$marcaId = '';
?>

<div class="container mx-auto px-4 py-10">
    <form class="max-w-3xl mx-auto bg-gradient-to-br from-purple-600 via-blue-500 to-indigo-600 p-8 rounded-lg shadow-md border-2 border-gray-200" method="POST" action="" enctype="multipart/form-data">
        <!-- Información general de la moto -->
        <fieldset class="mb-8">
            <legend class="text-2xl font-semibold text-center text-white uppercase italic mb-5">Información general de la moto</legend>

            <label for="nombre" class="block text-lg font-medium text-white mb-2">Moto</label>
            <input type="text" id="nombre" name="nombre" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nombre de la moto" required>

            <label for="marca" class="block text-lg font-medium text-white mt-5 mb-2">Marca</label>
            <select name="marca" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>-- Seleccione --</option>
                <?php while ($marca = mysqli_fetch_assoc($consulta)) : ?>
                    <option value="<?php echo $marca['id']; ?>" <?php echo $marcaId === $marca['id'] ? 'selected' : ''; ?>>
                        <?php echo $marca['marca']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="precio" class="block text-lg font-medium text-white mt-5 mb-2">Precio</label>
            <input type="number" id="precio" name="precio" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Valor de la moto" required>

            <label for="imagen" class="block text-lg font-medium text-white mt-5 mb-2">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/webp" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

            <label for="reseña" class="block text-lg font-medium text-white mt-5 mb-2">Reseña</label>
            <textarea name="reseña" id="reseña" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Reseña de la moto"></textarea>
        </fieldset>

        <!-- Información específica de la moto -->
        <fieldset class="mb-8">
            <legend class="text-2xl font-semibold text-center text-white uppercase italic mb-5">Información específica de la moto</legend>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="cilindraje" class="block text-lg font-medium text-white mb-2">Cilindraje</label>
                    <input type="text" id="cilindraje" name="cilindraje" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cilindraje">

                    <label for="frenos" class="block text-lg font-medium text-white mt-5 mb-2">Frenos</label>
                    <input type="text" id="frenos" name="frenos" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Frenos">

                    <label for="torque" class="block text-lg font-medium text-white mt-5 mb-2">Torque</label>
                    <input type="text" id="torque" name="torque" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Torque máximo">
                </div>

                <div>
                    <label for="potencia" class="block text-lg font-medium text-white mb-2">Potencia</label>
                    <input type="text" id="potencia" name="potencia" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Potencia máxima">

                    <label for="encendido" class="block text-lg font-medium text-white mt-5 mb-2">Encendido</label>
                    <input type="text" id="encendido" name="encendido" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tipos de encendido">

                    <label for="color" class="block text-lg font-medium text-white mt-5 mb-2">Color</label>
                    <input type="text" id="color" name="color" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Color">
                </div>
            </div>

            <label for="km" class="block text-lg font-medium text-white mt-5 mb-2">KM</label>
            <input type="text" id="km" name="km" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kilómetros recorridos">

            <label for="modelo" class="block text-lg font-medium text-white mt-5 mb-2">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="w-full p-3 border-2 border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Modelo de la moto">
        </fieldset>

        <div class="flex justify-end mt-10">
            <input type="submit" value="Crear publicación" class="bg--500 py-3 px-8 text-white uppercase font-semibold rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300 cursor-pointer">
        </div>
    </form>
</div>

<?php 
require "../../../conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica si los datos están definidos
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $marcaId = mysqli_real_escape_string($conexion, $_POST['marca']);
    $precio = isset($_POST['precio']) ? $_POST['precio'] : 0;
    $reseña = isset($_POST['reseña']) ? $_POST['reseña'] : '';
    $cilindraje = isset($_POST['cilindraje']) ? $_POST['cilindraje'] : '';
    $frenos = isset($_POST['frenos']) ? $_POST['frenos'] : '';
    $torque = isset($_POST['torque']) ? $_POST['torque'] : '';
    $potencia = isset($_POST['potencia']) ? $_POST['potencia'] : '';
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
    $encendido = isset($_POST['encendido']) ? $_POST['encendido'] : '';
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    $km = isset($_POST['km']) ? $_POST['km'] : '';
    
    // Subida de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $imagen_name = $_FILES['imagen']['name'];
        $ruta_imagen = "./img/" . basename($imagen_name);
        move_uploaded_file($imagen_tmp, $ruta_imagen); // Mover la imagen al directorio adecuado
    } else {
        $ruta_imagen = ''; // Si no hay imagen, dejar vacío
    }

    // Verificar si los campos numéricos como 'precio' no están vacíos
    if ($precio == 0) {
        die("Error: El precio no puede estar vacío o ser 0.");
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO publicacion (nombre, marca, precio, imagen, reseña, cilindraje, frenos, potencia, torque, encendido, modelo, km, color) 
            VALUES ('$nombre', '$marcaId', '$precio', '$ruta_imagen', '$reseña', '$cilindraje', '$frenos', '$potencia', '$torque', '$encendido', '$modelo', '$km', '$color')";

    if (mysqli_query($conexion, $sql)) {
        echo "<p class='text-green-500 text-center mt-5'>¡Publicación creada con éxito!</p>";
    } else {
        echo "<p class='text-red-500 text-center mt-5'>Error: " . mysqli_error($conexion) . "</p>";
    }
}

mysqli_close($conexion);
?>
