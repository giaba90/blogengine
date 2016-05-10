<div class="container">

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
            <div class="col-md-4">
                <div class="widget_image_upload">
                <? echo form_open_multipart('', array('id' => 'image_upload', 'class' => 'form-inline')); ?>
                <div class="form-group">
                 <label class="myLabel">
                    <?php
                 $data = array(
                        'name' => 'uploadedimages[]',
                        'multiple' => ''

                    );
                     echo form_upload($data); ?>
                     <span><i class="fa fa-cloud-upload"></i> Uplaod File</span>
                 </label>
                </div>
                    <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-info btn-block" style="width: 200px;" value="Add">
                </div>
                <? echo form_close(); ?>

                <div id="sorts" class="button-group">
                    <button class="original-order" data-sort-by="date">Ultimo caricato</button>
                    <button class="name-order-increasing" data-sort-by="name">crescente</button>
                    <button class="name-order-decreasing" data-sort-by="name">decrescente</button>
                </div>
                </div>

                </div> <!-- close col 2 -->
            </div> <!-- close row -->
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

<script src="<?php echo base_url().'assets/js/vendor/isotope.pkgd.min.js';?>"></script>
<script src="<?php echo base_url().'assets/js/vendor/imagesloaded.pkgd.min.js';?>"></script>



<script>
    loadgallery();
/*
    var $grid = $('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true
    });
    // layout Isotope after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.masonry();
    });

*/


/*
var $grid = $('.grid').isotope({
    // options
    percentPosition: true,
    masonry: {
        // use element for option
        columnWidth: '.grid-sizer'
    },
    getSortData:{
        name:'.name'
    }
});
*/
var $grid = $('.grid');
    $grid.isotope({
        itemSelector: '.grid-item',
        percentPosition: true,
        masonry: {
            columnWidth: 50
        },
        getSortData: {
            name:'.name',
            date: function (itemElem) {
                var date = $(itemElem).find('.date').text();
                //alert(date);
                return Date.parse(date);
            }
        }
    });



// bind sort button click

    $('.original-order').on( 'click', function() {
        var sortByValue = $(this).attr('data-sort-by');
        $grid.isotope({
            sortBy: sortByValue
        });
    });

    $('.name-order-increasing').on( 'click', function() {
        var sortByValue = $(this).attr('data-sort-by');
        $grid.isotope({
        sortBy: sortByValue,
        sortAscending: true
    });
});

    $('.name-order-decreasing').on( 'click', function() {
        var sortByValue = $(this).attr('data-sort-by');
        $grid.isotope({
            sortBy: sortByValue,
            sortAscending: false
        });
    });

    var options = {
        url:'image/upload',
        type: 'post',
        success: showResponse,
        resertForm: true

    };

    // bind to the form's submit event
    $('form').submit(function() {
        // inside event callbacks 'this' is the DOM element so we first
        // wrap it in a jQuery object and then invoke ajaxSubmit
        $(this).ajaxSubmit(options);

        // !!! Important !!!
        // always return false to prevent standard browser submit and page navigation
        return false;
    });

    /*
    $('#image_upload').ajaxForm({
        complete: function (xhr) {
            // $("#response").html(xhr.responseText);
            $('form').resetForm();
            $(xhr.responseText).appendTo("#preview-link");
            toggler('preview-link');
            loadgallery();
            $grid.isotope('layout');
        }
    });
    */
    function showResponse(xhr){
        $(xhr.responseText).appendTo("#preview-link");
        toggler('preview-link');
        loadgallery();
        $grid.isotope('layout');
    }

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
});
</script>

