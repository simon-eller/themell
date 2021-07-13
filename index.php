<?php
	$path = get_template_directory_uri();
    //Imports Header from header.php
    get_header();
?>
    <?php the_archive_title( '<h1 class="text-center">', '</h1>' ); ?>
	<article>
		<?php
			if ( have_posts() ){
				while( have_posts() ){

					the_post();
					get_template_part( 'template-parts/content', 'archive' );
				}
			}
        ?>
        
        <?php the_posts_pagination(); ?>
	</article>

    
<?php
    //Imports Footer from footer.php
    get_footer();
?>