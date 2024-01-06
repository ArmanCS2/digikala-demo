@if(session('toast-error'))
    <section class="toast-wrapper flex-row-reverse">
        <section class="toast">
            <section class="toast-body py-3 d-flex bg-danger text-white">
                <strong class="ml-auto">{{session('toast-error')}}</strong>
                <a class="mr-2 close" data-dismiss="toast" aria-label="Close">
                </a>

            </section>
        </section>
    </section>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show').delay(4000).queue(function () {
                $('.toast-wrapper').addClass('d-none');
                $(this).remove();
            });
        })
    </script>
@endif
