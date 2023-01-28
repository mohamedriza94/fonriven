@extends('layouts.adminMaster')

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0" id="wholePage">
            
            <div class="row layout-top-spacing">
                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-three">
                        <h5>Inquiries</h5>
                        <p id="inquiries"></p>
                    </div>
                </div>
                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-three">
                        <h5>Pending Supplier Requests</h5>
                        <p id="supplierRequests"></p>
                    </div>
                </div>
                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-three">
                        <h5>Total Buyers</h5>
                        <p id="buyers"></p>
                    </div>
                </div>
                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-three">
                        <h5>Total Suppliers</h5>
                        <p id="suppliers"></p>
                    </div>
                </div>
                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-three">
                        <h5>Total Users</h5>
                        <p id="users"></p>
                    </div>
                </div>
                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-three">
                        <h5>Total Connections</h5>
                        <p id="connections"></p>
                    </div>
                </div>
                
                
            </div>
            
        </div>
        
    </div>
    
    <script>
        $(document).ready(function(){
            counts();
            setInterval(() => {
                counts();
            }, 4000);

            function counts()
            {
                var url = '{{ url("admin/dashboard/counts") }}';
                
                $.ajax({
                    type:"GET",
                    url:url,
                    dataType:"json",
                    success: function(response)
                    {
                        $('#inquiries').text(response.inquiries);
                        $('#supplierRequests').text(response.supplierRequests);
                        $('#buyers').text(response.buyers);
                        $('#suppliers').text(response.suppliers);
                        $('#users').text(response.users);
                        $('#connections').text(response.connections);
                    }
                });
            }
        });
    </script>
    @endsection
    
