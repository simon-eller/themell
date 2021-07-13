<div class="button blog-box bg-light mt-2">
    <a class="blog-link" href="<?php the_permalink(); ?>">
        <div class="row">
            <div class="col-12 col-md-8">
                <h2><?php the_title(); ?></h2>
                <div class="blockquote-footer blog-link"><?php the_date(); echo " | "; comments_number(); ?>
                </div>
                <p><?php the_excerpt(); ?></p>
            </div>

            <div class="col-12 col-md-4 .d-none .d-md-block">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="" style="width:100%; height:auto;">

            </div>
        </div>
    </a>

</div>