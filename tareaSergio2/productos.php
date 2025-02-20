<?php
session_start();
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [
        1 => ["nombre" => "Laptop", "precio" => 1200, "categoria" => "Electrónica"],
        2 => ["nombre" => "Smartphone", "precio" => 800, "categoria" => "Electrónica"],
        3 => ["nombre" => "Tablet", "precio" => 500, "categoria" => "Electrónica"],
        4 => ["nombre" => "Smart Tv", "precio" => 9000, "categoria" => "Electrónica"],
    ];
}
function mostrarProductos($productos) {
    echo "<table border='1' style='width: 60%; border-collapse: collapse; margin: 0 auto; margin-bottom: 20px;'>";
    echo "<tr>
            <th style='padding: 10px; background-color:rgb(153, 231, 173);'>ID</th>
            <th style='padding: 10px; background-color: rgb(153, 231, 173);'>Nombre</th>
            <th style='padding: 10px; background-color: rgb(153, 231, 173);'>Precio</th>
            <th style='padding: 10px; background-color: rgb(153, 231, 173);'>Categoría</th>
            <th style='padding: 10px; background-color: rgb(153, 231, 173);'>Acciones</th>
          </tr>";
    foreach ($productos as $id => $producto) {
        echo "<tr>";
        echo "<td style='padding: 10px; text-align: center;'>$id</td>";
        echo "<td style='padding: 10px;'>{$producto['nombre']}</td>";
        echo "<td style='padding: 10px; text-align: right;'>$ {$producto['precio']}</td>";
        echo "<td style='padding: 10px;'>{$producto['categoria']}</td>";
        echo "<td style='padding: 10px; text-align: center;'>
                <a href='#' class='btn-eliminar' data-id='$id'>Eliminar</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
}
function eliminarProducto(&$productos, $id) {
    if (isset($productos[$id])) {
        unset($productos[$id]);
        return "Producto eliminado correctamente."; 
    } else {
        return "El producto no existe."; 
    }
}
function agregarProducto(&$productos, $nuevoProducto) {
    if (!is_numeric($nuevoProducto['precio']) || $nuevoProducto['precio'] <= 0) {
        return "El precio debe ser un número positivo. <br> Intente nuevamente"; 
    }
    $nuevoId = (count($productos) > 0) ? max(array_keys($productos)) + 1 : 1;
    $productos[$nuevoId] = $nuevoProducto;
    return "Producto agregado correctamente."; 
}
$mensajeModal = ""; 
if (isset($_GET['action']) && $_GET['action'] == 'eliminar') {
    $id = $_GET['id'];
    $mensajeModal = eliminarProducto($_SESSION['productos'], $id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {

    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
    $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';

    if (empty($nombre) || empty($categoria)) {
        $mensajeModal = "Todos los campos son obligatorios.";
    } else {
        $nuevoProducto = [
            "nombre" => $nombre,
            "precio" => $precio,
            "categoria" => $categoria,
        ];
        $mensajeModal = agregarProducto($_SESSION['productos'], $nuevoProducto);
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>
<!--  -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
</head>
<body>
    <h2>Lista de Productos</h2>
    <?php mostrarProductos($_SESSION['productos']); ?>

    <h2>Agregar Nuevo Producto</h2>
    <form method="POST" action="" style="max-width: 400px; margin: 0 auto;">
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>
        <label for="precio">Precio:</label><br>
        <input type="number" name="precio" step="0.01" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>
        <label for="categoria">Categoría:</label><br>
        <input type="text" name="categoria" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>
        <input type="submit" name="agregar" value="Agregar Producto" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer;">
    </form>
    <div id="modal-confirmacion" class="modal">
        <div class="modal-content">
            <p>¿Estás seguro de eliminar este producto?</p>
            <button id="confirmar-eliminar">Sí, eliminar</button>
            <button onclick="cerrarModal()">Cancelar</button>
        </div>
    </div>

    <div id="modal" class="modal" style="<?php echo !empty($mensajeModal) ? 'display: flex;' : 'display: none;'; ?>">
        <div class="modal-content">
            <p><?php echo $mensajeModal; ?></p>
            <button onclick="cerrarModal()">Cerrar</button>
        </div>
    </div>

    <script>
        let productoIdAEliminar = null;
        function abrirModalConfirmacion(id) {
            productoIdAEliminar = id;
            document.getElementById('modal-confirmacion').style.display = 'flex';
        }
        function cerrarModal() {
            document.getElementById('modal-confirmacion').style.display = 'none';
            document.getElementById('modal').style.display = 'none';
            productoIdAEliminar = null; 
        }
        function eliminarProducto() {
            if (productoIdAEliminar) {
                window.location.href = `?action=eliminar&id=${productoIdAEliminar}`;
            }
        }
        document.querySelectorAll('.btn-eliminar').forEach(boton => {
            boton.addEventListener('click', function (e) {
                e.preventDefault(); 
                const id = this.getAttribute('data-id'); 
                abrirModalConfirmacion(id); 
            });
        });
        document.getElementById('confirmar-eliminar').addEventListener('click', eliminarProducto);
    </script>
    <style>
        html, body {
            background: linear-gradient(to bottom,rgb(255, 255, 255), rgb(127, 247, 187));
            margin: 0;
            padding: 0;
            height: 100%; 
            overflow: hidden; 
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .modal-content button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal-content button:last-child {
            background-color: #f44336;
        }

        .btn-eliminar {
            text-decoration: none;
            color: rgb(182, 53, 37);
            font-size: 16px;
            font-family: initial;
            font-weight: bolder;
        }

        h1, h2 {
            position: relative;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.34);
        }
    </style>
</body>
</html>