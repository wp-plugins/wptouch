// Ajax Comments
function commentAdded() {
    if ($('#errors')) {
        $('#errors').hide();
    }

    $("#commentform").hide();
    $("#some-new-comment").fadeIn(2000);
    $("#refresher").fadeIn(2000);

    if ($('#nocomment')) {
        $('#nocomment').hide();
    }
    
    if($('#hidelist')) {
        $('#hidelist').hide();
    }
}