<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Sistem Informasi KRS</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="ti-settings"></i>
								<p>Settings</p>
                                <b class="caret"></b>
                            </a>
                             <ul class="dropdown-menu">
                                <li>
                                <a href="{{route(Auth::user()->role.'.resetpass')}}">Ubah Password</a></li>
                                <li><a href="{{route('logout')}}">Log Out</a></li>
                              </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>