$(document).ready(function(){
    let edit = false;

    /*empiezo con las validaciones, no las pongo en el add o en el edit pues eso funciona cuando se da clic en un boton para enviar*/
    $("#name").on("blur", function() {
        const nombre = $(this).val();    
        if (nombre.length === 0 || nombre.length > 100) {
            $(this).addClass("invalid");
            $('#name-validation').html('<i class="bi bi-x-circle"></i> El Nombre no debe tener menos de 1 caracter ni más de 100.');
            $('#name-validation').show();
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#name-validation').html('');
            $('#name-validation').hide();
        }
    });
    
    // Validación para el campo "Modelo"
    $("#model").on("blur", function() {
        let modelo = $(this).val();
        modelo = modelo.trim();
        const esAlfanumerico = /^[A-Z]{2}-\d{3}$/.test(modelo);

        if (!esAlfanumerico || modelo.trim() === "") {
            $(this).removeClass("valid").addClass("invalid");
            $('#model-validation').html('<i class="bi bi-x-circle"></i> El Modelo es obligatorio y debe seguir el formato XX-000.');
            $('#model-validation').show();
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#model-validation').html('');
            $('#model-validation').hide();
        }
    });

    // Validación para el campo "Precio"
    $("#price").on("blur", function() {
        const precio = $(this).val();
        const esPrecioValido = !isNaN(parseFloat(precio)) && isFinite(precio) && parseFloat(precio) > 99.99;

        if (!esPrecioValido || precio.trim() === "") {
            $(this).removeClass("valid").addClass("invalid");
            $('#price-validation').html('<i class="bi bi-x-circle"></i> El Precio ingresado no es un número válido o debe ser mayor a 99.99.');
            $('#price-validation').show();
            return;
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#price-validation').html('');
            $('#price-validation').hide();
        }
    });

    // Validación para el campo "Detalles"
    $("#details").on("blur", function() {
        const detalles = $(this).val();
        if (detalles.length >= 250) {
            $(this).removeClass("valid").addClass("invalid");
            $('#details-validation').html('<i class="bi bi-x-circle"></i> Los Detalles deben tener menos de 250 caracteres.');
            $('#details-validation').show();
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#details-validation').html('');
            $('#details-validation').hide();
        }
    });

    // Validación para el campo "Unidades"
    $("#units").on("blur", function() {
        const unidades = $(this).val();
        if (unidades === "0" || unidades.trim() === "") {
            $(this).removeClass("valid").addClass("invalid");
            $('#units-validation').html('<i class="bi bi-x-circle"></i> Debes ingresar una cantidad de Unidades mayor que 0.');
            $('#units-validation').show();
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#units-validation').html('');
            $('#units-validation').hide();
        }
    });

    // Validación para el campo "Imagen"
    $("#image").on("blur", function() {
        const imagen = $(this).val();
        if (imagen.trim() === "") {
            $(this).val('img/default.png')
            $(this).removeClass("invalid").addClass("valid");
            $('#image-validation').html('<i class="bi bi-lightbulb"></i> Se agregará una imagen por defecto.');
            $('#image-validation').show();
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#image-validation').html('');
            $('#image-validation').hide();
        }
    });
    $('#product-result').hide(); /*este es un id del div que sirve para mostrar mensajes acerca del estatus de consultas*/
    
    //EMPEZAMOS CON LAS FUNCIONES
    
    //FUNCION ADD
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
        /*objeto js a string json*/
        let stringPostData = JSON.stringify(postData);
        /*string json a objeto json*/
        let objPostData = JSON.parse(stringPostData);
        
        $.post(url, { data: objPostData }, (response) => {
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

            $('#description').val(objPostData);
            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            //RECORDAR DESCOMENTAR listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });



    /*Los sig id son para ocultar los divs que sirven para hacer la primera validacion de entradas. Muestran un pequeño mensaje 
    debajo del input indicando que esta mal*/
    $('#name-validation').hide();
    $('#model-validation').hide();
    $('#price-validation').hide();
    $('#details-validation').hide();
    $('#units-validation').hide();
    $('#image-validation').hide();
});