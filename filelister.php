<?php
// include_once 'phppagestart.php'; is in each index.php for scans directory 
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
echo '<!DOCTYPE html>';
//chdir ($root)
$_SESSION['pageurl']=$_SERVER['REQUEST_URI'];
$_SESSION['page']=basename($_SERVER['SCRIPT_FILENAME']);
$username= $_SESSION['username'];
include_once('config.inc.php');
include_once('lang.php');
// echo $_SESSION['username'];
$now=time();
$_SESSION['fromfilelister']='yes';
$random=(rand(1, 5)); // for tips
//$filelusterrandom=='$filelistertip'.$random;
// $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$basename = pathinfo($image, PATHINFO_FILENAME);
//$basename= substr($image, 0, -4);
//$without_extension = basename($filename, '.'.$ext');
$filelisterrandom=${'filelistertip'.$random};
//echo $filelisterrandom;
// echo '<html lang="'.$lang.'">';
$trash=$_GET['rand'];

if ($_SESSION['username']=='admin')
{
$_SESSION['viewpath']=$_SESSION['userpath'];
}


if ($requireauth=='yes')// && ($_SESSION['password']!='PAM')
{
$upath=$_SESSION["userpath"];
}
else
{
$upath=$filepath;
}

/*
(preg_match("/\bVi\b/i", $line, $match)) :

$str = 'In My Cart : 11 12 items';
preg_match('!\d+!', $str, $matches); //numbers
*/

preg_match('!\d+!', $filelistmaxheight, $filelistmaxheightnum);
preg_match('!\d+!', $filelistmaxwidth, $filelistmaxwidthnum);
//echo ($filelistmaxheightnum[0]);
//echo($filelistmaxwidthnum[0]);

if ($filelistmaxheightnum < $filelistmaxwidthnum)
{
$filelisterfontover=(round($filelistmaxheightnum/12.5)).'px';
$filelisterfontheight=(round($filelistmaxheightnum/10.8)).'px';
}
elseif ( $filelistmaxheightnum > $filelistmaxwidthnum)
{
$filelisterfontover=(round($filelistmaxwidth/12.5)).'px';
$filelisterfontheight=(round($filelistmaxwidth/10.8)).'px';
}

else // if ( $filelistmaxheight = $filelistmaxwidth)
{
$filelisterfontover= (round($filelistmaxwidth/12.5)).'px';
$filelisterfontheight=(round($filelistmaxwidth/10.8)).'px';
}

//echo $filelisterfontover ;
if ((isset($_SESSION['username'])) && ($_SESSION['loggedin']=='yes') && (isset($_SESSION['password'])) && (isset($_SESSION['expire'])) && ($_SESSION['expire'] >= $now))
{
	if (($_SESSION['expire'] - $now) <= $addtime)
	{
	$_SESSION['expire']=($_SESSION['expire'] + $buytime);
	}

	else
	{
	echo '';
	}
}
else
{
//echo '';
}
//echo $_SESSION['password'];
//echo '<br/>';
//echo $_SESSION['userpath'];




$timeremaining=($_SESSION['expire'] - $now);

/*
if ($requireauth !='yes')
{
$logouturl='';
}

else
{
$logouturl='<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=/logout.php?sound=yes">';
}
*/

if ($requireauth!='yes')
{
$refreshurl='';
}

elseif (($requireauth=='yes') && ($_SESSION['expire'] <= $now)) 
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="10; url=/logout.php?sound=yes">';
}
elseif (($requireauth=='yes') && (isset($_SESSION['username'])) && (isset($_SESSION['password'])) && (($_SESSION['expire']-$now)>0) && ($_SESSION['loggedin']== 'yes'))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=/logout.php?sound=yes">';
}
else
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="20; url=/logout.php">';
}
// <script src="'.$webroot.'javascript/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

// <link href="'.$webroot.'css/featherlight.min.css" type="text/css" rel="stylesheet" title="Featherlight Styles" />

// if ($_SESSION['fromuserfolder']=='yes')
echo '<html lang="'.$lang.'"><head>';
// $refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=logout.php">';
$pagehead=$refreshurl.'
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta name="Expires" content="'.$rfc_1123_date.'">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<meta charset="'.$charset.'">  
<meta name="author" content="root">
<meta name="robots" content="noindex">
<meta http-equiv="content-type" content="text/html; charset='.$charset.'">
<title>'.$pagetitle.'</title>
<script src="/javascript/jquery.min.js"></script>
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
<link rel="manifest" href="/images/site.webmanifest">
<link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#777aff">
<meta name="msapplication-TileColor" content="#ff0000">
<meta name="theme-color" content="#777AFF">
<link rel="stylesheet" href="/css/style.css" type="text/css" />
<script src="/javascript/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

<link href="/css/featherlight.min.css" type="text/css" rel="stylesheet" title="Featherlight Styles" />

<style>
/* https://www.w3schools.com/howto/howto_css_modal_images.asp */
/* begin modal */
body {
  font-family: Arial, Helvetica, sans-serif;
}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {
  opacity: 0.7;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 20px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: '.$filelistzoomwidth.';
  max-width: '.$filelistzoommaxwidth.';
  height:  '.$filelistzoomheight.';
  max-height:'.$filelistzoommaxheight.';
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 50%;
  max-width: auto;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 70px;
}

/* Add Animation */
.modal-content,
#caption {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {
    -webkit-transform: scale(0);
  }
  to {
    -webkit-transform: scale(1);
  }
}

@keyframes zoom {
  from {
    transform: scale(0);
  }
  to {
    transform: scale(1);
  }
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px) {
  .modal-content {
    width: 100%;
  }
}
/* end modal */

/* begin overlay , pinned menu*/


/* body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}*/

.top-container {
  background-color: #f1f1f1;
  padding: 0px;
  text-align: center;
}

.header {
  padding: 0px 16px;
  background: #FFF;
  color: #f1f1f1;
}

.content {
  padding: 0px;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1;
}

.sticky + .content {
  padding-top: 2px;
}
/* end overlay */

/* Text over image*/
/* Container holding the image and the text */

.container {
  position: relative;
  text-align: center;
font-size: '.$filelisterfontover.';
font-weight:bold;
 line-height: '.$filelisterfontheight.';
  color: #FFFFFF;
border: 1px solid #AAA;
}

/* Bottom left text */
.bottom-left {
  position: absolute;
  bottom: 8px;
  left: 16px;
}

/* Top left text */
.top-left {
  position: absolute;
  top: 8px;
  left: 16px;
}

/* Top right text */
.top-right {
  position: absolute;
  top: 8px;
  right: 16px;
}

/* Bottom right text */
.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
}

/* Centered text */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.wrap {
    width: 400px;
    height: 600px;
    padding: 0;
    overflow: hidden;
}
/*  iframes */
/*
.frame {
    width: 1200px;
    height: 1800px;
    border: 0;
    -ms-transform: scale(0.25);
    -moz-transform: scale(0.25);
    -o-transform: scale(0.25);
    -webkit-transform: scale(0.25);
    transform: scale(0.25);

    -ms-transform-origin: 0 0;
    -moz-transform-origin: 0 0;
    -o-transform-origin: 0 0;
    -webkit-transform-origin: 0 0;
    transform-origin: 0 0;
}*/



html,body        {height:100%;}
.h_iframe        {position:relative;}
.h_iframe .ratio {display:block;width:100%;height:auto;}
.h_iframe iframe {width:100%; height:100%;}
</style>
</head>
<body>
<table border =0 id="page_header"><tr><td>
        <a href="/airscan.php">
          <img id="logo" src="/images/AirScan.png" alt="AirScan">
        </a></td></tr>
	<tr><td><hr></td></tr><tr><td>';
?>

<?php
echo $pagehead;
//echo /*$logouturl.*/$pagehead;
if ($requireauth=='yes') 
{
	if (($_SESSION['expire'] <= $now) || ($_SESSION['loggedin'] != 'yes'))
	{
	echo '</td><tr></table><br/><p><center><span style="color:#666; font-weight:bold">'.$goodbye.'</span></center><br/></p>';
	session_unset($_SESSION["loggedin"]);
	session_unset($_SESSION["expire"]);
	session_unset($_SESSION["username"]);
	session_unset($_SESSION["password"]);
	session_unset($_SESSION["userpath"]);
	session_unset($_SESSION['scanneronline']);
	session_unset($_SESSION['fromuserfolder']);
	session_unset($_SESSION['fromuserfilelister']);
        session_destroy();
	exit();			
	}	
	else
	{
	echo '';
	}
}


else
{
echo '';
}


include'livemenu.php';
?>


</td></tr></table>

<center>

<?php 
//echo 'XX'.$_SESSION['userpath'];
echo'<br/>';

if ($requireauth=='yes')
{
	if ($showtips=='yes')
	{
	echo '<span style="color:#A80; font-weight:bold">'.$filelisterrandom.'</span><br/><br/>';
	}
	else
	{
	}	
//echo '<span style="color:#666; font-weight:bold">'.$userfilesfor.'</span>';
}


else
{
	if ($showtips=='yes')
	{
	echo '<span style="color:#A80; font-weight:bold">'.$filelusterrandom.'</span><br/><br/>';
	}
	else
	{
	}
// echo '<span style="color:#666; font-weight:bold">'.$alluserfilestxt.'</span>';

}

echo '<span style="color:#666; font-weight:bold">'.$alluserfilestxt.'</span><br/>';


echo '<div id="msg">
<table border=0 style="width: 30%"><tr><td><hr></td></tr><tr><td style="text-align: center;">
<span style="color:#666; font-weight:bold"><br/><br/>'.$loadingpleasewait.'</span></br></br><br/>
<img src="/images/spinner.gif"></td></tr></table>
</div><div id="body" style="display:none;">';

//echo $rfc_1123_date;

/*
echo '<div id="msg">
<table border=0 style="width: 30%"><tr><td><hr></td></tr><tr><td style="text-align: center;">
<span style="color:#666; font-weight:bold"><br/><br/>Please wait , Thinking...</span></br></br><br/>
<img src="../images/spinner.gif"></td></tr></table>
</div><div id="body" style="display:none;">';
*/



//$dh = opendir($upath);
/*
echo '<div id="msg"><span style="color:#666; font-weight:bold">
<br/><br/>Please wait , Thinking...</span></br></br><br/>
<img src="/images/spinner.gif">
</div><div id="body" style="display:none;">';
*/
echo '<table border=0 style="border-spacing: 12px 0px" >';
$i=1;







$files=array_map('basename', glob($upath.'*'));
natcasesort($files);
foreach ($files as $file)
{
//while (($file = readdir($dh)) !== false) {
    if($file != "." && $file != ".." && $file != "index.php" && $file != ".htaccess" && $file != "error_log" && $file != "cgi-bin") 
    	{
	$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
		/*if(($ext=='jpg') || ($ext=='jpeg'))
		{*/
		list($imgwidth, $imgheight, $imgtype, $imgattr) = getimagesize($upath.$file);
		$exif = exif_read_data($upath.$file);
		$xres = eval('return '.$exif["XResolution"].';');
		$yres = eval('return '.$exif["YResolution"].';');
		/*}
		else
		{
		echo '';
		}*/

	$filewpath = $upath.$file;
	$filesize = filesize($filewpath); // bytes
	$filesize = round($filesize / 1024, 2); // kilobytes with two digits
	//echo "The size of your file is $filesize KB.";		
if (($imgwidth == NULL) || ($imgheight == NULL) || ($imgwidth == '') || ($imgheight == '') || (!is_numeric($imgwidth)) || (!is_numeric($imgheight)))
{
$px ='';
$seppx='';
}

else
{
$px =$pixels;
$seppx='x';
}


		if (($exif["XResolution"]) == ($exif["YResolution"]))
   		{
			if ((is_numeric($xres)) && (is_numeric($yres))) 
        		{
        		$resolution=$yres.'x'.$xres;
			$dpitxt=$dpi;
			$printmenu="<td><p><a href='/airscan.php?image=$file&print=yes&returntofiles=yes&fastload=yes'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-right' data-tip='$printtip'><img src='/images/print-btn.png'/></i></span></a></p>";

				
				if (($filemanagerunits=='both') || ($filemanagerunits=='in'))
				{
				$imagewidthin=(number_format((float)($imgwidth / $xres), 2, '.', ''));
				$imageheightin=(number_format((float)($imgheight / $yres), 2, '.', ''));
				$inchestxt=$inches;
				$sepin='x';
				//$widthtxtin=$width;
				//$heighttxtin=$height;
				}				
				else
				{
				$imagewidthin='';
				$imageheightin='';
				$inchestxt='';
				$sepin='';
				//$widthtxtin='';
				//$heighttxtin='';
				}

				if (($filemanagerunits=='both') || ($filemanagerunits=='cm')) 
				{
				$imagewidthcm=(number_format((float)(($imgwidth / $resolution) * 2.54), 2, '.', ''));
				$imageheightcm=(number_format((float)(($imgheight / $resolution) * 2.54), 2, '.', ''));
				$centimeterstxt=$centimeters;
				$sepcm='x';
				//$widthtxtcm=$width;
				//$heighttxtcm=$height;
				}
				else 
				{
				$imagewidthcm='';
				$imageheightcm='';
				$centimeterstxt='';
				$sepcm='';
				//$widthtxtcm='';
				//$heighttxtcm='';
				}  

			}

			else 
        		{
        		$resolution='';
			$dpitxt='';
			$printmenu="<td><p><a href='/printnodpi.php?image=$file&print=yes&returntofiles=yes&fastload=yes'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-right' data-tip='$printtip'><img src='/images/print-btn.png'/></i></span></a></p>";
			$imagewidthin='';
			$imageheightin='';
			$inchestxt='';
			$sepin='';
			$widthtxtin='';
			$heighttxtin='';
			$imagewidthcm='';
			$imageheightcm='';
			$centimeterstxt='';
			$sepcm='';
			//$widthtxtcm='';
			//$heighttxtcm='';
			}

		}
        	else 
        	{
        	$resolution='';
		$dpitxt='';
		$printmenu="<td><p><a href='/printnodpi.php?image=$file&print=yes&returntofiles=yes&fastload=yes'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-right' data-tip='$printtip'><img src='/images/print-btn.png'/></i></span></a></p>";
		//$printmenu="<td>";
		$imagewidthin='';
		$imageheightin='';
		$inchestxt='';
		$sepin='';
		$widthtxtin='';
		$heighttxtin='';
		$imagewidthcm='';
		$imageheightcm='';
		$centimeterstxt='';
		$sepcm='';
		//$widthtxtcm='';
		//$heighttxtcm='';
		}


/*
	$imagemagickmenus1=" <p><a href='/imageedit.php?image=$file'><span style='color:#777AFF; font-weight:bold'>$editor</span></a></p>       
	
	<p><a href='/rotate.php?image=$file&degrees=-90'><span style='color:#777AFF; font-weight:bold'>$rotatelefttxt</span></a></p>
	<p><a href='/deskew.php?image=$file'><span style='color:#777AFF; font-weight:bold'>$deskewtxt</span></a></p>	
	<p><a href='/autocrop.php?image=$file'><span style='color:#777AFF; font-weight:bold'>$croptxt</span></a></p>
        <p><a href='/bw.php?image=$file&degrees=-90'><span style='color:#777AFF; font-weight:bold'>$grayselecttxt</span></a></p>
	<p><a href='/flip.php?image=$file&flip=flip'><span style='color:#777AFF; font-weight:bold'>$flipvtxt</span></a></p>
        <p><a href='/convert.php?image=$file'><span style='color:#777AFF; font-weight:bold'>$converttxt</span></a></p>
	</td>";
*/


//echo basename($_SERVER['PHP_SELF']);


$returntopage = basename($_SERVER['PHP_SELF']);

	$imagemagickmenus1=" <p><a href='/imageedit.php?image=$file'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-left' data-tip='$edittip'><img src='/images/edit-btn.png'/></i></span></a></p>       
	
	<p><a href='/rotate.php?image=$file&degrees=-90&return=$returntopage'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-left' data-tip='$quickedit $rotatel90tip'><img src='/images/rotatel90-btn.png'/></i></span></a></p>
	<p><a href='/deskew.php?image=$file'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-left' data-tip='$quickedit $deskewtip2'><img src='/images/deskew-btn.png'/></i></span></a></p>	
	<p><a href='/autocrop.php?image=$file'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-left' data-tip='$quickedit $autocroptip2'><img src='/images/autocrop-btn.png'/></i></span></a></p>
        <p><a href='/bw.php?image=$file'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-left' data-tip='$quickedit $grayscaletip'><img src='/images/grayscale-btn.png'/></i></span></a></p>

        <p><a href='/convert.php?image=$file'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-left' data-tip='$quickedit $converttip'><img src='/images/convert-btn.png'/></i></span></a></p>
	</td>";

// <p><a href='/flip.php?image=$file&flip=flip'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-left' data-tip='$quickedit $flipvtip'><img src='/images/flipv-btn.png'/></i></span></a></p>



         $imagemagickmenus2="<p><a href='/resize.php?image=$file'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-right' data-tip='$quickedit $resizetip'><img src='/images/resize-btn.png'/></i></span></a></p>
	<p><a href='/rotate.php?image=$file&degrees=90&return=$returntopage'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-right' data-tip='$quickedit $rotater90tip'><img src='/images/rotater90-btn.png'/></i></span></a></p>
         <p><a href='/rotate.php?image=$file&degrees=180&return=$returntopage'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-right' data-tip='$quickedit $rotate180tip'><img src='/images/rotate180-btn.png'/></i></span></a></p>
	 <p><a href='/mancrop.php?image=$file'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-right' data-tip='$quickedit $mancroptip'><img src='/images/mancrop-btn.png'/></i></span></a></p>
	 <p><a href='/lineart.php?image=$file'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-right' data-tip='$quickedit $linearttip'><img src='/images/lineart-btn.png'/></i></span></span></a></p>

         ";
 //<p><a href='/flip.php?image=$file&flip=flop'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-right' data-tip='$quickedit $fliphtip'><img src='/images/fliph-btn.png'/></i></span></a></p>


	/*	
         $imagemagickmenus2="<p><a href='/resize.php?image=$file'><span style='color:#777AFF; font-weight:bold'>$resizetxt</span></a></p>
	<p><a href='../../rotate.php?image=$file&degrees=90'><span style='color:#777AFF; font-weight:bold'>$rotaterighttxt</span></a></p>
         <p><a href='/rotate.php?image=$file&degrees=180'><span style='color:#777AFF; font-weight:bold'>$rotate180txt</span></a></p>
	 <p><a href='/mancrop.php?image=$file'><span style='color:#777AFF; font-weight:bold'>$manualcrop</span></a></p>
	 <p><a href='/lineart.php?image=$file&degrees=90'><span style='color:#777AFF; font-weight:bold'>$lineartselecttxt</span></span></a></p>
         <p><a href='/flip.php?image=$file&flip=flop'><span style='color:#777AFF; font-weight:bold'>$mirrortxt</span></a></p>
         ";
*/

/*

	$imagemagickmenuspdf1="<p><a href='/rotate.php?image=$file&degrees=-90'><span style='color:#777AFF; font-weight:bold'>$rotatelefttxt</span></a></p>
	<p><a href='/convert.php?image=$file'><span style='color:#777AFF; font-weight:bold'>$converttxt</span></a></p>        

	<p><a href='/flip.php?image=$file&flip=flip'><span style='color:#777AFF; font-weight:bold'>$flipvtxt</span></a></p>

	</td>";
		
         $imagemagickmenuspdf2="<p><a href='../../rotate.php?image=$file&degrees=90'><span style='color:#777AFF; font-weight:bold'>$rotaterighttxt</span></a></p>
         <p><a href='/rotate.php?image=$file&degrees=180'><span style='color:#777AFF; font-weight:bold'>$rotate180txt</span></a></p>
	 
	  <p><a href='/flip.php?image=$file&flip=flop'><span style='color:#777AFF; font-weight:bold'>$mirrortxt</span></a></p>
         ";
*/	
/*
	$imagemagickmenuspdf1="
	<p><a href='/airscan.php?pdfdone=yes&image=$file&rand=$rand'><span style='color:#777AFF; font-weight:bold'>Preview</span></a></p>        
	</td>";
	//http://localhost/airscan.php?image=Escan20190429190943.pdf&rand=21914&pdfdone=yes
*/



	$imagemagickmenuspdf1='';


		
         $imagemagickmenuspdf2="";	

	//$printmenu="<td><p><a href='/airscan.php?image=$file&print=yes&returntofiles=yes'><span style='color:#777AFF; font-weight:bold'><img src='/images/print-btn.png'/></span></a></p>";
	$renamemenu="<p><a href='/rename.php?image=$file'><span style='color:#777AFF; font-weight:bold'><i class='qtip tip-right' data-tip='$quickedit $renametip'><img src='/images/rename2-btn.png'/></i></span></a></p></tr>";




/*


		$imagemagickmenus="<p><a href='../../rotate.php?image=$file&degrees=-90'><span style='color:#777AFF; font-weight:bold'>$rotatelefttxt</span></a></p>
                <p><a href='../../autocrop.php?image=$file&print=yes'><span style='color:#777AFF; font-weight:bold'>$croptxt</span></a></p>
                <p><a href='../../bw.php?image=$file&degrees=-90'><span style='color:#777AFF; font-weight:bold'>$grayselecttxt</span></a></p>
		<p><a href='../../flip.php?image=$file&flip=flip'><span style='color:#777AFF; font-weight:bold'>$flipvtxt</span></a></p></td>
		


                <td><p><a href='../../airscan.php?image=$file&print=yes'><span style='color:#777AFF; font-weight:bold'>$printtxt</span></a></p>
                <p><a href='../../rotate.php?image=$file&degrees=90'><span style='color:#777AFF; font-weight:bold'>$rotaterighttxt</span></a></p>
                <p><a href='../../rotate.php?image=$file&degrees=180'><span style='color:#777AFF; font-weight:bold'>$rotate180txt</span></a></p>
		<p><a href='../../lineart.php?image=$file&degrees=90'><span style='color:#777AFF; font-weight:bold'>$lineartselecttxt</span></span></a></p>
                <p><a href='../../flip.php?image=$file&flip=flop'><span style='color:#777AFF; font-weight:bold'>$mirrortxt</span></a></p></tr>
                <tr><td colspan='3'><hr></td></tr>
";
*/

if ($ext=='jpg')
{
$mimeext='jpeg';
}
elseif ($ext=='tif')
{
$mimeext='tiff';
}
else
{
$mimeext=$ext;
}


// begin auth NOT required 0



// begin auth required 1 txt

// this one is for user files 
	

// begin auth required 2 PAM

// this one is for user files 
	
// this one is for admin files 

// above obsolete here we load for all users
	if (($requireauth == 'yes') && ($_SESSION['expire'] > $now) && ($_SESSION['loggedin'] == 'yes'))  // jjj
	{
        	if ($file == 'PDF')
		{
		echo '<tr><td><a name="'.$file.'"></a><a href="/'.$upath.'PDF/index.php"><img id="pdfImg" src="/images/PDF.png" alt="'.$file.'" style="z-index: 0; width:auto;max-width:500px;height:auto;max-height:500px"/></a><p><a href="/'.$upath.'PDF/index.php"><span style="color:#777AFF; font-weight:bold">'.$file.'</a></p></span></td><td><p><a href="/nodelete.php"><span style="color:#F44; font-weight:bold"><i class="qtip tip-left" data-tip="'.$deletetip.'"><img src="/images/delete-btn.png"/></i></span></a></p>';
		$i++;		
		}
		

		elseif (($_SESSION['password']!='PAM') && (($ext=='jpg') || ($ext=='jpeg') || ($ext=='png') || ($ext=='gif') || ($ext=='webp')))
		{
		echo '<tr><td colspan="3"><a name="'.$file.'"><hr></a><span style="color:#666; font-weight:bold"><p>'.$file.' '.$filesize.'KB<br/>'.$imgwidth.$seppx.$imgheight.$px.' '.$resolution.$dpitxt.'<br/>'.$imagewidthin.$sepin.$imageheightin.$inchestxt.$imagewidthcm.$sepcm.$imageheightcm.$centimeterstxt.'</p></span></td></tr><tr><td><img id="myImg" class="js-img" src="/'.$_SESSION['userpath'].$file.'" alt="'.$file.'" style="z-index: 0; width:'.$filelistwidth.';max-width:'.$filelistmaxwidth.';height:'.$filelistheight.';max-height:'.$filelistmaxheight.'"/></td><td><p><a href="/delete.php?image='.$file.'"><span style="color:#F44; font-weight:bold"><i class="qtip tip-left" data-tip="'.$deletetip.'"><img src="/images/delete-btn.png"/></i></span></a></p>';
				
		$i++;
		}
		elseif (($_SESSION['password']=='PAM') && (($ext=='jpg') || ($ext=='jpeg') || ($ext=='png') || ($ext=='gif') || ($ext=='webp')))
 		{
			if (file_exists($_SESSION['userpath'].$file))
			{
     			$b64image = base64_encode(file_get_contents($_SESSION['userpath'].$file));
			echo '<tr><td colspan="3"><a name="'.$file.'"><hr></a><span style="color:#666; font-weight:bold"><p>'.$file.' '.$filesize.'KB<br/>'.$imgwidth.$seppx.$imgheight.$px.' '.$resolution.$dpitxt.'<br/>'.$imagewidthin.$sepin.$imageheightin.$inchestxt.$imagewidthcm.$sepcm.$imageheightcm.$centimeterstxt.'</p></span></td></tr><tr><td><img id="myImg" download="'.$file.'" class="js-img" src="data:image/'.$mimeext.';base64,'.$b64image.'" alt="'.$file.'" style="z-index: 0; width:'.$filelistwidth.';max-width:'.$filelistmaxwidth.';height:'.$filelistheight.';max-height:'.$filelistmaxheight.'"/></td><td><p><a href="/delete.php?image='.$file.'"><span style="color:#F44; font-weight:bold"><i class="qtip tip-left" data-tip="'.$deletetip.'"><img src="/images/delete-btn.png"/></i></span></a></p>';
			} 
			else
			{
			}
		}

		/*
		<img id="pdfImg" src="/images/PDF.png" alt="'.$file.'" style="z-index: 0; width:auto;max-width:500px;height:auto;max-height:500px"/>
		elseif (($ext=='pdf') && ($_SESSION['password']!='PAM'))
		{
		echo '<tr><td colspan="3"><a name="'.$file.'"><hr></a><span style="color:#666; font-weight:bold"><p>'.$file.' '.$filesize.'KB<br/>'.$imgwidth.$seppx.$imgheight.$px.'<br/>'.$resolution.$dpitxt.'<br/>'.$imagewidthin.$sepin.$imageheightin.$inchestxt.' '.$imagewidthcm.$sepcm.$imageheightcm.$centimeterstxt.'</p></span></td></tr><tr><td><embed src="/'.$upath.$file.'" type="application/pdf" width="'.$filelistmaxwidth.'" height="'.$filelistmaxheight.'" /></a></span></td><td><p><a href="/delete.php?image='.$file.'"><span style="color:#F44; font-weight:bold"><i class="qtip tip-left" data-tip="'.$deletetip.'"><img src="/images/delete-btn.png"/></i></span></a></p>';
		$i++;		
		}
	
		*/
		elseif ($ext=='pdf') // && ($_SESSION['password']!='PAM'))
		{
		//echo '<tr><td colspan="3"><a name="'.$file.'"><hr></a><span style="color:#666; font-weight:bold"><p>'.$file.' '.$filesize.'KB<br/>'.$imgwidth.$seppx.$imgheight.$px.'<br/>'.$resolution.$dpitxt.'<br/>'.$imagewidthin.$sepin.$imageheightin.$inchestxt.' '.$imagewidthcm.$sepcm.$imageheightcm.$centimeterstxt.'</p></span></td></tr><tr><td><img id="pdfImg" src="/images/PDF.png" alt="'.$file.'" style="z-index: 0; width:auto;max-width:'.$filelistmaxwidth.';height:auto;max-height:'.$filelistmaxheight.'"/></a></span></td><td><p><a href="/delete.php?image='.$file.'"><span style="color:#F44; font-weight:bold"><i class="qtip tip-left" data-tip="'.$deletetip.'"><img src="/images/delete-btn.png"/></i></span></a></p>';
		echo '

		<tr><td colspan="3"><a name="'.$file.'"><hr></a><div style="display:none;"><div id="image'.$i.'">
		<iframe style = "overflow-y: auto; margin-top: 0px; margin-bottom: 0px; margin-left: 25px; margin-right: 25px; padding: 0px; border: 0px; width:'.$filelistzoompdfwidth.';max-width:'.$filelistzoompdfmaxwidth.';height:'.$filelistzoompdfheight.';max-height:'.$filelistzoompdfmaxheight.'" src="/showpdf.php?image='.$file.'"></iframe>
		<span style="color:#666; font-weight:bold; text-align:center" >
		<p>'.$i.' '.$file.'</p></span></div></div><span style="color:#666; font-weight:bold"><p>'.$file.' '.$filesize.'KB<br/>'.$imgwidth.$seppx.$imgheight.$px.'<br/>'.$resolution.$dpitxt.'<br/>'.$imagewidthin.$sepin.$imageheightin.$inchestxt.' '.$imagewidthcm.$sepcm.$imageheightcm.$centimeterstxt.'</p></span></td></tr><tr><td><a href="#" id="featherlight-image" data-featherlight="#image'.$i.'" download="'.$file.'"><span style="color:#777AFF; font-weight:bold"><img id="pdfImg" src="/images/PDF.png" alt="'.$file.'" style="z-index: 0; width:auto;max-width:'.$filelistmaxwidth.';height:auto;max-height:'.$filelistmaxheight.'"/></span></a></td><td><p><a href="/delete.php?image='.$file.'"><span style="color:#F44; font-weight:bold"><i class="qtip tip-left" data-tip="'.$deletetip.'"><img src="/images/delete-btn.png"/></i></span></a></p>';
		$i++;		
		}
		elseif (($ext=='pdf') && ($_SESSION['password']=='PAM'))
		{
		echo '<tr><td colspan="3"><a name="'.$file.'"><hr></a><span style="color:#666; font-weight:bold"><p>'.$file.' '.$filesize.'KB<br/>'.$imgwidth.$seppx.$imgheight.$px.'<br/>'.$resolution.$dpitxt.'<br/>'.$imagewidthin.$sepin.$imageheightin.$inchestxt.' '.$imagewidthcm.$sepcm.$imageheightcm.$centimeterstxt.'</p></span></td></tr><tr><td><img id="pdfImg" src="/images/PDF.png" alt="'.$file.'" style="z-index: 0; width:auto;max-width:'.$filelistmaxwidth.';height:auto;max-height:'.$filelistmaxheight.'"/></a></span></td><td><p><a href="/delete.php?image='.$file.'"><span style="color:#F44; font-weight:bold"><i class="qtip tip-left" data-tip="'.$deletetip.'"><img src="/images/delete-btn.png"/></i></span></a></p>';
		$i++;		
		}


		else
		{
		$i++;
		}
	}
	else
	{
	echo '';
	}



/*
echo '</div>

<script type="text/javascript">

$(document).ready(function() {
    $(\'#body\').show();
    $(\'#msg\').hide();
});
</script>';
*/


	if (($imagemagick !='yes') && ($freeversion == 'yes'))
	{
		if (($ext=='jpg') || ($ext=='jpeg') || ($ext=='png') || ($ext=='gif') || ($ext=='tif') || ($ext=='tiff') || ($ext=='webp'))	
		{
		echo '<td>';  // where there is no print menu
		echo $renamemenu;
		}
		elseif ($ext=='pdf')	
		{
		echo '<td>';  // where there is no print menu
		echo $renamemenu;
		}
		else 
		{
		echo '';
		}
	}

	elseif (($imagemagick !='yes') && ($freeversion != 'yes'))
	{
		if (($ext=='jpg') || ($ext=='jpeg') || ($ext=='png') || ($ext=='gif') || ($ext=='tif') || ($ext=='tiff') || ($ext=='webp'))	
		{
		echo $printmenu;
		echo $renamemenu;
		}
		elseif ($ext=='pdf')	
		{
		echo '<td>';  // where there is no print menu
		echo $renamemenu;
		}
		else 
		{
		echo '';
		}
	}

	elseif (($imagemagick =='yes') && ($freeversion == 'yes'))
	{
		if (($ext=='jpg') || ($ext=='jpeg') || ($ext=='png') || ($ext=='gif') || ($ext=='tif') || ($ext=='tiff') || ($ext=='webp'))	
		{
		echo '<td>';  // where there is no print menu
		echo $renamemenu;
		}
		elseif ($ext=='pdf')	
		{
		echo '<td>';  // where there is no print menu
		echo $renamemenu;
		}
		else 
		{
		echo '';
		}
	}


	elseif (($imagemagick == 'yes' ) && ($freeversion != 'yes'))
	{

		if (($ext=='jpg') || ($ext=='jpeg') || ($ext=='png') || ($ext=='gif') || ($ext=='tif') || ($ext=='tiff') || ($ext=='webp'))	
		{
		// echo $ext;
		echo $imagemagickmenus1;
		echo $printmenu;
		echo $imagemagickmenus2;
		echo $renamemenu;
		}
		elseif ($ext=='pdf')	
		{
		echo $imagemagickmenuspdf1;
		echo '<td>';  // where there is no print menu
		echo $imagemagickmenuspdf2;
		echo $renamemenu;
		}
		else 
		{
		echo '';
		}


	}

	      
	elseif (($_SESSION['expire'] <= $now) || ($_SESSION['loggedin'] != 'yes'))
	{
	echo '';
	session_unset($_SESSION["expire"]);
	session_destroy();
	}

	else
	{
	echo '';
	}

    }
}
//closedir($dh);
//echo $imagemagick;
//echo $freeversion;
//echo $sub1;
echo '</table>';

/*
echo'
<script>
$(document).ready(function() {
    $('#body').show();
    $('#msg').hide();
});
</script>';
*/

// echo $sub1.'<br/>';
// echo $sub2;


include 'footer.inc.php';
 /* echo '</div>
<script type="text/javascript">
$(document).ready(function() {
    $(\'#body\').show();
    $(\'#msg\').hide();
});
</script>';
*/
?>
</center>
<?php /*
else
{
echo '';
}
*/




/*
<script type="text/javascript">
$(document).ready(function() {
    $('#body').show();
    $('#msg').hide();
});

</script>
*/
?>



    <div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01" />
      <div id="caption"></div>
    </div>



<script>
// Get the modal
var modal = document.getElementById("myModal");
console.log(modal);

// Get the image and insert it inside the modal - use its "alt" text as a caption
var imgs = document.getElementsByClassName("js-img")
console.log(Array.from(imgs))
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
// Array.from is necessary because document.getElementsByClassName
// do not return an array but a HTMLCollection : https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementsByClassName
// you can use querySelectorAll (which is a more recent function), see here : https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelectorAll
Array.from(imgs).forEach(function(img) {
  img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  };
})

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
};


$(document).keyup(function(e) {
     if (e.key === "Escape") { // escape key maps to keycode `27`
          modal.style.display = "none";
    }
});


</script>
<?php
include'livemenujs.php';
$_SESSION['fromfilelister']='yes';
?>
</div>

<script>
$(document).ready(function() {
    $('#body').show();
    $('#msg').hide();
});
</script>

</body>
</html>
