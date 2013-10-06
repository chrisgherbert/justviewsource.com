<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Just View Source - Easily View Markup on Mobile Devices</title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- Synxtax Highligher CSS -->
	<link href="/js/sh/styles/shThemeDefault.css" rel="stylesheet" type="text/css" />

	<!-- Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet' type='text/css'>

	<!-- Scripts -->
	<script src="/js/sh/scripts/shCore.js" type="text/javascript"></script>
	<script src="/js/sh/scripts/shAutoloader.js" type="text/javascript"></script>
	<script src="/js/sh/scripts/shBrushXml.js" type="text/javascript"></script>

	<script>
		SyntaxHighlighter.defaults['toolbar'] = false;
		SyntaxHighlighter.all();
	</script>

</head>


<body>

	<div class="wrapper">

		<header>

			<h1 class="page-title cf">
				<a href="/">
					<span class="just">
						// Just
					</span>

					<span class="view">
						{ View }
					</span>

					<span class="source">
						&lt; Source >
					</span>
				</a>
			</h1>

		</header>


			<?php

				if ( $_GET['url'] ) {
					$url = $_GET['url'];
					if ( filter_var( $url, FILTER_VALIDATE_URL) ) {
						
						if ( file_get_contents($url) ) {
							$html = file_get_contents($url);
						}
						else {
							$html = '<!-- Oops! I couldn\'t find that site. -->';
						}

					}
					else {
						$html = '<!-- That appears to be an invalid URL. -->';
					}
				}
				else {
					$html = '<!-- View page markup on your tablet or phone without installing' . "\r";
					$html .= 'additional software. -->';
				}

				error_log($html);

				// Specify Tidy configuration
				$config = array(
					'indent' => true,
					'wrap' => 200
				);

				// Tidy
				$tidy = new tidy;
				$tidy->parseString($html, $config, 'utf8');
				$tidy->cleanRepair();
			?>

		<div class="main-content">

			<form method="get" action="/">
				<label for="url">URL</label>
				<input type="text" placeholder="http://website.com" name="url">
				<div class="button-wrapper">
					<button type="submit">Submit</button>
				</div>
			</form>

			<div class="highlighter">

				<pre class="brush: xml">
				<?php echo htmlentities($tidy); ?>
				</pre>

			</div>

			<footer>
				2013 <a href="http://chrisgherbert.com" target="_blank">Chris Herbert</a>
			</footer>

		</div>

	</div><!-- /.wrapper -->

</body>

</html>
