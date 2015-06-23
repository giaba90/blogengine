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

$("#userfile").change(function () {
    readURL(this);
});
$('form').ajaxForm({
    complete: function (xhr) {
        // $("#response").html(xhr.responseText);
        $('form').resetForm();
        $(xhr.responseText).appendTo("#preview-link");
        toggler('preview-link');
        loadgallery();
    }
});

function loadgallery() {
    $.ajax({
        url: 'image/fillGallery',
        type: 'GET'
    }).done(function (data) {
        $('.grid').html(data);

        //delete after debug code
        var btnDelete = $("#gallery").find($(".btn-delete"));
        (btnDelete).on('click', function (e) {
            e.preventDefault();
            // get the token value
            var cct = $("input[name=csrf_test_name]").val();
            var id = $(this).attr('id');
            $("#" + id + "g").hide();
            $.ajax({
                url: 'image/deleteimg',
                data: {'id': id, 'csrf_test_name': cct},
                type: 'POST'
            }).done(function (data) {
                $("#response").html(data);
            });
        });

    });
}

function toggler(divId) {
    $("#" + divId).toggle();
}

