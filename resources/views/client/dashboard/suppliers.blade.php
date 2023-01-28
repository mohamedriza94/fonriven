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
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select class="form-control" id="categorySearch">
                                                                <option value="all">All</option>
                                                                <option value="men">Men's Clothing</option>
                                                                <option value="women">Women's Clothing</option>
                                                                <option value="unisex">Unisex</option>
                                                                <option value="kids">Kid's Clothing</option>
                                                                <option value="accessories">Accessories</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
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
                        <input type="hidden" id="supplier_id">
                        
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
                    </div>
                    
                    {{-- products --}}
                    <hr class="bg-dark">
                    <h4>Products</h4>
                    <div class="row g-gs" id="productList">
                        
                    </div>
                    
                    <hr>
                    
                    @if (auth()->guard('client')->user()->role == "buyer")
                    <button class="btn btn-success" id="btnConnect"></em><span>Connect</span></button>
                    @endif
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">View Supplier Data before connecting</span>
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
                        
                        var joined = item.joined.slice(0,10);
                        
                        //get product count
                        var urlProduct = '{{ url("client/dashboard/getProductCount/:id") }}';
                        urlProduct = urlProduct.replace(':id', item.id);
                        
                        $.ajax({
                            type:"GET", url:urlProduct, dataType:"json",
                            success: function(response)
                            {
                                var rating = response.ratings.slice(0,3);
                                
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
                                                        <span class="sub-text">Joined On: '+joined+'</span>\
                                                    </div>\
                                                </div>\
                                                <ul class="team-statistics">\
                                                    <li><span>'+response.connects+'</span><span> Connections </span></li>\
                                                    <li><span>'+rating+'</span><span> Rating </span></li>\
                                                    <li><span>'+response.products+'</span><span> Products </span></li>\
                                                </ul>\
                                                <div class="team-view">\
                                                    <button value="'+item.id+'" id="btnView" data-bs-target="#modalViewProfile" data-bs-toggle="modal" class="btn btn-block btn-secondary"><span>Check</span></button>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                                ');
                                
                            }
                        });
                    });
                }
            });
        }
        
        //categorize
        $('#categorySearch').on('change', function() {
            if($("#categorySearch").val() == "all")
            {
                publicURL = '{{ url("client/dashboard/getSupplier") }}';
                getSupplier();
            }
            else
            {
                publicURL = '{{ url("client/dashboard/categorizeSupplier/:category") }}';
                publicURL = publicURL.replace(':category', $("#categorySearch").val());
                getSupplier();
            }
        });
        
        //View supplier
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
                    $('#supplier_id').val(response.clients.id);
                    
                    var url = '{{ url("client/dashboard/getProductsForView/:id") }}';
                    url = url.replace(':id', response.clients.id);
                    
                    $.ajax({
                        type: "GET",
                        url:url,
                        dataType:"json",
                        success:function(response){
                            
                            $('#productList').html('');
                            
                            $.each(response.products,function(key,item){
                                var category = "";
                                if(item.category == "men")
                                {
                                    category = 'Men\'s Clothing';
                                }
                                else if(item.category == "women")
                                {
                                    category = 'Women\'s Clothing';
                                }
                                else if(item.category == "unisex")
                                {
                                    category = 'Unisex';
                                }
                                else if(item.category == "kids")
                                {
                                    category = 'Kid\'s Clothing';
                                }
                                else
                                {
                                    category = 'Accessories';
                                }
                                
                                $('#productList').append('<div class="col-xxl-3 col-lg-4 col-sm-6">\
                                    <div class="card card-bordered product-card">\
                                        <div class="product-thumb">\
                                            <a>\
                                                <img class="card-img-top" src="'+item.thumbnail+'" alt="">\
                                            </a>\
                                        </div>\
                                        <div class="card-inner text-center">\
                                            <ul class="product-tags">\
                                                <li><a href="#">'+category+'</a></li>\
                                            </ul>\
                                            <h6><a class="text-dark">'+item.name+'</a></h6>\
                                            <p class="">Wholesale Price: <b>Rs.'+item.price+'</b></p>\
                                            <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="'+item.description+'">Description</button>\
                                        </div>\
                                    </div>\
                                </div>\
                                ');
                            });
                        }
                    });
                    
                }
            });
            
        });
        
        //make a connection
        $(document).on('click', '#btnConnect', function(e) {
            e.preventDefault();
            
            $('#btnConnect').text('Connecting...');
            
            var supplier = $('#supplier_id').val();
            
            var data = {
                'supplier' : supplier
            }
            
            $.ajax({
                type:"POST",
                url: '{{ url("client/dashboard/makeConnection") }}',
                data:data,
                dataType:"json",
                success: function(response){
                    if(response.status==400)
                    {
                        alert('Some Error. Please reload and retry');
                        $('#btnConnect').text('Connect');
                    }
                    else if(response.status==404)
                    {
                        alert('Connection Already Exists!');
                        $('#btnConnect').text('Connect');
                    }
                    else
                    {
                        $('#btnConnect').removeClass('btn-success');
                        $('#btnConnect').addClass('btn-light');
                        $('#btnConnect').text('Connected!');
                        
                        setTimeout(function(){
                            $('#btnConnect').removeClass('btn-light');
                            $('#btnConnect').addClass('btn-success');
                            $('#btnConnect').text('Connect');
                            
                            getSupplier();
                        }, 2000);
                    }
                }
            });
        });
    });
</script>

@endsection