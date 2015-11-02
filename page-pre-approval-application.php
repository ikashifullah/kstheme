<?php
/**
 * Template Name: Pre Approval Application
 */

get_header(); ?>

<div class="container">

	<div id="primary" class="content-area row">
		<main id="main" class="site-main col-md-9" role="main">




			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>
			<form action="../process.php" method="post" name="myForm">
				<fieldset>
						<legend>Personal Details</legend>
				<div class="row">
					<div class="form-group col-xs-12 col-md-4">
						<label for="name" class="control-label">First Name</label>
						<input type="email" value='' class="form-control" id="name" placeholder="Ime">
					</div>
					<div class="form-group col-xs-12 col-md-4">
						<label for="name" class="control-label">Middle Name</label>
						<input type="email" value='' class="form-control" id="name" placeholder="Ime">
					</div>
					<div class="form-group col-xs-12 col-md-4">
						<label for="name" class="control-label">Last Name</label>
						<input type="email" value='' class="form-control" id="name" placeholder="Ime">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12 col-md-6">
						<label for="name" class="control-label">Date of Birth</label>
						<input type="email" value='' class="form-control" id="name" placeholder="Ime">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12 col-md-4">
						<label for="name" class="control-label">Contact (Work)</label>
						<input type="email" value='' class="form-control" id="name" placeholder="Ime">
					</div>
					<div class="form-group col-xs-12 col-md-4">
						<label for="name" class="control-label">Contact (Home)</label>
						<input type="email" value='' class="form-control" id="name" placeholder="Ime">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12 col-md-5">
						<label for="name" class="control-label">Email (Work)</label>
						<input type="email" value="" class="form-control" id="name" placeholder="Ime">
					</div>
					<div class="form-group col-xs-12 col-md-5">
						<label for="name" class="control-label">Email (Home)</label>
						<input type="email" value='' class="form-control" id="name" placeholder="Ime">
					</div>
				</div>
				</fieldset>
				<fieldset>
					<legend>Your Interest</legend>
					<div class="row">
						<div class="form-group">
							<div class="col-xs-12 col-md-7">
								<br/>
								<label class="radio-inline col-md-3">
									<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Emirati
								</label>
								<label class="radio-inline col-md-4">
									<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> expatriate
								</label>
							</div>
							<div class=" col-xs-12 col-md-4">
								<label for="name" class="control-label">Nationality:</label>
								<select class="form-control">
									<?php
									$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
									foreach($countries as $country) {
										echo '<option value="'.$country.'">'.$country.'</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-xs-12 col-md-8">
								<div><b>Employment:</b></div>
								<label class="radio-inline col-md-3">
									<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Employed
								</label>
								<label class="radio-inline col-md-4">
									<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Self-Employed
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class=" col-xs-12 col-md-8">
							<label for="name" class="control-label">Designation</label>
							<input type="email" value='' class="form-control" id="name" placeholder="Ime">
							</div>
						</div>
						<div class="form-group">
						<div class="col-xs-12 col-md-8">
							<label for="name" class="control-label">Description</label>
							<textarea class="form-control"></textarea>
						</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-xs-12 col-md-10">
								<div><b>I want to:</b></div>
								<label class="radio-inline col-md-3">
									<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Buy New House
								</label>
								<label class="radio-inline col-md-5">
									<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Remortgage Existing Property
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<div><b>What amount of finance you are looking for (estimated):</b></div>
								<input type="email" value='' class="form-control" id="name" placeholder="Ime">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<div><b>Property Info:</b></div>
								<textarea class="form-control"></textarea>

							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-12 col-md-6">
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</div>
				</fieldset>
			</form>

		</main><!-- #main -->
		
		<?php get_sidebar(); ?>
		
	</div><!-- #primary -->
	
</div>	

<?php get_template_part( 'template-parts/content', 'footertop' ); ?>

<?php get_footer(); ?>
