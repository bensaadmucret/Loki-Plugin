<?php if ( true ) : ?>
<div class="login-form-container">
	<?php if ( $attributes['show_title'] ) : ?>
		<h2><?php _e( 'Connexion', 'personalize-login' ); ?></h2>
	<?php endif; ?>

	<!-- Show errors if there are any -->
	<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			<p class="login-error">
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>

	<!-- Show logged out message if user just logged out -->
	<?php if ( $attributes['logged_out'] ) : ?>
		<p class="login-info">
			<?php _e( 'Vous vous êtes déconnecté. Souhaitez-vous vous reconnecter?', 'personalize-login' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['registered'] ) : ?>
		<p class="login-info">
			<?php
				printf(
					__( 'You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', 'personalize-login' ),
					get_bloginfo( 'name' )
				);
			?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['lost_password_sent'] ) : ?>
		<p class="login-info">
			<?php _e( 'Recherchez dans votre messagerie un lien pour réinitialiser votre mot de passe.', 'personalize-login' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['password_updated'] ) : ?>
		<p class="login-info">
			<?php _e( 'Votre mot de passe a été changé. Vous pouvez vous connecter maintenant.', 'personalize-login' ); ?>
		</p>
	<?php endif; ?>

	<?php
		wp_login_form(
			array(
				'label_username' => __( 'Email', 'personalize-login' ),
				'label_log_in' => __( 'Sign In', 'personalize-login' ),
				'redirect' => $attributes['redirect'],
			)
		);
	?>

	<a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>">
		<?php _e( 'Mot de passe oublié?', 'personalize-login' ); ?>
	</a>

</div>
<?php else : ?>
	<div class="login-form-container">
		<form method="post" action="<?php echo wp_login_url(); ?>">

			<div class="login-username form-group">
				<label  for="user_login"><?php _e( 'Email', 'personalize-login' ); ?></label>
				<input class="form-control" type="text" name="log" id="user_login">
			</div>

			<div class="login-password form-group">
				<label for="user_pass"><?php _e( 'Password', 'personalize-login' ); ?></label>
				<input class="form-control" type="password" name="pwd" id="user_pass">
			</div>
			<p class="login-submit">
                <button type="submit" class="btn btn-primary">
                    <input type="submit" value="<?php _e( 'Sign In', 'personalize-login' ); ?>">
                </button>
			</p>
		</form>
	</div>
<?php endif; ?>
