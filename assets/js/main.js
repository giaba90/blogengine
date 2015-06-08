$('.open_menu').popover()

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




    function readURL(input) {
        $("#preview").show();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#userfile").change(function(){
        readURL(this);
    });
    $('form').ajaxForm({
        complete: function(xhr) {
            $("#response").html(xhr.responseText);
            $('form').resetForm();
            loadgallery();
        }
    });

    function  loadgallery(){
        $.ajax({
            url:'image/fillGallery',
            type:'GET'
        }).done(function (data){
            $("#gallery").html(data);
            var btnDelete  = $("#gallery").find($(".btn-delete"));
            (btnDelete).on('click', function (e){
                e.preventDefault();
                // get the token value
                var cct = $("input[name=csrf_test_name]").val();
                var id = $(this).attr('id');
                $("#"+id+"g").hide();
                $.ajax({
                    url:'image/deleteimg',
                    data:{'id':id,'csrf_test_name':cct},
                    type:'POST'
                }).done(function (data){
                    $("#response").html(data);
                });
            });

        });
    }

