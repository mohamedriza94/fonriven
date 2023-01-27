@extends('layouts.clientMaster')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Products</h3>
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
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddProduct" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Product</span></a>
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
                                <div class="nk-tb-list" id="productList">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col tb-col-sm"><span>Thumbnail</span></div>
                                        <div class="nk-tb-col"><span>Name</span></div>
                                        <div class="nk-tb-col"><span>Unit Price (LKR)</span></div>
                                        <div class="nk-tb-col"><span>status</span></div>
                                        <div class="nk-tb-col"><span>Category</span></div>
                                        <div class="nk-tb-col"><span>Action</span></div>
                                    </div><!-- .nk-tb-item -->











                                    


                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <img src="./images/product/a.png" alt="" class="thumb">
                                            </span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">Sample Name</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-lead">1500</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub"><span class="badge bg-success">Active</span></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="tb-lead">Men's Clothing</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <div class="btn-group btn-group-sm" aria-label="Basic example">
                                                <button type="button" class="btn btn-outline-success">Activate</button>
                                                <button type="button" class="btn btn-dark" data-bs-target="#modalEditProduct" data-bs-toggle="modal">Edit</button>
                                                <button type="button" class="btn btn-danger">Delete</button>
                                              </div>
                                        </div>
                                    </div>


















                                </div><!-- .nk-tb-list -->
                            </div>
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="btn-group btn-group-sm" aria-label="Basic example">
                                        <button type="button" class="btn btn-dim btn-danger">Prev</button>
                                        <button type="button" class="btn btn-dim btn-success">Next</button>
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
                                                    <img class="form-control" id="chosenPhoto" src="" style="height:100px; object-fit: contain;">
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
                                        <input type="hidden" id="productId" name="id">
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
                                                <label class="form-label" for="tags">Tags (Keep a space between each tag)</label>
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
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <span class="sub-text">Edit a Product from your portfolio</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection