<?include __DIR__.'/header.html'?>
<p>
	<a href="/">Back</a>
</p>

<p>
	<a href="/csv.php?<?=$_SERVER['QUERY_STRING']?>">Download CSV</a>
</p>

<br>Showing results for:<br>

<?
$links = [];

foreach ($_GET as $results => $on)
{
	echo urldecode($results).'<br>';
	$links = array_unique(array_merge($links, json_decode(file_get_contents(__DIR__."/output/$results.json"), true)['links']));
}
echo '<br>';

$linksHtml = '';
foreach ($links as $i => $link)
{
	$index = $i+1;
	$linksHtml .= "$index: <a target='_blank' href='$link'>$link</a></br>";
}
echo $linksHtml;