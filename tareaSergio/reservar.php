<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COCOLAND</title>
</head>
<body>
    <div class="form-container">
        <h2>RESERVA DE HABITACION</h2>
        <form action="procesar.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre Completo" required>
        <input type="email" name="email" placeholder="Correo Electronico" required>
        <input type="date" name="fechaEntrada" placeholder="Fecha de Entrada" required>
        <select name="tipoHabitacion" required>
                <option value="" disabled selected>Selecciona el tipo de Habitación</option>
                <option value="individual">Individual</option>
                <option value="doble">Doble</option>
                <option value="suite">Suite</option>
            </select> 
            <input type="submit" value="Reservar">
        </form>        
    </div>
    
    <style>   
    /*  */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('imagenes/cocoland.png');
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 255, 64, 0.93);
            width: 100%;
            max-width: 400px;
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
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            }
        input[type="tipoHabitacion"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #fff;
        }

        .form-container input:focus,
        .form-container select:focus {
            border-color: #66afe9;
            outline: none;
            box-shadow: 0 0 5px rgba(102, 175, 233, 0.5);
        }
    </style>
    
</body>
</html>