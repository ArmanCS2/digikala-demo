<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @include('app.layouts.head-tag')
    @yield('head-tag')
    @livewireStyles
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="">Livewire</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('livewire.index')}}">خانه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('livewire.task.base')}}">وظایف</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('livewire.product.base')}}">محصولات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('livewire.chat.rooms')}}">چت روم</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('livewire.cart')}}">
                        <livewire:product.cart-header/>
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('livewire.auth.logout')}}">خروج</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('livewire.auth.index')}}">ورود</a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</nav>


<!-- start main one col -->
<main id="main-body-one-col" class="main-body">

  @yield('content')

</main>
<!-- end main one col -->


<!-- start body -->
<section class="container-xxl body-container">
    <aside id="sidebar" class="sidebar">

    </aside>
    <main id="main-body" class="main-body">

    </main>
</section>
<!-- end body -->
@include('app.layouts.scripts')
@yield('scripts')


@include('alerts.toast.success')
@include('alerts.toast.error')
@include('alerts.toast.info')


@include('alerts.sweetalert.success')
@include('alerts.sweetalert.error')
@include('alerts.sweetalert.delete-confirm',['className'=>'delete'])
@livewireScripts
<script>
    let modal=document.getElementById('exampleModal');
    if (modal){
        var editModal= new bootstrap.Modal(modal);
    }
    Livewire.on('showEditForm',()=>{
        editModal.show();
    });
    Livewire.on('hideEditForm',()=>{
        editModal.hide();
    });
    Livewire.on('swal',(params)=>{
        Swal.fire(params);
    });
</script>
</body>
</html>
