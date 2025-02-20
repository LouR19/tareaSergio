<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPINIÓN - COCOLAND</title>
</head>
<body>
    <?php
    if (isset($_GET['nombre']) && isset($_GET['email'])) {
        $nombre = htmlspecialchars($_GET['nombre']);
        $email = htmlspecialchars($_GET['email']);
    } else {
        header("Location: reservar.php");
        exit();
    }
    ?>

    <button class="exit-button" onclick="window.location.href='reservar.php'">Salir</button>
    <div class="form-container">
        <h2>OPINIÓN DEL SERVICIO</h2>
        <form id="opinionForm" action="procesar.php" method="GET">
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" readonly>
            <input type="email" name="email" value="<?php echo $email; ?>" readonly>
            <select name="calificacion" required>
                <option value="" disabled selected>Califica nuestro servicio</option>
                <option value="5">5 - Excelente 😁</option>
                <option value="4">4 - Muy bueno 😄</option>
                <option value="3">3 - Bueno 🙂</option>
                <option value="2">2 - Regular 😐</option>
                <option value="1">1 - Malo 🙁</option>
            </select>
            <textarea name="comentarios" placeholder="Escribe tu comentario..." required></textarea>
            <input type="submit" value="Enviar opinión">
        </form>
    </div>
    
    <div id="modal" class="modal">
        <div class="modal-content">
            <p id="modal-message"></p>
            <button onclick="cerrarModal()">Cerrar</button>
        </div>
    </div>

    <script>
        document.getElementById('opinionForm').addEventListener('submit', function(event) {
            event.preventDefault(); 

            const nombre = document.querySelector('input[name="nombre"]').value;
            const calificacion = document.querySelector('select[name="calificacion"]').value;
            const comentarios = document.querySelector('textarea[name="comentarios"]').value;

            document.getElementById('modal-message').innerHTML = `
                ¡Gracias por tu comentario, ${nombre}!<br>
                Calificación: ${calificacion}<br>
                Comentarios: ${comentarios}
            `;

            document.getElementById('modal').style.display = 'flex';
        });

  
        function cerrarModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>
       <style>
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

        body {
            font-family: Arial, sans-serif;
            background-color: rgba(156, 214, 236, 0.63);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(35, 20, 172, 0.93);
            width: 100%;
            max-width: 400px;
        }

        .exit-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        select{
            width: 100%;
        }
        input[type="text"],
        input[type="email"]{
            cursor: not-allowed; 
            color: #218838;
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
    </style>
</body>
</html>