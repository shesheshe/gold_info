<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>想知道黃金一克多少 >_^</title>
<body>
<div></div>
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
	$(function() {
	
		var get_gold_info = function() {
			console.log("go");
			//$("div").html("");
			var now_time = new Date($.now());
			$.ajax({
				url: "gold_fn.php",
				data: {},
				type: "POST",
				dataType: 'json',
				success: function(msg){
					console.log(msg);
					var text = "目前 黃金(";
					for(var item in msg) {
						if(item==0) {
							text += msg[item];
						} else if(item==1) {
							text += ") 買進:"+msg[item];
						} else {
							text += " 賣出:"+msg[item];
						}
					}
					$("div").html(text + '--時間: ' + now_time);
				},
				error: function(xhr, ajaxOptions, thrownError){ 
				   console.log(xhr.status); 
				   console.log(thrownError); 
				}
			});		
		};
		
		setInterval(get_gold_info, 5000);
	});
</script>
</body>
</html>