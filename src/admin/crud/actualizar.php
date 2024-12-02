<?php 
$crud=true;
require '../../../conexion.php';
require '../head.php';

// El resto de tu código PHP debe ir después de session_start()
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
  header('Location: ../login.php');
  exit(); // Aquí no debería haber problemas si no hay salida previa.
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM publicacion WHERE id = $id";
    $result = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($result);
    if (!$row) {
        echo 'Anuncio no encontrado';
        exit;
    }
?>

<div class="container w-4/6 mx-auto">
<form class="mt-10" method="POST" action="">
    <fieldset class="flex flex-col justify-between ">
        <legend class="text-center text-xl uppercase italic text-stone-60">Información general de la moto</legend>
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        
        <label class="text-lg font-bold capitalize " for="nombre">Moto</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre de la moto" value="<?php echo htmlspecialchars($row['nombre'])?>">

        <legend class="text-lg font-bold capitalize mt-5">Marca</legend>
        <input name="marca" value="<?php echo htmlspecialchars($row['marca']) ?>">

        <label class="text-lg font-bold capitalize mt-5" for="precio">Precio</label>
        <input type="number" id="precio" name="precio" placeholder="Valor de la moto" value="<?php echo htmlspecialchars($row['precio'])?>">

        <label class="text-lg font-bold capitalize mt-5" for="reseña">Reseña</label>
        <input name="reseña" id="reseña" value="<?php echo htmlspecialchars($row['reseña'])?>">
    </fieldset>

    <fieldset class="flex justify-between w-full gap-5">
        <legend class="text-center text-xl uppercase italic text-stone-60">Información específica de la moto</legend>

        <div class="flex flex-col justify-start w-full bg-sky-100">
            <label class="text-lg font-bold capitalize mt-5" for="cilindraje">Cilindraje</label>
            <input type="text" id="cilindraje" name="cilindraje" placeholder="Cilindraje" value="<?php echo htmlspecialchars($row['cilindraje'])?>">

            <label class="text-lg font-bold capitalize mt-5" for="frenos">Frenos</label>
            <input type="text" id="frenos" name="frenos" placeholder="Frenos" value="<?php echo htmlspecialchars($row['frenos'])?>">

            <label class="text-lg font-bold capitalize mt-5" for="torque">Torque</label>
            <input type="text" id="torque" name="torque" placeholder="Torque máximo" value="<?php echo htmlspecialchars($row['torque'])?>">

            <label class="text-lg font-bold capitalize mt-5" for="potencia">Potencia</label>
            <input type="text" id="potencia" name="potencia" placeholder="Potencia máxima" value="<?php echo htmlspecialchars($row['potencia'])?>">

            <label class="text-lg font-bold capitalize mt-5" for="encendido">Encendido</label>
            <input type="text" id="encendido" name="encendido" placeholder="Tipos de encendido" value="<?php echo htmlspecialchars($row['encendido'])?>">
        </div>

        <div class="flex flex-col justify-start w-full bg-sky-100">
            <label class="text-lg font-bold capitalize mt-5" for="color">Color</label>
            <input type="text" id="color" name="color" placeholder="Color" value="<?php echo htmlspecialchars($row['color'])?>">

            <label class="text-lg font-bold capitalize mt-5" for="km">KM</label>
            <input type="text" id="km" name="km" placeholder="KM" value="<?php echo htmlspecialchars($row['km'])?>"> 

            <label class="text-lg font-bold capitalize mt-5" for="modelo">Modelo</label>
            <input type="text" id="modelo" name="modelo" placeholder="Modelo" value="<?php echo htmlspecialchars($row['modelo'])?>"> 
        </div>
    </fieldset>

    <div class="my-10 flex justify-end">
        <input type="submit" value="Actualizar publicación" class="bg-blue-700 py-2 px-5 text-white uppercase font-bold rounded-lg">
    </div>
</form>
</div>

<?php 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $reseña = $_POST['reseña'];
    $cilindraje = $_POST['cilindraje'];
    $frenos = $_POST['frenos'];
    $torque = $_POST['torque'];
    $potencia = $_POST['potencia'];
    $modelo = $_POST['modelo'];
    $encendido = $_POST['encendido'];
    $color = $_POST['color'];
    $km = $_POST['km'];

    // Actualizar el registro
    $sql = "UPDATE publicacion SET nombre='$nombre', marca='$marca', precio='$precio', reseña='$reseña', cilindraje='$cilindraje', frenos='$frenos', torque='$torque', encendido='$encendido', modelo='$modelo', km='$km', color='$color' WHERE id=$id";

    if (mysqli_query($conexion, $sql)) {
        header('Location: ../main.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
