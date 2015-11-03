<table width="600" cellpadding="10" cellspacing="0" align="center" border="1">
  <tr>
    <td width="300">
      <img src="mortgage_house_logo.png" />
    </td>
    <td width="300">
      <h2>MortgageHouse Pre-Approve Form</h2>
    </td>
  </tr>
  <tr>
    <td> Name : </td>
    <td> <?php echo $first_name.' '.$middle_name.' '.$last_name; ?> </td>
  </tr>
  <tr>
    <td> Date of Birth : </td>
    <td> <?php echo $dob; ?> </td>
  </tr>
  <tr>
    <td rowspan="2"> Contact Nos : </td>
    <td> <?php echo $contact_work; ?> </td>
  </tr>
  <tr>
    <td> <?php echo $contact_home; ?> </td>
  </tr>
  <tr>
    <td rowspan="2"> Emails : </td>
    <td> <?php echo $email_work; ?> </td>
  </tr>
  <tr>
    <td> <?php echo $email_home; ?> </td>
  </tr>
  <tr>
    <td> Nationality : </td>
    <td> <?php echo $nationality_country; ?> </td>
  </tr>
  <tr>
    <td rowspan="2"> Employment : </td>
    <?php
        if($employment == 'Employed') {
          $company = $employed_company;
          $description = $employed_description;
        } else {
          $company = $self_company;
          $description = $self_description;
        }
    ?>

    <td> <?php echo $company; ?> </td>
  </tr>
  <tr>
    <td> <?php echo $description; ?> </td>
  </tr>
  <tr>
    <td> I want to : </td>
    <td> <?php echo $want; ?> </td>
  </tr>
  <tr>
    <td> What amount of finance you are looking for (estimated): </td>
    <td> <?php echo $finance_amount; ?> </td>
  </tr>
  <?php
    if($property_info_provided == 'yes') { ?>
      <tr>
        <td> Property Info </td>
        <td> <?php echo $property_info; ?> </td>
      </tr>
   <?php } ?>
</table>