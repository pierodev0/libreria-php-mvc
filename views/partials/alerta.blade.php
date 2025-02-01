
<script>
    let alerta = {!! json_encode(Helpers\Session::get('mensaje')) !!};

    document.addEventListener('DOMContentLoaded', function() {
        Toastify({
            text: alerta,
            duration: 4000,
            newWindow: true,
            close: true,
            gravity: "top", // top or bottom
            position: "right", // left, center or right
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#28a745",
                textColor: "white"
            },
            onClick: function() {} // Callback after click
        }).showToast();
    })
</script>
