<?php

$list_string=$_POST['list'];
$template_string=$_POST['template'];
$teller = $_POST['countstart'];
$pad = $_POST['countpad'];
$fp = fopen("php://memory", 'r+');
fputs($fp, $list_string);
rewind($fp);
echo "<pre><xmp>";
while($line = fgets($fp)){
	$line = trim(preg_replace('/\s+/', ' ', $line));
	$info = pathinfo($line);
  $f = basename($line,'.'.$info['extension']);
  $fe = basename($line);
  $p = $info['dirname'];
  $pf = $p.'/'.$f;
	$pfe = $line;
	$c=$teller;
	$cp=str_pad($c,$pad,"0",STR_PAD_LEFT);
	$temp = $template_string;
	$temp = str_replace("%f%", $f, $temp);
	$temp = str_replace("%fe%", $fe, $temp);
	$temp = str_replace("%pf%", $pf, $temp);
	$temp = str_replace("%pfe%", $pfe, $temp);
	$temp = str_replace("%p%", $p, $temp);
	$temp = str_replace("%c%", $c, $temp);
	$temp = str_replace("%cp%", $cp, $temp);

	echo $temp . "\n";
	$teller++;
}
echo "</xmp></pre>";
fclose($fp);

?>
