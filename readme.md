# Themell

[![Build Status](https://api.travis-ci.org/simon-eller/themell.svg?branch=main)](https://simon-eller.at/projekte/themell)

Themell is a custom build wordpress theme based on [Bootstrap 5](https://github.com/topics/bootstrap).

## Features

- Standard Wordpress pages
- Blog pages (single, author, archive)
- Navbar with custom Navwalker
- Searchform
- Contact page
- Customizations with the Wordpress Customizer

## Files and structure
In the following sectioin the files of the theme and how they work are explained.
In the **template_parts** folder are some templates to render the content.

### Style
The style.css file is the file that Wordpress needs to recognize the theme at all. All the properties of the theme are there.

### Functions
Some Wordpress functions for the theme are created in the functions.php file.

The first function creates the possibility of changing the logo dynamically in the Wordpress Customizer.
```php
if ( ! function_exists( 'themell_theme_support' ) ) {

    function themell_theme_support(){
        //Adds dynamic title tag and logo
        add_theme_support( 'title-tag' );
        $logo_width  = 250;
		    $logo_height = 70;

		add_theme_support(
			'custom-logo',
      array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);
        add_theme_support('post-thumbnails');
    }
    add_action( 'after_setup_theme', 'themell_theme_support' );
}
```

Next, the primary and footer menu are declared. We'll use it later on.
```php
function themell_menus(){

    $locations = array(
        'primary' => "Header menu",
        'footer' => "Footer Menu"
    );

    register_nav_menus($locations);
}

add_action('init','themell_menus');
```

The next lines are there to include the stylesheets in the header.
```php
function themell_register_styles(){

    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style('themell-bootstrap', get_template_directory_uri() . "/assets/css/bootstrap.css", array(), '5.0.0', 'all');
    wp_enqueue_style('themell-style', get_template_directory_uri() . "/assets/css/style.css", array('themell-bootstrap'), $version, 'all');
    wp_enqueue_style('themell-w3', get_template_directory_uri() . "/assets/css/w3.css", array(), '4', 'all');
}

add_action( 'wp_enqueue_scripts', 'themell_register_styles');
```

The same applies to the Javascript files in the footer.
```php
function themell_register_scripts(){

    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_script('themell-bootstrap', get_template_directory_uri() . "/assets/js/bootstrap.min.js", array(), '5.0.0',true);
    wp_enqueue_script('themell-main', get_template_directory_uri() . "/assets/js/main.js", array(), $version,true);
}

add_action( 'wp_enqueue_scripts', 'themell_register_scripts');
```

And finally, your own Navwalker is registered in order to receive a nice Navbar later.
```php
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

?>

```
### Index/Archive
The **index.php** file is the so called fallback template. It's used for pages where there is no "more specific" template. And it's the same code as in the **archive.php** file because somehow the **archive.php** itself is not recognized by Wordpress.

Just for fun we define a variable called *path* to get the current templates directory. Maybe we'll need it later on.
```php
$path = get_template_directory_uri();
```

The next function is to output the header.
```php
get_header();
```

Next, the page title is rendered as the heading.
```php
the_archive_title( '<h1 class="text-center">', '</h1>' );
```

The following construct is there to output all existing posts with the template **archive**.
```php
if ( have_posts() ){
	while( have_posts() ){
        the_post();
			get_template_part( 'template-parts/content', 'archive' );
	}
}
```

When the maximum number of posts on a page is reached, multiple pages are created and this function outputs the navigation bar.^[https://developer.wordpress.org/reference/functions/the_posts_pagination]
```php
the_posts_pagination();
```

### Header
The website's metadata is defined in the **header.php** file and the navbar is programmed there.
Firstly there are some variables.
```php
$version = wp_get_theme()->get( 'Version' );
$theme_path = get_template_directory_uri();
$site_url = get_site_url( $blog_id = null, $path = '', $scheme = null );
$a_fn = get_the_author_meta('first_name');
$a_ln = get_the_author_meta('last_name');
```

#### Navbar
The navbar is simply based on the Bootstrap 5 navbar with a custom navwalker.
To show the logo that is defined in the Wordpress Customizer there is the following function.

```php
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
```

The next lines of code are there to dynamically output the content of the **primary menu** in the navbar. Up to two levels (one sub-item) are displayed from the menu.
```php
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
```

### Footer
The **footer.php** file is statically programmed and is used on every page that has a footer at all.
In order to dynamically output links (e.g. for the data protection declaration), there is a Wordpress function, called **get_site_url**, which is used in this theme. 
This is solved in such a way that there are no errors if the website URL changes at some point.
```php
$site_url = get_site_url( $blog_id = null, $path = '', $scheme = null );
```

In order to be able to display dynamic elements that have been added in the Wordpress Customizer, the following line of code is required.
```php
dynamic_sidebar('footer-1');
```

In order to integrate the Javascript files required by Wordpress into the website, the following command comes last.
```php
wp_footer();
```

### Comments
The file comments.php is there to display the comments (if there are comments) of a post.
The following lines are used to check whether there are any comments.^[https://developer.wordpress.org/reference/functions/get_comments_number/]
```php
if( ! have_comments()){
}
else{
    echo get_comments_number(). " comments";
}
```

All comments are output with the following Wordpress function. The avatar size is set as a parameter.^[https://developer.wordpress.org/reference/functions/wp_list_comments/]
```php
wp_list_comments(
    array(
        'avatar_size' => 50,
        'style' => 'div',
    )
);
```

If the comment function is activated for this post, a form for writing a comment is also displayed. The parameters are used to display the form in bootstrap style.
```php
if( comments_open() ){
    $comment_args = array(
        'class_submit' => 'btn themell-btn',
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" class="form-control" cols="45" rows="8" maxlength="1000" aria-required="true" required="required"></textarea></p>',
        'fields' => array(
            'class_form' => '',
            'title_reply_before' => '<h2>',
            'title_replay_after' => '</h2>',
            'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="email" name="email" class="form-control" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
            '<input id="url" name="url" class="form-control" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
            )
    );
    comment_form($comment_args);
}
```

### Front Page
The **front-page.php** file is there to output the content of the start page as it was created in the block editor.

### Search
The **search.php** file is there to output the search results. It uses the template part search to display each individual search result.

### Searchform
The **searchform.php** file is there to output the searchform.

### Contact
In order not to have to rely on external form plugins, Themell provides its own contact form.
In order to use this form, a new page must then be created in Wordpress and this template selected.
The form itself is not magic. It's just a standard Bootstrap 5 contact form with the fields you want.

The secret lies in the PHP code afterwards. The first thing to do is to check that the fields are not empty.
The e-mail is then sent using the *wp_mail* function.^[https://developer.wordpress.org/reference/functions/wp_mail/]
```php
if ($_POST['firstname']!="" and $_POST['lastname']!="" and $_POST['email']!="" and $_POST['subject']!="" and $_POST['message']!="")
{    
    $to = get_option('admin_email');
    $subject = $_POST['subject'];
        $sender = $_POST['firstname'] . ' ' . $_POST['lastname'] . ' (' . $_POST['email'] . ')';
        $message = 'Es ist eine neue Nachricht über das Kontaktformular der Homepage eingegangen.' . "\r\n\r\n" . 'Von: ' . $sender .  "\r\n" .'Nachricht: ' . $_POST['message'];
        $sender_mail = $_POST['email'];
        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: Wordpress Site <your@email.com>',
            'Reply-To: ' . $sender . ' <' . $sender_mail . '>',
        );
    wp_mail($to, $subject, $message, $headers);
    echo '<div class="alert alert-success" role="alert"">Your message has been sent successfully.</div>';    
}
```

### Template Parts
#### Page
The template part **page** is the simplest template. It only outputs the content of the corresponding page without formatting. ^[https://developer.wordpress.org/reference/functions/the_content/]
```php
the_content();
```

### Search
The template part **search** outputs one search result and uses a few Wordpress functions.

### Archive
The template part **archive** outputs the content of a blog post.

## Wordpress functions
Wordpress has many php functions that are used in this template. The following section describes the most important of these functions, which are often used in this theme.

### The Title
Display or retrieve the current post title with optional markup.^[https://developer.wordpress.org/reference/functions/the_title/]
```php
the_title();
```

### The Permalink
Displays the permalink for the current post.^[https://developer.wordpress.org/reference/functions/the_permalink/]
```php
the_permalink();
```

### The Excerpt
Display the post excerpt.^[https://developer.wordpress.org/reference/functions/the_excerpt/]
```php
the_excerpt();
```

### The Date
Display or Retrieve the date the current post was written (once per date).^[https://developer.wordpress.org/reference/functions/the_date/]
```php
the_date();
```

### Comments Number
Displays the language string for the number of comments the current post has.^[https://developer.wordpress.org/reference/functions/comments_number/]
```php
comments_number();
```

### The Post Thumbnail URL
Return the post thumbnail URL to display the image.^[https://developer.wordpress.org/reference/functions/the_post_thumbnail_url/]
```php
the_post_thumbnail_url();
```

## Dependencies
- [Wordpress](https://github.com/WordPress/WordPress)
- [Bootstrap 5](https://github.com/topics/bootstrap)
- [Bootstrap Navwalker](https://github.com/wp-bootstrap/wp-bootstrap-navwalker) (with some little changes to work with Bootstrap 5)

## License
[GNU General Public License v3 or later](https://www.gnu.org/licenses/gpl-3.0.en.html)
