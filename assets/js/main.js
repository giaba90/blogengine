var bumpIt = function() {
        $('body').css('margin-bottom', $('.footer').height());
    },
    didResize = false;

bumpIt();

$(window).resize(function() {
    didResize = true;
});
setInterval(function() {
    if(didResize) {
        didResize = false;
        bumpIt();
    }
}, 250);

function resetForm(){
    CKEDITOR.instances.content.setData(' ');
}


function toggler(divId) {
    $("#" + divId).toggle();
}