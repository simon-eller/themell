<?php
$version = wp_get_theme()->get( 'Version' );
$theme_path = get_template_directory_uri();
$site_url = get_site_url( $blog_id = null, $path = '', $scheme = null );
$a_fn = get_the_author_meta('first_name');      //author's first name
$a_ln = get_the_author_meta('last_name');       //author's last name
?>

<!DOCTYPE html>
<html lang="<?php echo get_bloginfo('language'); ?>" dir="ltr">
<head>
	<!-- Meta -->
	<!--<title><?php the_title(); ?> | <?php echo get_bloginfo('name'); ?></title>-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="author" content="<?php echo $a_fn . ' ' .  $a_ln; ?>">
	<link rel="shortcut icon" href="images/logo.png">
	<meta name="generator" content="Themell <?php echo $version ?>"/>
	<meta name="publisher" content="<?php echo get_bloginfo('name'); ?>">
	<meta name="copyright" content="<?php echo get_bloginfo('name'); ?>">
    <?php
    wp_head();
    ?>

</head>

<body>

	<!--Navbar-->
	<nav class="navbar sticky-top navbar-expand-lg navbar-light themell-bg1 pt-2 pb-2">
		<div class="container">
			<a class="navbar-brand" href="<?php echo $site_url ?>">
        <?php
        $custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

		//if a custom images was chosen
		if ( has_custom_logo() ) {
			echo '<img src="' . $logo[0] . '" alt="' . get_bloginfo( 'name' ) . '" width="auto" height="70">';
		}
		//else the standard logo will be displayed
		else {
			echo '<img src="' . $theme_path . '/assets/images/Logo.svg" alt="' . get_bloginfo( 'name' ) . '" width="250" height="70">';
		}

        ?>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>

			<!--Dynamic Menu-->

			<?php
				wp_nav_menu( array(
					'theme_location'  => 'primary',
					'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
					'container'       => 'div',
					'container_class' => 'collapse navbar-collapse',
					'container_id'    => 'navbarSupportedContent',
					'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker(),
				) );
			?>

		</div>
	</nav>
	<!--End of Navbar-->

	<!--Main content-->
	<div class="container-fluid">
		<div class="container pt-2 pb-2 mt-3 mb-3">
