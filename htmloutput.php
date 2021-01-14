<?php
function dataToHtml($linksArr)
{
	$header = file_get_contents(__DIR__ . "/header.html");
	$footer = file_get_contents(__DIR__ . "/footer.html");
	$linksHtml = '';
	foreach ($linksArr as $i => $link)
	{
		$linksHtml .= "<p>$i: <a target='_blank' href='$link'>$link</a></p>";
	}
	return $header . $linksHtml . $footer;
}