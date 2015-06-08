<div class="row clear-fix">
        <div class="col-md-12">
            <? echo form_open_multipart('image/upload', array('id' => '','class' => 'form-inline')); ?>
                <div class="form-group" style="background: #f5f5f5">
                    <label for="">Choose image</label>
                    <input type="file" name="userfile" id="userfile" multiple>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info btn-block" style="width: 200px;" value="Add">
                </div>
                <div class="form-group">
                    <img id="preview" src="#" style="display:none;height: 80px;border: 1px solid #DDC; " />
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
                    <ul class="list-inline"  id="gallery">

                    </ul>
                </blockquote>
            </div>
        </div>
    </div>



</div>
<script>
    $(document).ready(function (){
        loadgallery();
    });
</script>

