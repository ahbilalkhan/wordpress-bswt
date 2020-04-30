</head>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Home Delivery Form</a></h1>
		<form id="form_107555" class="appnitro" enctype="multipart/form-data" method="post" action="">
					<div class="form_description">
			<h2>Enter Doner's Details</h2>
		</div>						
			<ul >
			
					<li id="li_11" >
		<label class="description" for="element_11">Select Campaign </label>
		<div>
		<select class="" id="element_11" name="element_11"> 
			<option value="" selected="selected"></option>
<option value="1" >Rasion Delivery</option>
<option value="2" >Second option</option>
<option value="3" >Third option</option>

		</select>
		</div> 
		</li>		<li id="li_1" >
		<label class="description" for="element_1" style= "strong" > Doner's Name:  </label>
        <span>
        <label>First</label>
			<input id="element_1_1" name= "element_1_1" class="element text" maxlength="255" size="14" value=""/>
			
		</span>
		<span>
        <label>Last</label>
			<input id="element_1_2" name= "element_1_2" class="element text" maxlength="255" size="14" value=""/>
			
		</span> 
		</li>		<li id="li_2" >
        <label class="description" for="element_2">Doner's Contact no. </label>
        <br>
		<span>
			<input id="element_2_1" name="element_2_1" class="element text" maxlength="11" value="" type="tel" placeholder="03001234567">
		</span>
		
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Email </label>
		<div>
			<input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Baitussalam’s Donation Receipt # </label>
		<div>
			<input id="element_4" name="element_4" class="element text medium" type="text" maxlength="255" value=""/> 
        </div> 
        <label class="description" for="element_6">Donation Amount </label>
		<div>
			<input id="element_6" name="element_6" class="element text medium" type="int" maxlength="10" value=""/> 
		</div> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Attach photo of receipt </label>
		<div>
			<input id="element_5" name="element_5" class="element file" type="file"/> 
		</div>  
		</li>		<li class="section_break">
			<h3>Enter Beneficiary Details</h3>
			
        <div class="repeater">
        <a href="#" class="buttonGray buttonRight deleteBeneficiary">Delete</a>
        
        <div class="description">
            <span>
                <label class ="description"> First Name:</label>
            <input type="text" name="first_name_#{x}" id="first_name_#{x}" size=14 value="" />
        </span>
            
        <span>
            <label class ="description"> Last Name:</label>
            <input type="text" name="last_name_#{x}" id="last_name_#{x}" size=14 value="" /></span>
            
        </div>
        
        <div class="form row"> 
            
            <label class="form row" for="benefeciary_contact">Phone no. </label>
			<input id="benefeciary_contact" name="benefeciary_contact" class="element text" maxlength="11" value="" type="tel" placeholder='03001234567'>
            
       
        <label class="description" for="beneficiary_cnic">CNIC : </label>
            <input class='textbox' id='cnic' inputmask="'mask': '99999-9999999-9'" maxlength='15' name='cnic_#' placeholder='xxxxx-xxxxxxx-x' required='required' type='text'>
        
        </div>
        <br>
		
        <div class="formRow">
           

        </div>
        
		
		<div class="formRow">
            <label class="description" for="beneficiary_address">Address </label>
			<input id="beneficiary_address" name="beneficiary_address" placeholder='Enter Address' class="element text large" value="" type="text">
			
        </div>
        
    </div>
    <div class="formRowRepeatingSection">

            <a method="addBeneficiary" class="buttonGray buttonRight addBeneficiary" >Add Beneficiary</a>
        </div>
   
		</li>
			
					<li class="buttons">

                <input class='addBeneficiary' id='addBeneficiary' type='button' value='Add Person'>

                <input id='count' name='count' type='hidden' value='3'>

                <input type="hidden" name="form_id" value="107555" />
                <button type="button" onclick="" id="addBeneficiary">Click Me!</button>
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
		
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>

