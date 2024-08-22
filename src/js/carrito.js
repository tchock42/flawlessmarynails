(function(){
    document.addEventListener('DOMContentLoaded', function(){
        let productos = [];
        const carritoVisible = false;
        const carritoItems = document.querySelector('#carrito__items');         // selecciona el DIV para inyectar los elementos del carrito
        const carritoTotalSPAN = document.querySelector('.carrito__total__cantidad');

        if(carritoItems){

            const productosBoton = document.querySelectorAll('.producto__agregar');

            productosBoton.forEach(boton => boton.addEventListener('click', seleccionarProducto));

            if(productos.length === 0){
                ocultarCarrito();
            }

            
            function seleccionarProducto(e){
                
                
                productos = [...productos,        // arreglo de objetos de js
                    {
                        id: e.target.dataset.id,
                        nombre: e.target.parentElement.querySelector('.producto__resumen').querySelector('H3').textContent.trim(),
                        imagen: e.target.parentElement.querySelector('IMG').src,
                        precio: e.target.parentElement.querySelector('.producto__resumen').querySelector('H4').querySelector('SPAN').textContent.trim()
                    }]
                console.log(productos);
                // deshabilitar el producto
                e.target.disabled = true;
                // TO DO: animar el boton para que aparezca 'Agregado al carrito de compras'

                // mostrar los productos en el carrito
                mostrarCarrito();
                mostrarProductos();

            }

            function mostrarProductos(){
                // limpiar HTML para que no se repitan los anteriores productos
                limpiarProductos();

                if(productos.length > 0){

                    productos.forEach(producto => {
                        const productoDIV = document.createElement('DIV');
                        productoDIV.classList.add('carrito__item');

                        const productoIMG = document.createElement('IMG');
                        productoIMG.classList.add('carrito__item__img');
                        productoIMG.src = producto.imagen

                        productoDetalles = document.createElement('DIV');
                        productoDetalles.classList.add('carrito__item__detalles');

                        const productoTitulo = document.createElement('SPAN');
                        productoTitulo.classList.add('carrito__item__titulo');
                        productoTitulo.textContent = producto.nombre;

                        const productoPrecio = document.createElement('SPAN');
                        productoPrecio.classList.add('carrito__item__precio');
                        productoPrecio.textContent = formatCurrency(producto.precio);

                        const productoSpanEliminar = document.createElement('SPAN');
                        productoSpanEliminar.classList.add('carrito__item__eliminar');
                        productoSpanEliminar.onclick = function(){
                            eliminarProducto(producto.id);
                        }

                        const productoIconEliminar = document.createElement('I');
                        productoIconEliminar.classList.add('fa-solid', 'fa-trash');

                        //renderizar
                        productoDetalles.appendChild(productoTitulo);
                        productoDetalles.appendChild(productoPrecio);

                        productoSpanEliminar.appendChild(productoIconEliminar);

                        productoDIV.appendChild(productoIMG);
                        productoDIV.appendChild(productoDetalles);
                        productoDIV.appendChild(productoSpanEliminar);

                        carritoItems.appendChild(productoDIV);

                        actualizarTotalCarrito();
                    })
                }else{
                    // si no se tienen eventos seleccionados
                    const noProductos = document.createElement('P');
                    noProductos.textContent = 'No hay elementos en tu Carrito';
                    noProductos.classList.add('carrito__item__empty');

                    carritoItems.appendChild(noProductos);
                }
            }

            function eliminarProducto(id){
                productos = productos.filter(producto => producto.id !== id);
                const botonAgregar = document.querySelector(`[data-id = "${id}"]`);
                botonAgregar.disabled = false;
                console.log(productos);
                mostrarProductos();

                ocultarCarrito();
            }

            function limpiarProductos(){
                while(carritoItems.firstChild){
                    carritoItems.removeChild(carritoItems.firstChild);
                    carritoTotalSPAN.textContent = '$0.00';
                }
            }

            function actualizarTotalCarrito(){

                const total = productos.reduce( (total, producto) => (total + parseInt(producto.precio)), 0);
                carritoTotalSPAN.textContent = formatCurrency(total);
            }

            function formatCurrency(cantidad){
                let MXpesos = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                });
                return MXpesos.format(cantidad);
            }
            function ocultarCarrito(){
                if(productos.length === 0){
                    var carrito = document.getElementById('carrito');
                    carrito.style.marginRight = '-100%';
                    carrito.style.opacity = '0';
                    carrito.style.height = '0';

                    // maximizar contenedor de productos

                    var tiendaListado = document.getElementById('tienda__listado');
                    tiendaListado.style.width = '100%';
                }
            }
            function mostrarCarrito(){
                if (productos.length > 0){
                    console.log()
                    var carrito = document.getElementById('carrito');
                    carrito.style.marginRight = '0';
                    carrito.style.opacity = '1';
                    carrito.style.height = 'auto';
                    // recorrer el contenedor de productos

                    var tiendaListado = document.getElementById('tienda__listado');
                    tiendaListado.style.width = '100%'
                }
            }
        }
    });
    
    
})();