/*----------------------------------------------------------------------------------------------------------*/
function SendCheck(txt_valid,Phone,TempId){
	$.ajax({
		type: "GET",
		url: "/ajax/checknum.php",
		data: {date:txt_valid},
		dataType: "json",
		success: function(data){
			if(data==1){
				SendTemp(Phone,TempId);
			}else{
				alert('请正确填写正确的图形码!');
				return false;
			}
		}
	 });	
}

/*----------------------------------------------------------------------------------------------------------*/
function SendTemp(Phone,TempId){
	$.ajax({
		 type: "GET",
		 url: "/Demo/SendTemplateSMS.php",
		 data: {date:Phone,_TempId:TempId},
		 dataType: "json",
		 success: function(data){
		 }
	 });

	$('#getcodes').hide();
	$('#getcodes2').show();
	var i = 120; 
	var intervalid; 
	intervalid = setInterval(timeload, 1000); 
	function timeload() { 
		if (i == 0) { 
			$('#getcodes').show();
			$('#getcodes2').hide();
			clearInterval(intervalid);
		} 
			$("#timeload").html(i); 
			i--; 
			//console.info(i);
	}	
}