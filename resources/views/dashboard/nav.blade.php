<div class="col-lg-2  nav-vertical col-sm-12">
    <ul class="nav flex-column bg-dark fixed">
        <li class="nav-item pt-3 mx-auto">
            <img src="/storage/profile_image/{{ session('profile') }}" class="rounded-circle img-profil" alt="">
            <div class="ml-3 mt-2">
                <i class="fas fa-circle text-success d-inline"></i>
                <p class="mt-1 text-center text-white d-inline ">Online</p>
            </div>
        </li>
        <li class="nav-item pt-2">
            <p class="text-center title-nav text-white">Hello, {{ session('name')}}</p>
            <hr class="hr-nav">
        </li>
        <li class="nav-item pt-2">
            <a class="nav-link active text-primary" href="{{ url('/dashboard')}}"><i class="fas fa-user pr-2"></i>Info Akun</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link active text-primary" href="{{ url('/dashboard/index')}}"><i class="far fa-edit pr-2"></i>Daftar makanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-primary" href="{{ url('/dashboard/tambah')}}"><i class="fas fa-plus pr-2"></i>Tambah makanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary" href="{{ url('/dashboard/payment')}}"><i class="fas fa-align-justify pr-2"></i>Transaksi Berhasil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary pb-5" href="{{ url('/dashboard/payment/success')}}"><i class="fas fa-calendar-check  pr-2"></i>Pesanan Selesai</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary" href="{{ url('/')}}"><i class="fas fa-home pr-2"></i>Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger pb-5" href="{{ url('/logout')}}"><i class="fas fa-sign-out-alt pr-2"></i>Logout</a>
        </li>
    </ul>
</div>