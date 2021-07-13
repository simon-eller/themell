<?php
	$path = get_template_directory_uri();
    //Imports Header from header.php
    get_header();
?>

	<article>
        <h1 class="text-center">Fehler 404</h1>
        <p class="text-center">Die angeforderte Seite wurde nicht gefunden.</p>

        <?php
            get_search_form();
        ?>
	</article>

    
<?php
    //Imports Footer from footer.php
    get_footer();
?>