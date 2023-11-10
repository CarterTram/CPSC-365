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
});

    