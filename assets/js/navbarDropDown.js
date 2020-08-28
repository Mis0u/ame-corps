import $ from 'jquery';
export default

$(function () {
    $(document).scroll(function () {
        var $nav = $("nav");
        $nav.toggleClass('active', $(this).scrollTop() > $nav.height());
    });
});