/**
 * Created by Ivan on 04.01.2016.
 */
var start_text = null;
$('a.collapse-control').click(function () {
    start_text = start_text == null ? $(this).text() : start_text;
    var end_text = 'Свернуть';

    $(this).text(function (i, old) {
        return old == start_text ? end_text : start_text;
    });
});
