<script src="{{asset('admin-assets/js/jquery-3.5.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{asset('admin-assets/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('admin-assets/js/grid.js')}}"></script>
<script src="{{asset('admin-assets/select2/js/select2.min.js')}}"></script>
<script src="{{asset('sweetalert/sweetalert2.min.js')}}"></script>

<script>
    let notificationDropdown = document.getElementById('header-notification-toggle');
    notificationDropdown.addEventListener('click', function(){
        $.ajax({
            type : "POST",
            url : "{{route('admin.notification.read-all')}}",
            data : {_token: "{{ csrf_token() }}" },
            success : function(){
                console.log('read all notifications');
            }
        })
    });
</script>
