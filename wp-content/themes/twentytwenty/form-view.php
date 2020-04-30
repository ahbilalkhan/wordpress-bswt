<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" role="main">

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		?>
		<div id="form_container">
	
	<h1><a>Home Delivery Form</a></h1>
	<form id="deliveryForm" class="ajax" enctype="multipart/form-data" method="post">
				<div class="form_description">
		<h2>Enter Donor's Details</h2>
	</div>						
		<ul >
		
				<li id="li_11" >
	<label class="description" for="campaigns">Select Campaign </label>
	<div>
	<select class="" id="campaigns" name="campaigns" > 
		
<option value="1" >Rasion Delivery</option>
<option value="2" >Second option</option>
<option value="3" >Third option</option>

	</select>
	</div> 
	</li>		<li id="li_1" >
	<label class="description" for="donorName" > Donor's Name:  </label>
	<span>
	<label>First</label>
		<input id="donorFirstName" name= "donorFirstName" class="element text" maxlength="255" size="14" value=""/>
		
	</span>
	<span>
	<label>Last</label>
		<input id="donorLastName" name= "donorLastName" class="element text" maxlength="255" size="14" value=""/>
		
	</span> 
	</li>		<li id="li_2" >
	<label class="description" for="donorContact">Donor's Contact no. </label>
	
	<span>
		<input id="donorContact" name="donorContact" class="element text" maxlength="11" value="" type="tel" placeholder="03001234567">
	</span>
	
	</li>		<li id="li_3" >
	<label class="description" for="donorEmail">Email </label>
	<div>
		<input id="donorEmail" name="donorEmail" class="element text medium" type="text" maxlength="255" value=""/> 
	</div> 
	</li>		<li id="li_4" >
	<label class="description" for="receiptNum">Baitussalam’s Donation Receipt # </label>
	<div>
		<input id="receiptNum" name="receiptNum" class="element text medium" type="text" maxlength="255" value=""/> 
	</div> 
	<label class="description" for="donationAmount">Donation Amount </label>
	<div>
		<input id="donationAmount" name="donationAmount" class="element text medium" type="number" maxlength="10" value=""/> 
	</div> 
	</li>		<li id="li_5" >
	<label class="description" for="receiptPhoto">Attach photo of receipt </label>
	<div>
		<input id="receiptPhoto" name="receiptPhoto" class="element file" type="file"/> 
	</div>  
	</li>		<li class="section_break">
		
		
	<div class="repeatingSection">
	<h3>Enter Beneficiary Details</h3>
	<a href="#" class="buttonGray buttonRight remove deleteBeneficiary">Delete</a>
	
	<div class="description">
		<span>
			<label class ="description"> First Name:</label>
		<input type="text" class="b_f_name" name="beneficiaryFirstName" id="beneficiaryFirstName" size=14 value="" />
	</span>
		
	<span>
		<label class ="description"> Last Name:</label>
		<input type="text" name="first_name_#{x}" id="first_name_#{x}" size=14 value="" /></span>
		
	</div>
	
	<div class="form row"> 
		
		<label class="form row" for="benefeciaryContact">Phone no. </label>
		<input id="benefeciaryContact" name="benefeciaryContact" class="element text" maxlength="11" value="" type="tel" placeholder='03001234567'>
		
   
	<label class="description" for="cnic">CNIC : </label>
		<input class='textbox' id='cnic' inputmask="'mask': '99999-9999999-9'" maxlength='15' name='cnic_#' placeholder='xxxxx-xxxxxxx-x' required='required' type='text'>
	
	</div>
	<br>
	
	<div class="formRow">
	   

	</div>
	
	
	<div class="formRow">
		<label class="description" for="beneficiaryAddress">Address </label>
		<input id="beneficiaryAddress" name="beneficiaryAddress" placeholder='Enter Address' class="element text large" value="" type="text">
		
	</div>
	
</div>
<!-- <div class="formRowRepeatingSection">

		<a href="#" method="addBeneficiary" class="buttonGray buttonRight addBeneficiary" >Add Beneficiary</a>
	</div> -->

	</li>
		
				<li class="buttons">

			<input href="#" class='addBeneficiary' id="addBeneficiary" type="button" value='Add Beneficiary'>
			
			
			<input id='count' name='count' type='hidden' value='3'>
			
			<input id="saveForm" class="button_text" type="submit" value="Submit" />
			
			<input type="checkbox" id="remainingbeneficiaries" name="remainingbeneficiaries" value="">
  			<label for="remainingbeneficiaries"> Let Baitussalam choose remaining beneficiaries</label><br>
		</li>
		</ul>
	</form>	
	
</div>
<?php


		}
	}

	?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
