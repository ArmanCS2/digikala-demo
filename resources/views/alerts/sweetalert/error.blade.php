@if(\Illuminate\Support\Facades\Session::has('swal-error'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                title: 'خطا!',
                text: '{{\Illuminate\Support\Facades\Session::get('swal-error')}}',
                icon: 'error',
                confirmButtonText: 'باشه'
            })
        })
    </script>
    @php
        \Illuminate\Support\Facades\Session::forget('swal-error');
    @endphp
@endif
