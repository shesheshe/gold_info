<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>想知道黃金一克多少 >_^</title>
<body>
<table border="1">
</table>
<div></div>
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
	$(function() {
	
		var get_gold_info = function() {
			console.log("go");
			var now_time = new Date($.now());
			$.ajax({
				url: "gold_fn.php",
				data: {},
				type: "POST",
				dataType: 'json',
				success: function(msg){
					console.log(msg);
					var text = "<tr><td>銀行名稱</td><td>銀行買進</td><td>銀行賣出</td></tr>";
					for(var item in msg) {
						text += "<tr>";
						for(var item2 in msg[item]) {
							text += "<td>" + msg[item][item2] + "</td>";
						}
						text += "</tr>";
					}
					$("table").html(text);
					$("div").html("時間: " + now_time);
				},
				error: function(xhr, ajaxOptions, thrownError){ 
				   console.log(xhr.status); 
				   console.log(thrownError); 
				}
			});		
		};
		
		setInterval(get_gold_info, 10*1000); // 10s
	});
</script>
</body>
</html>