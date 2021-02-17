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
		//$("#search a[data-ved]").each(function(){
		$("a").each(function(){
			var url = $(this).attr("href");
			if(!url) return;

			/*if(url.startsWith("http") && !url.startsWith("https://webcache") && !url.startsWith("http://webcache"))
			{
				url = url.split(',').join('%2C');
			}*/

			// url in the form of:
			// /url?esrc=s&amp;q=&amp;rct=j&amp;sa=U&amp;url=https://www.youtube.com/watch%3Fv%3DfFLqwKzfe8U&amp;ved=2ahUKEwiv4fqR1PHuAhWJTsAKHSIkAyY4ARC3AjAAegQIBRAB&amp;usg=AOvVaw09wXP4hPWQPF_zgragCURl
			if(url.startsWith("/url?"))
			{
				// parse URL
				var urlObj = new URL('https://www.google.com' + url);
				url = urlObj.searchParams.get('url');
				//console.log(urlObj);
				if(url.startsWith("https://support.google.com")) return;
				if(url.startsWith("https://accounts.google.com")) return;
			}
			else
			{
				return;
			}

			if(urls.includes(url)) return;

			nUrl++;
			console.log(nUrl + ": " + url);
			urls.push(url);
			csv += url + "\n";

			
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