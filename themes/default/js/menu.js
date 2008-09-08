var menu_loaded = 0;

function bnc_load_menu(loc) {
    if (menu_loaded == 0) {
        $J.get(loc, {}, function(data) { $J('#dropmenu').html(data); $J('#dropmenu').slideToggle();  } );
    } else {
        $J('#dropmenu').slideToggle();
    }
    menu_loaded = 1;
}

function bnc_scroll_comment(comment_num) {
     var h = $("body").height();

    var two = parseInt(comment_num)+1;
    var first = $('#comment-num-' + comment_num).offset().top;
    var numbertwo = $('#comment-num-' + two).offset().top;
    var diff = numbertwo - first;
    //alert($(window).scrollTop());
    //alert($(document).scrollTop());
    //alert($('body').scrollTop());

   // $(window).scrollTop(numbertwo - 20);
    $J(document).scrollTop($(document).scrollTop()+diff);  
    //$(window).animate({scrollTop: diff}, 1000);

}

