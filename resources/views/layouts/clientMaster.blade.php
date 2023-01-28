<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    {{-- <link rel="shortcut icon" href="./images/favicon.png"> --}}
    <!-- Page Title  -->
    <title>FONRIVEN</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/client/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/client/assets/css/theme.css?ver=3.0.3') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body class="nk-body bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger me-sm-2 d-lg-none">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                                class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand">
                                <a href="{{ route('client.dashboard') }}" class="logo-link d-flex align-items-center">
                                    <b>FONRIVEN</b>
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-menu ms-auto" data-content="headerNav">
                                <div class="nk-header-mobile">
                                    <div class="nk-header-brand">
                                        <a href="{{ route('client.dashboard') }}" class="logo-link">
                                            <b>FONRIVEN</b>
                                        </a>
                                    </div>
                                    <div class="nk-menu-trigger me-n2">
                                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon"
                                        data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                                    </div>
                                </div>
                                <ul class="nk-menu nk-menu-main ui-s2">
                                    
                                    <li class="nk-menu">
                                        <a href="{{ route('client.dashboard') }}" class="nk-menu-link">
                                            <span class="nk-menu-text">Home</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                    
                                    
                                    
                                    
                                    {{-- as a guest --}}
                                    @guest
                                    <li class="nk-menu">
                                        <a class="nk-menu-link">
                                            <span class="nk-menu-text">Make an Inquiry</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->

                                    <li class="nk-menu">
                                        <a data-bs-toggle="modal" data-bs-target="#modalSignup" class="nk-menu-link">
                                            <span class="nk-menu-text">Sign Up</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                    
                                    <li class="nk-menu">
                                        <a data-bs-toggle="modal" data-bs-target="#modalLogin"  class="nk-menu-link">
                                            <span class="nk-menu-text">Login</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                    @endguest
                                    
                                    
                                    
                                    @auth
                                    {{-- as a supplier --}}
                                    @if (auth()->guard('client')->user()->role == "supplier")
                                    <li class="nk-menu">
                                        <a href="{{ route('client.products') }}" class="nk-menu-link">
                                            <span class="nk-menu-text">Products</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                    @endif

                                    {{-- as a buyer --}}
                                    @if (auth()->guard('client')->user()->role == "buyer")
                                    <li class="nk-menu">
                                        <a href="{{ route('client.suppliers') }}" class="nk-menu-link">
                                            <span class="nk-menu-text">Suppliers</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                    @endif
                                    
                                    <li class="nk-menu">
                                        <a href="{{ route('client.connections') }}" class="nk-menu-link">
                                            <span class="nk-menu-text">My Connections</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                    
                                    <li class="nk-menu">
                                        <a href="{{ route('client.messages') }}" class="nk-menu-link">
                                            <span class="nk-menu-text">Messages</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                    
                                    <li class="nk-menu">
                                        <a data-bs-toggle="modal" data-bs-target="#modalManageAccount" class="nk-menu-link">
                                            <span class="nk-menu-text text-dark">Account</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                    
                                    <li class="nk-menu bg-dark">
                                        <a  href="{{ route('client.logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" class="nk-menu-link">
                                        <span class="nk-menu-text text-light">Logout</span>
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('client.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    @endauth
                                    
                                    
                                </ul><!-- .nk-menu -->
                            </div><!-- .nk-header-menu -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                
                @yield('content')
                @yield('scripts')
                
                
                {{-- MODALS --}}
                <!-- Modal Zoom -->
                <div class="modal fade zoom xl" tabindex="-1" id="modalSignup">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Signup</h5>
                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <em class="icon ni ni-cross"></em>
                                </a>
                            </div>
                            <div class="modal-body">
                                
                                <div class="alert alert-icon alert-danger" role="alert">
                                    <ul id="errorList"></ul>
                                </div>
                                
                                <div class="preview-block">
                                    <form class="row gy-4" enctype="multipart/form-data" method="post" id="signupForm">
                                        @csrf
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="name" name="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Telephone</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" id="telephone" name="telephone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">I am a</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="role" name="role" required>
                                                        <option value="supplier">Supplier</option>
                                                        <option value="buyer">Buyer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control" id="email" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Profile Photo</label></label>
                                                <div class="form-control-wrap">
                                                    <div class="form-file">
                                                        <input type="file" multiple class="form-file-input" id="photo" name="photo">
                                                        <label class="form-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <button class="btn btn-primary text-center" id="btnSignup" type="submit">Signup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <span class="sub-text">Get Registered as a Buyer or Supplier</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade zoom" tabindex="-1" id="modalLogin">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Login</h5>
                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <em class="icon ni ni-cross"></em>
                                </a>
                            </div>
                            <div class="modal-body">
                                
                                <div class="alert alert-icon alert-danger" role="alert">
                                    <ul>
                                        @error('password')
                                        <li id="errorListLogin">{{ $message }}</li>
                                        @enderror
                                    </ul>
                                </div>
                                
                                <div class="preview-block">
                                    <form class="row gy-4" method="post" action="{{ route('client.login.submit') }}">
                                        @csrf
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="emailLogin" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Password</label>
                                                <div class="form-control-wrap">
                                                    <input type="password" class="form-control" id="passwordLogin" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <button class="btn btn-primary text-center" id="btnLogin" type="submit">Login</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <span class="sub-text">Login as a Buyer or Supplier</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                @auth
                <div class="modal fade zoom xl" tabindex="-1" id="modalManageAccount">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Manage Account</h5>
                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <em class="icon ni ni-cross"></em>
                                </a>
                            </div>
                            <div class="modal-body">
                                
                                <div class="alert alert-icon alert-danger" role="alert">
                                    <ul id="errorList_Edit"></ul>
                                </div>
                                
                                <div class="preview-block">
                                    <form class="row gy-4" enctype="multipart/form-data" method="post" id="manageAccountForm">
                                        <input type="hidden" value="{{ auth()->guard('client')->user()->id }}" name="id" id="id">
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"  value="{{ auth()->guard('client')->user()->name }}" name="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Joined On</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" readonly value="{{ auth()->guard('client')->user()->joined }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Telephone</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"  value="{{ auth()->guard('client')->user()->telephone }}" name="telephone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Account Type</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" readonly value="{{ auth()->guard('client')->user()->role }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" value="{{ auth()->guard('client')->user()->email }}" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Profile Photo</label></label>
                                                <div class="form-control-wrap">
                                                    <img class="form-control" id="chosenPhoto" src="{{ auth()->guard('client')->user()->photo }}" style="height:100px; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Change Profile Photo</label></label>
                                                <div class="form-control-wrap">
                                                    <div class="form-file">
                                                        <input type="file" multiple class="form-file-input" id="editPhoto" name="photo">
                                                        <label class="form-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <button class="btn btn-dark text-center" id="btnSave" type="submit">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <span class="sub-text">My Account Details</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endauth
                
                
                <script>
                    $(document).ready(function(){
                        
                        //auto open login form if invalid credentials entered
                        setTimeout(() => {
                            
                            if($('#errorListLogin').html() == 'invalid Credentials')
                            {
                                $('#modalLogin').modal('show');
                            }
                        }, 100);  
                        
                        //csrf token
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        
                        //Create Account
                        $(document).on('click', '#btnSignup', function(e) {
                            e.preventDefault();
                            
                            $('#btnSignup').text('Creating...');
                            
                            var role = $('#role').val();
                            
                            var url = "";
                            
                            if(role=="supplier")
                            {
                                url = "{{ url('client/signupSupplier') }}";
                            }
                            else if(role=="buyer")
                            {
                                url = "{{ url('client/signupBuyer') }}";
                            }
                            
                            let formData = new FormData($('#signupForm')[0]);
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: formData,
                                contentType:false,
                                processData:false,
                                success: function(response){
                                    if(response.status==400)
                                    {
                                        $.each(response.errors,function(key,err_value){
                                            $('#errorList').append('<li>'+err_value+'</li>');
                                        });
                                        
                                        $('#btnSignup').text('Signup');
                                    }
                                    else
                                    {
                                        $('#errorList').html('');
                                        
                                        $('#btnSignup').removeClass('btn-primary');
                                        $('#btnSignup').addClass('btn-success');
                                        $('#btnSignup').text('Signup Request Sent!');
                                        
                                        setTimeout(function(){
                                            $('#btnSignup').removeClass('btn-success');
                                            $('#btnSignup').addClass('btn-primary');
                                            $('#btnSignup').text('Signup');
                                        }, 2000);
                                        
                                        $('#name').val('');
                                        $('#telephone').val('');
                                        $('#role').val('');
                                        $('#email').val('');
                                    }
                                }
                            });
                        });
                        
                        $("#editPhoto").change(function(){
                            var reader = new FileReader();
                            reader.onload = function(){
                                var output = document.getElementById('chosenPhoto');
                                output.src = reader.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        });
                        
                        //Edit Account
                        $(document).on('click', '#btnSave', function(e) {
                            e.preventDefault();
                            
                            
                            let formData = new FormData($('#manageAccountForm')[0]);
                            $.ajax({
                                type: "POST",
                                url: "{{ url('client/dashboard/editAccount') }}",
                                data: formData,
                                contentType:false,
                                processData:false,
                                success: function(response){
                                    if(response.status==400)
                                    {
                                        $.each(response.errors,function(key,err_value){
                                            $('#errorList_Edit').append('<li>'+err_value+'</li>');
                                        });
                                    }
                                    else
                                    {
                                        window.location.reload();
                                    }
                                }
                            });
                        });
                    });
                </script>
                
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer bg-white">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright">Copyright © 2023 <b>Fonriven</b>. All rights reserved.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- app-root @e -->
        <!-- JavaScript -->
        <script src="{{ asset('assets/client/assets/js/bundle.js?ver=3.0.3') }}"></script>
        <script src="{{ asset('assets/client/assets/js/scripts.js?ver=3.0.3') }}"></script>
        <script src="{{ asset('assets/client/assets/js/charts/gd-invest.js?ver=3.0.3') }}"></script>
        <script src="{{asset('assets/print/printThis.js')}}"></script>
        
    </body>
    
    </html>
