@extends('layouts.clientMaster')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Messages</h3>
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
                                                <input type="text" class="form-control" id="searchProduct" placeholder="Search">
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddProduct" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddProduct" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Compose</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                
                                <table class="table text-left">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Unit Price (LKR)</th>
                                            <th scope="col">status</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productList">
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="btn-group btn-group-sm" aria-label="Basic example">
                                        <button type="button" id="btnPrev" class="btn btn-dim btn-danger">Prev</button>
                                        <button type="button" id="btnNext" class="btn btn-dim btn-success">Next</button>
                                    </div>
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                
                
                {{-- modal to add product --}}
                <div class="modal fade zoom xl" tabindex="-1" id="modalAddProduct">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">New Product</h5>
                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <em class="icon ni ni-cross"></em>
                                </a>
                            </div>
                            <div class="modal-body">
                                
                                <div class="alert alert-icon alert-danger" role="alert">
                                    <ul id="errorList"></ul>
                                </div>
                                
                                <div class="preview-block">
                                    
                                    <form class="row g-3" method="post" enctype="multipart/form-data" id="addProductForm">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="product-title">Product Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="pName" name="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="regular-price">Wholesale Price (LKR)</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" id="pPrice" name="price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label" for="category">Category</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="pCategory" name="category">
                                                        <option value="men">Men's Clothing</option>
                                                        <option value="women">Women's Clothing</option>
                                                        <option value="unisex">Unisex</option>
                                                        <option value="kids">Kid's Clothing</option>
                                                        <option value="accessories">Accessories</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="tags">Tags (Keep a space between each tag)</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="pTags" name="tag">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <img class="form-control" id="pChosenPhoto" src="" style="height:100px; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Choose a thumbnail</label></label>
                                                <div class="form-control-wrap">
                                                    <div class="form-file">
                                                        <input type="file" class="form-file-input" id="pThumbnail" name="thumbnail">
                                                        <label class="form-file-label" for="customFile">Choose</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="regular-price">Description</label>
                                                <div class="form-control-wrap">
                                                    <textarea rows="5" type="number" class="form-control" id="pDescription" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary" id="btnAddProduct" type="submit"><em class="icon ni ni-plus"></em><span>Add Product</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <span class="sub-text">Add a Product to your portfolio</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- modal to edit product --}}
                <div class="modal fade zoom xl" tabindex="-1" id="modalEditProduct">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Product</h5>
                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <em class="icon ni ni-cross"></em>
                                </a>
                            </div>
                            <div class="modal-body">
                                
                                <div class="alert alert-icon alert-danger" role="alert">
                                    <ul id="errorList_update"></ul>
                                </div>
                                
                                <div class="preview-block">
                                    
                                    <form class="row g-3" method="post" enctype="multipart/form-data" id="editProductForm"> 
                                        <input type="hidden" id="productId" name="no">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="product-title">Product Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="name" id="up_product_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="regular-price">Wholesale Price (LKR)</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="price" id="up_product_price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label" for="category">Category</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" name="category" id="up_product_category">
                                                        <option value="men">Men's Clothing</option>
                                                        <option value="women">Women's Clothing</option>
                                                        <option value="unisex">Unisex</option>
                                                        <option value="kids">Kid's Clothing</option>
                                                        <option value="accessories">Accessories</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="tags">Add More Tags (Keep a space between each tag)</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="tag" id="up_product_tag">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <img class="form-control" id="up_chosenPhoto" src="" style="height:100px; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Change thumbnail</label></label>
                                                <div class="form-control-wrap">
                                                    <div class="form-file">
                                                        <input type="file" class="form-file-input" name="thumbnail" id="up_product_thumbnail">
                                                        <label class="form-file-label" for="customFile">Choose</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="regular-price">Description</label>
                                                <div class="form-control-wrap">
                                                    <textarea rows="5" type="number" class="form-control" id="up_product_description" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit" id="btnUpdateProduct"></em><span>Save Changes</span></button>
                                        </div>
                                    </form>
                                    
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
                        
                        var publicURL = '{{ url("client/dashboard/getProduct/:limit") }}';
                        getProduct();
                        
                        //Add Product
                        $(document).on('click', '#btnAddProduct', function(e) {
                            e.preventDefault();
                            
                            $('#btnAddProduct').text('Adding...');
                            
                            let formData = new FormData($('#addProductForm')[0]);
                            $.ajax({
                                type: "POST",
                                url: "{{ url('client/dashboard/addProduct') }}",
                                data: formData,
                                contentType:false,
                                processData:false,
                                success: function(response){
                                    if(response.status==400)
                                    {
                                        $.each(response.errors,function(key,err_value){
                                            $('#errorList').append('<li>'+err_value+'</li>');
                                        });
                                        
                                        $('#btnAddProduct').text('Add Product');
                                    }
                                    else
                                    {
                                        $('#errorList').html('');
                                        
                                        $('#btnAddProduct').removeClass('btn-primary');
                                        $('#btnAddProduct').addClass('btn-success');
                                        $('#btnAddProduct').text('Added!');
                                        
                                        setTimeout(function(){
                                            $('#btnAddProduct').removeClass('btn-success');
                                            $('#btnAddProduct').addClass('btn-primary');
                                            $('#btnAddProduct').text('Add Product');
                                        }, 1000);
                                        
                                        getProduct();
                                        
                                        $('#pName').val('');
                                        $('#pPrice').val('');
                                        $('#pTags').val('');
                                        $('#pDescription').val('');
                                    }
                                }
                            });
                        });
                        
                        $("#pThumbnail").change(function(){
                            var reader = new FileReader();
                            reader.onload = function(){
                                var output = document.getElementById('pChosenPhoto');
                                output.src = reader.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        });
                        
                        $("#up_product_thumbnail").change(function(){
                            var reader = new FileReader();
                            reader.onload = function(){
                                var output = document.getElementById('up_chosenPhoto');
                                output.src = reader.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        });
                        
                        //limit and offset for pagination
                        var limit = 0;
                        $(document).on('click', '#btnNext', function(e) {
                            
                            limit = limit + 5;
                            getProduct();
                            
                        });
                        
                        $(document).on('click', '#btnPrev', function(e) {
                            
                            limit = limit - 5;
                            
                            if(limit < 0)
                            {
                                limit = 0;
                            }
                            
                            getProduct();
                            
                        });
                        
                        //read
                        function getProduct()
                        {
                            var url = publicURL;
                            url = url.replace(':limit', limit);
                            
                            $.ajax({
                                type: "GET",
                                url:url,
                                dataType:"json",
                                success:function(response){
                                    
                                    $('#productList').html('');
                                    
                                    $.each(response.products,function(key,item){
                                        
                                        var name = item.name;
                                        var name = name.slice(0,15)+'...';
                                        
                                        var status = '';
                                        var button = '';
                                        if(item.status == 'active')
                                        {
                                            status = '<span class="badge bg-success">Active</span>';
                                            
                                            button = '<div class="btn-group btn-group-sm">\
                                                <button id="btnDeactivate" value="'+item.no+'" class="btn btn-outline-danger">Deactivate</button>\
                                                <button id="btnEdit" value="'+item.no+'" class="btn btn-dark" data-bs-target="#modalEditProduct" data-bs-toggle="modal">Edit</button>\
                                                <button id="btnDelete" value="'+item.no+'" class="btn btn-danger">Delete</button>\
                                            </div>';
                                        }
                                        else
                                        {
                                            status = '<span class="badge bg-danger">Inactive</span>';
                                            
                                            button = '<div class="btn-group btn-group-sm">\
                                                <button id="btnActivate" value="'+item.no+'" class="btn btn-outline-success">Activate</button>\
                                                <button id="btnEdit" value="'+item.no+'" class="btn btn-dark" data-bs-target="#modalEditProduct" data-bs-toggle="modal">Edit</button>\
                                                <button id="btnDelete" value="'+item.no+'" class="btn btn-danger">Delete</button>\
                                            </div>';
                                        }
                                        
                                        
                                        
                                        $('#productList').append('<tr>\
                                            <td>\
                                                <img src="'+item.thumbnail+'" style="height:40px; object-fit: contain;">&nbsp;\
                                                '+name+'\
                                            </td>\
                                            <td>\
                                                '+item.price+'\
                                            </td>\
                                            <td>\
                                                '+status+'\
                                            </td>\
                                            <td>\
                                                '+item.category+'\
                                            </td>\
                                            <td>\
                                                '+button+'\
                                            </td>\
                                        </tr>\
                                        ');
                                    });
                                }
                            });
                        }
                        
                        //activate
                        $(document).on('click', '#btnActivate', function(e) {
                            
                            e.preventDefault();
                            var no = $(this).val();
                            var status = 'active';
                            
                            var data = {
                                'no' : no,
                                'status' : status
                            }
                            
                            var url = '{{ url("client/dashboard/changeStatus") }}';
                            
                            $.ajax({
                                type:"POST",
                                url: url,
                                data:data,
                                dataType:"json",
                                success: function(response){
                                    getProduct();
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
                            
                            var url = '{{ url("client/dashboard/changeStatus") }}';
                            
                            $.ajax({
                                type:"POST",
                                url: url,
                                data:data,
                                dataType:"json",
                                success: function(response){
                                    getProduct();
                                }
                            });
                        });
                        
                        //delete
                        $(document).on('click', '#btnDelete', function(e) {
                            
                            e.preventDefault();
                            var no = $(this).val();
                            
                            var data = {
                                'no' : no,
                                'status' : status
                            }
                            
                            var url = '{{ url("client/dashboard/deleteProduct") }}';
                            
                            $.ajax({
                                type:"DELETE",
                                url: url,
                                data:data,
                                dataType:"json",
                                success: function(response){
                                    getProduct();
                                }
                            });
                        });
                        
                        //Edit
                        $(document).on('click', '#btnEdit', function(e) {
                            
                            var no = $(this).val();
                            
                            var url = '{{ url("client/dashboard/getOneProduct/:no") }}';
                            url = url.replace(':no', no);
                            
                            $.ajax({
                                type:"GET",
                                url:url,
                                dataType:"json",
                                success: function(response)
                                {
                                    $('#productId').val(response.products.no);
                                    $('#up_product_name').val(response.products.name);
                                    $('#up_product_price').val(response.products.price);
                                    $('#up_product_category').val(response.products.category);
                                    $('#up_chosenPhoto').attr("src", response.products.thumbnail);
                                    $('#up_product_description').val(response.products.description);
                                    productNoForTags = response.products.no;
                                    getTags();
                                    
                                }
                            });
                            
                        });
                        
                        //read tags
                        function getTags()
                        {
                            var url = '{{ url("client/dashboard/getTags/:product") }}';
                            url = url.replace(':product', productNoForTags);
                            
                            $.ajax({
                                type: "GET",
                                url:url,
                                dataType:"json",
                                success:function(response){
                                    
                                    $('#tagList').html('');
                                    
                                    $.each(response.tags,function(key,item){
                                        
                                        
                                        $('#tagList').append('<tr>\
                                            <td>\
                                                '+item.tag+'\
                                            </td>\
                                            <td>\
                                                <div class="btn-group btn-group-sm">\
                                                    <button id="btnDeleteTag" value="'+item.id+'" class="btn btn-danger">Delete</button>\
                                                </div>\
                                            </td>\
                                        </tr>\
                                        ');
                                    });
                                }
                            });
                        }
                        
                        //search
                        $("#searchProduct").keyup(function(){
                            
                            var length = $('#searchProduct').val().length;
                            
                            if (length > 0) {
                                publicURL = '{{ url("client/dashboard/searchProduct/:search") }}';
                                publicURL = publicURL.replace(':search', $("#searchProduct").val());
                                getProduct();
                            }
                            else
                            {
                                publicURL = '{{ url("client/dashboard/getProduct/:limit") }}';
                                getProduct();
                            }
                        });
                        
                        //delete tag
                        $(document).on('click', '#btnDeleteTag', function(e) {
                            
                            e.preventDefault();
                            var no = $(this).val();
                            
                            var data = {
                                'no' : no,
                            }
                            
                            var url = '{{ url("client/dashboard/deleteTag") }}';
                            
                            $.ajax({
                                type:"DELETE",
                                url: url,
                                data:data,
                                dataType:"json",
                                success: function(response){
                                    getTags();
                                }
                            });
                        });
                        
                        //Update Product
                        $(document).on('click', '#btnUpdateProduct', function(e) {
                            e.preventDefault();
                            
                            $('#btnUpdateProduct').text('Updating...');
                            
                            let formData = new FormData($('#editProductForm')[0]);
                            $.ajax({
                                type: "POST",
                                url: "{{ url('client/dashboard/updateProduct') }}",
                                data: formData,
                                contentType:false,
                                processData:false,
                                success: function(response){
                                    if(response.status==400)
                                    {
                                        $.each(response.errors,function(key,err_value){
                                            $('#errorList_update').append('<li>'+err_value+'</li>');
                                        });
                                        
                                        $('#btnUpdateProduct').text('Save Changes');
                                    }
                                    else
                                    {
                                        $('#errorList_update').html('');
                                        
                                        $('#btnUpdateProduct').removeClass('btn-primary');
                                        $('#btnUpdateProduct').addClass('btn-success');
                                        $('#btnUpdateProduct').text('Updated!');
                                        
                                        setTimeout(function(){
                                            $('#btnUpdateProduct').removeClass('btn-success');
                                            $('#btnUpdateProduct').addClass('btn-primary');
                                            $('#btnUpdateProduct').text('Save Changes');
                                            $('#modalEditProduct').modal('hide');
                                        }, 1000);
                                        
                                        getProduct();
                                    }
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection