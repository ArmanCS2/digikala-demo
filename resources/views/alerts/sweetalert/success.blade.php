@if(session('swal-success'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                title:'موفق',
                text:'{{session('swal-success')}}',
                icon:'success',
                confirmButtonText:'باشه'
            });
        });
    </script>

@endif
