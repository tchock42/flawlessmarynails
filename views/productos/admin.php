<main class="contenedor encabezado">
    <div class="barrita">
        <h1 class="barrita__heading"><?php echo $titulo; ?></h1>
        <p class="barrita__descripcion">Buenos días Mary, aquí puedes administrar los productos para que aparezcan en la tienda.</p>
    </div>
</main>

<section class="productos">
    <a href="/productos/crear" class="productos__boton">Nuevo Producto</a>

    <h2 class="productos__heading">Productos en Stock</h2>
    <table class="productos__tabla">
        <thead>
            <tr>
                <th>ID</th>     <!--elemento de fila-->
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--Mostrar los resultados-->
            <!--Itera sobre la base de datos-->
            <?php foreach ($productos as $producto): ?>
                <tr class="productos__tabla__producto">
                    <td> <?php echo $producto->id; ?> </td>
                    <td> <?php echo $producto->nombre; ?> </td>
                    <td> <img src="/imagenes/<?php echo $producto->imagen; ?>.jpeg" class="imagen-tabla"> </td>
                    <td>$ <?php echo $producto->precio; ?></td>
                    <td class="productos__acciones">
                        <form method="POST" class="w-100" action="/productos/eliminar">
                            <input type="hidden" name = "id" value="<?php echo $producto->id ?>">
                            <input type="hidden" name = "tipo" value="producto">
                            <input type="submit" class="productos__acciones__boton-eliminar" value="Eliminar">
                        </form>
                        <a href="/productos/actualizar?id=<?php echo $producto->id;?>" class="productos__acciones__boton-actualizar">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</section>