
var win = $(window);
win.scroll(function() {
    //win.scrollTop ei tööta Google Chrome'is päris korrektselt, seega kasutan ceil funktsiooni, mis mõnevõrra parandab scrollTop väärust
    if ($(document).height() - win.height() === Math.ceil(win.scrollTop())) {
        //console.log("End");
        loadmore();
    }
});
//AJAX funktsioon, mis tekitab ühe uue uudise. Käivitatakse kui jõutakse lehekülje lõppu
function loadmore()
{
    var val = document.getElementById("row_no").value;
    $.ajax({
        type: 'get',
        url: '?controller=news&action=show&id='+val,
        success: function (response) {
            var content = document.getElementById("all_rows");
            content.innerHTML = content.innerHTML+response;

            document.getElementById("row_no").value = Number(val)+1;
        }
    });
}