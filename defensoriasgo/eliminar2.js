function alerta_eliminar2(codigo){
    
    Swal.fire({
        title: 'Desea Eliminar Este Registro?',
        text: "No Podras Revertir Esta Accion!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar!'
      }).then((result) => {
        if (result.isConfirmed) {
          mandar_php(codigo);
        }
      })
}

function mandar_php(codigo){
    parametros = { id: codigo};
    $.ajax({
        data: parametros,
        url: "eliminar2.php",
        type: "POST",
        beforeSend: function () {},
        success: function () {

            Swal.fire(
                'Eliminado!',
                'Empleado Eliminado Correctamente.',
                'success'
              ).then((result) => {
                window.location.href = "panelempleados.php"
              });
        },
            
});
}