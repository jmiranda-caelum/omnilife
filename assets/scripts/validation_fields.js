function submit_form(){

    var dolares = $('#salarioDolares').val();
    if (isNaN(dolares)) { 
        Swal.fire('Solo dígitos en dolares','','error');
        return;
    }

    var pesos = $('#salarioPesos').val();
    if (isNaN(dolares)) { 
        Swal.fire('Solo dígitos en pesos','','error');
        return;
    }

    var codigo = $('#codigo').val();
    var nombre = $('#nombre').val();
    var direccion = $('#direccion').val();
    var estado = $('#estado').val();
    var ciudad = $('#ciudad').val();
    var telefono = $('#telefono').val();
    var correo = $('#correo').val();

    checkCode(codigo);
    
    
    //CAMPOS VACIOS

    if (codigo == '') {
        Swal.fire('','El codigo se encuentra vacío','warning');
        return;
    }

    if (nombre == '') {
        Swal.fire('','El nombre se encuentra vacío','warning');
        return;
    }

    if (dolares == '' || dolares == 0) {
        Swal.fire('','Ingresar una cantidad en dolares mayor a 0','warning');
        return;
    }

    if (pesos == '' || pesos == 0) {
        Swal.fire('','Ingresar una cantidad en dolares mayor a 0','warning');
        return;
    }

    if (direccion == '') {
        Swal.fire('','La dirección está vacía','warning');
        return;
    }

    if (estado == '') {
        Swal.fire('','El estado estpa vacío','warning');
        return;
    }

    if (ciudad == '') {
        Swal.fire('','El campo ciudad está vacío','warning');
        return;
    }

    if (telefono == '') {
        Swal.fire('','El teléfono se encuentra vacío','warning');
        return;
    }

    if (correo == '') {
        Swal.fire('','El correo se encuentra vacío','warning');
        return;
    }

    // EXTRA VALIDATIONS

    if(!ValidateEmail(correo)){
        Swal.fire('','Verifica el formato del correo','warning');
        return;
    }

    if(check_characters(nombre)){
        Swal.fire('','Verifica que el nombre no tenga acentos, ni "ñ"','warning');
        return;
    }

    $('#form_employees').submit();
}

function ValidateEmail(mail) 
{
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(mail);
}

function check_characters(name){
    var accentArray = ["á","à","ã","â","é","è","ê","í","ì","î","õ","ó","ò","ô","ú","ù","û","ñ","Ñ","Á","É","Í","Ó","Ú"]
    var stringToCheck = name

    for(var i=0; i < stringToCheck.length; i++){
        for(var j=0; j < accentArray.length; j++){
            if(stringToCheck[i] === accentArray[j]){
                return true;
            }
        }
    }
}
