var code;
function createCaptcha() {
    //clear the contents of captcha div first 
    document.getElementById('captcha').innerHTML = "";
    var charsArray =
        "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var lengthOtp = 4;
    var captcha = [];
    for (var i = 0; i < lengthOtp; i++) {
        //below code will not allow Repetition of Characters
        var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
        if (captcha.indexOf(charsArray[index]) == -1)
            captcha.push(charsArray[index]);
        else i--;
    }
    var canv = document.createElement("canvas");
    canv.id = "captcha";
    canv.width = 100;
    canv.height = 50;
    var ctx = canv.getContext("2d");
    ctx.font = "25px Georgia";
    ctx.strokeText(captcha.join(""), 0, 30);
    //storing captcha so that can validate you can save it somewhere else according to your specific requirements
    code = captcha.join("");
    document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
}
function validateCaptcha(e) {
    e.preventDefault();

    if (document.getElementById("cpatchaTextBox").value == code) {
        alert("Valid Captcha")

    } else {
        alert("Invalid Captcha. try Again");
        createCaptcha();
    }
}


















$(document).ready(function () {

    // TODO: agregar funcion de llenado de lista

    $("#form_nuevo_usuario").submit(function (event) {
        event.preventDefault();

        if (document.getElementById("cpatchaTextBox").value == code) {
            // alert("Valid Captcha")
            const formData = new FormData($("#form_nuevo_usuario")[0]);
          
            $.ajax({
                url: 'index.php',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (response) {
                    // console.log(response);
                    // $('#form_nuevo_usuario').trigger('reset');
                    // alertify.success('Exitoso. Usuario registrado.');
                    console.log(response)
                    if(response!="0"){
                      window.location='';  
                    }else{
                        $("#errorcito").html("Nombre de usuario y/o password incorrecto");
                    }
                    
                    // listar_usuarios();

                }
            });

        } else {
            alert("Invalid Captcha. try Again");
            createCaptcha();
        }









    });
    // listar
    function listar_usuarios() {
        $.post('listar-usuario', function (response) {
            $("#contenedor-lista").html(response)
        });
    }
    // eliminar
    $(document).on('click', '.delete_pro', () => {
        const element = document.activeElement.parentNode.lastElementChild;
        const [usu_id, usu_img, per_id] = element.value.split(",");
        // console.log(usu_id)
        alertify.confirm('¿Desea eliminar el producto?', function () {
            const url = 'eliminar-usuario';
            $.post(url, {
                usu_id, usu_img, per_id
            }, (response) => {
                console.log(response)
                listar_usuarios();
            });
            alertify.warning('Producto eliminado.');
        });
    });

    // editar -lanzar modal de edicion
    $(document).on('click', '.edit_pro', () => {

        const element = document.activeElement.parentNode.lastElementChild;
        const [usu_id] = element.value.split(",");
        console.log(usu_id)
        $.post('editar-usuario', { usu_id }, function (response) {
            $("#show-modal-editar").html(response)
            $("#modalusuarioeditar").modal('show');
            // console.log(response)
        });
    });

    // button activo o incativo

    $(document).on('click', '.btn-est', () => {

        const element = document.activeElement.parentNode.parentNode.lastElementChild.lastElementChild;
        const [usu_id] = element.value.split(",");
        let elemento = document.activeElement.parentNode.lastElementChild.innerHTML;

        let estado;
        if (elemento == 'activo') {
            estado = "0";
        }
        else {
            estado = "1"
        }

        console.log("ele:", elemento)
        console.log("estado:", estado)
        $.post('estado-usuario', { usu_id, estado }, function (response) {

            console.log("res:", response)
            listar_usuarios()
        });
    });




    // editar para actualizar la bd
    // TODO: el form debe estar en el html
    $("#formedita").submit(function (event) {
        event.preventDefault();
        // const formData = new FormData($("#form_editar_usuario")[0]);
        console.log("editatatatat")
        // $.ajax({
        //     url: 'editar-usuario-guardar',
        //     type: 'POST',
        //     data: formData,
        //     cache: false,
        //     processData: false,
        //     contentType: false,
        //     success: (response) => {
        //         console.log(response);
        //         // alertify.success("<b>Datos enviados...</b>");
        //         // alertify.alert("<b style='color: #008000;'>" + dat + "</b> ", function () {
        //         //     window.location = '';
        //         // });
        //     }
        // });
    });
    // listar al inicio 
    // listar_usuarios();
});



// // Alinicio 
// $(document).ready(function () {
//     fetchProductos();
//     let editar = false;
//     // obteniendo los productos por ajax y renderizando los mismos en el DOM
//     function fetchProductos() {
//         $.ajax({
//             url: 'producto/ajaxProductos',
//             type: 'GET',
//             success: function (response) {
//                 const productos = JSON.parse(response);
//                 let template = '';
//                 productos.forEach((producto, index) => {
//                     // console.log(producto)
//                     template += `
//                 <tr>
//                     <th scope="row">${index + 1}</th>
//                     <td>${producto.nombre}</td>
//                     <td>${producto.nombre_pro}</td>
//                     <td>${producto.precio_pro}</td>
//                     <td>${producto.stock_pro}</td>
//                     <td>
//                         <button type="button" class="edit_pro btn btn-sm btn-outline-warning">
//                             <img src="public/icons/edit.png" alt="">
//                         </button>
//                         <button type="button" class="delete_pro btn btn-sm btn-outline-danger">
//                             <img src="public/icons/delete.png" alt="">
//                         </button>
//                     </td>
//                     <td class="oculto">${producto.id_producto}</td>
//                 </tr>
//                 `

//                 });
//                 $('#contenedor-lista').html(template);
//             }
//         });
//     }

//     // enviando datos del formulario PRODUCTO por ajax
//     $('#form-producto').submit(e => {
//         e.preventDefault();
//         $('#modalproducto').modal('hide');
//         const postData = {
//             nombre: $('#nombre').val(),
//             precio: $('#precio').val(),
//             stock: $('#stock').val(),
//             estado: $('input:checkbox[name=estado]:checked').val() ? "1" : "0",
//             idcategoria: $('select[id=categoria]').val(),
//             id_producto: $('#id_producto').val()

//         };
//         console.log(postData.id_producto);
//         if (editar) {
//             let url = 'producto/ajaxActualizarProducto';
//             console.log(postData, url);
//             $.post(url, postData, (response) => {
//                 console.log(response);
//                 $('#form-producto').trigger('reset');
//                 alertify.notify('Producto actualizado.', 'success', 5, function () { console.log('dismissed'); })

//             });
//             // resetenado valores para el MOdo Nuevo 
//             editar=false
//             $('#id_producto').val('');
//         }
//         else {
//             let url = 'producto/ajaxGuardarProductos';
//             // console.log(postData, url);
//             $.post(url, postData, (response) => {
//                 console.log(response);
//                 $('#form-producto').trigger('reset');
//                 alertify.notify('Producto registrado', 'success', 5, function () { console.log('dismissed'); })

//             });
//         }
//         fetchProductos();
//     });





//     // eliminando un producto

//     $(document).on('click', '.delete_pro', (e) => {
//         const element = document.activeElement.parentNode.parentNode.lastElementChild
//         const id = element.innerHTML;

//         alertify.confirm('¿Desea eliminar el producto?', function () {

//             const url = 'producto/ajaxEliminarProducto';
//             console.log(id)
//             $.post(url, { id }, (response) => {
//                 console.log(response)
//                 fetchProductos();
//             });
//             alertify.warning('Producto eliminado.');
//         });
//     });
//     // editar el producto
//     $(document).on('click', '.edit_pro', (e) => {
//         const element = document.activeElement.parentNode.parentNode.lastElementChild
//         const id = element.innerHTML;
//         const url = 'producto/ajaxGetProducto';
//          // para reutilizar el modal pero en modo Edicion
//          editar=true;
//          $('#id_producto').val(id);
//          console.log(id)
//          // 
//         console.log(id);
//         $.post(url, { id }, (response) => {
//             // console.log(response)
//             const producto = JSON.parse(response);
//             console.log(producto)
//             $('#nombre').val(producto.nombre_pro);
//             $('#precio').val(producto.precio_pro);
//             $('#stock').val(producto.stock_pro);

//             $("#categoria").val(producto.id_categoria).change();
//             if (producto.estado_pro == '1')
//                 $("#estado").prop('checked', true);
//             else
//                 $("#estado").prop('checked', false);

//             $('#modalproductoLabel').text('Editar Producto')
//         });

//         $('#modalproducto').modal('show');
//         e.preventDefault();

//     });


// });
// function resetFormulario() {
//     $('#form-producto').trigger('reset');
// }