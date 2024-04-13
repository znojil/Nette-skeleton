<?php
header('HTTP/1.1 503 Service Unavailable');
header('Retry-After: 300');
?>
<!DOCTYPE html>
<html lang="en" style="font-size:100%;height:100%">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="robots" content="noindex">
		<title>Site is temporarily down for maintenance</title>
	</head>
	<body style="align-items:center;background-color:#fff;color:#000;display:flex;font-size:1rem;font-family:sans-serif;height:100%;justify-content:center;margin:0">
		<div style="max-width:480px;padding:1rem">
			<h1 style="font-weight:bold;font-size:2.75rem;margin:2rem 0">We're Sorry</h1>
			<p style="font-size:1.25rem">The site is temporarily down for maintenance. Please try again in a few minutes.</p>
		</div>
	</body>
</html>
<?php
exit;
