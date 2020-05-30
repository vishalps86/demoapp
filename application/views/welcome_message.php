<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type='text/javascript' src="<?php echo base_url(); ?>js/api_script.js"></script>
    <script type='text/javascript' src="<?php echo base_url(); ?>js/script.js"></script>   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCftdI2POyIA3VaWzERnSLlEdZYYIAVU2s&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Autocomplete Address Form</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">    
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/style.css"></style>
  </head>

  <body>
    <div class="page-header">
      <h1>Real Estate API Demo</h1>
    </div>
    <div id="locationField">
      <input id="autocomplete"  placeholder="Enter your address" onFocus="geolocate()"  type="text"/>
    </div>

    <table id="address" cellpadding="4">
      <tr>
        <td class="label">Street address</td>
        <td class="slimField"><input class="field" id="street_number" disabled="true"/></td>
        <td class="wideField" colspan="2"><input class="field" id="route" disabled="true"/></td>
      </tr>
      <tr>
        <td class="label">City</td>
        <td class="wideField" colspan="3"><input class="field" id="locality" disabled="true"/></td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field" id="administrative_area_level_1" disabled="true"/></td>
        <td class="label">Zip code</td>
        <td class="wideField"><input class="field" id="postal_code" disabled="true"/></td>
      </tr>
      <tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3"><input class="field" id="country" disabled="true"/></td>
      </tr>
    </table>

	   <div class='submit_btn'>
        <button type='button' class='btn btn-primary' id='submit' name='submit'>Submit</button>
     </div>

     <div class='loading-gif'>
        <img src="<?php echo base_url(); ?>img/loading_gif.png">
     </div>

     <div class='zillow-api-result'>
        <div>
          <p><b>Zillow API Response</b></p>
          <div id='zillow_error' class="alert alert-danger"></div>
        </div>
      
        <div id='zillow_success'>
           <table class='table table-striped table-bordered'>          
             <tr>
               <td>SQFT</td>
               <td id='zillow_sqft'></td>
             </tr>
              <tr>
               <td>Number of bedrooms</td>
               <td id='zillow_bedrooms'></td>
             </tr>
              <tr>
               <td>Number of bathrooms</td>
               <td id='zillow_bathrooms'></td>
             </tr>
              <tr>
               <td>Lot size</td>
               <td id='zillow_lot'></td>
             </tr>
             <tr>
               <td>Built Year</td>
               <td id='zillow_built'></td>
             </tr>
           </table>
       </div>
      </div>

      <div class='estated-api-result'>
        <div>
          <p><b>Estated API Response</b></p>
          <div id='estated_error' class="alert alert-danger"></div>
        </div>
      
         <div id='estated_success'>
            <table class='table table-striped table-bordered estated-table'>        
              <tr>
               <td>SQFT</td>
               <td id='estated_sqft'></td>
             </tr>
              <tr>
               <td>Number of bedrooms</td>
               <td id='estated_bedrooms'></td>
             </tr>
              <tr>
               <td>Number of bathrooms</td>
               <td id='estated_bathrooms'></td>
             </tr>
              <tr>
               <td>Lot size</td>
               <td id='estated_lot'></td>
             </tr>
             <tr>
               <td>Built Year</td>
               <td id='estated_built'></td>
             </tr>
           </table>
         </div>
      </div>
     

  </body>
</html>