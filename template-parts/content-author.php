<div class="button blog-box bg-light mt-2">
    <a class="blog-link" href="<?php the_permalink(); ?>">
        <div class="row">
            <div class="col-12">
                <h2><?php the_title(); ?></h2>
                <div class="blockquote-footer blog-link"><?php the_date(); echo " | "; comments_number(); ?>
                </div>
                <p><?php the_excerpt(); ?></p>
            </div>

        </div>
    </a>

</div>