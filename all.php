<p>
	<a href="/">Back</a>
</p>

<?php
include_once __DIR__.'/htmloutput.php';
//print_r($_GET);

$links = [];

foreach ($_GET as $results => $on)
{
	$links = array_unique(array_merge($links, json_decode(file_get_contents(__DIR__."/output/$results.json"), true)['links']));
}

echo dataToHtml($links);