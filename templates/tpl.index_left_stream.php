<?php 
$eden_cfg['www_dir'] = dirname(__FILE__);
$eden_cfg['www_dir_cms'] = $eden_cfg['www_dir']."/../edencms/";
$eden_cfg['www_dir_lang'] = $eden_cfg['www_dir']."/../lang/";
$eden_cfg['ip'] = $_SERVER["REMOTE_ADDR"];
require_once($eden_cfg['www_dir_cms']."eden_init.php");
include_once($eden_cfg['www_dir_cms']."db.magic.inc.php");
include_once($eden_cfg['www_dir_cms']."functions_frontend.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Magic-live.cz</title>
<link href="<?php echo $eden_cfg['url_skins'].$_GET['eden_project_skin'];?>eden-common.css" rel="stylesheet" type="text/css" media="all">
<style>";
body {height:100%;font-size:11px;font-family:Trebuchet MS, Verdana CE, Verdana, Geneva CE, Geneva, Arial CE, Arial, Helvetica CE, Helvetica, sans-serif;} 
body, html {padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;}
td {font-size:11px;font-family:Trebuchet MS, Verdana CE, Verdana, Geneva CE, Geneva, Arial CE, Arial, Helvetica CE, Helvetica, sans-serif;}
</style>
</head>
<body>
<?php
$stream = new Stream($eden_cfg);
echo $stream->showChannels();
?>
</body>
</html>