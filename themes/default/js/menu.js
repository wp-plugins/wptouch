var menu_loaded = 0;

function bnc_load_menu(loc) {
    if (menu_loaded == 0) {
        $.get(loc, {}, function(data) { $('#dropmenu').html(data); $('#dropmenu').slideToggle();  } );
    } else {
        $('#dropmenu').slideToggle();
    }
    menu_loaded = 1;
}