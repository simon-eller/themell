<?php
	$path = get_template_directory_uri();
    //Imports Header from header.php
    get_header();
?>

    <h1 class="text-center">Suchergebnisse</h1>
	<article>
		<?php
			if ( have_posts() ){
				while( have_posts() ){

					the_post();
					get_template_part( 'template-parts/content', 'search' );
				}
            }
            else{
                echo '<h1 class="text-center">Suchergebnisse</h1><p class="text-center">Ihre Suche ergab keine Treffer.</h1>';
                get_search_form();
            }
		?>
	</article>

    
<?php
    //Imports Footer from footer.php
    get_footer();
?>