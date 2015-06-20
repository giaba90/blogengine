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
        $("#gallery").html(data);

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


$('#imageModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    var cct = $("input[name=csrf_test_name]").val();
    $.ajax({
        url: 'image/getinfo',
        data: {'id': id, 'csrf_test_name': cct},
        type: 'POST'
    }).done(function(data){
        //do something
        modal.find('.modal-body').html(data)

        var btnDelete = $("#imageModal").find($(".deleteimage"));
        (btnDelete).on('click', function (e) {
            e.preventDefault();
            // get the token value
            $("#" + id + "g").hide();
            modal.hide();
            $.ajax({
                url: 'image/deleteimg',
                data: {'id': id, 'csrf_test_name': cct},
                type: 'POST'
            }).done(function (data) {
                $("#response").html(data);
            });
        });
    });
})

