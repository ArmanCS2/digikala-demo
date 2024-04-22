<script src="{{asset('admin-assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('admin-assets/js/popper.js')}}"></script>
<script src="{{asset('admin-assets/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('admin-assets/js/grid.js')}}"></script>
<script src="{{asset('admin-assets/select2/js/select2.min.js')}}"></script>
<script src="{{asset('sweetalert/sweetalert2.min.js')}}"></script>
<script src="{{asset('admin-assets/fontawesome/js/all.js')}}"></script>

<script>
    let notificationDropdown = document.getElementById('header-notification-toggle');
    notificationDropdown.addEventListener('click', function () {
        $.ajax({
            type: "POST",
            url: "{{route('admin.notification.read-all')}}",
            data: {_token: "{{ csrf_token() }}"},
            success: function () {
                console.log('read all notifications');
            }
        })
    });
</script>
