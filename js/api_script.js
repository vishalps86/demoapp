 $(function() { 

	 $("#submit").on('click',function(event)
     {
        var autocomplete_field = $('#autocomplete').val();        
        if (autocomplete_field!='') {
    		event.preventDefault();    
    		var address_street = $('#street_number').val();
    		var route = $('#route').val();
    		var city = $('#locality').val();
    		var state = $('#administrative_area_level_1').val();
    		var zip = $('#postal_code').val();
    		var country = $('#country').val();
    		
            $('.loading-gif').show();
            $.ajax(
                    {
                        type:"post",
                        url: "index.php/Welcome/api",
                        data:{ "address_street":address_street,"route":route,"city":city,"state":state,"country":country,"zip":zip },
                        success:function(response) {
                            $('.loading-gif').hide();
                            $('.zillow-api-result').show();
    						console.log(response);
                            var resp = JSON.parse(response);
                            var zillow_response = resp.zillow_response;
                            var zillow_error_code = zillow_response.error_code;
                            var zillow_message = zillow_response.message_text;

                            if (zillow_error_code!=0) {
                                $('#zillow_error').html(zillow_message);
                                $('#zillow_success').hide();
                            }
                            else if (zillow_error_code == 0) {
                                $('#zillow_error').hide();
                                $('#zillow_success').show();
                            }

                            $('.estated-api-result').show();                            

                            var estated_response = resp.estated_response;

                            if (estated_response.error != 0) {
                                $('#estated_error').html(estated_response.error);
                                $('#estated_success').hide();
                            }
                            else if (estated_response.error == 0) {
                                $('#estated_error').hide();
                                $('#estated_success').show();

                                $('#estated_sqft').html(estated_response.area_sq_ft);
                                $('#estated_bedrooms').html(estated_response.beds_count);
                                $('#estated_bathrooms').html(estated_response.baths_count);
                                $('#estated_lot').html(estated_response.lot_number);
                                $('#estated_built').html(estated_response.year_built);    
                            }          
                           

                        },
                        error:function() {
                            $('.loading-gif').hide();
                            alert("Invalid!");
                        },
                    },
                );
        }
           
        });

});