<div class="row clear-fix">
    <div class="col-md-12">
        <? echo form_open_multipart('image/upload', array('id' => '', 'class' => 'form-inline')); ?>
        <div class="form-group" style="background: #f5f5f5">
            <label for="">Choose image</label>
            <?php echo form_upload('uploadedimages[]', '', 'multiple'); ?>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-info btn-block" style="width: 200px;" value="Add">
        </div>
        <div class="form-group">
            <img id="preview" src="#" style="display:none;height: 80px;border: 1px solid #DDC; "/>
        </div>
        <? echo form_close(); ?>
    </div>
</div>
<div class="row clear-fix">
    <div class="col-md-12">
        <div id="response">

        </div>
    </div>
</div>

<div class="row clear-fix">
    <div class="col-md-12">
        <div style="margin-top: 1%;">
            <blockquote>
                <ul class="list-inline" id="gallery">

                </ul>
            </blockquote>
        </div>
    </div>
</div>

<div id="preview-link" class="preview-link modal-content" style="display: none;">
    <button class="close" onclick="$(this).parent().hide();"><i class="fa fa-times"></i></button>
    <h4 style='color:green'>Image(s) uploaded Succesfully</h4><hr>
    <b>Link</b><br><br>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="imageModalLabel">Dettagli Immagine</h4>
            </div>
            <div class="modal-body">
               <p>prova</p>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        loadgallery();

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
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var cct = $("input[name=csrf_test_name]").val();
            var id = recipient;
            $.ajax({
                url: 'image/getinfo',
                data: {'id': id, 'csrf_test_name': cct},
                type: 'POST'
            }).done(function(data){
                //do something
                modal.find('.modal-body').html(data)
            });

        //    modal.find('.modal-title').text('New message to ' + recipient)
        //    modal.find('.modal-body').text(recipient)
        })

    });
</script>

