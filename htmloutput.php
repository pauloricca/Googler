<?php
function dataToHtml($linksArr)
{
	$linksHtml = '';
	foreach ($linksArr as $i => $link)
	{
		$linksHtml .= "$i: <a target='_blank' href='$link'>$link</a></br>";
	}
	return $linksHtml;
}