<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
      ol, ul { 
      list-style-type: none;
      }
    </style>
    <title>Formulario</title>
</head>
</head>

<body>
    <script type="text/javascript">
        function verificar(event){
            var nombre=document.getElementById('nombre').value;
            var marca = document.getElementById('marcas').options[document.getElementById('marcas').selectedIndex].text;
            var modelo=document.getElementById('modelo').value;
            var precio=document.getElementById('precio').value;
            var detalles=document.getElementById('detalles').value;
            var unidades=document.getElementById('unidades').value;
            var imagen=document.getElementById('imagen').value;

            if(nombre.length<=0 || nombre.length>100){
                alert('EL nombre no debe de tener menos o 0 caracteres ni tampoco tener mas de 100!!!');
                event.preventDefault();
                return false;
            }
            else{
                /*se verifica el modelo*/
                var esAlfanumerico = true; 
                var modelo = modelo.trim();

                if (modelo.length === 0) {
                    alert('El campo "modelo" es obligatorio y no puede estar en blanco.');
                    event.preventDefault(); // Evita el envío del formulario.
                    return false;
                }

                /*var esAlfanumerico = /^[a-zA-Z0-9]+$/.test(modelo);*/
                for (var i = 0; i < modelo.length; i++) {
                    var charCode = modelo.charCodeAt(i);
                    if (!((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || (charCode >= 48 && charCode <= 57))) {
                        esAlfanumerico = false;
                        break;
                    }
                }
                if (!esAlfanumerico || modelo.length > 25) {
                    alert('El modelo debe ser alfanumérico y tener una longitud máxima de 25 caracteres.');
                    event.preventDefault(); // Evita el envío del formulario.
                    return false;
                }
                else{
                    var esPrecioValido = !isNaN(parseFloat(precio)) && isFinite(precio) && parseFloat(precio) > 99.99;
                    if (!esPrecioValido) {
                        alert('El precio ingresado no es un número válido o debe de ser mayor a 99.99.');
                        event.preventDefault();
                        return false;
                    } 
                    else {
                        if(detalles.length >= 250){
                            alert('Los detalles deben de ser menos de 250 caracteres');
                            event.preventDefault();
                             return false;
                        }
                        else{
                            if(unidades.trim() === "" ){
                                alert('debe ingresar una cantidad unidades');
                                event.preventDefault();
                                return false;
                            }
                            else{
                                var unidadesNumericas = parseInt(unidades);
                                if (isNaN(unidadesNumericas) || unidadesNumericas < 0) {
                                    alert('Las unidades ingresadas no son un número válido o son menores que 0.');
                                    event.preventDefault();
                                    return false;
                                } else {
                                    if (imagen.trim() === "") {
                                        imagen = 'http://localhost/tecweb_practicas_PC/practicas/p07-base/img/default.png';

                                        document.getElementById('imagen').value = imagen;
                                        alert('Largo de nombre correcto, pero agregaremos una imagen por defecto, vuelve a registrar si estas seguro. \nMarca seleccionada: ' + marca + '.\nModelo: ' + modelo + '.\nPrecio: ' + precio + '.\nDetalles: ' + detalles + '.\nUnidades: ' + unidades + '.\nImagen por defecto: ' + imagen);
                                        event.preventDefault();
                                        return false;
                                    } else {
                                        alert('Largo de nombre correcto. \nMarca seleccionada: ' + marca + '.\nModelo: ' + modelo + '.\nPrecio: ' + precio + '.\nDetalles: ' + detalles + '.\nUnidades: ' + unidades + '.\nImagen seleccionada: ' + imagen);
                                        return true;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    </script>


    <!-- formulario -->
    <h1>Datos del reloj</h1>
<!--el onSubmit="" se queda asi vacio, pues la verificacion con js la activa el boton registrar con su onClick, evita enviar 
informacion incorrecta-->
    <form id="miFormulario" onsubmit="" method="post" action="set_producto_v2.php">
    <!-- 
    <form id="miFormulario" onsubmit="" method="post" action="set_producto_v2.php">
    -->
        <fieldset>
            <legend>Ingresa los datos e informacion de tu reloj a vender!:</legend>
            <ul>
                <li> <label for="nombre">Nombre:</label> <input type="text" name="nombre" id="nombre"> </li>
                <li> <label for="marcas">Marca:</label> 
                    <select id="marcas" name="marcas">
                        <option value="rolex">Rolex</option>
                        <option value="omega">Omega</option>
                        <option value="seiko">Seiko</option>
                        <option value="casio">Casio</option>
                        <option value="tagh">TAG Heuerio</option>
                        <option value="fossil">Fossil</option>
                    </select>
                </li>
                <li> <label for="modelo">Modelo:</label> <input type="text" name="modelo" id="modelo"> </li>
                <li> <label for="precio">Precio:</label> <input type="text" name="precio" id="precio"> </li>
                <li> <label for="detalles">Detalles:</label> <input type="text" name="detalles" id="detalles"> </li>
                <li> <label for="unidades">Unidades:</label> <input type="text" name="unidades" id="unidades"> </li>
                <li> <label for="imagen">Imagen:</label> <input type="text" name="imagen" id="imagen"> </li>
                
            </ul>
        </fieldset>
        <p>
            <input type="submit" name="registroProducto" value="Registrar" onClick="return verificar(event);">
        </p>
    </form>
</body>
</html>

