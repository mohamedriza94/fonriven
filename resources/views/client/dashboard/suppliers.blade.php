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
                        
                        
                        
                        
                        {{-- <div class="col-sm-6 col-lg-4 col-xxl-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="team">
                                        
                                        <div class="user-card user-card-s2">
                                            <div class="user-avatar lg bg-primary">
                                                <span>AB</span>
                                            </div>
                                            <div class="user-info">
                                                <h6>Abu Bin Ishtiyak</h6>
                                                <span class="sub-text">UI/UX Designer</span>
                                            </div>
                                        </div>
                                        <ul class="team-info">
                                            <li><span>Join Date</span><span>24 Jun 2015</span></li>
                                            <li><span>Contact</span><span>+88 01713-123656</span></li>
                                            <li><span>Email</span><span>info@softnio.com</span></li>
                                        </ul>
                                        <div class="team-view">
                                            <a href="html/user-details-regular.html" class="btn btn-block btn-dim btn-primary"><span>View Profile</span></a>
                                        </div>
                                    </div><!-- .team -->
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col --> --}}
                        
                        
                        
                        
                    </div>
                </div><!-- .nk-block -->
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
                                            <button value="'+item.id+'" id="btnView" class="btn btn-block btn-primary"><span>View Profile</span></button>\
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
        $("#searchProduct").keyup(function(){
            
            var length = $('#searchProduct').val().length;
            
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
    });
</script>

@endsection