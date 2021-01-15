<?php
$config = include __DIR__.'/config.php';

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$search_query = urlencode( $_GET["query"] );

$page = 0;
while($page < $config['number of search result pages'])
{
	$url="https://www.google.com/search?q=" . $search_query . "&start=" . (($page * 10) + 1);
    //echo $url;
	$agent= 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_URL,$url);
	
	$page++;
	
	echo curl_exec($ch);
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
	$(function(){
		urls = [];
		var nUrl = 0;
		var csv = "";
		$("#search a[data-ved]").each(function(){
			var url = $(this).attr("href");
			if(!url) return;
			if(url.startsWith("http") && !url.startsWith("https://webcache") && !url.startsWith("http://webcache") && !urls.includes(url))
			{
				url = url.split(',').join('%2C');
				nUrl++;
				console.log(nUrl + ": " + url);
				urls.push(url);
				csv += url + "\n";
			}
		});
		console.log(csv);
		console.log(urls.join());
		console.log('done processing results');

		$.post("save.php?query=<?=$search_query?>",urls.join(','),function(data,status,xhr){
			window.location = '/results.php?'+encodeURIComponent(data)+'=on';
			console.log('results saved');
		},"text");

	});
</script>