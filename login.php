<?php
/**
 * Login/logout Page
 *
 * @author       Matt Ryan
 * @link         http://www.mattryan.co/
 * @copyright    Copyright (c) 2016, Matt Ryan
 * @license      GPL-3.0+
 * @link 				 https://calvinkoepke.com/build-custom-login-page-genesis/
 */

// Remove our default page content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

// Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Add custom login form to our page content
add_action( 'genesis_entry_content', 'cws_do_login_form' );
function cws_do_login_form() {

// Get login status and username
	$loggedin = is_user_logged_in();
	$user = wp_get_current_user();

// If already logged in, output pleasent message with logout option.
// The logout option will redirect back to this custom login/logout page.

	if ( $loggedin ) { ?>

		<h3>You are already logged in!</h3>
		<p>Hello <?php echo $user->user_firstname; ?>! Looks like you are already signed in. No need to log in again.</p>
		<p><a href="/">Go to Homepage</a> or <a href="<?php echo wp_logout_url( get_permalink() . "/login" ); ?>">Log Out</a></p>

	<?php
	} else {
// Set up array to pass to login function
		$args = array(
			'form_id'			=> 'loginform',
			'redirect'			=> get_bloginfo( 'url' ),
			'id_username'		=> 'user_login',
			'id_password'		=> 'user_pass',
			'id_remember'		=> 'rememberme',
			'id_submit'			=> 'wp-submit',
			'label_username'	=> __( 'Username' ),
			'label_password'	=> __( 'Password' ),
			'label_remember'	=> __( 'Remember Me' ),
			'label_log_in'		=> __( 'Log In' ),
		);
		?>
<!--
	Create content for custom login page.
	Format the login page and provide instructions to visitor.
	Offer links to website front page and password retreival.
	Call WP funciton to display UI.
	Display lost password link.
-->
		<center><h1>Website Login Page</h1><hr>
		<h5>Enter your login username and password to log <br>into the administrative area of your website,<br>
		<a href="/">or click here for the website Front Page</a></h5>
		<hr>
		Use the '<strong>Lost your password?</strong>' link below <br>to have a password reset link sent to you by email.
		<br><hr><br>
		</center>
		<?php

		wp_login_form( $args );

		?>
		<a href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password">Lost your password?</a>
		<?php
	}
}

genesis();
