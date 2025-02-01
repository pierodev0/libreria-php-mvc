<script>
    document.addEventListener('DOMContentLoaded', function() {
        let alertas = {!! json_encode($alertas) !!};

        const obtenerFondo = (tipo) => {
            switch (tipo) {
                case 'error':
                    return "#e45054"; // Rojo para errores
                case 'exito':
                    return "#28a745"; // Verde para éxitos
                default:
                    return "#e45054"; // Fondo por defecto (rojo)
            }
        };

        Object.entries(alertas).forEach(([tipo, mensajes]) => {
            mensajes.forEach(mensaje => {

                Toastify({
                    text: mensaje,
                    duration: 4000,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: obtenerFondo(tipo),
                        textColor: "white"
                    },
                    onClick: function() {} // Callback after click
                }).showToast();

            });
        });
    });
</script>
