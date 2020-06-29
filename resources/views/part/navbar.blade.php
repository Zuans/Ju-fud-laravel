<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Ju-Fud</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item{{ request()->is('/')? ' active' : ' '}}">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown{{ request()->is('category')? ' active' : ' '}}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Category
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/category/Fast Food">Fast food</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/category/Makanan Warteg">Makanan Warteg</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/category/Makanan Padang">Makanan Padang</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/category/Cookie">Cookies</a>
                </div>
            </li>
            <li class="nav-item{{ request()->is('cart')? ' active' : ' '}}">
                <a class="nav-link" href="/cart">Cart</a>
            </li>
        </ul>
        <span class="navbar-text">
            <a href="{{ url('/login')}}" role="button" class="btn btn-outline-primary text-primary">Login</a>
        </span>
    </div>
</nav>