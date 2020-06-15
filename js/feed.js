// this file is used to get the notification popup in feed
$(document).ready(function (){
    $.getJSON('getNotifications.php', function(data){
        var notification = "";
        $.each(data, function(index, notificationobj){
            // getting notification as per the type comment or like
            if (notificationobj.comment == null){
                notification += "<div class='card bg-dark text-white'><div class='card-body'>" + notificationobj.first_name + " liked your \"" +
                notificationobj.title + "\" recipe on " + notificationobj.posted_date + "</div></div>";
            }
            else {
                notification += "<div class='card bg-secondary text-white'><div class='card-body'>" + notificationobj.first_name + " commented \"" +
                notificationobj.comment + "\" on your recipe \"" + notificationobj.title + "\" on "+ notificationobj.posted_date + "</div></div>";
            }
        })
        if (notification !== ""){
            $('#modal-body').html(notification);
            $("#myModal").modal();
        }
    })
});
