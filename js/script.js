$(function(){

	$("#findWeather").click(function(e){

		//Hiding any alert div on click event
		$("#fail").hide();
		$("#success").hide();
		$("#noCity").hide();

		e.preventDefault();

		var city = $("#city").val(); 
		if(city != ""){
			
			$.get("scrapper.php?city=" + city, function(data){

				if(data == ""){
					$("#fail").fadeIn();
				}
				else{
					$("#success").html(data);
					$("#success").fadeIn();
				}
				
			});

		}
		else{
			$("#noCity").fadeIn();
		}

		
	})
});