<section class="module">
	<div class="content">
        <?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<form method="post">
			<p><label for="cptTitle"><?php _e('Enter the Post Title:', 'mytextdomain') ?></label>
			<input type="text" name="cptTitle" id="cptTitle" /></p>
			
			<p> <label for="cptContent"><?php _e('Enter Some Content:', 'mytextdomain') ?></label>
			<textarea name="cptContent" id="cptContent" rows="4" cols="20"></textarea> </p>

			<button type="submit"><?php _e('Submit', 'mytextdomain') ?></button>

			<input type="hidden" name="post_type" id="post_type" value="phys_story" />

			<?php wp_nonce_field( 'cpt_nonce_action', 'cpt_nonce_field' ); ?>
		</form>	
	</div>
</section>