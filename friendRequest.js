$(document).ready(function () {

    // var sender = $('#fetch').data('sender');
    // var receiver = $('#fetch').data('receiver');
    // var friendstatus = $('#fetch').data('status');
    
    // var postData = {
    //     sender: sender,
    //     receiver: receiver
    // };

    $('#fetch').click(function () {
        $("#fetch").hide();
        var sender = $(this).data('sender');
        var receiver = $(this).data('receiver');
        var friendstatus = $(this).data('status');
        var postData = {
            sender: sender,
            receiver: receiver
        };
        $.post('friendRequest.php', postData, function (data) {
            var response = JSON.parse(data);
            $('#response').append(response.message);
        });
    });
    //other buttons for accept and reject
    $('#friendAccept').click(function() {
        $("#buttons").hide();
    
        var sender = $(this).data('sender');
        var friend2 = $(this).data('friend2');
        var postData ={
            friend1: sender,
            friend2: friend2

        };
        $.post('friendAccept.php',postData,function(data){
            var response = JSON.parse(data);
            $('#response').append(response.message);

        });

    });
    $('#friendReject').click(function() {
        $("#buttons").hide();
    
        var sender = $(this).data('sender');
        var friend2 = $(this).data('friend2');
        var postData ={
            friend1: sender,
            friend2: friend2
        };
        $.post('friendReject.php',postData,function(data){
            var response = JSON.parse(data);
            $('#response').append(response.message);

        });

    });
});

    