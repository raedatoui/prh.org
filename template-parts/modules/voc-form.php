<section class="module voc">
	<div class="content voc-form">
        <?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<form method="post">
			<div class="col col1">
				<textarea name="cptContent" id="cptContent" placeholder="My story is..."></textarea>
			</div>
			<div class="col col2">
				<div class="input">
					<input type="text" name="first" id="first" placeholder="First name" />
				</div>
				<div class="input">
					<input type="text" name="email" id="email" placeholder="email"/>
				</div>
				<div class="input">
					<input type="text" name="last" id="last" placeholder="last name"/>
				</div>
				<div class="input">
					<input class="inputfile" type="file" name="photo" id="photo"/>
					<label for="photo">
						<span>Photo upload</span>
						<div class="icon"><span class="visually-hidden">upload</span></div>
					</label>
				</div>
				<div class="input">
					<input type="hidden" name="post_type" id="post_type" value="phys_story" />
				</div>

				<button type="submit">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<defs>
							<style>.cls-1{fill:url(#linear-gradient);}</style>
							<linearGradient id="linear-gradient" y1="50%" x2="100%" y2="50%" gradientUnits="userSpaceOnUse">
								<stop offset="0" stop-color="#adbdff"/>
								<stop offset="1" stop-color="#0580c3"/>
							</linearGradient>
						</defs>
						<g id="Layer_2" data-name="Layer 2">
							<g id="Layer_1-2" data-name="Layer 1">
								<rect class="cls-1" width="100%" height="100%"/>
							</g>
						</g>
					</svg>
					<span>SUBMIT</span>
				</button>
			</div>
			<?php wp_nonce_field( 'cpt_nonce_action', 'cpt_nonce_field' ); ?>
		</form>	
	</div>
</section>