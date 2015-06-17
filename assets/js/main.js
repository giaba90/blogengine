$('.open_menu').popover();

$(".close_menu").hide();
$(".menu").hide();
$(".open_menu").click(function() {
  $(".menu").slideToggle("slow", function() {
    $(".open_menu").hide();
    $(".close_menu").show();
  });
});

$(".close_menu").click(function() {
  $(".menu").slideToggle("slow", function() {
    $(".close_menu").hide();
    $(".open_menu").show();
  });
});

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



