require('./bootstrap');
$(function () {


    /* ===============================================================
         PRODUCT QUNATITY
      =============================================================== */
    $('.dec-btn').click(function () {
        event.preventDefault();
        var siblings = $(this).siblings('input');
        if (parseInt(siblings.val(), 10) >= 1) {
            siblings.val(parseInt(siblings.val(), 10) - 1);
        }
    });

    $('.inc-btn').click(function () {
        event.preventDefault();
        var siblings = $(this).siblings('input');
        siblings.val(parseInt(siblings.val(), 10) + 1);
    });

    /* ===============================================================
         DISABLE UNWORKED ANCHORS
      =============================================================== */
    $('a[href="#"]').on('click', function (e) {
        e.preventDefault();
    });

});
