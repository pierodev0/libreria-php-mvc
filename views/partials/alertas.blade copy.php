@if (!empty($alertas))
    <div class="flex flex-col gap-4">
       
    </div>

    <script>
        const alertas = document.querySelectorAll('.close-alert');
        alertas.forEach(alerta => {
            alerta.addEventListener('click', (e) => {
                const closeAlert = alerta.closest('.alert');
                closeAlert.remove();
            });
        });
        
    </script>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function() {
      Toastify({
        text: "This is a toast",
        duration: 3500,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "#e45054",
            textColor: "white"
        },
        onClick: function() {} // Callback after click
    }).showToast();
    })
</script>
