<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FONRIVEN</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/admin/src/assets/img/.ico')}}"/>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="{{asset('assets/admin/src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/layouts/collapsible-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/layouts/collapsible-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset('assets/admin/src/plugins/src/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/src/assets/css/light/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/dark/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/light/components/modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/dark/components/modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('assets/admin/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/src/assets/css/light/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('assets/admin/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/src/assets/css/dark/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/src/assets/css/light/elements/alert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/src/assets/css/dark/elements/alert.css')}}">
    <link href="{{asset('assets/admin/src/assets/css/dark/components/timeline.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/light/components/timeline.css')}}" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="{{ asset('assets/print/printThis.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    
</head>
<body class="layout-boxed alt-menu">
    
    











    
    @auth('admin')
    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">
            
            <ul class="navbar-item flex-row ms-lg-auto">
                
                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar" src="{{ Auth::guard('admin')->user()->photo }}" class="rounded-circle" id="profilePhotoHeader">
                            </div>
                        </div>
                    </a>
                    
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <div class="emoji me-2">
                                    <img alt="avatar" src="{{ Auth::guard('admin')->user()->photo }}" 
                                    class="rounded-circle" id="profilePhotoDropDown">
                                </div>
                                <div class="media-body">
                                    <h5>{{ Auth::guard('admin')->user()->name }}</h5>
                                    <p>Admin</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="dropdown-item">
                            <a id="logoutButton" href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket" style="width:30px;"></i>
                            <span>Log Out</span>
                        </a>
                        
                        <form id="logout-form" 
                        action="{{ route('admin.logout') }}" 
                        method="POST" class="d-none">
                        @csrf
                    </form>
                    
                </div>
            </div>
        </li>
    </ul>
</header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container sidebar-closed sidebar-closed" id="container">
    
    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">
        
        <nav id="sidebar">
            
            <div class="navbar-nav theme-brand flex-row  text-center">
                <div class="nav-logo">
                    <div class="nav-item theme-logo">
                        <a href="">
                        </a>
                    </div>
                    <div class="nav-item theme-text">
                        <a href="" class="nav-link">FONRIVEN</a>
                    </div>
                </div>
            </div>
            <div class="shadow-bottom"></div>
            <ul class="list-unstyled menu-categories" id="accordionExample">
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span class="text-capitalize"><i class="fa-solid fa-home" style="width:50px; height:100%;"></i>dashboard</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.supplierRequest') ? 'active' : '' }}">
                    <a href="{{ route('admin.supplierRequest') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span class="text-capitalize"><i class="fa-solid fa-box" style="width:50px; height:100%;"></i>supplier requests</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.users') ? 'active' : '' }}">
                    <a href="{{ route('admin.users') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span class="text-capitalize"><i class="fa-solid fa-user" style="width:50px; height:100%;"></i>users</span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--  END SIDEBAR  -->
    
    @yield('content')
    @yield('scripts')
    
    @endauth
    







    
    <!--  BEGIN FOOTER  -->
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">Copyright © <span class="dynamic-year">2023</span> <a href="">LOCKHOOD</a>, All rights reserved.</p>
        </div>
    </div>
    <!--  END FOOTER  -->
</div>
<!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/admin/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/admin/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/admin/src/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
<script src="{{asset('assets/admin/layouts/collapsible-menu/app.js')}}"></script>
<script src="{{asset('assets/admin/src/plugins/src/global/vendors.min.js')}}"></script>
<script src="{{asset('assets/admin/src/plugins/src/highlight/highlight.pack.js')}}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->

<script src="{{asset('assets/admin/src/assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('assets/admin/src/plugins/src/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/admin/src/assets/js/dashboard/dash_1.js')}}"></script>

<script src="{{asset('assets/admin/src/assets/js/apps/blog-create.js')}}"></script>
<script src="{{ asset('assets/print/printThis.js') }}"></script>
<!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->