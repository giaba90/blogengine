<div class="container oh">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="my_breadcrumb">
                <a href="<?php echo base_url('/'); ?>"><u>Home</u>  &middot;</a>
            </div>

            <ul class="post-list">
                <?php foreach ($posts as $post) : ?>
                <li>
                    <!-- single post element -->
                    <h2>
                        <a class="post-list" href="<?php base_url().'single/';echo $post['post_slug'];?>"><?php echo $post['post_title']; ?></a>
                    </h2>
                    <span class="post-meta">
                        <i class="fa fa-calendar"></i> <?php echo $post['date']; ?>
                        <? if($display_nome){ ?> - <i class="fa fa-user"></i> <?php echo $post['first_name'].' '. $post['last_name'];} ?> -
                        <i class="fa fa-folder-open"></i><? $cats = $this->category->get_category_post($post['post_id']);
                        foreach($cats as $cat){ echo ' '.$cat['category_name']; } ?>
                    </span>
                </li>
                <?php endforeach; ?>
            </ul>
            <div id="pagenavigation">
                <?php echo $links; ?>
            </div>
        </div>
        <!-- close column -->
    </div>
    <!-- close row -->
</div>
<!-- /container -->