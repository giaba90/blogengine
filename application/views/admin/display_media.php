<div class="container">
    <div class="row">
        <? echo form_open_multipart('image/upload', array('id' => '', 'class' => 'form-inline')); ?>
        <div class="form-group" style="background: #f5f5f5">
            <label for="">Choose image</label>
            <?php echo form_upload('uploadedimages[]', '', 'multiple'); ?>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-info btn-block" style="width: 200px;" value="Add">
        </div>
        <? echo form_close(); ?>

        <div class="row clear-fix">
            <div class="col-md-12">
                <div id="response">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div id="gallery">
                    <div class="grid">
                    </div>
                </div>

            </div><!-- close col 1 -->
            <div class="col-md-4"></div>
        </div>
        </div>
    <div class="footer2 text-center">
        <p>Copyleft &copy; 2015 - Developed by <a href="http://www.gianlucabarranca.it">Gianluca Barranca</a></p>
    </div>
</div>



<div id="preview-link" class="preview-link modal-content" style="display: none;">
    <button class="close" onclick="$(this).parent().hide();"><i class="fa fa-times"></i></button>
    <h4 style='color:green'>Image(s) uploaded Succesfully</h4>
    <hr>
    <b>Link</b><br><br>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="imageModalLabel">Dettagli Immagine</h4>
            </div>
            <div class="modal-body">
                <p>An error has occurred !</p>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url().'assets/js/vendor/masonry.pkgd.min.js';?>"></script>
<script src="<?php echo base_url().'assets/js/vendor/imagesloaded.pkgd.min.js';?>"></script>


<script>
    var $grid = $('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true
    });
    // layout Isotope after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.masonry();
    });

    loadgallery();


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
        }).done(function (data) {
            //do something
            modal.find('.modal-body').html(data)

            var btnDelete = $("#imageModal").find($(".deleteimage"));
            (btnDelete).on('click', function (e) {
                e.preventDefault();
                // get the token value
                $("#" + id).parent().hide();
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
</script>

