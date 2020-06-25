require('bootstrap-datepicker/js/bootstrap-datepicker.js');
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js');
require('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
$(document).ready(function () {
    $('.js-datepicker').each(function () {
        $(this).datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: false,
            language: 'fr',
        });
    });
});