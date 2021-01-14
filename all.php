<?include __DIR__.'/header.html'?>
<p>
	<a href="/">Back</a>
</p>

<br>Showing results for:<br>

<?php
include_once __DIR__.'/htmloutput.php';

$links = [];

foreach ($_GET as $results => $on)
{
	echo urldecode($results).'<br>';
	$links = array_unique(array_merge($links, json_decode(file_get_contents(__DIR__."/output/$results.json"), true)['links']));
}

echo '<br>'.dataToHtml($links);