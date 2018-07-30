<section class="module voc">
	<div class="content voc-form">
        <?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<form method="post">
			<div class="col col1">
				<textarea name="cptContent" id="cptContent" placeholder="My story is..."></textarea>
			</div>
			<div class="col col2">
				<div class="input">
					<input type="text" name="cptTitle" id="cptTitle" placeholder="First name" />
				</div>
				<div class="input">
					<input type="text" name="cptTitle" id="cptTitle" placeholder="email"/>
				</div>
				<div class="input">
					<input type="text" name="cptTitle" id="cptTitle" placeholder="last name"/>
				</div>
				<div class="input">
					<input type="text" name="cptTitle" id="cptTitle" placeholder="photo upload"/>
				</div>
				<div class="input">
					<input type="hidden" name="post_type" id="post_type" value="phys_story" />
				</div>
				<button type="submit"><?php _e('Submit', 'mytextdomain') ?></button>
			</div>
			<?php wp_nonce_field( 'cpt_nonce_action', 'cpt_nonce_field' ); ?>
		</form>	
	</div>
</section>