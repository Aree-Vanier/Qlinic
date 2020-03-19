<?php 
include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php"); 
include_once(BACKEND."/queue.php");

$queue = getFullQueue();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Waiting Room Display</title>
    <link rel="stylesheet" type="text/css" href="/public/styles/display.css">
<script>
	function updateTime(){
		let date = new Date();
		let seconds = date.getSeconds();
		let hour = date.getHours();
		let minutes = date.getMinutes();

		if(seconds < 10){
			seconds = "0"+seconds;
		}

		if(hour > 12){
			hour -= 12;
		}
		let str = hour+":"+minutes+":"+seconds;
		document.getElementById("currentTime").innerHTML = str;
	}
	
	function refresh(){
		$.ajax("/RIO/display", {success: function(result){
			let newer = new DOMParser().parseFromString(result, "text/html");
			document.getElementsByTagName("body")[0].innerHTML = newer.getElementsByTagName("body")[0].innerHTML;
		
		
		}});
	}

	$(document).ready(function(){
	//	setInterval(updateTime, 200);
		setInterval(refresh, 500);
	})
	
</script>

</head>

<body>

<table>
    <tr>
        <td>
            <table>
                <tr id="current">
                    <td style="font-size:2.5em">
                        Now Serving<br/>
			<span id="serving"><?php echo getNextServed()?></span>
                    </td>
                </tr>
                <tr>
                    <td id="wait" style="font-size:2.5em">
                        Estimated Wait<br/>
			<span id="serving"><?php echo formatDuration(getTime())?></span><br/><br/>
			<?php echo count($queue)?> people in queue<br/>
			Next Number: <?php echo getNextAvailable()?>
                    </td>
                </tr>
            </table>
        </td>
        <td style="width:25%">
            <table>
                <tr class="queueTitle">
                    <td style="font-size:2em">Up Next</td>
                </tr>
                <tr class="queueItem">
		    <td><?php if(count($queue) >= 2) echo $queue[1]["position"]?></td>
                </tr>
                <tr class="queueItem">
		    <td><?php if(count($queue) >= 3) echo $queue[2]["position"]?></td>
                </tr>
                <tr class="queueItem" id="time">
			<td id="currentTime">
				<?php echo date("g:i:s") ?><br/>
				<span style="font-size:0.35em"><?php echo date("l M dS Y")?></span>
			</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
