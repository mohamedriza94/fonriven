@extends('layouts.clientMaster')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">MY CONNECTIONS</h3>
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
                                                <input type="text" class="form-control" id="searchConnection" placeholder="Search">
                                            </div>
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
                                            <th scope="col">Connection No.</th>
                                            <th scope="col">Supplier</th>
                                            <th scope="col">Since</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="connectionList">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                
                {{-- modal to add product --}}
                <div class="modal fade zoom xl" tabindex="-1" id="modalViewConnections">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Connection Details</h5>
                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <em class="icon ni ni-cross"></em>
                                </a>
                            </div>
                            <div class="modal-body">
                                
                                <div class="preview-block">
                                    
                                    <div class="row g-3">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="form-label" for="product-title">Connection No.</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="connectionNo" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="regular-price">Since</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="since" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="regular-price">Status</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="status" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr class="bg-dark">
                                        <h4>Supplier</h4>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <img class="form-control" id="supplierPhoto" src="" style="height:100px; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="form-label" for="product-title">Telephone</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="supplierTelephone" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="form-label" for="product-title">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="supplierEmail" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="product-title">Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="supplierName" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <span class="sub-text">See this connection's details</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- modal to add product --}}
                <div class="modal fade zoom" tabindex="-1" id="modalRating">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Rate This Supplier</h5>
                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <em class="icon ni ni-cross"></em>
                                </a>
                            </div>
                            <div class="modal-body">
                                <div class="preview-block">
                                    <div class="row g-3">
                                        <div class="btn-group btn-group-sm">
                                            <button id="btnRateOne" class="btn btn-dark">1</button>
                                            <button id="btnRateTwo" class="btn btn-light">2</button>
                                            <button id="btnRateThree" class="btn btn-danger">3</button>
                                            <button id="btnRateFour" class="btn btn-primary">4</button>
                                            <button id="btnRateFive" class="btn btn-success">5</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        
        var publicURL = '{{ url("client/dashboard/viewConnections") }}';
        viewConnections();
        
        //read
        function viewConnections()
        {
            $.ajax({
                type: "GET",
                url:publicURL,
                dataType:"json",
                success:function(response){
                    
                    $('#connectionList').html('');
                    
                    $.each(response.connections,function(key,item){
                        
                        var name = item.supplierName;
                        var name = name.slice(0,15)+'...';
                        
                        var status = '';
                        var button = '';
                        if(item.connectionStatus == 'active')
                        {
                            status = '<span class="badge bg-success">Active</span>';
                            
                            button = '<div class="btn-group btn-group-sm">\
                                <button id="btnEndConnection" value="'+item.connectionNo+'" class="btn btn-outline-danger">End Connection</button>\
                                <button id="btnView" data-bs-toggle="modal" data-bs-target="#modalViewConnections" value="'+item.connectionNo+'" class="btn btn-primary">View</button>\
                                <button id="btnRate" data-bs-toggle="modal" data-bs-target="#modalRating" value="'+item.supplierNo+'" class="btn btn-success">Rate</button>\
                            </div>';
                        }
                        else if(item.connectionStatus == 'ended')
                        {
                            status = '<span class="badge bg-danger">Ended</span>';
                            
                            button = '<div class="btn-group btn-group-sm">\
                                <button id="btnView" data-bs-toggle="modal" data-bs-target="#modalViewConnections" value="'+item.connectionNo+'" class="btn btn-primary">View</button>\
                            </div>';
                        }
                        
                        
                        
                        $('#connectionList').append('<tr>\
                            <td>\
                                '+item.connectionNo+'\
                            </td>\
                            <td>\
                                <img src="'+item.supplierPhoto+'" style="height:40px; object-fit: contain;">&nbsp;\
                                '+name+'\
                            </td>\
                            <td>\
                                '+item.connectionDate+'\
                            </td>\
                            <td>\
                                '+status+'\
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
        
        //view
        $(document).on('click', '#btnView', function(e) {
            
            var connectionNo = $(this).val();
            
            var url = '{{ url("client/dashboard/viewOneConnection/:connectionNo") }}';
            url = url.replace(':connectionNo', connectionNo);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success: function(response)
                {
                    $('#connectionNo').val(response.connections.connectionNo);
                    $('#since').val(response.connections.connectionDate);
                    $('#status').val(response.connections.connectionStatus);
                    $('#supplierPhoto').attr("src", response.connections.supplierPhoto);
                    $('#supplierTelephone').val(response.connections.supplierTelephone);
                    $('#supplierEmail').val(response.connections.supplierEmail);
                    $('#supplierName').val(response.connections.supplierName);
                }
            });
            
        });
        
        //search
        $("#searchConnection").keyup(function(){
            
            var length = $('#searchConnection').val().length;
            
            if (length > 0) {
                publicURL = '{{ url("client/dashboard/searchConnections/:search") }}';
                publicURL = publicURL.replace(':search', $("#searchConnection").val());
                viewConnections();
            }
            else
            {
                publicURL = '{{ url("client/dashboard/viewConnections") }}';
                viewConnections();
            }
        });
        
        //end connection
        $(document).on('click', '#btnEndConnection', function(e) {
            
            e.preventDefault();
            var no = $(this).val();
            var status = 'ended';
            
            var data = {
                'no' : no,
                'status' : status
            }
            
            var url = '{{ url("client/dashboard/endConnection") }}';
            
            $.ajax({
                type:"POST",
                url: url,
                data:data,
                dataType:"json",
                success: function(response){
                    viewConnections();
                }
            });
        });
    });
</script>

@endsection