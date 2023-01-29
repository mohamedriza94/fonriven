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
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="form-label" for="product-title">Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="supplierName" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="form-label" for="product-title">Rating</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="rating" readonly>
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
                                        
                                        <label id="labelRating"></label>
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
        
        //declare public url to get list of connections from backend
        var publicURL = '{{ url("client/dashboard/viewConnections") }}';
        
        //calling the view connections method when the page loads
        viewConnections();
        
        //function to view list connections in table
        function viewConnections()
        {
            //ajax GET request to dynamically get data from backend
            $.ajax({
                type: "GET",
                url:publicURL,
                dataType:"json",
                success:function(response){
                    
                    //empty the table before populating it with data
                    $('#connectionList').html('');
                    
                    //alias the array into a key called 'item'
                    $.each(response.connections,function(key,item){
                        
                        //slice the length of characters before displaying
                        var name = item.supplierName.slice(0,15)+'...';
                        
                        var status = '';
                        var button = '';
                        var rateButton = '';
                        
                        //check user
                        if(response.userType == "supplier")
                        {
                            //if the logged in user is a supplier, don't display the rating button
                            rateButton = "-";
                        }
                        else
                        {
                            //if the logged in user is a buyer, display the rating button
                            rateButton = '<button id="btnRate" data-bs-toggle="modal" data-bs-target="#modalRating" value="'+item.supplierNo+'" class="btn btn-success">Rate</button>';
                        }
                        
                        if(item.connectionStatus == 'active')
                        {
                            status = '<span class="badge bg-success">Active</span>';
                            
                            button = '<div class="btn-group btn-group-sm">\
                                <button id="btnEndConnection" value="'+item.connectionNo+'" class="btn btn-outline-danger">End Connection</button>\
                                <button id="btnView" data-bs-toggle="modal" data-bs-target="#modalViewConnections" value="'+item.connectionNo+'" class="btn btn-primary">View</button>\
                                '+rateButton+'\
                            </div>';
                        }
                        else if(item.connectionStatus == 'ended')
                        {
                            status = '<span class="badge bg-danger">Ended</span>';
                            
                            button = '<div class="btn-group btn-group-sm">\
                                <button id="btnView" data-bs-toggle="modal" data-bs-target="#modalViewConnections" value="'+item.connectionNo+'" class="btn btn-primary">View</button>\
                            </div>';
                        }
                        
                        //append each row of data from database into an html table
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
        
        //event to view details of a single connection
        $(document).on('click', '#btnView', function(e) {
            
            //get connection number using from the value of view button AKA btnView
            var connectionNo = $(this).val();
            
            //declare url
            var url = '{{ url("client/dashboard/viewOneConnection/:connectionNo") }}';
            //concatenate the connection no. into the url using the 'replace' function
            url = url.replace(':connectionNo', connectionNo);
            
            //pass the ajax server request
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success: function(response)
                {
                    //populate each text field with data from database
                    $('#connectionNo').val(response.connections.connectionNo);
                    $('#since').val(response.connections.connectionDate);
                    $('#status').val(response.connections.connectionStatus);
                    $('#supplierPhoto').attr("src", response.connections.supplierPhoto);
                    $('#supplierTelephone').val(response.connections.supplierTelephone);
                    $('#supplierEmail').val(response.connections.supplierEmail);
                    $('#supplierName').val(response.connections.supplierName);
                    
                    //show only 3 characters of a rating
                    var rating = response.ratings.slice(0,3);
                    
                    //show the rating in a text field
                    $('#rating').val(rating+" / 5");
                }
            });
            
        });
        
        //search a connection
        $("#searchConnection").keyup(function(){
            //get the number of characters in the search box
            var length = $('#searchConnection').val().length;
            
            //check if the search box has any character
            if (length > 0) {
                //if yes, concatenate the searched string into the public url and call the method to get connections
                publicURL = '{{ url("client/dashboard/searchConnections/:search") }}';
                publicURL = publicURL.replace(':search', $("#searchConnection").val());
                viewConnections();
            }
            else
            {
                ///if no, call the method with the below url
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
        
        //rating system
        var supplier_id = "";
        var rating = "";
        //get the supplier id from the value of 'btnRate'
        $(document).on('click', '#btnRate', function(e) {
            supplier_id = $(this).val();
        });
        
        //one star rating
        $(document).on('click', '#btnRateOne', function(e) {
            rating = "1";
            rateSupplier();
        });
        //two star rating
        $(document).on('click', '#btnRateTwo', function(e) {
            rating = "2";
            rateSupplier();
        });
        //three star rating
        $(document).on('click', '#btnRateThree', function(e) {
            rating = "3";
            rateSupplier();
        });
        //four star rating
        $(document).on('click', '#btnRateFour', function(e) {
            rating = "4";
            rateSupplier();
        });
        //five star rating
        $(document).on('click', '#btnRateFive', function(e) {
            rating = "5";
            rateSupplier();
        });
        
        //function to rate a supplier
        function rateSupplier()
        {
            var data = {
                'supplier_id' : supplier_id,
                'rating' : rating
            }
            
            $.ajax({
                type:"POST",
                url: '{{ url("client/dashboard/rating") }}',
                data:data,
                dataType:"json",
                success: function(response){
                    $('#labelRating').text('Thank you for your rating.');
                    
                    setTimeout(() => {
                        $('#labelRating').text('');
                    }, 2000);
                }
            });
        }
    });
</script>

@endsection