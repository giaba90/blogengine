<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="my_breadcrumb">
                <a href="<? echo base_url('/') ; ?>"><u>Home</u>  &middot;</a>
                <a href="#"><?php echo $post_item['post_title']; ?></a>
            </div>

            <div class="post">
                <div class="post-header">
                    <h1 class="post-title"><?php echo $post_item['post_title']; ?></h1>
                    <?php if($this->ion_auth->logged_in()){?>
                    <a href="<? echo base_url().'dashboard/editpost/'.$post_item['post_id'];?>"><span class="label label-default">Modifica</span></a>
                    <? } ?>
                    <span class="post-meta"><i class="fa fa-calendar"></i> <?php echo $post_item['date']; ?> - <i class="fa fa-user"></i> <?php echo $post_item['first_name'].' '. $post_item['last_name']; ?> -
                    <i class="fa fa-folder-open"></i><? $cats = $this->category->get_category_post($post_item['post_id']);
                        foreach($cats as $cat){ echo ' '.$cat['category_name']; } ?>
                    </span>
                </div>
                <article class="post-content">
                    <?php echo $post_item['post_content']; ?>
                </article>
            </div>

        </div>
        <!-- close column -->
    </div>
    <!-- close row -->
</div>
<!-- /container -->