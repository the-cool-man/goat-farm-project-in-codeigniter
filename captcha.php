<?php //$code=rand(100000,999999);
//setcookie('captcha_code', $code, time() + (86400 * 1));
$heigh_cap = 46;
$heigh_cap_top = 15;
if(isset($_REQUEST['captch_code']) && $_REQUEST['captch_code'] !='')
{
	if(isset($_REQUEST['captch_code_front']) && $_REQUEST['captch_code_front'] !='')
	{
		$heigh_cap = 34;
		$heigh_cap_top = 10;
	}
	$code = $_REQUEST['captch_code'];
	$im = imagecreatetruecolor(130, $heigh_cap);
	$bg = imagecolorallocate($im, 60, 141, 188); //background color blue
	$fg = imagecolorallocate($im, 255, 255, 255);//text color white
	imagefill($im, 0, 0, $bg);
	imagestring($im, 15, 40, $heigh_cap_top,  $code, $fg);
	header("Cache-Control: no-cache, must-revalidate");
	header('Content-type: image/png');
	imagepng($im);
	imagedestroy($im);
}
?>