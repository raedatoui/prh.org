<section class="module voc">
	<div class="content voc-form">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<form method="post" action="" name="new_story" enctype="multipart/form-data">
			<div class="col col1">
				<textarea name="storyContent" id="story-content" placeholder="My story is..."></textarea>
			</div>
			<div class="col col2">
				<div class="input">
					<input type="text" name="storyFirstName" id="story-first-name" placeholder="First name" />
				</div>
				<div class="input">
					<input type="text" name="storyEmail" id="story-email" placeholder="Email"/>
				</div>
				<div class="input">
					<input type="text" name="storyLastName" id="story-last" placeholder="Last name"/>
				</div>
				<div class="input">
					<select name="storyState" id="story-state" placeholder="State">
						<option class='select-prompt' value="null">Select State</option>
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>
				</div>
				<div class="input upload">
					<input class="inputfile" type="file" name="storyPhoto" id="story-photo"/>
					<label for="story-photo">
						<span id="story-filename">Photo upload</span>
						<img id="story-file-preview" alt="your image" />
						<div class="icon"><span class="visually-hidden">upload</span></div>
					</label>
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
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset( $_POST['cpt_nonce_field'] ) && wp_verify_nonce( $_POST['cpt_nonce_field'], 'cpt_nonce_action' ) ) {
			
			// create post object with the form values
			$post_title = $_POST['storyFirstName'] . " ". $_POST['storyLastName'];
			$my_cptpost_args = array(
				'post_title' => $post_title,
				'post_status' => 'pending',
				'post_type' => 'phys_story',
			);

			// insert the post into the database
			$cpt_id = wp_insert_post( $my_cptpost_args, $wp_error);
			update_field('voc_story', $_POST['storyContent'], $cpt_id);
			update_field('voc_email', $_POST['storyEmail'], $cpt_id);
			update_field('voc_first_name', $_POST['storyFirstName'], $cpt_id);
			update_field('voc_last_name', $_POST['storyLastName'], $cpt_id);
			update_field('voc_state', $_POST['storyState'], $cpt_id);

			// insert the photo is present
			$f = 'storyPhoto';
			if( !empty( $_FILES[$f]['name'] )) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				$upload_overrides = array( 'test_form' => false );
				$file = wp_handle_upload( $_FILES[$f], $upload_overrides);
			
				if ( isset( $file['error'] )) {
					return new WP_Error( 'upload_error', $file['error'] );
				}
				$file_type = wp_check_filetype($_FILES[$f]['name'], array(
					'jpg|jpeg' => 'image/jpeg',
					'gif' => 'image/gif',
					'png' => 'image/png',
				));
				if ($file_type['type']) {
					$name_parts = pathinfo( $file['file'] );
					$name = $file['filename'];
					$type = $file['type'];
					
					$attachment = array(
					  'post_title' => ($post_title . "-photo"),
					  'post_type' => 'attachment',
					  'post_parent' => $pid,
					  'post_mime_type' => $type,
					  'guid' => $file['url'],
					);
					
					$attach_id = wp_insert_attachment( $attachment, $file['file'], $cpt_id );
					update_field('voc_photo', $attach_id, $cpt_id);
				}
			}

			
		}
	?>
	
</section>

