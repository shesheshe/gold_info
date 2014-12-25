<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>想知道黃金一克多少 >_^</title>
<body>
<table border="1">
</table>
<div id="cd"></div>
<div id="now_time"></div>
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
	$(function() {
		var reload_time = 60;
		var reload_time2 = 60;
		
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
					var text = "<tr><td>銀行名稱</td><td>銀行賣出</td><td>銀行買進</td><td>價差</td></tr>";
					for(var item in msg) {
						text += "<tr>";
						for(var item2 in msg[item]) {
							text += "<td>" + msg[item][item2] + "</td>";
						}
						text += "</tr>";
					}
					$("table").html(text);
					$("div#now_time").html("時間: " + now_time);
				},
				error: function(xhr, ajaxOptions, thrownError){ 
				   console.log(xhr.status); 
				   console.log(thrownError); 
				}
			});		
		};

		var cd = function() {
			$("div#cd").html("剩" + reload_time + "秒刷新.");
			console.log(reload_time--);
			if(reload_time==0) {
				reload_time = reload_time2;
			}
			
			setTimeout(arguments.callee, 1000);
		};
		
		get_gold_info();
		cd();
		setInterval(get_gold_info, reload_time2*1000); // 10s
	});
</script>
</body>
</html>