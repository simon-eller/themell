<?php
    $a_fn = get_the_author_meta('first_name');      //author's first name
    $a_ln = get_the_author_meta('last_name');       //author's last name
	$path = get_template_directory_uri();
    //Imports Header from header.php
    get_header();
?>
    <h1 class="text-center"><?php the_author_meta('display_name'); ?></h1>
    <div class="blockquote">
        <p class=""><?php the_author_meta('description'); ?></p>
        <div class="blockquote-footer">
        <p><?php echo $a_fn . ' ' .  $a_ln; ?></p>
        </div>
    
    </div>
    <h2 class="text-center">Weitere Artikel des Autors</h2>
	<article>
		<?php
			if ( have_posts() ){
				while( have_posts() ){

					the_post();
					get_template_part( 'template-parts/content', 'author' );
				}
			}
		?>
	</article>

    
<?php
    //Imports Footer from footer.php
    get_footer();
?>