$("#navbarDropdownUser").click(function(e) {

    if ($('#dropDownUser').hasClass('show')) {
        $('div.show').removeClass('show');
    } else {
        $('div.show').removeClass('show');
        $("#dropDownUser").addClass("show");
    }
});

$("#navbarDropdownReservation").click(function(e) {

    if ($('#dropDownReservation').hasClass('show')) {
        $('div.show').removeClass('show');
    } else {
        $('div.show').removeClass('show');
        $("#dropDownReservation").addClass("show");
    }
});