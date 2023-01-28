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
                                            @if (auth()->guard('client')->user()->role == "supplier")
                                            <div class="btn-group" aria-label="Basic example">
                                                <button value="toSuppier" id="btnInbox" class="btn btn-dark">Inbox</button>
                                                <button value="supplierTo" id="btnSent" class="btn btn-dark">Sent</button>
                                            </div>
                                            @endif
                                            
                                            @if (auth()->guard('client')->user()->role == "buyer")
                                            <div class="btn-group" aria-label="Basic example">
                                                <button value="toBuyer" id="btnInbox" class="btn btn-dark">Inbox</button>
                                                <button value="buyerTo" id="btnSent" class="btn btn-dark">Sent</button>
                                            </div>
                                            @endif
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalCompose" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalCompose" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Compose</span></a>
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
                                            <th scope="col">Date</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Entity</th>
                                            <th scope="col">status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="messageList">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                
                {{-- modal to add product --}}
                <div class="modal fade zoom xl" tabindex="-1" id="modalCompose">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Compose Message</h5>
                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <em class="icon ni ni-cross"></em>
                                </a>
                            </div>
                            <div class="modal-body">
                                
                                <div class="alert alert-icon alert-danger" role="alert">
                                    <ul id="errorList_Message"></ul>
                                </div>
                                
                                <div class="preview-block">
                                    
                                    <form class="row g-3">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Choose Recipient</label>
                                                <div class="form-control-wrap">
                                                    <select id="chooseRecipient" class="form-select js-select2">
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Subject</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="subject">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="regular-price">Message</label>
                                                <div class="form-control-wrap">
                                                    <textarea rows="5" type="number" class="form-control" id="message"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary" id="btnSend"><span>Send</span></button>
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
                
                {{-- modal to add product --}}
                <div class="modal fade zoom xl" tabindex="-1" id="modalView">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">View Message</h5>
                                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <em class="icon ni ni-cross"></em>
                                </a>
                            </div>
                            <div class="modal-body">
                                
                                <div class="preview-block">
                                    
                                    <form class="row g-3">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" id="viewEntity">Sent To: </label><br>
                                                <label class="form-label" id="viewDate">Date:</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" id="viewSubject"><u><b></b></u></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="regular-price">Message</label>
                                                <div class="form-control-wrap">
                                                    <textarea rows="5" readonly class="form-control" id="viewMessage"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    <hr>
                                    
                                    <form class="row g-3 d-none" id="replyForm">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Reply</label><br>
                                                <div class="form-control-wrap">
                                                    <textarea rows="5" class="form-control" id="reply"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <button class="btn btn-primary" id="btnSendReply"><span>Mail Reply</span></button>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <script>
                    $(document).ready(function(){
                        
                        getRecipients();
                        $("#btnInbox").click()
                        function getRecipients()
                        {
                            $.ajax({
                                type: "GET",
                                url: '{{ url("client/dashboard/viewConnections") }}',
                                dataType:"json",
                                success:function(response){
                                    
                                    $('#chooseRecipient').html('');
                                    
                                    $.each(response.connections,function(key,item){
                                        
                                        $('#chooseRecipient').append('<option value="'+item.supplierNo+'">'+item.supplierEmail+' &nbsp; '+item.supplierName+'</option>\
                                        ');
                                    });
                                }
                            });
                        }
                        
                        //send message
                        $(document).on('click', '#btnSend', function(e) {
                            e.preventDefault();
                            var chooseRecipient = $('#chooseRecipient').val();
                            var subject = $('#subject').val();
                            var message = $('#message').val();
                            
                            var data = {
                                'recipient' : chooseRecipient,
                                'subject' : subject,
                                'message' : message
                            }
                            
                            var url = '{{ url("client/dashboard/composeMessage") }}';
                            
                            $.ajax({
                                type:"POST",
                                url: url,
                                data:data,
                                dataType:"json",
                                success: function(response){
                                    if(response.status==400)
                                    {
                                        $('#errorList_Message').html('');
                                        
                                        $.each(response.errors,function(key,err_value){
                                            $('#errorList_Message').append('<li>'+err_value+'</li>');
                                        });
                                        
                                        $('#btnSend').text('Send');
                                    }
                                    else
                                    {
                                        $('#errorList_Message').html('');
                                        
                                        $('#btnSend').removeClass('btn-primary');
                                        $('#btnSend').addClass('btn-success');
                                        $('#btnSend').text('Sent!');
                                        
                                        setTimeout(function(){
                                            $('#btnSend').removeClass('btn-success');
                                            $('#btnSend').addClass('btn-primary');
                                            $('#btnSend').text('Send');
                                            $('#modalCompose').modal('hide');
                                        }, 1000);
                                        
                                        getRecipients();
                                        
                                        $('subject').val('');
                                        $('message').val('');
                                    }
                                }
                            });
                        });
                        
                        var entity = "From";
                        var publicURL = '';
                        //view inbox
                        $(document).on('click','#btnInbox', function(e){
                            entity = "From";
                            
                            publicURL = '{{ url("client/dashboard/getMessages/:type") }}';
                            publicURL = publicURL.replace(':type', $(this).val());
                            getMessages();
                        });
                        
                        //view sent
                        $(document).on('click','#btnSent', function(e){
                            entity = "To";
                            
                            publicURL = '{{ url("client/dashboard/getMessages/:type") }}';
                            publicURL = publicURL.replace(':type', $(this).val());
                            getMessages();
                        });
                        
                        function getMessages()
                        {
                            $.ajax({
                                type: "GET",
                                url: publicURL,
                                dataType:"json",
                                success:function(response){
                                    
                                    $('#messageList').html('');
                                    
                                    $.each(response.messages,function(key,item){
                                        
                                        var date = item.date.slice(0,10);
                                        var subject = item.subject.slice(0,20);
                                        
                                        var status = '';
                                        if(item.status == 'unread')
                                        {
                                            status = '<span class="badge bg-danger">Unread</span>';
                                        }
                                        else
                                        {
                                            status = '<span class="badge bg-success">Read</span>';
                                        }
                                        
                                        var replybutton = "";
                                        if(item.status == 'unread' && entity=="From")
                                        {
                                            replybutton = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalView" id="btnReply" class="btn btn-dark">Reply</button>';
                                        }
                                        
                                        var entityName = "";
                                        //get entity details
                                        if(entity=="From")
                                        {
                                            var url = '{{ url("client/dashboard/getEntity/:no") }}';
                                            url = url.replace(':no', item.sender);
                                            
                                            $.ajax({
                                                type:"GET", url:url, dataType:"json",
                                                success: function(response)
                                                {
                                                    entityName = response.entity.name;
                                                    
                                                    $('#messageList').append('<tr>\
                                                        <td>'+date+'</td>\
                                                        <td>'+subject+'</td>\
                                                        <td>'+entity+' <b>'+entityName+'</b></td>\
                                                        <td>'+status+'</td>\
                                                        <td><button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalView" id="btnView" class="btn btn-success">Open</button>\
                                                            '+replybutton+'\
                                                        </td>\
                                                    </tr>');
                                                }
                                            });
                                        }
                                        else
                                        {
                                            var url = '{{ url("client/dashboard/getEntity/:no") }}';
                                            url = url.replace(':no', item.recipient);
                                            
                                            $.ajax({
                                                type:"GET", url:url, dataType:"json",
                                                success: function(response)
                                                {
                                                    entityName = response.entity.name;
                                                    
                                                    $('#messageList').append('<tr>\
                                                        <td>'+date+'</td>\
                                                        <td>'+subject+'</td>\
                                                        <td>'+entity+' <b>'+entityName+'</b></td>\
                                                        <td>'+status+'</td>\
                                                        <td><button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalView" id="btnView" class="btn btn-success">Open</button>\
                                                        </td>\
                                                    </tr>');
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        }
                        
                        //delete 
                        $(document).on('click', '#btnDelete', function(e) {
                            
                            e.preventDefault();
                            var id = $(this).val();
                            
                            var data = {
                                'id' : id,
                            }
                            
                            var url = '{{ url("client/dashboard/deleteMessage") }}';
                            
                            $.ajax({
                                type:"DELETE",
                                url: url,
                                data:data,
                                dataType:"json",
                                success: function(response){
                                    getMessages();
                                }
                            });
                        });
                        
                        //view 
                        $(document).on('click', '#btnView', function(e) {
                            
                            $('#replyForm').addClass('d-none');
                            
                            e.preventDefault();
                            var url = '{{ url("client/dashboard/getOneMessage/:id") }}';
                            url = url.replace(':id', $(this).val());
                            
                            $.ajax({
                                type:"GET", url:url, dataType:"json",
                                success: function(response)
                                {
                                    
                                    $('#viewDate').text("Date: "+response.messages.date);
                                    $('#viewSubject').text("Subject: "+response.messages.subject);
                                    $('#viewMessage').val(response.messages.message);
                                    
                                    messageID = response.messages.id;
                                    messageSubject = response.messages.subject;
                                    messageDate = response.messages.date;
                                    
                                    if(entity=="From")
                                    {
                                        var url = '{{ url("client/dashboard/getEntity/:no") }}';
                                        url = url.replace(':no', response.messages.sender);
                                        
                                        $.ajax({
                                            type:"GET", url:url, dataType:"json",
                                            success: function(response)
                                            {
                                                $('#viewEntity').html(entity+" "+response.entity.name+" &nbsp; &nbsp; Sender\'s Email: "+response.entity.email);
                                                messageEmail = response.entity.email;
                                            }
                                        });
                                    }
                                    else
                                    {
                                        var url = '{{ url("client/dashboard/getEntity/:no") }}';
                                        url = url.replace(':no', response.messages.recipient);
                                        
                                        $.ajax({
                                            type:"GET", url:url, dataType:"json",
                                            success: function(response)
                                            {
                                                $('#viewEntity').html(entity+" "+response.entity.name+" &nbsp; &nbsp; Recipient\'s Email: "+response.entity.email);
                                                messageEmail = response.entity.email;
                                            }
                                        });
                                    }
                                }
                            });
                        });
                        
                        $(document).on('click', '#btnReply', function(e) {

                            $('#replyForm').removeClass('d-none');
                            
                            var url = '{{ url("client/dashboard/getOneMessage/:id") }}';
                            url = url.replace(':id', $(this).val());
                            
                            $.ajax({
                                type:"GET", url:url, dataType:"json",
                                success: function(response)
                                {
                                    
                                    $('#viewDate').text("Date: "+response.messages.date);
                                    $('#viewSubject').text("Subject: "+response.messages.subject);
                                    $('#viewMessage').val(response.messages.message);
                                    
                                    messageID = response.messages.id;
                                    messageSubject = response.messages.subject;
                                    messageDate = response.messages.date;
                                    
                                    if(entity=="From")
                                    {
                                        var url = '{{ url("client/dashboard/getEntity/:no") }}';
                                        url = url.replace(':no', response.messages.sender);
                                        
                                        $.ajax({
                                            type:"GET", url:url, dataType:"json",
                                            success: function(response)
                                            {
                                                $('#viewEntity').html(entity+" "+response.entity.name+" &nbsp; &nbsp; Sender\'s Email: "+response.entity.email);
                                                messageEmail = response.entity.email;
                                            }
                                        });
                                    }
                                    else
                                    {
                                        var url = '{{ url("client/dashboard/getEntity/:no") }}';
                                        url = url.replace(':no', response.messages.recipient);
                                        
                                        $.ajax({
                                            type:"GET", url:url, dataType:"json",
                                            success: function(response)
                                            {
                                                $('#viewEntity').html(entity+" "+response.entity.name+" &nbsp; &nbsp; Recipient\'s Email: "+response.entity.email);
                                                messageEmail = response.entity.email;
                                            }
                                        });
                                    }
                                }
                            });
                        });
                        
                        //reply section
                        var messageID = "";
                        var messageSubject = "";
                        var messageDate = "";
                        var messageEmail = "";
                        
                        
                        //send message
                        $(document).on('click', '#btnSendReply', function(e) {
                            e.preventDefault();
                            $('#btnSendReply').text('Replying...');
                            var reply = $('#reply').val();
                            
                            var data = {
                                'messageID' : messageID,
                                'messageSubject' : messageSubject,
                                'messageDate' : messageDate,
                                'messageEmail' : messageEmail,
                                'reply' : reply
                            }
                            
                            var url = '{{ url("client/dashboard/reply") }}';
                            
                            $.ajax({
                                type:"POST",
                                url: url,
                                data:data,
                                dataType:"json",
                                success: function(response){
                                    if(response.status==400)
                                    {
                                        alert('Type a reply');
                                        $('#btnSendReply').text('Send Reply');
                                        $('#btnSendReply').text('Mail Reply');
                                    }
                                    else
                                    {
                                        $('#btnSendReply').removeClass('btn-primary');
                                        $('#btnSendReply').addClass('btn-success');
                                        $('#btnSendReply').text('Replied!');
                                        
                                        setTimeout(function(){
                                            $('#btnSendReply').removeClass('btn-success');
                                            $('#btnSendReply').addClass('btn-primary');
                                            $('#btnSendReply').text('Mail Reply');
                                            $('#modalView').modal('hide');
                                        }, 1000);
                                        
                                        getMessages();
                                        
                                        $('#reply').val('');
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