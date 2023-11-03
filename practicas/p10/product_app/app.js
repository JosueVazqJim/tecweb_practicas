// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

$(document).ready(function(){
    let edit = false;
    /*empiezo con las validaciones, no las pongo en el add o en el edit pues eso funciona cuando se da clic en un boton para enviar*/
    $("#name").on("blur", function() {
        const nombre = $(this).val();
    if (nombre.length === 0 || nombre.length > 100) {
        $(this).addClass("invalid");
        alert('El nombre no debe tener menos de 1 caracter ni más de 100.');
    } else {
        $(this).removeClass("invalid").addClass("valid");
    }
    });
    // Validación para el campo "Modelo"
    $("#model").on("blur", function() {
        let modelo = $(this).val();
        modelo = modelo.trim();
        const esAlfanumerico = /^[A-Z]{2}-\d{3}$/.test(modelo);

        if (!esAlfanumerico || modelo.trim() === "") {
            alert('El campo "Modelo" es obligatorio y debe seguir el formato XX-000.');
            $(this).removeClass("valid").addClass("invalid");
        } else {
            $(this).removeClass("invalid").addClass("valid");
        }
    });

    // Validación para el campo "Precio"
    $("#price").on("blur", function() {
        const precio = $(this).val();
        const esPrecioValido = !isNaN(parseFloat(precio)) && isFinite(precio) && parseFloat(precio) > 99.99;

        if (!esPrecioValido || precio.trim() === "") {
            alert('El precio ingresado no es un número válido o debe ser mayor a 99.99.');
            $(this).removeClass("valid").addClass("invalid");
        } else {
            $(this).removeClass("invalid").addClass("valid");
        }
    });

    // Validación para el campo "Detalles"
    $("#details").on("blur", function() {
        const detalles = $(this).val();
        if (detalles.length >= 250 || detalles.trim() === "") {
            alert('Los detalles deben tener menos de 250 caracteres.');
            $(this).removeClass("valid").addClass("invalid");
        } else {
            $(this).removeClass("invalid").addClass("valid");
        }
    });

    // Validación para el campo "Unidades"
    $("#units").on("blur", function() {
        const unidades = $(this).val();
        if (unidades === "0" || unidades.trim() === "") {
            alert('Debes ingresar una cantidad de unidades mayor que 0.');
            $(this).removeClass("valid").addClass("invalid");
        } else {
            $(this).removeClass("invalid").addClass("valid");
        }
    });

    // Validación para el campo "Imagen"
    $("#image").on("blur", function() {
        const imagen = $(this).val();
        if (imagen.trim() === "") {
            alert('Se agregará una imagen por defecto.');
            $(this).removeClass("valid").addClass("invalid");
        } else {
            $(this).removeClass("invalid").addClass("valid");
        }
    });


    let JsonString = JSON.stringify(baseJSON,null,2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
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
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
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

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
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
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        // SE CONVIERTE EL JSON DE STRING A OBJETO
        //let postData = JSON.parse( $('#description').val() );
        // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
       /*postData['nombre'] = $('#name').val();
        postData['id'] = $('#productId').val();*/
        let postData = {
            id : $('#productId').val(),
            nombre : $('#name').val(),
            marca : $('#brand').val(),
            modelo : $('#model').val(),
            precio : $('#price').val(),
            detalles : $('#details').val(),
            unidades : $('#units').val(),
            imagen : $('#image').val(),
        };

        console.log(postData)
        /**
         * AQUÍ DEBES AGREGAR LAS VALIDACIONES DE LOS DATOS EN EL JSON
         * --> EN CASO DE NO HABER ERRORES, SE ENVIAR EL PRODUCTO A AGREGAR
         **/
        
        var nombre=postData['nombre'];
        var marca = postData['marca'];
        var modelo=postData['modelo'];
        var precio=postData['precio'];
        var detalles=postData['detalles'];
        var unidades=postData['unidades'];
        var imagen=postData['imagen'];

        if(nombre.length<=0 || nombre.length>100){
            $('#name').addClass("invalid");
            alert('EL nombre no debe de tener menos o 0 caracteres ni tampoco tener mas de 100!!!');
            return; 
            /*con return, la función agregarProducto se detendrá inmediatamente en ese punto y no ejecutará el código restante en la función. */
        }
        else{
            /*se verifica el modelo*/
            var modelo = modelo.trim();
            var esAlfanumerico = /^[A-Z]{2}-\d{3}$/.test(modelo); 

            if (!esAlfanumerico) {
                $('#model').addClass("invalid");
                alert('El campo "modelo" es obligatorio y no puede estar en blanco.');
                return; 
            }
            else{
                var esPrecioValido = !isNaN(parseFloat(precio)) && isFinite(precio) && parseFloat(precio) > 99.99;
                if (!esPrecioValido) {
                    $('#price').addClass("invalid");
                    alert('El precio ingresado no es un número válido o debe de ser mayor a 99.99.');
                    return; 
                } 
                else {
                    if(detalles.length >= 250){
                        alert('Los detalles deben de ser menos de 250 caracteres');
                        $('#details').addClass("invalid");
                        return; 
                    }
                    else{
                        if(parseInt(unidades) == 0){
                            $('#units').addClass("invalid");
                            alert('debe ingresar una cantidad unidades');
                            return; 
                        }
                        else{
                            var unidadesNumericas = parseInt(unidades);
                            if (isNaN(unidadesNumericas) || unidadesNumericas < 0) {
                                $('#units').addClass("invalid");
                                alert('Las unidades ingresadas no son un número válido o son menores que 0.');
                                return; 
                            } else {
                                if (imagen.trim() === "") {
                                    imagen = 'img/default.png';

                                    finalJSON['imagen'] = imagen;
                                    $('#image').addClass("invalid");
                                    alert('agregaremos una imagen por defecto');
                                }
                            }
                        }
                    }
                }
            }
        }

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        $.post(url, postData, (response) => {
            console.log(response);
            //console.log(response);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            // SE REINICIA EL FORMULARIO
            $('#name').val('');
            $('#brand').val('rolex');
            $('#model').val('');
            $('#price').val('');
            $('#details').val('');
            $('#units').val('');
            $('#image').val('');

            $('#description').val(JsonString);
            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });

    //borrar registro
    $(document).on('click', '.product-delete', function(){
        if(confirm('estas seguro?')){
            let id = event.target.parentElement.parentElement.getAttribute("productId");
            console.log(id);
            $.post('./backend/product-delete.php', {id}, function(response) {
                console.log(response);
                listarProductos();
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

    //editar registro
    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            $('#brand').val(product.marca);
            $('#model').val(product.modelo);
            $('#price').val(product.precio);
            $('#details').val(product.detalles);
            $('#units').val(product.unidades);
            $('#image').val(product.imagen);
           
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#productId').val(product.id);
            // SE ELIMINA nombre, eliminado E id PARA PODER MOSTRAR EL JSON EN EL <textarea>
            delete(product.nombre);
            delete(product.eliminado);
            delete(product.id);
            // SE CONVIERTE EL OBJETO JSON EN STRING
            //let JsonString = JSON.stringify(product,null,2);
            // SE MUESTRA STRING EN EL <textarea>
            //$('#description').val(JsonString);
            
            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });    

    $('#name').keyup(function() {
        if($('#name').val()) {
            let name = $('#name').val();
            $.ajax({
                url: './backend/product-search2.php?name='+$('#name').val(),
                data: {name},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template_bar = '';

                            

                                template_bar += `
                                    <li>${productos.message}</il>
                                `;
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                        
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });
});