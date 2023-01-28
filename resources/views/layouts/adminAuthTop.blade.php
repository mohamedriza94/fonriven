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
    
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/src/assets/css/light/elements/alert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/src/assets/css/dark/elements/alert.css')}}">
    <link href="{{asset('assets/admin/src/assets/css/dark/components/timeline.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/light/components/timeline.css')}}" rel="stylesheet" type="text/css" />
    
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- END PAGE LEVEL CUSTOM STYLES -->

</head>
<body class="form">


    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

        <div class="d-flex mt-5 align-items-center justify-content-center">
        <h2 class="text-success"><b>FONRIVEN</b></h2>
        </div><hr>
            
    
            <div class="row">
                            @yield('content')
                            @yield('scripts')
            </div>
            
        </div>

    </div>
    
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
    <script src="{{asset('assets/admin/src/assets/js/scrollspyNav.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>
</html>