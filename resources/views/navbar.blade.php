<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">{{getLanguage()=='ar'? 'الفئات' : 'Categories'}}</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            @php
            $categories = App\Models\Category::latest()->getData()->with(['subCategories' => function ($query) {
            $query->getData()->get();
            }])->get();
            @endphp
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    @foreach ($categories as $category)
                    @if (!($category->subCategories->isEmpty()))
                    <div class="nav-item dropdown">
                        <a href="{{route('category.products',['category_slug'=>$category->category_slug])}}" class="nav-link" data-toggle="dropdown">{{$category->category_name}} <i class="fa fa-angle-down float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            @foreach ($category->subCategories as $sub_category)
                            <a href="{{route('sub.category.products',['sub_category_slug'=>$sub_category->sub_category_slug])}}" class="dropdown-item">{{$sub_category->sub_category_name}}</a>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <a href="{{route('category.products',['category_slug'=>$category->category_slug])}}" class="nav-item nav-link">{{$category->category_name}}</a>
                    @endif
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('index')}}" class="nav-item nav-link">Home</a>
                        <!-- <a href="{{route('shop')}}" class="nav-item nav-link">Shop</a> -->
                        <!-- <a href="{{route('details',['product_slug'=>'Colorful-Stylish-Shirt'])}}" class="nav-item nav-link">Shop Detail</a> -->
                        <a href="{{route('cart')}}" class="nav-item nav-link">Shopping Cart</a>
                        <a href="{{route('checkout')}}" class="nav-item nav-link">Checkout</a>
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{route('cart')}}" class="dropdown-item">Shopping Cart</a>
                                <a href="{{route('checkout')}}" class="dropdown-item">Checkout</a>
                            </div>
                        </div> -->
                        <a href="{{route('contact')}}" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        @guest
                        <a href="{{route('login')}}" class="nav-item nav-link">Login</a>
                        <a href="{{route('register')}}" class="nav-item nav-link">Register</a>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>