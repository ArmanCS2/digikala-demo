@if(\Illuminate\Support\Facades\Session::has('swal-success'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                title: 'موفق',
                text: '{{\Illuminate\Support\Facades\Session::get('swal-success')}}',
                icon: 'success',
                confirmButtonText: 'باشه'
            });
        });
    </script>
    @php
        \Illuminate\Support\Facades\Session::forget('swal-success');
    @endphp
@endif
