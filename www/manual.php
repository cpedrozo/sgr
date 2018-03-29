<?php
$file = 'file:///home/toba_2_6_7/toba_2_7_6/proyectos/sgr/www/pdf-sample.pdf';
$filename = 'pdf-sample.pdf'; /* Note: Always use .pdf at the end. */

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');

readfile($file);
?>

<!-- <html>
<head>
  <meta charset="UTF-8" />

</head>
<body>
<div id="scroller">
<iframe src="https://docs.google.com/viewer?url=https://drive.google.com/open?id=10R4iSC73qUtNsxWAm_ZKxqMChOCK22TE&embedded=true" width="600" height="780" style="border: none;"></iframe>
</div>
</body>
</html> -->
