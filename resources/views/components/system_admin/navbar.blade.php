<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">ADMIN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!-- CÂY CẢNH -->
            <li class="nav-item dropdown {{ substr(Route::currentRouteName(), 0, strpos(Route::currentRouteName(), '.')) == 'server_plant' ? 'active font-weight-bold ' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Bách khoa cây cảnh
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/admin/server_plant/list_plant">Danh sách cây cảnh</a>
                    <a class="dropdown-item" href="/admin/server_plant/list_plant_contribute">Yêu cầu đóng góp cây cảnh</a>
                    <a class="dropdown-item" href="/admin/server_plant/list_plant_edit">Yêu cầu chỉnh sửa cây cảnh</a>
                    <a class="dropdown-item" href="/admin/server_plant/add_plant">Thêm mới</a>
                </div>
            </li>
            <!-- DUYỆT CHUYÊN GIA -->
            <li class="nav-item dropdown {{ substr(Route::currentRouteName(), 0, strpos(Route::currentRouteName(), '.')) == 'expert_pending' ? 'active font-weight-bold ' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Duyệt chuyên gia
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/admin/expert_pending/list_pending">Danh sách yêu cầu duyệt chuyên
                        gia</a>
                    <a class="dropdown-item" href="/admin/expert_pending/list_expert">Danh sách chuyên gia</a>
                </div>
            </li>
            <!-- THẺ BÀI VIẾT -->
            <li class="nav-item dropdown {{ substr(Route::currentRouteName(), 0, strpos(Route::currentRouteName(), '.')) == 'tag' ? 'active font-weight-bold ' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Thẻ bài viết
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/admin/tag/list_tag">Danh sách thẻ bài viết</a>
                    <a class="dropdown-item" href="/admin/tag/add_tag">Thêm mới</a>
                </div>
            </li>
        </ul>



        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Search Plant -->
            @if(Route::current()->getName() == 'server_plant.list_plant')
                <form type="GET" class="form-inline my-2 my-lg-0">
                    <input name='keyword' class="form-control mr-sm-2" type="search" placeholder="Tìm cây cảnh" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm</button>
                </form>
            @endif
            <!-- Search Tag -->
            @if(Route::current()->getName() == 'tag.list_tag')
                <form type="GET" class="form-inline my-2 my-lg-0">
                    <input name='keyword' class="form-control mr-sm-2" type="search" placeholder="Tìm thẻ" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm</button>
                </form>
            @endif
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Đăng xuất') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
