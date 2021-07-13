<?php
/*
Template Name: contact form
 */

	$path = get_template_directory_uri();
    //Imports Header from header.php
    get_header();
?>

	<h1 class="text-center"><?php the_title(); ?></h1>
    <article>
		<?php
			if ( have_posts() ){
				while( have_posts() ){

					the_post();
					get_template_part( 'template-parts/content', 'page' );
				}
            }
        ?>
	</article>
    
	<form method="post" class="row g-3 needs-validation" novalidate>

        <!--first name field-->
        <div class="col-md-6">
            <label for="validationCustom01" class="form-label">first name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <!-- last name field-->
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">last name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <!--email field-->
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">email</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
        </div>

        <!--subject field-->
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">subject</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <!--textarea-->
        <div class="mb-3">
            <label for="validationTextarea" class="form-label">message</label>
            <textarea class="form-control" id="message" name="message" required></textarea>
            <div class="invalid-feedback">
                 Please enter a message in the textarea.
            </div>
        </div>

        <div class="col-12">
            <button class="btn themell-btn" id="submit" type="submit">send message</button>
        </div>
</form>

<?php

//message validation
if ($_POST['firstname']!="" and $_POST['lastname']!="" and $_POST['email']!="" and $_POST['subject']!="" and $_POST['message']!="")
{    
    $to = get_option('admin_email');
    $site_name = get_bloginfo();
    $subject = $_POST['subject'];
        $sender = $_POST['firstname'] . ' ' . $_POST['lastname'] . ' (' . $_POST['email'] . ')';
        $message = 'Es ist eine neue Nachricht über das Kontaktformular der Homepage eingegangen.' . "\r\n\r\n" . 'Von: ' . $sender .  "\r\n" .'Nachricht: ' . $_POST['message'];
        $sender_mail = $_POST['email'];
        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: ' . $site_name . ' <' . $to . '>',
            'Reply-To: ' . $sender . ' <' . $sender_mail . '>',
        );
    wp_mail($to, $subject, $message, $headers);
    echo '<div class="alert alert-success" role="alert"">Your message has been sent successfully.</div>';  
}

?>
    
<?php
    //Imports Footer from footer.php
    get_footer();
?>