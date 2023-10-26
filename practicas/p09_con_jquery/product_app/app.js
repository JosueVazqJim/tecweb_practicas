// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
}


$(document).ready(function() {

    let editar = false;
    console.log('jQuery trabajando');
    fetchProducts();

    // FUNCIÓN del input buscar. captura el evento de la barra de busqueda"
    $('#product-result').hide();
    $('#search').keyup(function(e){ //keyup captura evento del teclado en la barra
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php',
                type: 'POST',
                data: {search},
                success: function(response){
                    let productos = JSON.parse(response);
                    let template = ''; 
                    let template_bar = '';
                    productos.forEach(producto =>{
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        /*la linea <tr productId="${producto.id}">  siguiente sirve para lsa demas funciones
                        como elimianr o editar y pues se hace deacuerdo al id del producto*/
                        template += `
                            <tr productId="${producto.id}">  
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;

                        template_bar += `
                            <li>${producto.nombre}</il>
                        `;
                        //console.log(response)
                    });
                    $('#product-result').show();
                    $('#container').html(template_bar);
                    $('#products').html(template);
                }
            });
        }
    });

    // FUNCIÓN del add. captura el evento del formulario agregar"
    $('#product-form').submit(function(e) {
        e.preventDefault(); /* evita el funcionamiento normal del formulario*/       

        let productoJsonString = $('#description').val();
        // SE CONVIERTE EL JSON DE STRING A OBJETO
        let finalJSON = JSON.parse(productoJsonString);
        // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
        finalJSON['id'] = $('#productID').val();
        finalJSON['nombre'] = $('#name').val();
        // SE OBTIENE EL STRING DEL JSON FINAL
        productoJsonString = JSON.stringify(finalJSON,null,2);

        var nombre=finalJSON['nombre'];
        var marca = finalJSON['marca'];
        var modelo=finalJSON['modelo'];
        var precio=finalJSON['precio'];
        var detalles=finalJSON['detalles'];
        var unidades=finalJSON['unidades'];
        var imagen=finalJSON['imagen'];

        if(nombre.length<=0 || nombre.length>100){
            alert('EL nombre no debe de tener menos o 0 caracteres ni tampoco tener mas de 100!!!');
            return; 
            /*con return, la función agregarProducto se detendrá inmediatamente en ese punto y no ejecutará el código restante en la función. */
        }
        else{
            /*se verifica el modelo*/
            var modelo = modelo.trim();
            var esAlfanumerico = /^[A-Z]{2}-\d{3}$/.test(modelo); 

            if (!esAlfanumerico) {
                alert('El campo "modelo" es obligatorio y no puede estar en blanco.');
                return; 
            }
            else{
                var esPrecioValido = !isNaN(parseFloat(precio)) && isFinite(precio) && parseFloat(precio) > 99.99;
                if (!esPrecioValido) {
                    alert('El precio ingresado no es un número válido o debe de ser mayor a 99.99.');
                    return; 
                } 
                else {
                    if(detalles.length >= 250){
                        alert('Los detalles deben de ser menos de 250 caracteres');
                        return; 
                    }
                    else{
                        if(parseInt(unidades) == 0){
                            alert('debe ingresar una cantidad unidades');
                            return; 
                        }
                        else{
                            var unidadesNumericas = parseInt(unidades);
                            if (isNaN(unidadesNumericas) || unidadesNumericas < 0) {
                                alert('Las unidades ingresadas no son un número válido o son menores que 0.');
                                return; 
                            } else {
                                if (imagen.trim() === "") {
                                    imagen = 'img/default.png';

                                    finalJSON['imagen'] = imagen;
                                    alert('agregaremos una imagen por defecto');
                                }
                            }
                        }
                    }
                }
            }
        }
        if (editar === false) {
            var url = './backend/product-add.php';
        } else {
            var url = './backend/product-edit.php';
        }

        console.log(url);
        $.ajax({
            url: url,
            type: 'POST',
            data: {productoJsonString},
            success: function(response){
                console.log(response);
                fetchProducts();
                let respuesta = JSON.parse(response);
                let template_bar = '';
                    template_bar += `
                        <li>${respuesta.message}</il>
                    `;
                    //console.log(response)
                $('#product-result').show();
                $('#container').html(template_bar);
            }
        });
    });

    /*funcion de listar productos*/
    function fetchProducts(){
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response){
                let productos = JSON.parse(response);    // similar a eval('('+client.responseText+')');
                
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';
    
                    productos.forEach(producto => {
                        // SE COMPRUEBA QUE SE OBTIENE UN OBJETO POR ITERACIÓN
                        //console.log(producto);
    
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>
                                    <a href="#" class="product-item">${producto.nombre}</a>
                                </td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger product-delete">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    /* boton delete*/
    $(document).on('click', '.product-delete', function(){
        if(confirm('estas seguro?')){
            let id = event.target.parentElement.parentElement.getAttribute("productId");
            console.log(id);
            $.post('./backend/product-delete.php', {id}, function(response) {
                console.log(response);
                fetchProducts();
                    let respuesta = JSON.parse(response);
                    let template_bar = '';
                        template_bar += `
                            <li>${respuesta.message}</il>
                        `;
                        //console.log(response)
                    $('#product-result').show();
                    $('#container').html(template_bar);
            })
        }
    })

    /* editar producto*/
    $(document).on('click', '.product-item', function(){
        let id = event.target.parentElement.parentElement.getAttribute("productId");
        $.post('./backend/product-single.php', {id}, function(response) {
            console.log(response);
            const producto = JSON.parse(response);
            $('#name').val(producto.name);

            var editJSON = {
                precio: parseFloat(producto.precio), // Convierte a número
                unidades: parseInt(producto.unidades), // Convierte a número entero
                modelo: producto.modelo,
                marca: producto.marca,
                detalles: producto.detalles,
                imagen: producto.imagen
            };
            var JsonString = JSON.stringify(editJSON,null,2);
            $('#description').val(JsonString);
            $('#productID').val(producto.id);
            editar = true;
        })
    });
});