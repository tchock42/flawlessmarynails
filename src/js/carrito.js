(function(){
    document.addEventListener('DOMContentLoaded', async function(){
        let productos = [];
        let productosDB = [];
        let usuario = {
            id: '',
            nombre: '',
            idCarrito: ''
        }
        const carritoItems = document.querySelector('#carrito__items');         // selecciona el DIV para inyectar los elementos del carrito
        const carritoTotalSPAN = document.querySelector('.carrito__total__cantidad');
        if(carritoItems){
            //Leer la base de datos| Si está la sesión iniciada, carga el carrito de db, si no, carga de LS
            await obtenerCarrito();       // usuario con datos o vacío
            sincronizarDByLS();
            //Query Selectors
            const productosBoton = document.querySelectorAll('.producto__agregar');
            const carritoPagar = document.getElementById('carrito__pagar');
            productosBoton.forEach(boton => boton.addEventListener('click', seleccionarProducto));
            inicializar();
            carritoPagar.addEventListener('click', pagarCarrito);
            
            function sincronizarDByLS(){
                
                if(productos.length === 0 ){ // si no hay sesion activa
                    //Leer LocalStorage
                    
                    const productosLS = JSON.parse(localStorage.getItem('carritoFMN'));
                    productos = productosLS ?? [];
                }
            }
            function inicializar(){
                if(productos.length === 0){
                    ocultarCarrito();
                }else{
                    mostrarCarrito();
                    mostrarProductos();
                    sincronizar();
                }
            }
            function seleccionarProducto(e){
                const producto = {
                    id: e.target.dataset.id,
                    nombre: e.target.parentElement.querySelector('.producto__resumen').querySelector('H3').textContent.trim(),
                    imagen: e.target.parentElement.querySelector('IMG').src,
                    precio: e.target.parentElement.querySelector('.producto__resumen').querySelector('H4').querySelector('SPAN').textContent.trim()
                }
                
                const repetido = productos.find(producto => producto.id === e.target.dataset.id);
                if(repetido){
                    alert('El producto ya se encuentra en el carrito');
                    return;
                }

                productos = [...productos,        // arreglo de objetos de js
                    producto
                ];
                
                const botonSelected = e.target;
                botonSelected.classList.add('selected');
                botonSelected.innerText = 'Agregado al carrito';
                carritoLocalStorage();
                
                // mostrar los productos en el carrito
                mostrarCarrito();
                mostrarProductos();
                
                // insercion de un nuevo carrito
                fecha = new Date();
                fecha = fecha.getUTCFullYear() + '-' +
                    ('00' + (fecha.getUTCMonth()+1)).slice(-2) + '-' +
                    ('00' + fecha.getUTCDate()).slice(-2) + ' ' + 
                    ('00' + fecha.getUTCHours()).slice(-2) + ':' + 
                    ('00' + fecha.getUTCMinutes()).slice(-2) + ':' + 
                    ('00' + fecha.getUTCSeconds()).slice(-2);
                // if(!Object.values(usuario)[0].includes('')){ // si hay un usuario activo
                    guardarCarrito(producto);   // guarda en lka base de datos
                // }
                
   
            }

            async function guardarCarrito(producto){
                console.log(producto);
                // se guarda en tabla carrito si no se ha creado 
                const estadoCarrito = 0; // no está pagado
                const datos = new FormData();
                datos.append('fecha', fecha);
                datos.append('estado', estadoCarrito);

                if(Object.values(usuario)[0].length>0){
                    try {
                        const url = 'http://localhost:3000/api/carrito';
                        const respuesta = await fetch(url, {
                            method: 'POST',
                            body: datos
                        });
    
                        const resultado = await respuesta.json();
                        usuario.idCarrito = resultado.id;   // guarda el id del carrito 
    
                        // agregar el producto a detalles_carrito
                        const cantidad = 1;                 // posible cambio en un futuro
                        console.log('Agregando articulo');
                        const datos2 = new FormData();
                        datos2.append('id_carrito', usuario.idCarrito);
                        datos2.append('id_producto', producto.id);
                        datos2.append('cantidad', cantidad);
                        datos2.append('precio_unitario', producto.precio);
                        datos2.append('subtotal', (+producto.precio)*cantidad);
                        // console.log([...datos2]);
                        const url2 = 'http://localhost:3000/api/producto';
    
                        const respuesta2 = await fetch(url2, {
                            method: 'POST',
                            body: datos2
                        });
                        
                        const resultado2 = await respuesta2.json();
                        // console.log(resultado2);
                    } catch (error) {
                        console.error('Error al guardar el Carrito del usuario', error)
                    }
                }
                
                
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

            async function eliminarProducto(id){
                productos = productos.filter(producto => producto.id !== id);
                const botonAgregar = document.querySelector(`[data-id = "${id}"]`);
                botonAgregar.classList.remove('selected');
                botonAgregar.innerText = 'Agregar al Carrito';
                // eliminar de la base de datos
                
                if(Object.values(usuario)[0].length>0){ // si hay un usuario activo
                    try {
                        console.log('Eliminando producto');
                        const url = 'http://localhost:3000/api/eliminar';
                        const datos = new FormData();
                        datos.append('id_producto', id);
    
                        const respuesta = await fetch(url, {
                            method: 'POST',
                            body: datos
                        });
    
                        const resultado = await respuesta.json();
                        // console.log(resultado);
                    } catch (error) {
                        console.error('Error al eliminar el producto del carrito', error);
                    }
                }
                
                // renderizar otra vez
                mostrarProductos();
                ocultarCarrito();
                carritoLocalStorage();
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
                    console.log('Mostrando carrito');
                    var carrito = document.getElementById('carrito');
                    carrito.style.marginRight = '0';
                    carrito.style.opacity = '1';
                    carrito.style.height = 'auto';
                    // recorrer el contenedor de productos

                    var tiendaListado = document.getElementById('tienda__listado');
                    tiendaListado.style.width = '100%'
                }
            }

            function carritoLocalStorage(){
                
                localStorage.setItem('carritoFMN', JSON.stringify(productos));
            }
 
            function sincronizar(){
                productos.forEach(producto => {
                    const botonAgregar = document.querySelector(`[data-id = "${producto.id}"]`);
                    botonAgregar.classList.add('selected');
                    botonAgregar.innerText = 'Agregado al Carrito';
                });
            }

            function pagarCarrito(){
                // const productosId = productos.map(producto => producto.id);
                console.log('Pagando...');
            }

            async function obtenerCarrito(){

                
                try {
                    const url = 'http://localhost:3000/api/usuario';
                    const datos = new FormData();
                    datos.append('usuario', 'jacob');

                    const respuesta = await fetch(url, {
                        method: 'POST',
                        body: datos
                    });
                    
                    resultado = await respuesta.json();
                    console.log(resultado)
                    if(resultado.usuario){
                        console.log('Existe un usuario activo')
                        usuario.id= resultado.usuario.id ?? '';
                        usuario.idCarrito = resultado.carrito.id ?? '';
                        usuario.nombre = resultado.usuario.nombre ?? '';
                    }
                    if(resultado.productos){
                        console.log('Hay productos en carrito')   
                        productosDB = resultado.productos;    // estos productos requieren transformarse al formato del id, imagen, nombre, precio para desplegarse
                        productos = productosDB.map(productoDB => {
                            
                            const productoAux = document.querySelector(`[data-id = "${productoDB.id_producto}"]`); //idproducto=6
                            
                            const product = {
                                id: productoDB.id_producto,
                                nombre: productoAux.parentElement.querySelector('.producto__resumen').querySelector('H3').textContent.trim(),
                                imagen: productoAux.parentElement.querySelector('IMG').src,
                                precio: productoAux.parentElement.querySelector('.producto__resumen').querySelector('H4').querySelector('SPAN').textContent.trim()
                            }
                            return product;
                        })
                    }
                } catch (error) {
                    console.log('Error al obtener el usuario y carrito:', error)
                }
                
            }
        }
    });
})();