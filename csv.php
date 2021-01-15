<?
header('Content-Disposition: attachment; filename="merged-results.csv";');
echo 'index,link';
foreach ($_GET as $results => $on) echo ','.urldecode($results);
echo "\n";

$links = [];
$linksPerResult = [];
foreach ($_GET as $results => $on)
{
	$linksPerResult[urldecode($results)] = json_decode(file_get_contents(__DIR__."/output/$results.json"), true)['links'];
	$links = array_unique(array_merge($links, $linksPerResult[urldecode($results)]));
}

foreach ($links as $linkIndex => $link)
{
	echo $linkIndex.',';
	echo $link;
	foreach ($_GET as $results => $on)
	{
		echo ',';
		if(in_array($link, $linksPerResult[urldecode($results)])) echo 'x';
	}
	echo "\n";
}