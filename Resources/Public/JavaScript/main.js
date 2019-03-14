/* ----------- @ DROPDOWN NAVIGATION ------------ */
jQuery(document).ready(function($) {

    // MENU
    $('.navbar-collapse').on('show.bs.collapse', function () {
        toggleIcon = $('.navbar-toggle-menu .glyphicon');
        toggleIcon.addClass('glyphicon-remove').removeClass('glyphicon-list');
    });
    $('.navbar-collapse').on('hide.bs.collapse', function () {
        toggleIcon = $('.navbar-toggle-menu .glyphicon');
        toggleIcon.removeClass('glyphicon-remove').addClass('glyphicon-list');
    });



    $('.nav li.dropdown').hover(
        function () {
            $(this).addClass('open').find('ul').stop(true, true).hide().slideDown('fast');
        },
        function () {
            $(this).removeClass('open').find('ul').stop(true, true).slideUp('fast');
        }
    );
    $('.nav li.dropdown li').unbind('mouseover').unbind('mouseout');


});


