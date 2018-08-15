<section class="module voc">	
	<div class="content voc-form">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<form method="post" action="" name="new_story" enctype="multipart/form-data">
			<div class="col col1">
				<textarea name="storyContent" id="story-content" placeholder="My story is..." required></textarea>
			</div>
			<div class="col col2">
				<div class="input">
					<input type="text"  name="storyName" id="story-name" placeholder="Name" required/>
				</div>

				<div class="input">
					<input type="text" name="storyEmail" id="story-email" placeholder="Email" required/>
				</div>

				<div class="input">
					<select name="storyState" id="story-state" placeholder="State" required>
						<option value="">Select State</option>
						<option value="Alabama">Alabama</option>
						<option value="Alaska">Alaska</option>
						<option value="Arizona">Arizona</option>
						<option value="Arkansas">Arkansas</option>
						<option value="California">California</option>
						<option value="Colorado">Colorado</option>
						<option value="Connecticut">Connecticut</option>
						<option value="Delaware">Delaware</option>
						<option value="District Of">District Of Columbia</option>
						<option value="Florida">Florida</option>
						<option value="Georgia">Georgia</option>
						<option value="Hawaii">Hawaii</option>
						<option value="Idaho">Idaho</option>
						<option value="Illinois">Illinois</option>
						<option value="Indiana">Indiana</option>
						<option value="Iowa">Iowa</option>
						<option value="Kansas">Kansas</option>
						<option value="Kentucky">Kentucky</option>
						<option value="Louisiana">Louisiana</option>
						<option value="Maine">Maine</option>
						<option value="Maryland">Maryland</option>
						<option value="Massachusetts">Massachusetts</option>
						<option value="Michigan">Michigan</option>
						<option value="Minnesota">Minnesota</option>
						<option value="Mississippi">Mississippi</option>
						<option value="Missouri">Missouri</option>
						<option value="Montana">Montana</option>
						<option value="Nebraska">Nebraska</option>
						<option value="Nevada">Nevada</option>
						<option value="New Hampshire">New Hampshire</option>
						<option value="New Jersey">New Jersey</option>
						<option value="New Mexico">New Mexico</option>
						<option value="New York">New York</option>
						<option value="North Carolina">North Carolina</option>
						<option value="North Dakota">North Dakota</option>
						<option value="Ohio">Ohio</option>
						<option value="Oklahoma">Oklahoma</option>
						<option value="Oregon">Oregon</option>
						<option value="Pennsylvania">Pennsylvania</option>
						<option value="Rhode Island">Rhode Island</option>
						<option value="South Carolina">South Carolina</option>
						<option value="South Dakota">South Dakota</option>
						<option value="Tennessee">Tennessee</option>
						<option value="Texas">Texas</option>
						<option value="Utah">Utah</option>
						<option value="Vermont">Vermont</option>
						<option value="Virginia">Virginia</option>
						<option value="Washington">Washington</option>
						<option value="West Virginia">West Virginia</option>
						<option value="Wisconsin">Wisconsin</option>
						<option value="Wyoming">Wyoming</option>
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
</section>

