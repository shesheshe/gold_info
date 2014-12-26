<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>想知道黃金一克多少 >_^</title>
<body>
<table border="1">
</table>
<input type="button" id="hand_reload" value="手動刷新" disabled="true" />
<input type="button" id="auto_reload" value="自動刷新" disabled="true" />
<input type="button" id="stop_reload" value="取消自動刷新" disabled="true" />
<div id="cd"></div>
<div id="now_time"></div>
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
	$(function() {
		var reload_time = 60;
		var reload_time2 = reload_time;
		var auto_reload_id = 0;
		var cd_id = 0;
		
		function cd() {
			$("div#cd").html("剩" + reload_time + "秒刷新.");
			reload_time--;
			if(reload_time<0) {
				clearTimeout(cd_id);
				reload_time = reload_time2;
				$("div#cd").html("更新中.");
				get_gold_info();
			} else {
				cd_id = setTimeout(arguments.callee, 1000);
			}
		};
		
		function get_gold_info() {
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
					cd();
					$("input#hand_reload").attr("disabled", false);
					$("input#stop_reload").attr("disabled", false);
				},
				error: function(xhr, ajaxOptions, thrownError){ 
				   console.log(xhr.status); 
				   console.log(thrownError); 
				}
			});
		};

		function init() {
			$("div#cd").html("讀取中.");
		}
		
		//手動刷新
		$("input#hand_reload").on("click", function() {
			$("input#auto_reload").attr("disabled", true);
			$("input#stop_reload").attr("disabled", false);
			if(cd_id != 0) {
				clearTimeout(cd_id);
			}
			reload_time = reload_time2;
			$("div#cd").html("手動更新.");
			get_gold_info();
		});

		//自動刷新
		$("input#auto_reload").on("click", function() {
			$("input#auto_reload").attr("disabled", true);
			$("input#stop_reload").attr("disabled", false);
			if(cd_id != 0) {
				clearTimeout(cd_id);
			}
			reload_time = reload_time2;
			get_gold_info();
		});
		
		//停止手動刷新
		$("input#stop_reload").on("click", function() {
			$("input#auto_reload").attr("disabled", false);
			$("input#stop_reload").attr("disabled", true);
			if(cd_id == 0) {
				alert("已停止自動更新.");
				return false;
			}
			clearTimeout(cd_id);
			cd_id = 0;
			reload_time = reload_time2;
			$("div#cd").html("停止自動更新.");
		});
		
		init();
		get_gold_info();

	});
</script>
</body>
</html>