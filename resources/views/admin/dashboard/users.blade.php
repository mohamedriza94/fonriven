@extends('layouts.adminMaster')

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>USERS</b></h3>
                <hr>
            </div>
            
            <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="alert">
                <strong></strong>
            </div>
            
            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-dark" id="btnAll">All</button>
                <button type="button" class="btn btn-dark" id="btnBuyers">Buyers</button>
                <button type="button" class="btn btn-dark" id="btnSuppliers">Suppliers</button>
                <input type="text" placeholder="Search" class="" id="search">
            </div>
            
            <div class="row layout-top-spacing">
                <div id="tableSimple" class="col-lg-12 col-12">
                    <div class="">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><b>User No.</b></th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="userTable">
                                        
                                    </tbody>
                                </table>
                                
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" id="btnPrev">Prev</button>
                                    <button type="button" class="btn btn-primary" id="btnNext">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- View Modal -->
            <div class="modal fade bd-example-modal-xl" id="viewModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contentLabel">View User Info.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body" id="">
                            
                            <form class="row g-3">
                                <div class="col-md-3">
                                    <img class="form-control" id="photoDisplay" src="" style="height:100px; object-fit: contain;">
                                </div>
                                
                                <div class="col-md-9">
                                    <label class="form-label">Name</label>
                                    <input  type="text" class="form-control text-dark" id="name" readonly>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">Telephone</label>
                                    <input  type="text" class="form-control text-dark" id="telephone" readonly>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">Email</label>
                                    <input  type="email" class="form-control text-dark" id="email" readonly>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">Joined</label>
                                    <input  type="email" class="form-control text-dark" id="joined" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    
</div>
</div>
</div>
@endsection


@section('scripts')
<script>
    $(document).ready(function(){
        
        //csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var publicURL = '{{ url("admin/dashboard/getUsers/:limit/:type") }}';
        var type = "all";
        getUsers();
        
        //limit and offset for pagination
        var limit = 0;
        $(document).on('click', '#btnNext', function(e) {
            limit = limit + 5;
            getUsers();
        });
        
        $(document).on('click', '#btnPrev', function(e) {
            limit = limit - 5;
            if(limit < 0)
            {
                limit = 0;
            }
            getUsers();
        });
        
        //select type
        $(document).on('click','#btnAll', function(e){
            type = "all";
            getUsers();
        });
        $(document).on('click','#btnBuyers', function(e){
            type = "buyer";
            getUsers();
        });
        $(document).on('click','#btnSuppliers', function(e){
            type = "supplier";
            getUsers();
        });
        
        //read users
        function getUsers()
        {
            var url = publicURL;
            url = url.replace(':limit', limit);
            url = url.replace(':type', type);
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    
                    $('#userTable').html('');
                    
                    $.each(response.users,function(key,item){
                        
                        var name = item.name;
                        var name = name.slice(0,15)+'...';
                        
                        var status = '';
                        if(item.status == 'active')
                        {
                            status = '<span class="badge badge-success">Active</span>';
                            button = '<div class="btn-group">\
                                <button value='+item.id+' class="btn btn-danger" id="btnDeactivate"> Deactivate </button>\
                                <button data-bs-toggle="modal" data-bs-target="#viewModal" value='+item.id+' class="btn btn-primary"\
                                id="btnView"> View </button>\
                            </div>';
                        }
                        else
                        {
                            status = '<span class="badge badge-danger">Inactive</span>';
                            button = '<div class="btn-group">\
                                <button value='+item.id+' class="btn btn-success" id="btnActivate"> Activate </button>\
                                <button data-bs-toggle="modal" data-bs-target="#viewModal" value='+item.id+' class="btn btn-primary"\
                                id="btnView"> View </button>\
                            </div>';
                        }
                        
                        $('#userTable').append('<tr><td>'+item.id+'</td>\
                            <td>'+name+'</td>\
                            <td>'+item.role+'</td>\
                            <td>'+status+'</td>\
                            <td>'+button+'\</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        //search
        $("#search").keyup(function(){
            
            var length = $('#search').val().length;
            
            if (length > 0) {
                publicURL = '{{ url("admin/dashboard/searchUsers/:search") }}';
                publicURL = publicURL.replace(':search', $("#search").val());
                getUsers();
            }
            else
            {
                publicURL = '{{ url("admin/dashboard/getUsers/:limit/:type") }}';
                getUsers();
            }
        });
        
        //activate
        $(document).on('click', '#btnActivate', function(e) {
            
            e.preventDefault();
            var no = $(this).val();
            var status = 'active';
            
            var data = {
                'no' : no,
                'status' : status
            }
            
            var url = '{{ url("admin/dashboard/changeStatus") }}';
            
            $.ajax({
                type:"POST",
                url: url,
                data:data,
                dataType:"json",
                success: function(response){
                    getUsers();
                }
            });
        });
        
        //deactivate
        $(document).on('click', '#btnDeactivate', function(e) {
            
            e.preventDefault();
            var no = $(this).val();
            var status = 'inactive';
            
            var data = {
                'no' : no,
                'status' : status
            }
            
            var url = '{{ url("admin/dashboard/changeStatus") }}';
            
            $.ajax({
                type:"POST",
                url: url,
                data:data,
                dataType:"json",
                success: function(response){
                    getUsers();
                }
            });
        });
        
        //view
        $(document).on('click', '#btnView', function(e) {
            e.preventDefault();

            var id = $(this).val();
            
            var url = '{{ url("admin/dashboard/viewUser/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success: function(response)
                {
                    $('#photoDisplay').attr("src", response.clients.photo);
                    $('#name').val(response.clients.name);
                    $('#telephone').val(response.clients.telephone);
                    $('#email').val(response.clients.email);
                    $('#joined').val(response.clients.joined);
                }
            });
        });
    });
    
</script>
@endsection