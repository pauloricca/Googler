<?
include __DIR__.'/location.php';
include_once __DIR__.'/htmloutput.php';

$data = file_get_contents('php://input');
$query = urlencode($_GET["query"]);

if(!file_exists(__DIR__."/output")) mkdir(__DIR__."/output");
if(!file_exists(__DIR__."/output/$query"))
{
	mkdir(__DIR__."/output/$query");
	file_put_contents(__DIR__."/output/$query/all.php", '<?include __DIR__."/../../all.php";');
}

$outputHtmlFile = "output/$query/$location.html";
$outputDataFile = "output/$query/$location.json";

$links = explode(',', $data);

file_put_contents(__DIR__ . "/$outputHtmlFile", dataToHtml($links));
file_put_contents(__DIR__ . "/$outputDataFile", '{"links": ' . json_encode($links) . '}');

echo $outputHtmlFile;