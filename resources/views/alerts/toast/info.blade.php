@if(\Illuminate\Support\Facades\Session::has('toast-info'))
    <section class="toast-wrapper flex-row-reverse">
        <section class="toast">
            <section class="toast-body py-3 d-flex bg-info text-white">
                <strong class="ml-auto">{{\Illuminate\Support\Facades\Session::get('toast-info')}}</strong>
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
    @php
        \Illuminate\Support\Facades\Session::forget('toast-info');
    @endphp
@endif
