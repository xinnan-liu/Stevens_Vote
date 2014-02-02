$(document).ready(function(){
	function connect()
	{
		$.ajax({
			type:"POST",
			dataType:"json",
			url:"http://relidin.com/vote/demo.php",
			timeout:800000,
			data:{time:"80"},
			success:function(data){
				alert("success");
				for (var i = 0; i <	data.length; i++) {
					alert(data[i]);
				};
			},
			error:function(){
				alert("error");
			}
		});
	}

	connect();
});