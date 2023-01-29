@extends('layouts.adminMaster')

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>INQUIRIES</b></h3>
                <hr>
            </div>
            
            <div class="row layout-top-spacing">
                <div id="tableSimple" class="col-lg-12 col-12">
                    <div class="">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><b>Name</b></th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="inquiryTable">
                                        
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
                            <h5 class="modal-title" id="contentLabel">Respond to Inquiry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body" id="">
                            
                            <form class="row g-3">
                                <input type="hidden" id="inquiryID">
                                
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input  type="text" class="form-control text-dark" id="name" readonly>
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label">Telephone</label>
                                    <input  type="text" class="form-control text-dark" id="telephone" readonly>
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label">Email</label>
                                    <input  type="email" class="form-control text-dark" id="email" readonly>
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label">Subject</label>
                                    <input  type="email" class="form-control text-dark" id="subject" readonly>
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control text-dark" rows="5" id="message" readonly></textarea>
                                </div>
                            </form>
                            <hr>
                            <form class="row g-3 d-none" id="replySection">
                                <div class="col-md-12">
                                    <label class="form-label">Reply</label>
                                    <textarea class="form-control text-dark" rows="5"  id="reply"></textarea>
                                </div>
                                
                                <div class="col-md-12">
                                    <button class="btn btn-dark" id="btnSend">Send</button>
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
        
        getInquiries();
        
        //limit and offset for pagination
        var limit = 0;
        $(document).on('click', '#btnNext', function(e) {
            limit = limit + 5;
            getInquiries();
        });
        
        $(document).on('click', '#btnPrev', function(e) {
            limit = limit - 5;
            if(limit < 0)
            {
                limit = 0;
            }
            getInquiries();
        });
        
        //read list of inquiries
        function getInquiries()
        {
            var url = '{{ url("admin/dashboard/getInquiries/:limit") }}';
            url = url.replace(':limit', limit);
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    
                    $('#inquiryTable').html('');
                    
                    $.each(response.inquiries,function(key,item){
                        
                        var name = item.name.slice(0,15);
                        var subject = item.subject.slice(0,15);
                        var date = item.date.slice(0,10);
                        
                        var status = '';
                        var button = '';
                        if(item.status == 'unread')
                        {
                            status = '<span class="badge badge-danger">Unread</span>';
                            button = '<div class="btn-group">\
                                <button data-bs-toggle="modal" data-bs-target="#viewModal" value='+item.id+' class="btn btn-success"\
                                id="btnRespond"> Respond </button>\
                            </div>';
                        }
                        else
                        {
                            status = '<span class="badge badge-success">Responded</span>';
                            button = '<div class="btn-group">\
                                <button data-bs-toggle="modal" data-bs-target="#viewModal" value='+item.id+' class="btn btn-primary"\
                                id="btnView"> View </button>\
                            </div>';
                        }
                        
                        $('#inquiryTable').append('<tr><td>'+name+'</td>\
                            <td>'+subject+'</td>\
                            <td>'+status+'</td>\
                            <td>'+date+'\</td>\
                            <td>'+button+'\</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        //open message to respond
        $(document).on('click', '#btnRespond', function(e) {
            e.preventDefault();
            
            $('#replySection').removeClass('d-none');
            
            var id = $(this).val();
            
            var url = '{{ url("admin/dashboard/getOneInquiry/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success: function(response)
                {
                    $('#inquiryID').val(response.inquiries.id);
                    $('#name').val(response.inquiries.name);
                    $('#telephone').val(response.inquiries.telephone);
                    $('#email').val(response.inquiries.email);
                    $('#subject').val(response.inquiries.subject);
                    $('#message').val(response.inquiries.message);
                }
            });
        });
        
        //open message to just view
        $(document).on('click', '#btnView', function(e) {
            e.preventDefault();
            
            $('#replySection').addClass('d-none');
            
            var id = $(this).val();
            
            var url = '{{ url("admin/dashboard/getOneInquiry/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success: function(response)
                {
                    $('#inquiryID').val(response.inquiries.id);
                    $('#name').val(response.inquiries.name);
                    $('#telephone').val(response.inquiries.telephone);
                    $('#email').val(response.inquiries.email);
                    $('#subject').val(response.inquiries.subject);
                    $('#message').val(response.inquiries.message);
                }
            });
        });
        
        //send a response
        $(document).on('click', '#btnSend', function(e) {
            e.preventDefault();
            
            $('#btnSend').text('Mailing...');
            
            var inquiryID = $('#inquiryID').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var subject = $('#subject').val();
            var reply = $('#reply').val();
            
            var data = {
                'inquiryID' : inquiryID,
                'name' : name,
                'email' : email,
                'subject' : subject,
                'reply' : reply,
            }
            
            var url = '{{ url("admin/dashboard/respond") }}';
            
            $.ajax({
                type:"POST",
                url: url,
                data:data,
                dataType:"json",
                success: function(response){
                    if(response.status==400)
                    {
                        alert('Enter a reply');
                        $('#btnSend').text('Send');
                    }
                    else
                    {
                        $('#btnSend').removeClass('btn-dark');
                        $('#btnSend').addClass('btn-success');
                        $('#btnSend').text('Response Mailed!');
                        
                        setTimeout(function(){
                            $('#btnSend').removeClass('btn-success');
                            $('#btnSend').addClass('btn-dark');
                            $('#btnSend').text('Send');
                            $('#viewModal').modal('hide');
                        }, 2000);
                        
                        getInquiries();
                    }
                }
            });
        });
    });
    
</script>
@endsection