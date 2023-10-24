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
        $.ajax({
            url: './backend/product-add.php',
            type: 'POST',
            data: {productoJsonString},
            success: function(response){
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

    function fetchProducts(){
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response){
                console.log(response);
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
                                <td>${producto.nombre}</td>
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
    $(document).on('click', '.product-delete', function(){
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
        
    })
});


// FUNCIÓN CALLBACK DE BOTÓN "Eliminar"
function eliminarProducto() {
    if( confirm("De verdad deseas eliinar el Producto") ) {
        var id = event.target.parentElement.parentElement.getAttribute("productId");
        /* var id = document.getElementById('productId').value; no funciona pues productoId es como
        una clase. 
        En la otra linea que si funciona línea, estás utilizando el evento (event) para acceder al elemento que 
        desencadenó el 
        evento y luego navegando a través de dos niveles de elementos padres (parentElement.parentElement) 
        para encontrar el elemento que tiene el atributo "productId". Esto funcionará si la estructura del 
        DOM es la correcta y el atributo "productId" está presente en el elemento.*/
        //NOTA: OTRA FORMA PODRÍA SER USANDO EL NOMBRE DE LA CLASE, COMO EN LA PRÁCTICA 7

        // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
        var client = getXMLHttpRequest();
        client.open('GET', './backend/product-delete.php?id='+id, true);
        client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        client.onreadystatechange = function () {
            // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
            if (client.readyState == 4 && client.status == 200) {
                console.log(client.responseText);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                let respuesta = JSON.parse(client.responseText);
                // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;

                // SE HACE VISIBLE LA BARRA DE ESTADO
                document.getElementById("product-result").className = "card my-4 d-block";
                // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                document.getElementById("container").innerHTML = template_bar;

                // SE LISTAN TODOS LOS PRODUCTOS
                listarProductos();
            }
        };
        client.send();
    }
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}