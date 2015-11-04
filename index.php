<?php

	$FirefoxBookmarksFile = './bookmarks-2015-09-22.json'; // <--- Specify path to your bookmarks file here

	header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head><title>Firefox bookmarks reader</title></head>
<body>
<pre>
<?php

	$bookmarks = json_decode(file_get_contents($FirefoxBookmarksFile), TRUE);

	$printer = function($node, $indent=0) use (&$printer) {
			echo str_repeat("\t", $indent);
			if (!empty($node['title'])) echo htmlspecialchars(mb_substr($node['title'], 0, 100, 'utf-8'));
			if (!empty($node['uri']) && substr($node['uri'],0,4)=='http') {
				echo " | ";
				echo htmlspecialchars($node['uri']);
			}
			echo PHP_EOL;
			if (!empty($node['children'])) foreach($node['children'] as $child) {
				$printer($child, $indent+1);
			}
	};
	$printer($bookmarks);
?>
</pre>
</body>
</html>
