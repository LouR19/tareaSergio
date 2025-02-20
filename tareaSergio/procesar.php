<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación - COCOLAND</title>
</head>
<body>
    <?php
    if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['fechaEntrada']) && isset($_POST['tipoHabitacion'])) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $fechaEntrada = $_POST['fechaEntrada'];
        $tipoHabitacion = $_POST['tipoHabitacion'];

        $imagenFondo = '';
        if ($tipoHabitacion == 'individual') {
            $imagenFondo = 'imagenes/inv.jpg';
        } elseif ($tipoHabitacion == 'doble') {
            $imagenFondo = 'imagenes/doble.jpg';
        } elseif ($tipoHabitacion == 'suite') {
            $imagenFondo = 'imagenes/suite.jpg'; 
        }
    }
    ?>

    <div class="form-container">
        <h2>Confirmación de Reserva</h2>
        <form>
            <input type="text" value="<?php echo $nombre; ?>" readonly>
            <input type="email" value="<?php echo $email; ?>" readonly>
            <input type="date" value="<?php echo $fechaEntrada; ?>" readonly>
            <select readonly>
                <option value="<?php echo $tipoHabitacion; ?>" selected><?php echo ucfirst($tipoHabitacion); ?></option>
            </select>
        </form>

        <?php if (!empty($imagenFondo)) : ?>
            <img src="<?php echo $imagenFondo; ?>" alt="Imagen de <?php echo $tipoHabitacion; ?>" class="imagen-fondo">
        <?php endif; ?>

        <a href="opinion.php?nombre=<?php echo $nombre; ?>&email=<?php echo $email; ?>">
            <button class="button">Dar opinión</button>
        </a>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(109, 26, 26, 0.78); 
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        select {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f9f9;
            cursor: not-allowed; 
        }

        .imagen-fondo {
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
            display: block;
            border-radius: 8px; 
        }

        .button {
            background-color: #4CAF50; 
            border: none; 
            color: white; 
            padding: 15px 32px;
            text-align: center;
            text-decoration: none; 
            display: inline-block;
            font-size: 16px; 
            font-family: 'Arial', sans-serif;
            border-radius: 8px; 
            cursor: pointer; 
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .button:hover {
            background-color: rgb(38, 223, 47);
            transform: translateY(-2px); 
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15); 
        }

        .button:active {
            background-color: rgb(238, 255, 0); 
            transform: translateY(0);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</body>
</html>