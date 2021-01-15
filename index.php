<?include __DIR__.'/header.html'?>
<form method="get" action="search.php"><input type="text" name="query" placeholder="search term"/><input type="submit" value="search"/></form>

<br><br>

<form action="results.php" method="get">
<?php
if(file_exists(__DIR__.'/output'))
{
	$outputDir = __DIR__ . '/output';
	$files = scandir($outputDir);
	$atLeastOneResultSet = false;
	foreach ($files as $file)
	{
		$dirPath = "$outputDir/$file";
		if ($file != '.' && $file != '..' && is_dir($dirPath))
		{
			$langs = scandir($dirPath);
			foreach ($langs as $lang)
			{
				$langPath = "$dirPath/$lang";
				if (substr($langPath, -5) == '.json')
				{
					if(!$atLeastOneResultSet) echo 'Previous Queries:<br>';
					$atLeastOneResultSet = true;
					$langNoJson = substr($lang, 0, strlen($lang) - 5);
					echo "<p><label><input type='checkbox' name='$file/$langNoJson'/><a href='/results.php?".urlencode($file.'/'.$langNoJson)."=on'>" . urldecode($file) . " – $langNoJson</a></label></p>";
				}
			}
		}
	}
	if ($atLeastOneResultSet) echo '<input type="submit" value="show merged results"/>';
}
?>

</form>