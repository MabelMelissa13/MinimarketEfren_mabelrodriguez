<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <link rel="stylesheet" href="./css/tailwind.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Formulario</h2>
        <form id="productoForm" action="index.php" method="post">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <p id="nombreError" class="text-red-500 text-xs italic mt-2 hidden">El nombre del producto es requerido.</p>
            </div>
            <div class="mb-4">
                <label for="precio" class="block text-gray-700 font-semibold mb-2">Precio por Unidad:</label>
                <input type="text" id="precio" name="precio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <p id="precioError" class="text-red-500 text-xs italic mt-2 hidden">Ingrese un precio válido.</p>
            </div>
            <div class="mb-4">
                <label for="cantidad" class="block text-gray-700 font-semibold mb-2">Cantidad del Inventario:</label>
                <input type="text" id="cantidad" name="cantidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <p id="cantidadError" class="text-red-500 text-xs italic mt-2 hidden">Ingrese una cantidad válida.</p>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Agregar Producto</button>
            </div>
        </form>

        <?php
        // Inicialización de variables
        $nombre = $precio = $cantidad = "";
        $nombreErr = $precioErr = $cantidadErr = "";
        $productos = [];

        // Función para limpiar los datos ingresados
        function test_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        // Función para agregar producto al array
        function agregarProducto($nombre, $precio, $cantidad) {
            global $productos;
            $productos[] = [
                "nombre" => $nombre,
                "precio" => $precio,
                "cantidad" => $cantidad
            ];
        }

        // Procesar el formulario cuando se envía
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = test_input($_POST["nombre"]);
            $precio = test_input($_POST["precio"]);
            $cantidad = test_input($_POST["cantidad"]);
            $isValid = true;

            // Validación del nombre
            if (empty($nombre)) {
                $nombreErr = "El nombre del producto es requerido.";
                $isValid = false;
            }

            // Validación del precio
            if (empty($precio)) {
                $precioErr = "El precio por unidad es requerido.";
                $isValid = false;
            } elseif (!is_numeric($precio) || $precio <= 0) {
                $precioErr = "Ingrese un precio válido.";
                $isValid = false;
            }

            // Validación de la cantidad
            if (empty($cantidad)) {
                $cantidadErr = "La cantidad del inventario es requerida.";
                $isValid = false;
            } elseif (!is_numeric($cantidad) || $cantidad < 0) {
                $cantidadErr = "Ingrese una cantidad válida.";
                $isValid = false;
            }

            // Si los datos son válidos, agregar producto
            if ($isValid) {
                agregarProducto($nombre, $precio, $cantidad);
                echo "<p class='text-green-500 text-sm mt-4'>Producto agregado exitosamente.</p>";
            }
        }
        ?>

        <!-- Mostrar la tabla solo si hay productos -->
        <?php if (!empty($productos)) : ?>
            <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Productos</h2>
            <table class="w-full text-center">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Precio</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalGeneral = 0;
                    foreach ($productos as $producto) {
                        $totalProducto = $producto['precio'] * $producto['cantidad'];
                        $totalGeneral += $totalProducto;
                        $estado = $producto['cantidad'] > 0 ? 'En stock' : 'Agotado';
                        echo "<tr>";
                        echo "<td class='border px-4 py-2'>{$producto['nombre']}</td>";
                        echo "<td class='border px-4 py-2'>" . number_format($producto['precio'], 2) . "</td>";
                        echo "<td class='border px-4 py-2'>{$producto['cantidad']}</td>";
                        echo "<td class='border px-4 py-2'>" . number_format($totalProducto, 2) . "</td>";
                        echo "<td class='border px-4 py-2'>{$estado}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="px-4 py-2" colspan="3">Total general</th>
                        <th class="px-4 py-2"><?= number_format($totalGeneral, 2) ?></th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </div>
    <script src="validations.js"></script>
</body>
</html>
