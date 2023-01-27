@extends('layouts.clientMaster')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Suppliers</h3>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input type="text" class="form-control" id="searchSupplier" placeholder="Search">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                
                <div class="nk-block nk-block-lg">
                    <div class="row g-gs" id="supplierList">
                        
                        
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

{{-- modal to check supplier details  --}}
<div class="modal fade zoom xl" tabindex="-1" id="modalViewProfile">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Profile</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="preview-block">
                    
                    <div class="row g-3"> 
                        <input type="hidden" id="id">
                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <img class="form-control" id="photo" src="" style="height:100px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Telephone</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="telephone" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Joined On</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="joined" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" id="btnUpdateProduct"></em><span>Save Changes</span></button>
                        </div>
                    </div>
                    
                    {{-- tags --}}
                    <hr>
                    <h4>Tags</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Tag</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tagList">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Edit a Product from your portfolio</span>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        
        var publicURL = '{{ url("client/dashboard/getSupplier") }}';
        getSupplier();
        
        //read
        function getSupplier()
        {
            var url = publicURL;
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    
                    $('#supplierList').html('');
                    
                    $.each(response.clients,function(key,item){
                        
                        $('#supplierList').append('<div class="col-sm-6 col-lg-4 col-xxl-3">\
                            <div class="card card-bordered">\
                                <div class="card-inner">\
                                    <div class="team">\
                                        <div class="user-card user-card-s2">\
                                            <div class="user-avatar lg bg-primary">\
                                                <span><img src="'+item.photo+'" alt=""></span>\
                                            </div>\
                                            <div class="user-info">\
                                                <h6>'+item.name+'</h6>\
                                                <span class="sub-text">Rating</span>\
                                            </div>\
                                        </div>\
                                        <ul class="team-info">\
                                            <li><span>Join Date</span><span>'+item.joined+'</span></li>\
                                            <li><span>Contact</span><span>'+item.telephone+'</span></li>\
                                            <li><span>Email</span><span>'+item.email+'</span></li>\
                                        </ul>\
                                        <div class="team-view">\
                                            <button value="'+item.id+'" id="btnView" data-bs-target="#modalViewProfile" data-bs-toggle="modal" class="btn btn-block btn-secondary"><span>Check</span></button>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        ');
                    });
                }
            });
        }
        
        //search
        $("#searchSupplier").keyup(function(){
            
            var length = $('#searchSupplier').val().length;
            
            if (length > 0) {
                publicURL = '{{ url("client/dashboard/searchSupplier/:search") }}';
                publicURL = publicURL.replace(':search', $("#searchSupplier").val());
                getSupplier();
            }
            else
            {
                publicURL = '{{ url("client/dashboard/getSupplier") }}';
                getSupplier();
            }
        });
        
        //Edit
        $(document).on('click', '#btnView', function(e) {
            
            var no = $(this).val();
            
            var url = '{{ url("client/dashboard/getOneSupplier/:id") }}';
            url = url.replace(':id', no);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success: function(response)
                {
                    $('#photo').attr("src", response.clients.photo);
                    $('#name').val(response.clients.name);
                    $('#telephone').val(response.clients.telephone);
                    $('#email').val(response.clients.email);
                    $('#joined').val(response.clients.joined);
                    $('#id').val(response.clients.id);
                    
                }
            });
            
        });
    });
</script>

@endsection