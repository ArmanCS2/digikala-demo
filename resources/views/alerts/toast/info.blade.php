@if(session('toast-info'))
    <section class="toast" data-delay="3000">
        <section class="toast-body py-3 d-flex bg-info text-white">
            <strong class="ml-auto">{{session('toast-info')}}</strong>
            <a  class="mr-2 close" data-dismiss="toast" aria-label="Close">
            </a>

        </section>
    </section>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        })
    </script>
@endif
