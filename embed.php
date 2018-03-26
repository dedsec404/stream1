<?php  
    require "cryp.php";
   require_once(__DIR__ .'/class.DriveProxy.php');
    if($_GET['id'] != "") {
        $driveid = dencrypt($_GET['id']);
        $drive = new DriveProxy();
        $drive->driveid($driveid);
        $gdata = $drive->proxylink;
    }

  if( isset($_GET["poster"]) ) {
    $poster_url = $_GET["poster"];
    $poster = " poster='{$poster_url}' ";
  } else {
    $poster="";
  }

if (  isset($_GET["subtitle"]) ) {
  $subtitle_url= $_GET["subtitle"];
  $subtitle="<track kind='subtitles' src='{$subtitle_url}' srclang='es' label='Español'>";
} else {
  $subtitle="";
}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Google Drive Proxy Player</title>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <style>
            html,body{
            	height: 100%;
            	width: 100%;
            	margin: 0;
            }
	    </style>
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
  <link href="http://vjs.zencdn.net/6.4.0/video-js.css" rel="stylesheet">
  <link href="https://unpkg.com/silvermine-videojs-quality-selector@1.1.2/dist/css/quality-selector.css" rel="stylesheet">

  <!-- If you'd like to support IE8 -->
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
	</head>
	<body>
<div id="myElement">
<video id="player" class="video-js vjs-default-skin" controls <?=$poster?> >

<?php
    foreach(json_decode($gdata) as $g ){
        echo "<source src='".$g->file."' label='".$g->label."' type='".$g->type."'>";
    }
    echo $subtitle;
?>
        
    </video>
</div>

  <script src="http://vjs.zencdn.net/6.4.0/video.js"></script>
<script src="https://unpkg.com/silvermine-videojs-quality-selector/dist/js/silvermine-videojs-quality-selector.min.js"></script>


<script>
    var player = videojs('player');
    player.controlBar.addChild('QualitySelector');
</script>
    </body>
</html>
