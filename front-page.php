<?php
	$path = get_template_directory_uri();
    //Imports Header from header.php
    get_header();
?>
    
	<article>
		<?php
			if ( have_posts() ){
				while( have_posts() ){

					the_post();
					the_content();
				}
			}
		?>
	</article>

    
<?php
    //Imports Footer from footer.php
    get_footer();
?>