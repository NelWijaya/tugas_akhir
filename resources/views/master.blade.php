<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

    @stack('scriptHead')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:200,400,600&display=swap" rel="stylesheet">

    <title>Sanber Question</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand">Navbar</a>

        <button class="navbar-toggler d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="button col-12 col-md-3 ">

            @if (Session('name'))
                <a class="navbar-brand">Hello {{ Session('name') }}</a>
                <a href="/logout" class="btn btn-primary btn-lg active" role="button" aria-pressed="false">Log Out</a>
            @else
                <button type="button" class="btn btn-secondary col-12 col-lg-5 float-md-right ml-lg-3 ml-md-1 mb-3 mb-md-0 mt-3 mt-md-0"  data-toggle="modal" data-target="#signup">
                    Sign Up
                </button>
                <button type="button" class="btn btn-primary col-12 mt-md-3 mt-lg-0 col-lg-5 mb-3 mb-md-0 float-md-right" data-toggle="modal" data-target="#login">
                    Log In
                </button>
            @endif
        </div>
    </nav>
    <!-- End Navbar -->


    <!-- Modal -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="login" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="sign-up/store" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="sumbit" class="btn btn-primary">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End Modal -->

    <!-- Sidebar -->
    <div class="container-fluid sidebar">
        <div class="row" style="height: 100%;">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 bg-light d-md-block sidebar collapse border-right">
                <div class="sidebar-sticky pt-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a href="/pertanyaan" class="nav-link" role="button" aria-pressed="false">Home</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="/pertanyaan" role="tab" aria-controls="v-pills-profile" aria-selected="false">Tags</a>
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Users</a>
                    </div>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 pt-3">
                <!-- Content -->
                @yield('content')
                <!-- EndContent -->
            </main>
        </div>

    </div>

    <!-- End Sitebar -->

    <!-- Optional JavaScript -->
    @stack('script')

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('js/jquery-3.4.1.min.js')}}" ></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>
  </body>
</html>
