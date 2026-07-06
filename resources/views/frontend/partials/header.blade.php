<div id="header">
    <div class="container">
        <div id="welcomeLine" class="row">
            <div class="span6">Welcome! <strong>User</strong></div>
            <div class="pull-right">
                <a href="#">
                    <span class="btn btn-mini btn-primary">
                        <i class="icon-shopping-cart icon-white"></i>
                        [ 3 ] Items in your cart
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

<section id="navbar">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">

                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <a class="brand" href="https://www.patrickjmasoka.co.zw/">DelosTech</a>

                <div class="nav-collapse">
                    <ul class="nav">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        @foreach ($categories as $category)
                            <li class="dropdown">
                                {{-- Main Category Link --}}
                                <a href="{{ url($category->slug) }}" class="dropdown-toggle" data-toggle="dropdown">
                                    {{ $category->name }}
                                    @if ($category->children->count())
                                        <b class="caret"></b>
                                    @endif
                                </a>

                                @if ($category->children->count())
                                    <ul class="dropdown-menu">
                                        @foreach ($category->children as $child)
                                            {{-- Child clickable --}}
                                            <li>
                                                <a href="{{ url($child->slug) }}">
                                                    <strong>{{ $child->name }}</strong>
                                                </a>
                                            </li>

                                            {{-- Sub children --}}
                                            @foreach ($child->children as $sub)
                                                <li style="padding-left:15px;">
                                                    <a href="{{ url($sub->slug) }}">
                                                        - {{ $sub->name }}
                                                    </a>
                                                </li>
                                            @endforeach

                                            <li class="divider"></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <form class="navbar-search pull-left">
                        <input type="text" class="search-query span2" placeholder="Search">
                    </form>

                    <ul class="nav pull-right">
                        <li>
                            <a href="#">Contact</a>
                        </li>

                        <li class="divider-vertical"></li>

                        @guest
                            <li>
                                <a href="{{ route('register') }}">Register</a>
                            </li>

                            <li class="divider-vertical"></li>

                            <li>
                                <a href="">Login</a>
                            </li>
                        @endguest

                        @auth
                            <li>
                                <a href="">My Account</a>
                            </li>

                            <li class="divider-vertical"></li>

                            <li>
                                <form action="" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit"
                                        style="background:none;border:none;padding:0;color:#08c;cursor:pointer;">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>
