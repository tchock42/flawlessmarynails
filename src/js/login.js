(function(){
    document.addEventListener('DOMContentLoaded', function(){
        let carrito = {
            fecha: '',
            estado: ''
        }
        // let detalleCarrito = {
        //     id_carrito: '',
        //     id_producto: '',
        //     cantidad: '',
        //     precio_unitario: 0,
        //     subtotal: 0
        // }
        let fechaActual = new Date();
        fechaActual = fechaActual.getUTCFullYear() + '-' +
            ('00' + (fechaActual.getUTCMonth()+1)).slice(-2) + '-' +
            ('00' + fechaActual.getUTCDate()).slice(-2) + ' ' + 
            ('00' + fechaActual.getUTCHours()).slice(-2) + ':' + 
            ('00' + fechaActual.getUTCMinutes()).slice(-2) + ':' + 
            ('00' + fechaActual.getUTCSeconds()).slice(-2);
        
        let estadoCarrito = 0;
        
        const loginForm = document.getElementById('loginForm');
        loginForm.addEventListener('submit', async function(event){
           
            event.preventDefault();
            //carrito del LocalStorage
            const productos = JSON.parse(localStorage.getItem('carritoFMN')) || [];
            carrito = {
                fecha: fechaActual,
                estado: estadoCarrito
            };
            console.log(carrito);
            const formData = new FormData(loginForm);
          
            formData.append('productos', JSON.stringify(productos));
            formData.append('carrito', JSON.stringify(carrito));
            console.log([...formData]);

            respuesta = await fetch('/login', {
                method: 'POST',
                body: formData
            });
           
            resultado = await respuesta.json();
            console.log(resultado);
        })
    });
})();