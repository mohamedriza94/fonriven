@extends('layouts.adminMaster')

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>SUPPLIER REQUESTS</b></h3>
                <hr>
            </div>
            
            <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="alert">
                <strong></strong>
            </div>
            
            <div class="row layout-top-spacing">
                <div id="tableSimple" class="col-lg-12 col-12">
                    <div class="">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><b>Request No.</b></th>
                                            <th scope="col">Supplier</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="supplierTable">
                                        
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
            
            <!-- Decision Modal -->
            <div class="modal fade bd-example-modal-xl" id="decisionModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contentLabel">Request Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <ul class="bg-warning form-control px-5" id="errorList">
                                
                            </ul>
                        </div>
                        
                        <div class="modal-body" id="">
                            
                            <form class="row g-3">
                                <input type="hidden" id="id" readonly>
                                <input type="hidden" id="photo" readonly>

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
                                    <label class="form-label">Request Date</label>
                                    <input  type="email" class="form-control text-dark" id="date" readonly>
                                </div>
                                
                                <div class="col-md-6">
                                    <button class="btn btn-success form-control" type="submit" id="btnAccept">Accept</button>
                                </div>
                                
                                <div class="col-md-6">
                                    <button class="btn btn-danger form-control" type="submit" id="btnDecline">Decline</button>
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
        
        //call function to get factories
        setInterval(() => {
            getRequests();
        }, 2000);
        
        //limit and offset for pagination
        var limit = 0;
        $(document).on('click', '#btnNext', function(e) {
            
            limit = limit + 5;
            getRequests();
            
        });
        
        $(document).on('click', '#btnPrev', function(e) {
            
            limit = limit - 5;
            
            if(limit < 0)
            {
                limit = 0;
            }
            
            getRequests();
            
        });
        
        //read
        function getRequests()
        {
            var url = '{{ url("admin/dashboard/getRequests/:limit") }}';
            url = url.replace(':limit', limit);
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    
                    $('#supplierTable').html('');
                    
                    $.each(response.requests,function(key,item){
                        
                        var name = item.name;
                        var name = name.slice(0,15)+'...';

                        var status = '';
                        var button = '';
                        if(item.status == 'pending')
                        {
                            status = '<span class="badge badge-warning">Pending</span>';
                            button = '<div class="btn-group">\
                                    <button data-bs-toggle="modal" data-bs-target="#decisionModal" value='+item.id+' class="btn btn-dark" id="btnOpen">View</button>\
                                </div>';
                        }
                        else if(item.status == 'accepted')
                        {
                            status = '<span class="badge badge-success">Accepted</span>';
                            button = '-';
                        }
                        else
                        {
                            status = '<span class="badge badge-danger">Declined</span>';
                            button = '-';
                        }

                        $('#supplierTable').append('<tr><td>'+item.id+'</td>\
                            <td>'+name+'</td>\
                            <td>'+item.date+'</td>\
                            <td>'+status+'</td>\
                            <td>'+button+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        //Accept
        $(document).on('click', '#btnAccept', function(e) {
            
            $('#btnAccept').text('Wait...');
            $('#btnAccept').attr('disabled','disabled');

            e.preventDefault();
            var id = $('#id').val();
            var photo = $('#photo').val();
            var name = $('#name').val();
            var telephone = $('#telephone').val();
            var email = $('#email').val();
            var status = 'accepted';
            
            var data = {
                'id' : id,
                'photo' : photo,
                'name' : name,
                'telephone' : telephone,
                'email' : email,
                'status' : status
            }
            
            var url = '{{ url("admin/dashboard/takeActionToRequest") }}';
            
            $.ajax({
                type:"POST",
                url: url,
                data:data,
                dataType:"json",
                success: function(response){
                    if(response.status==400)
                    {
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else
                    {
                        $('#errorList').html('');
                        
                        $('#btnAccept').removeClass('btn-success');
                        $('#btnAccept').addClass('btn-dark');
                        $('#btnAccept').text('Accepted!');
                        
                        setTimeout(function(){
                            $('#btnAccept').removeClass('btn-dark');
                            $('#btnAccept').addClass('btn-success');
                            $('#btnAccept').removeAttr('disabled');
                            $('#decisionModal').modal('hide');
                        }, 2000);
                        
                        getRequests();
                    }
                }
            });
        });
        
        //Decline
        $(document).on('click', '#btnDecline', function(e) {
            
            $('#btnDecline').text('Wait...');
            $('#btnDecline').attr('disabled','disabled');
            
            e.preventDefault();
            var id = $('#id').val();
            var photo = $('#photo').val();
            var name = $('#name').val();
            var telephone = $('#telephone').val();
            var email = $('#email').val();
            var status = 'declined';
            
            var data = {
                'id' : id,
                'photo' : photo,
                'name' : name,
                'telephone' : telephone,
                'email' : email,
                'status' : status
            }
            
            var url = '{{ url("admin/dashboard/takeActionToRequest") }}';
            
            $.ajax({
                type:"POST",
                url: url,
                data:data,
                dataType:"json",
                success: function(response){
                    if(response.status==400)
                    {
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else
                    {
                        $('#errorList').html('');
                        
                        $('#btnDecline').removeClass('btn-danger');
                        $('#btnDecline').addClass('btn-dark');
                        $('#btnDecline').text('Accepted!');
                        
                        setTimeout(function(){
                            $('#btnDecline').removeClass('btn-dark');
                            $('#btnDecline').addClass('btn-danger');
                            $('#btnDecline').removeAttr('disabled');
                            $('#decisionModal').modal('hide');
                        }, 2000);
                        
                        getRequests();
                    }
                }
            });
        });
        
        //Edit
        $(document).on('click', '#btnOpen', function(e) {
            
            var id = $(this).val();
            
            var url = '{{ url("admin/dashboard/viewRequest/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success: function(response)
                {
                    $('#id').val(response.requests.id);
                    $('#photo').val(response.requests.photo);
                    $('#photoDisplay').attr("src", response.requests.photo);
                    $('#date').val(response.requests.date);
                    $('#name').val(response.requests.name);
                    $('#telephone').val(response.requests.telephone);
                    $('#email').val(response.requests.email);
                }
            });
            
        });
    });
    
</script>
@endsection