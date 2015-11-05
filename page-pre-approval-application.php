<?php
/**
 * Template Name: Pre Approval Application
 */

get_header (); ?>

<?php
$response = '';
if ( isset( $_POST['submitted'] ) ) {
    $html = getEmailTemplate ( $_POST );
    global $response;
    if( isset( $_POST['email_work'] ) && isset( $_POST['email_home'] ) ) {
        $multiple_recipients = array ( 'support@propertyhouseuae.com', $_POST['email_home'], $_POST['email_work'] );
    } else {
        $multiple_recipients = array ( 'support@propertyhouseuae.com', $_POST['email_home'] );
    }

    $headers[] = 'From: "MortgageHouse Info" <info@mortgagehouseuae.com>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $subject = 'Pre Approve Form: Mortgagehouse Website';
    $body = $html;
    $errors = array();
    if(empty($_POST['first_name'])) {
        $errors[] = "<div class='alert alert-danger'> Please enter your first name!</div>";
    } else {
        $sent = wp_mail ( $multiple_recipients, $subject, $body, $headers );
        if($sent) {
            $response = "<div class='alert alert-success'> A copy of information is send to your email address, and we'll get in touch with you soon!</div>";
        }
    }
}

?>
<div class="container">

    <div id="primary" class="content-area row">
        <main id="main" class="site-main col-md-9" role="main">


            <?php while ( have_posts () ) : the_post (); ?>

                <?php get_template_part ( 'template-parts/content', 'page' ); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open () || get_comments_number () ) :
                    comments_template ();
                endif;
                ?>

            <?php endwhile; // End of the loop. ?>
            <?php if ( isset( $response ) ) echo $response; ?>
            <form action="<?php the_permalink (); ?>" method="post" id="pre-approval-form">
                <fieldset class="pre-approved-btn-fieldset">
                    <legend class="pre-approved-btn-legend">Personal Details</legend>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-4">
                            <label for="first_name" class="control-label">First Name</label><span class="pre-approved-required">*</span>
                            <input type="text" name="first_name" class="form-control" id="first_name"
                                   placeholder="Enter your First Name">
                        </div>
                        <div class="form-group col-xs-12 col-md-4">
                            <label for="middle_name" class="control-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" id="middle_name"
                                   placeholder="Enter your Middle Name">
                        </div>
                        <div class="form-group col-xs-12 col-md-4">
                            <label for="last_name" class="control-label">Last Name</label><span class="pre-approved-required">*</span>
                            <input type="text" name="last_name" class="form-control" id="last_name"
                                   placeholder="Enter your Last Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="dob" class="control-label">Date of Birth</label><span class="pre-approved-required">*</span>
                            <input type="text" name="dob" class="form-control date-picker" id="dob"
                                   data-date-format="dd-MM-yyyy" placeholder="MM/DD/YYYY" readonly="readonly">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-4">

                            <label for="contact_work" class="control-label">Contact (Mobile)</label><span class="pre-approved-required">*</span>
                            <input type="text" name="contact_work" class="form-control" id="contact_work"
                                   placeholder="e.g. +971501234567">
                            <p class="help-block help-style">e.g. +971-50-123-1234</p>
                        </div>
                        <div class="form-group col-xs-12 col-md-4">
                            <label for="contact_home" class="control-label">Contact (Landline)</label>
                            <input type="text" name="contact_home" class="form-control" id="contact_home" placeholder="e.g. +971501234567">
                            <p class="help-block help-style">e.g. +971-4-123-1234</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-5">
                            <label for="dob" class="control-label">Enter contact number (Including Country Code) if you need be contacted outside of UAE:</label>
                            <input type="text" name="contact_international" class="form-control input-small" id="contact_international" placeholder="Enter your International Contact">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-5">
                            <label for="email_home" class="control-label">Email (Personal)</label><span class="pre-approved-required">*</span>
                            <input type="email" name="email_home" class="form-control" id="email_home" placeholder="Enter your Personal Email">
                        </div>
                        <div class="form-group col-xs-12 col-md-5">
                            <label for="email_work" class="control-label">Email (Work)</label>
                            <input type="email" name="email_work" class="form-control" id="email_work" placeholder="Enter your Work email">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="pre-approved-btn-fieldset">
                    <legend  class="pre-approved-btn-legend">Your Interest</legend>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-8">
                                <div class="pre-approved-field-heading"><b>Nationality:</b><span class="pre-approved-required">*</span></div>
                                <label class="radio-inline col-md-4">
                                    <input type="radio" name="nationality" class="nationality-check" data-id="emirati"
                                           value="Emirati"> I am Emirati National
                                </label>
                                <label class="radio-inline col-md-4">
                                    <input type="radio" name="nationality" class="nationality-check"
                                           data-id="expatriate" value="Expatriate"> I am Expatriate
                                </label>
                                <label for="nationality" class="error help-block" style="display:none;">* Please pick an option above</label>
                            </div>
                            <div class=" col-xs-12 col-md-4 nationality-box">
                                <label for="name" class="control-label">Choose your Country:</label>
                                <select class="form-control" name="nationality_country" id="nationality_country">
                                    <option value="">Please select your country</option>
                                    <?php
                                    $countries = array ( "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe" );
                                    foreach ( $countries as $country ) {
                                        echo '<option value="' . $country . '">' . $country . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="form-group col-xs-12 col-md-8">
                                <div class="pre-approved-field-heading"><b>Tell us about your Employment Status:</b><span class="pre-approved-required">*</span></div>
                                <label class="radio-inline col-md-3">
                                    <input type="radio" name="employment" class="employment-check" data-id="employed" value="Employed">I am Employed
                                </label>
                                <label class="radio-inline col-md-4">
                                    <input type="radio" name="employment" class="employment-check"
                                           data-id="self-employed" value="Self-Employed"> I am Self-Employed
                                </label>
                                <label for="employment" class="error" style="display:none;">* Please pick an option above</label>
                            </div>
                        </div>
                    </div>
                    <div class="row employment-employed-box">
                        <div class="form-group">
                            <div class="form-group col-xs-12 col-md-8">
                                <label for="employed_company" class="control-label">Company / Employer Name</label><span class="pre-approved-required">*</span>
                                <input type="text" class="form-control" name="employed_company" id="designation"
                                       placeholder="Enter company Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-8">
                                <label for="employed_description" class="control-label">Job Title / Designation </label><span class="pre-approved-required">*</span>
                                <input type="text" name="employed_description" class="form-control" id="employed_description" placeholder="Enter your Job Title / Description"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row employment-self-box">
                        <div class="form-group">
                            <div class="form-group col-xs-12 col-md-8">
                                <label for="self_company" class="control-label">Company Name</label><span class="pre-approved-required">*</span>
                                <input type="text" name="self_company" class="form-control" id="company"
                                       placeholder="Enter your Company Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-8">
                                <label for="self_description" class="control-label">Description</label><span class="pre-approved-required">*</span>
                                <textarea name="self_description" class="form-control" placeholder="Description about your company"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="form-group col-xs-12 col-md-12">
                                <div class="pre-approved-field-heading"><b>I am inquiring to:</b><span class="pre-approved-required">*</span></div>
                                <label class="radio-inline col-md-3">
                                    <input type="radio" name="want" id="want-buy" value="Buy New House"> Buy New House
                                </label>
                                <label class="radio-inline col-md-4">
                                    <input type="radio" name="want" id="want-remortgage" value="Remortgage Existing Property"> Remortgage Existing Property
                                </label>
                                <label class="radio-inline col-md-4">
                                    <input type="radio" name="want" id="my-option" value="Find out my options"> Find out my options
                                </label>
                                <label for="want" class="error" style="display:none;">* Please pick an option above</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                                <div class="pre-approved-field-heading"><b>What amount of finance you are looking for (estimated):</b><span class="pre-approved-required">*</span></div>
                                <input type="text" name="finance_amount" class="form-control" id="finance_amount"
                                       placeholder="Estimated Finance Amount">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <div class="pre-approved-field-heading"><b>Property Info:</b></div>
                                <label class="radio-inline col-md-3">
                                    <input type="radio" name="property_info_provided" class="property-info-check"
                                           data-id="yes" value="yes"> Yes
                                </label>
                                <label class="radio-inline col-md-5">
                                    <input type="radio" name="property_info_provided" class="property-info-check"
                                           data-id="no" value="no"> No
                                </label>

                                <div class="property-info-box">
                                    <textarea class="form-control" name="property_info" id="property_info"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                            <br />
                            <input type="hidden" name="submitted" value="1">
                            <button type="submit" class="btn btn-default" style="1px solid #aaa;">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </main>
        <!-- #main -->

        <?php get_sidebar (); ?>

    </div>
    <!-- #primary -->

</div>
<script>
    jQuery(function () {
        /* Nationality Box Process */
        jQuery('.nationality-box').hide();
        jQuery('.nationality-check').change(function (event) {
            var id = jQuery(this).data('id');
            if (id == 'emirati') {
                jQuery('.nationality-box').hide();
            } else {
                jQuery('.nationality-box').show();
            }
        });
        /* Employment Box Process */
        jQuery('.employment-employed-box').hide();
        jQuery('.employment-self-box').hide();
        jQuery('.employment-check').change(function (event) {
            var employedId = jQuery(this).data('id');
            if (employedId == 'employed') {
                jQuery('.employment-self-box').hide();
                jQuery('.employment-employed-box').show();
            } else {
                jQuery('.employment-employed-box').hide();
                jQuery('.employment-self-box').show();
            }
        });
        jQuery('.property-info-box').hide();
        jQuery('.property-info-check').change(function (event) {
            var propertyInfoId = jQuery(this).data('id');
            if (propertyInfoId == 'yes') {
                jQuery('.property-info-box').show();
            } else {
                jQuery('.property-info-box').hide();
            }
        });

        // Jquery Validatoin
        jQuery("#pre-approval-form").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                dob: "required",
                contact_work: "required",
                nationality: "required",
                nationality_country : "required",
                employment: "required",
                employed_company: "required",
                employed_description: "required",
                self_company: "required",
                self_description: "required",
                want: "required",
                finance_amount: "required",
                property_info: "required",
                email_work: {
                    email: true
                },
                email_home: {
                    required: true,
                    email: true
                }
            },
            messages: {
                first_name: "Please enter your firstname",
                last_name: "Please enter your lastname",
                dob: "Please select your date of birth",
                email_home: {
                    required: "Please enter your email (Personal)",
                    email: "Please enter valid email address",
                },
                email_work: {
                    email: "Please enter valid email address",
                },
                contact_work: "Please enter your contact (mobile)",
                nationality: "Please choose your nationality",
                nationality_country: "Please choose your country",
                employment: "Please choose your employment",
                employed_company: "Please enter your Company / Employer Name",
                employed_description: "Please enter your Job Title / Designation",
                self_company: "Please enter your own Company Name",
                self_description: "Please enter your Company Description",
                want: "Please choose your interest",
                finance_amount: "Please enter your Finance amount",
                property_info: "Please enter your Property Information",
            }
        });
        jQuery.mask.definitions['~']='[+]';
        jQuery("#contact_work").mask("~999-99-999-9999",{placeholder:"+971-__-___-____"});
        jQuery("#contact_home").mask("~999-9-999-9999",{placeholder:"+971-_-___-____"});

    });


</script>

<?php get_template_part ( 'template-parts/content', 'footertop' ); ?>

<?php get_footer (); ?>
