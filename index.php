<?php
$eden_cfg['www_dir'] = dirname(__FILE__);
$eden_cfg['www_dir_cms'] = $eden_cfg['www_dir']."/edencms/";
$eden_cfg['www_dir_cms_files'] = $eden_cfg['www_dir']."/edencms_files/";
$eden_cfg['www_dir_lang'] = $eden_cfg['www_dir']."/lang/";
$eden_cfg['ip'] = $_SERVER["REMOTE_ADDR"];

/*
if ($_SERVER["REMOTE_ADDR"] == "92.27.38.30" || $eden_cfg['ip'] == "192.168.1.3" || $eden_cfg['ip'] == "127.0.0.1"){
	$title_maintanance = "Maintanance mode! - ";
} else {
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"\n";
	echo "    \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
	echo "<head>\n";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n";
	echo "  <title>PokerTeam</title>\n";
	echo "</head>\n";
	echo "<body><div style=\"width:500px;margin:auto;\">\n";
	echo "<h1>We are down for maintanance</h1>";
	echo "<h2>Sorry for the inconvinience. We will be back shortly.</h2>";
	echo "</div></body>\n";
	echo "</html>";
	exit;
}
*/
require_once($eden_cfg['www_dir_cms']."eden_init.php");
if (!isset($title_maintanance)){$title_maintanance = "";}
/******* Overeni POST a GET proti SSI a Javascript utokum - START *******/
require_once($eden_cfg['www_dir_cms']."eden_sec.php");
Kontrola_hlavicek();

/*
function GetMicrotime(){
	list($usec, $sec) = explode(" ",microtime());
	return ((float)$usec + (float)$sec);
}
$time_start = GetMicrotime();
*/
//setcookie('visit', 'PAGEVIEW', mktime(23,59,59, date('m'), date('d'), date('Y')), '/');

/******* Nacteni zakladnich nastaveni a sessions - START *******/
$project = "magic";
$_GET['lang'] = "cz";
require_once($eden_cfg['www_dir_lang']."lang_cz.php");
require_once($eden_cfg['www_dir_cms']."eden_lang_cz.php");
require_once($eden_cfg['www_dir_cms']."db.magic.inc.php");
require_once($eden_cfg['www_dir_cms']."sessions.php");
require_once($eden_cfg['www_dir_cms']."functions_frontend.php");
require_once($eden_cfg['www_dir_cms']."eden_forum.php");

/******* Nacteni cokies - START *******/
	if (($_COOKIE[$project."_autologin"] == 1) && ($_SESSION['login'] != $_COOKIE[$project."_name"]) && ($_SESSION['login_status'] != "true")){
		$_GET['action'] = "login";
	}
	$link_adm = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	setcookie($project.'_link', '', time() - 186400);
	setcookie($project.'_link', $link_adm, time() + 186400);

// nastavenipro guestbook
$gid = 1;
if (empty($_GET['action'])){$_GET['action'] = "article";}

/* Kdyz je uzivatel prihlaseny */
if ($_SESSION['loginid'] != ""){
	/* Nacteni informaci o uzivateli */
	$res_admin = mysql_query("SELECT a.admin_nick, a.admin_lang, a.admin_priv, ai.admin_info_filter, ai.admin_info_customize_skin FROM $db_admin AS a, $db_admin_info AS ai WHERE a.admin_id=".(integer)$_SESSION['loginid']." AND ai.aid=".(integer)$_SESSION['loginid']) or die ("<strong>"._ERROR."</strong> ".mysql_error());
	$ar_admin = mysql_fetch_array($res_admin);
}

$res_setup = mysql_query("SELECT * FROM $db_setup") or die ("<strong>"._ERROR."</strong> ".mysql_error());
$ar_setup = mysql_fetch_array($res_setup);
//if (count($admin_custom) == 0){$admin_custom = array();}

if (empty($ar_admin['admin_info_filter'])){
	$filter_ar = array("all");
	$filter_ar = array_flip($filter_ar);
} else {
	$filter_ar = explode ("||", $ar_admin['admin_info_filter']);
	$filter_ar = array_flip($filter_ar);
}

// Zabanovani uzivatele, ktery je v seznamu
UserBan();
if ($_GET['action'] == "allow_rg"){AllowReg($_GET['rg_code']);} /* Zobrazi oznameni o aktivaci uctu */
if ($_GET['action'] == "allow_change_email"){AllowChangeEmail($_GET['rg_code']);} /* Zobrazi oznameni o zmene emailove adresy */
if ($_GET['action'] == "login" || $_POST['action'] == "login"){Login('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],"index.php?lang=".$_GET['lang']."","index.php?lang=".$_GET['lang']."");}
if ($_GET['action'] == "logout"){Logout();}
if ($_GET['action'] == "reg_scr" || $_POST['action'] == "reg_scr"){$_GET['action'] = "reg";} /* Zajisti zobrazeni registracniho formulare pri chybe */
if ($_GET['action'] == "edit_user"){$_GET['action'] = "user_edit";} /* Zajisti zobrazeni registracniho formulare pri chybe */

/******* TITLE *******/
if ($_GET['action'] == "clanek" || $_GET['action'] == "komentar"){
	if($_GET['modul'] == "news"){
		$res_title = mysql_query("SELECT news_headline FROM $db_news WHERE news_id=".(float)$_GET['id']) or die ("<strong>"._ERROR."</strong> ".mysql_error());
		$ar_title = mysql_fetch_array($res_title);
		$title = "Aktuality - ".TreatText($ar_title['news_headline'],"150")." - Magic-live.cz";
	}elseif($_GET['modul'] == "poll"){
		$res_title = mysql_query("SELECT poll_questions_question FROM $db_poll_questions WHERE poll_questions_id=".(float)$_GET['id']) or die ("<strong>"._ERROR."</strong> ".mysql_error());
		$ar_title = mysql_fetch_array($res_title);
		$title = "Anketa - ".TreatText($ar_title['poll_questions_question'],"150")." - Magic-live.cz";
	} else {
		$res_title = mysql_query("SELECT article_headline FROM $db_articles WHERE article_id=".(float)$_GET['id']) or die ("<strong>"._ERROR."</strong> ".mysql_error());
		$ar_title = mysql_fetch_array($res_title);
		$title = "Článek - ".TreatText($ar_title['article_headline'],"150")." - Magic-live.cz";
	}
}elseif ($_GET['action'] == "forum"){
	$title = "Fórum - Magic-live.cz";
}elseif ($_GET['action'] == "kdehrat"){
	$title = "Kde hrát - Magic-live.cz";
}elseif ($_GET['action'] == "kdehrat_clubs"){
	$title = "Kde hrát - Kluby a herny - Magic-live.cz";
}elseif ($_GET['action'] == "kdehrat_online"){
	$title = "Kde hrát - Online herny - Magic-live.cz";
}elseif ($_GET['action'] == "online_magic"){
	$title = "Online Magic - Magic-live.cz";
}elseif ($_GET['action'] == "players_profiles"){
	$title = "Profily hráčů - Magic-live.cz";
}elseif ($_GET['action'] == "strategie"){
	$title = "Strategie - Magic-live.cz";
}elseif ($_GET['action'] == "strategie_turnaje"){
	$title = "Strategie - Turnaje - Magic-live.cz";
}elseif ($_GET['action'] == "strategie_obecne"){
	$title = "Strategie - Obecné - Magic-live.cz";
}elseif ($_GET['action'] == "turnaje"){
	$title = "Reportáže z turnaju - Magic-live.cz";
}elseif ($_GET['action'] == "begining"){
	$title = "Začínáme s pokerem - Magic-live.cz";
}elseif ($_GET['action'] == "curiosity"){
	$title = "Zajímavosti - Magic-live.cz";
} else {
	$title = "Magic-live.cz - Nejlépe rozdané karty na webu";
}

/* Vyber zobrazeni veci c levem a pravem panelu */
if ($_GET['action'] == "player" || $_GET['action'] == "league_team" || $_GET['action'] == "league_team_reg" || $_GET['action'] == "team_list" || $_GET['action'] == "user_edit"){$panels = "low";}else{ $panels = "full";}

/******* VYBER KATEGORII PRO ZOBRAZENI *******/
$magic_categories['magic_all_articles']		= "1:2:15:17";
$magic_categories['magic_all_news']	= "3";


/******* SKIN *******/
$eden_project_skin = CheckSkin();
if ($eden_project_skin != ""){ $eden_project_skin .= "/";}

$res_pm = mysql_query("SELECT COUNT(*) FROM $db_forum_pm WHERE forum_pm_recipient_id=".(integer)$_SESSION['loginid']." AND forum_pm_del<>".(integer)$_SESSION['loginid']."" ) or die ("<strong>"._ERROR." </strong> ".mysql_error());
$num_pm = mysql_fetch_array($res_pm);
$res_pm_log = mysql_query("SELECT forum_pm_log_posts FROM $db_forum_pm_log WHERE forum_pm_log_admin_id=".(integer)$_SESSION['loginid']) or die ("<strong>"._ERROR." </strong>".mysql_error());
$ar_pm_log = mysql_fetch_array($res_pm_log);
$res_sgb = mysql_query("SELECT COUNT(*) FROM $db_forum_posts WHERE forum_posts_pid=44") or die ("<strong>"._ERROR." </strong> ".mysql_error());
$num_sgb = mysql_fetch_array($res_sgb);
$res_sgb_log = mysql_query("SELECT forum_posts_log_posts FROM $db_forum_posts_log WHERE forum_posts_log_forum_topic_id=44 AND forum_posts_log_admin_id=".(integer)$_SESSION['loginid']) or die ("<strong>"._ERROR." </strong>".mysql_error());
$ar_sgb_log = mysql_fetch_array($res_sgb_log);
$res_online_all = mysql_query("SELECT COUNT(*) FROM $db_sessions WHERE sessions_pages='".mysql_real_escape_string($eden_cfg['misc_web'])."' GROUP BY sessions_user") or die ("<strong>"._ERROR." </strong> ".mysql_error());
$num_online_all = mysql_fetch_array($res_online_all);
$res_online_usr = mysql_query("SELECT sessions_pages FROM $db_sessions WHERE sessions_pages='".mysql_real_escape_string($eden_cfg['misc_web'])."' GROUP BY sessions_user") or die ("<strong>"._ERROR." </strong> ".mysql_error());
$num_online_usr = mysql_num_rows($res_online_usr);

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "<head>\n";
echo "	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
echo "	<title>".$title_maintanance.$title."</title>\n";
echo "	<link href=\"".$eden_cfg['url_skins'].$eden_project_skin."eden-common.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\">\n";
echo "	<link href=\"".$eden_cfg['url_skins'].$eden_project_skin."magic.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\">\n";
echo "	<meta name=\"keywords\" lang=\"cs\" content=\"magic, gathering, online, turnaj, liga\">\n";
echo "	<meta name=\"description\" lang=\"cs\" content=\"Vše o Magic the Gathering\">\n";
echo "	<meta name=\"generator\" content=\"EDEN Content Management System - www.blackfoot.cz/eden/\">\n";
echo "	<meta name=\"author\" content=\"Magic-live.cz\">\n";
echo "	<meta name=\"robots\" content=\"all,follow\">\n";
echo "	<meta name=\"copyright\" content=\"© 2010, Magic-live.cz\">\n";
echo "	<meta http-equiv=\"content-language\" content=\"cs\">\n";
echo "	<meta http-equiv=\"Content-Style-Type\" content=\"text/css\">\n";
echo "	<meta http-equiv=\"Content-Script-Type\" content=\"text/javascript\">\n";
echo "	<script type=\"text/javascript\" src=\"".$eden_cfg['url']."js/animatedcollapse.js\"></script>";
echo "<script type=\"text/javascript\" src=\"".$eden_cfg['url']."js/jquery.js\"></script>\n";
echo "<script type=\"text/javascript\" src=\"".$eden_cfg['url']."js/jquery.form.js\"></script>\n";
include ($eden_cfg['www_dir_cms']."eden_js.php");
if ($_GET['action'] == "clanek" || $_GET['action'] == "komentar"){
  echo "<style type=\"text/css\">\n";
	echo "h1 {font-size:20px;}\n";
	echo "h1 A {font-size:20px;}\n";
	echo "h1 A:visited {font-size:20px;}\n";
	echo "h1 A:hover {font-size:20px;}\n";
  echo "</style>\n";
}
echo "	<script type=\"text/javascript\">\r\n";
echo "		<!-- \r\n";
echo "		var uniquepageid=\"".$project."\";\r\n"; /* AnimatedColapse */
echo "		var v_form_name=\""; if ($_GET['lang'] == "cz"){ echo "Napište prosím své jméno.";  } else { echo "Please write your name."; } echo "\";\r\n";
echo "		var v_form_email=\""; if ($_GET['lang'] == "cz"){ echo "Vaše emailová adresa je neplatná!  Zadejte ji, prosím, správně."; } else { echo "Your email is icorrect! Please type correct."; } echo "\";\r\n";
echo "		var v_skin_path_plus=\"".$eden_cfg['url_skins'].$eden_project_skin."images/sys_icon_plus_2.gif\";\r\n";  /* AnimatedColapse */
echo "		var v_skin_path_minus=\"".$eden_cfg['url_skins'].$eden_project_skin."images/sys_icon_minus_2.gif\";\r\n"; /* AnimatedColapse */
echo "		var v_chcolor=\""; if ($ar_sgb_log['forum_posts_log_posts'] < $num_sgb[0] && ($_SESSION['u_status'] == "admin")){ echo "1";} else {echo "0";} echo "\";\r\n";/* Skript pro blikani secret Guestbooku */
echo "		//-->\r\n";
echo "	</script>\r\n";
echo "	<script type=\"text/javascript\" src=\"".$eden_cfg['url']."js/magic.js\"></script>\n";
echo "	<script type=\"text/javascript\" src=\"".$eden_cfg['url']."js/eden.js\"></script>\n";
echo "</head>\n";
echo "<body>"; 
echo "<div id=\"container\">\n";
echo "<a name=\"top\"></a>";
echo "<div id=\"menu_custom\">\n";
echo "	<div id=\"menu_custom_left\"><a href=\"javascript:MM_swapImgRestore();MM_swapImage('search','','".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_icon_minus.gif',1);collapse1.slideit();\"><img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_icon_plus.gif\" width=\"12\" height=\"12\" style=\"position:relative;top:2px;\" name=\"search\" alt=\".\">&nbsp;&nbsp;"._MENU_CUS_SEARCH."</a></div>\n";
echo "	<div id=\"menu_custom_right\">";
	echo "<form action=\"index.php?lang=".$_GET['lang']."\" method=\"post\">";
	echo "<ul id=\"layout_login\">";
	if ($_SESSION['u_status'] == "" || $_SESSION['u_status'] == "vizitor"){
		unset($login);
		echo "<li><input type=\"hidden\" name=\"action\" value=\"login\"><input tabindex=\"3\" type=\"submit\" id=\"login_submit\" value=\"\" title=\""._LOGIN."\"></li>\n";
		echo "<li><input tabindex=\"2\" type=\"password\" id=\"login_pass\" name=\"pass\" value=\"password\" onFocus=\"if (this.value=='password') this.value='';\" onBlur=\"if (this.value=='') this.value='password';\" size=\"10\"></li>\n";
		echo "<li><input tabindex=\"1\" type=\"text\" id=\"login_name\" name=\"login\" value=\"username\" onFocus=\"if (this.value=='username') this.value='';\" onBlur=\"if (this.value=='') this.value='username';\"  onMouseDown=\"this.value=''\" size=\"10\"></li>";
	}
	echo "<li>";
	if ($_SESSION['u_status'] != "vizitor" && $_SESSION['nick'] != ""){
		echo "<a href=\"index.php?action=player&amp;mode=player_acc&amp;id=".$_SESSION['loginid']."&amp;lang=".$_GET['lang']."\">".stripslashes($ar_admin['admin_nick'])."</a>";
		if (($_SESSION['u_status'] == "user" || $_SESSION['u_status'] == "admin") && $ar_pm_log['forum_pm_log_posts'] < $num_pm[0]){
			echo "<a href=\"index.php?project=".$_SESSION['project']."&amp;action=forum&amp;faction=pm\"><img src=\"images/sys_message_new.gif\" alt=\""._PM."\" title=\""._PM."\" width=\"15\" height=\"10\" border=\"0\" style=\"position:relative;top:2px;\"> ("; echo $num_pm[0] - $ar_pm_log['forum_pm_log_posts']; echo ")</a>";
		} else {
			echo "<a href=\"index.php?project=".$_SESSION['project']."&amp;action=forum&amp;faction=pm\"><img src=\"images/sys_message.gif\" alt=\""._PM."\" title=\""._PM."\" width=\"15\" height=\"10\" border=\"0\" style=\"position:relative;top:2px;\"></a>";
		}
		echo "&nbsp;<span class=\"menu_custom_divider\">|</span>&nbsp;ID: ".$_SESSION['loginid'];
	}
	if ($_SESSION['u_status'] == "" || $_SESSION['u_status'] == "vizitor"){
		echo "<a href=\"index.php?action=reg_scr\">"._REG."</a>";
		echo "&nbsp;<span class=\"menu_custom_divider\">|</span>&nbsp;<a href=\"index.php?action=forgotten_pass&amp;project=".$_SESSION['project']."\">"._LOGIN_FORGOTTEN_PASS."</a>&nbsp;&nbsp;";
	}
	if ($_SESSION['u_status'] != "vizitor" && $_SESSION['login'] != ""){
		echo "&nbsp;<span class=\"menu_custom_divider\">|</span>&nbsp;<a href=\"index.php?action=user_edit&amp;mode=edit_user\">"._USER_EDIT."</a>\n";
		echo "&nbsp;<span class=\"menu_custom_divider\">|</span>&nbsp;<a href=\"index.php?action=forum&amp;project=".$_SESSION['project']."&amp;faction=friends\">"._USER_FRIENDS."</a>\n";
		echo "&nbsp;<span class=\"menu_custom_divider\">|</span>&nbsp;"._CMN_ONLINE.": <a title=\"Online\">".$num_online_all[0]."</a>/<a href=\"index.php?action=whoisonline\" target=\"_self\" title=\"Users\">".$num_online_usr."</a>\n";
		echo "&nbsp;<span class=\"menu_custom_divider\">|</span>&nbsp;<a href=\"index.php?action=logout&amp;project=".$_SESSION['project']."\">"._LOGOUT."</a>&nbsp;&nbsp;";
	}
echo "		</li>\n";
echo "		</ul>\n";
echo "		</form>\n";
echo "	</div>\n";
echo "</div>\n";
echo "<div id=\"cat1\" style=\"width:964px;height:50px;\">\n";
echo "	<div style=\"padding: 0px 0px 0px 5px;\">\n";
echo "		<div align=\"center\" style=\"padding-left:10px; padding-top:0px;\">&nbsp;"; Search(20,0,1); echo "</div>\n";
echo "	</div>\n";
echo "</div>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "var collapse1=new animatedcollapse(\"cat1\", 300, false)\n";
echo "//-->\n";
echo "</script>\n";
echo "<div id=\"menu_logo\">\n";
echo "	<div id=\"menu_logo_1\"></div>\n";
echo "	<div id=\"menu_logo_link\" onclick=\"document.location.href='".$eden_cfg['url']."index.php?action='\">&nbsp;</div>\n";
echo "	<div id=\"menu_logo_2\">";
Reklama(19);
echo "</div>\n";
echo "</div>\n";
echo "<!-- This is the start of the menu -->\n";
echo "<div id=\"menu_main\">\n";
echo "	<a href=\"".$eden_cfg['url']."index.php?action=\" target=\"_self\" title=\"Novinky\"><img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_left.gif\" width=\"12\" height=\"27\" alt=\"Novinky\" title=\"Novinky\" align=\"middle\">&nbsp;Novinky&nbsp;<img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_right.gif\" width=\"12\" height=\"27\" align=\"middle\" alt=\".\"></a>\n";
echo "	<a href=\"".$eden_cfg['url']."index.php?action=playrooms_clubs\" target=\"_self\" title=\"Herny a kluby\"><img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_left.gif\" width=\"12\" height=\"27\" alt=\"Herny a kluby\" title=\"Herny a kluby\" align=\"middle\">&nbsp;Herny a kluby&nbsp;<img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_right.gif\" width=\"12\" height=\"27\" align=\"middle\" alt=\".\"></a>\n";
echo "	<a href=\"".$eden_cfg['url']."index.php?action=rules\" target=\"_self\" title=\"Pravidla\"><img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_left.gif\" width=\"12\" height=\"27\" alt=\"Pravidla\" title=\"Pravidla\" align=\"middle\">&nbsp;Pravidla&nbsp;<img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_right.gif\" width=\"12\" height=\"27\" align=\"middle\" alt=\".\"></a>\n";
echo "	<a href=\"".$eden_cfg['url']."index.php?action=tournaments\" target=\"_self\" title=\"Turnaje\"><img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_left.gif\" width=\"12\" height=\"27\" alt=\"Turnaje\" title=\"Turnaje\" align=\"middle\">&nbsp;Turnaje&nbsp;<img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_right.gif\" width=\"12\" height=\"27\" align=\"middle\" alt=\".\"></a>\n";
echo "	<a href=\"".$eden_cfg['url']."index.php?action=decklists\" target=\"_self\" title=\"Decklisty\"><img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_left.gif\" width=\"12\" height=\"27\" alt=\"Decklisty\" title=\"Decklisty\" align=\"middle\">&nbsp;Decklisty&nbsp;<img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_right.gif\" width=\"12\" height=\"27\" align=\"middle\" alt=\".\"></a>\n";
echo "	<a href=\"".$eden_cfg['url']."index.php?action=fan_cards_comp\" target=\"_self\" title=\"Fan Karty\"><img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_left.gif\" width=\"12\" height=\"27\" alt=\"Fan Karty\" title=\"Fan Karty\" align=\"middle\">&nbsp;Fan Karty&nbsp;<img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_right.gif\" width=\"12\" height=\"27\" align=\"middle\" alt=\".\"></a>\n";
echo "	<a href=\"".$eden_cfg['url']."index.php?action=forum\" target=\"_self\" title=\""._MENU_FORUM_HELP."\"><img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_left.gif\" width=\"12\" height=\"27\" alt=\"Fórum\" title=\"Fórum\" align=\"middle\">&nbsp;Fórum&nbsp;<img src=\"".$eden_cfg['url_skins'].$eden_project_skin."/images/sys_menu_tabmenu_right.gif\" width=\"12\" height=\"27\" align=\"middle\" alt=\".\"></a>\n";
echo "</div>\n";
echo "<div id=\"menu_sub\">\n";
echo "	<div id=\"submenu_1\" class=\"menu_submenu\">\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=\" target=\"_self\" title=\"Hlavní stránka\">Hlavní stránka</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=curiosity\" target=\"_self\" title=\"Zajímavosti\">Zajímavosti</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=players_profiles\" target=\"_self\" title=\"Profily hráčů\">Profily hráčů</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=online_magic\" target=\"_self\" title=\"Online Magic\">Online Magic</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=mtg_card_list\" target=\"_self\" title=\"Seznam karet\">Seznam karet</a>\n";
echo "	</div>\n";
echo "	<div id=\"submenu_2\" class=\"menu_submenu\">\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=playrooms\" target=\"_self\" title=\"Herny\">Herny</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=clubs\" target=\"_self\" title=\"O lize\">Kluby</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=eshops\" target=\"_self\" title=\"Pravidla\">eShopy</a>\n";
echo "	</div>\n";
echo "	<div id=\"submenu_3\" class=\"menu_submenu\">\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=begining\" target=\"_self\" title=\"Začínáme s pokerem\">Začínáme s Magic the Gathering</a>\n";
echo "	</div>\n";
echo "	<div id=\"submenu_4\" class=\"menu_submenu\">\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=tournaments\" target=\"_self\" title=\"Turnaje\">Turnaje</a>\n";
echo "	</div>\n";
echo "	<div id=\"submenu_5\" class=\"menu_submenu\">\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=decklists\" target=\"_self\" title=\"Zobrazit decklisty\">Zobrazit decklisty</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=decklist_add\" target=\"_self\" title=\"Přidat decklist\">Přidat decklist</a>\n";
	if ($_SESSION['loginid'] != ""){
		echo "		&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"".$eden_cfg['url']."index.php?action=decklists_my\" target=\"_self\" title=\"Mé decklisty\">Mé decklisty</a>\n";
	}
echo "	</div>\n";
echo "	<div id=\"submenu_6\" class=\"menu_submenu\">\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=fan_cards_comp\" target=\"_self\" title=\"Soutěže\">Soutěže</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=fan_cards\" target=\"_self\" title=\"Karty\">Karty</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=clanek&id=90\" target=\"_self\" title=\"Návod\">Návod</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n\n";
echo "		<a href=\"".$eden_cfg['url']."index.php?action=clanek&id=241\" target=\"_self\" title=\"Síň slávy\">Síň slávy</a>\n";
echo "	</div>\n";
echo "	<div id=\"submenu_7\" class=\"menu_submenu\">\n";
echo "	</div>\n";
echo "</div>\n";
echo "<div style=\"height:5px;width:950px;\"><img src=\"images/bod.gif\" width=\"1\" height=\"1\" alt=\".\" onload=\"javascript:initMenu()\"></div>\n";
if (!empty($_GET['msg']) || $_GET['action'] == "msg"){
?>
<script>
// prepare the form when the DOM is ready 
$(document).ready(function() { 
    $('#content_err_col').delay(7000).fadeOut(400); 
});
</script>
<?php
	echo "<div id=\"content_err_col\" class=\"clearfix\">\n";
	echo "	<div id=\"content_err_col_cont\">\n";
	echo "		<div id=\"content_err_col_text\"><br><strong>"; Msg($_GET['msg']); echo "</strong><br><br></div>\n";
	echo "	</div>\n";
	echo "</div>";
}
echo "<!-- //////////////////////////////////////////////////////// HEADER - END ////////////////////////////////////////////////// -->";
echo "<!-- //////////////////////////////////////////////////////// LEFT ////////////////////////////////////////////////// -->";
if ($_GET['action'] != "forum"){
	echo "<div id=\"content\" class=\"clearfix\">";
	echo "	<!-- ///////////////////////// LEFT ///////////////////////// -->";
	echo "	<div class=\"content_side_col\">";
	
	
	echo "	<!-- *** FACEBOOK *** -->\n";
	//echo "	<div class=\"content_side_col_cont\">\n";
	echo "		<iframe src=\"http://www.facebook.com/plugins/likebox.php?locale="; if ($_GET['lang'] == "cz"){echo "cs_CZ";} else {echo "en_US";} echo "&amp;href=http%3A%2F%2Fwww.facebook.com%2FMagicLiveCZ&amp;width=175&amp;colorscheme=light&amp;show_faces=true&amp;border_color=&amp;stream=false&amp;header=true&amp;height=240\" scrolling=\"yes\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:175px; height:240px; margin:5px 0px 5px 0px; background-color:#ffffff\" allowTransparency=\"true\"></iframe>";
	//echo "	</div>\n";
	echo "	<!-- *** FACEBOOK KONEC *** -->\n";
	
	
	echo " 	<!-- *** STREAM *** -->\n";
	echo " 	<div class=\"content_side_col_header\">\n";
	echo " 		<div class=\"content_side_col_title\">Stream</div>\n";
	echo " 	</div>\n";
	echo " 	<div class=\"content_side_col_cont\">\n";
	echo " 		<div class=\"content_side_col_text\" style=\"padding-top:5px;line-height:18px;\">";
	echo " 			<iframe src=\"templates/tpl.index_left_stream.php?eden_project_skin=".$eden_project_skin."\" width=\"175\" align=\"top\" frameborder=\"0\" scrolling=\"auto\"></iframe>"; 
   	echo " 		</div>\n";
	echo " 		<div style=\"width:159px;text-align:center;padding:8px;\">";
	echo "			<input type=\"button\" value=\"Přidat stream\" onclick=\"window.open('index.php?action=clanek&id=99', '_self')\" class=\"eden_button\"/>";
	echo " 		</div>\n";
	echo " 	</div>\n";
	echo " 	<!-- *** STREAM *** -->\n";
	
	
	if ($_GET['action'] != "clanek" && $panels == "full"){
		echo "<!-- *** ANKETA *** -->\n";
		echo "<div class=\"content_side_col_header\">\n";
		echo "	<div class=\"content_side_col_title\">"._POLL."</div>\n";
		echo "</div>\n";
		echo "<div class=\"content_side_col_cont\">\n";
		Poll(0,$_GET['lang'],135,10,"poll",125,41); echo "<br>\n";
		echo "	&nbsp;<a href=\"index.php?action=oldpolls&amp;lang=".$_GET['lang']."\" target=\"_self\">"._POLL_OLDER."</a>\n";
		echo "	</div>\n";
		echo "	<!-- *** ANKETA - KONEC *** -->\n";
	}
	
	echo "<!-- *** KARTY *** -->\n";
	echo "<div class=\"content_side_col_header\">\n";
	echo "	<div class=\"content_side_col_title\">Vyhledávání karet</div>\n";
	echo "</div>\n";
	echo "<div class=\"content_side_col_cont\">\n";
	echo "	<div class=\"content_side_col_text\" style=\"min-height: 80px;\"><form action=\"index.php?action=mtg_show_card&amp;project=".$_SESSION['project']."\" method=\"get\">\n";
	echo "		<table border=\"0\">\n";
	echo "			<tr>\n";
	echo "				<td colspan=\"2\">Název karty:<br>\n";
	echo "					<input type=\"text\" id=\"card_name\" name=\"card_name\" value=\"\" size=\"27\" autocomplete=\"off\" onkeyup=\"ajax_showOptions(this,'getMtGCardByLetters=1&amp;project=".$_SESSION['project']."',event)\">\n";
	echo "					<input type=\"hidden\" id=\"card_name_hidden\" name=\"card_id\">\n";
	echo "					<input type=\"hidden\" name=\"action\" value=\"mtg_show_card\">\n";
	echo "					<input type=\"hidden\" name=\"project\" value=\"".$_SESSION['project']."\">\n";
	echo "				</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td><input type=\"submit\" value=\""._DICT_SHOW_WORD."\" class=\"eden_button\"></td>\n";
	echo "				<td><input type=\"button\" value=\"Seznam karet\" onclick=\"window.open('index.php?action=mtg_card_list', '_self')\" class=\"eden_button\"/></td>\n";
	echo "			</tr>\n";
	echo "		</table></form>\n";
	echo "	</div>\n";
	echo "</div>\n";
	echo "<!-- *** KARTY - KONEC *** -->\n";
	
	
	echo "<!-- *** SLOVNIK *** -->\n";
	echo "<div class=\"content_side_col_header\">\n";
	echo "	<div class=\"content_side_col_title\">Slovník MtG výrazů</div>\n";
	echo "</div>\n";
	echo "<div class=\"content_side_col_cont\">\n";
	echo "	<div class=\"content_side_col_text\" style=\"min-height: 80px;\"><form action=\"index.php\" method=\"get\">\n";
	echo "		<table border=\"0\">\n";
	echo "			<tr>\n";
	echo "				<td colspan=\"2\">"._DICTIONARY_WORD.":<br>\n";
	echo "					<input type=\"text\" id=\"word\" name=\"word\" value=\"\" size=\"27\" autocomplete=\"off\" onkeyup=\"ajax_showOptions(this,'getDictionaryByLetters=1&amp;project=".$_SESSION['project']."',event)\">\n";
	echo "					<input type=\"hidden\" id=\"word_hidden\" name=\"id\">\n";
	echo "					<input type=\"hidden\" name=\"action\" value=\"dict\">\n";
	echo "					<input type=\"hidden\" name=\"mode\" value=\"open\">\n";
	echo "				</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td><input type=\"submit\" value=\""._DICT_SHOW_WORD."\" class=\"eden_button\">";  echo "</td>\n";
	echo "				<td><input type=\"button\" value=\"Přidat výraz\" onclick=\"window.open('index.php?action=dict&mode=dict_add_word', '_self')\" class=\"eden_button\"/></td>\n";
	echo "			</tr>\n";
	echo "		</table></form>\n";
	echo "	</div>\n";
	echo "</div>\n";
	echo "<!-- *** SLOVNIK - KONEC *** -->\n";
	
	
	
	echo "</div>\n";
	echo "<!-- ///////////////////////// LEFT - KONEC ///////////////////////// -->";
}
echo "<!-- //////////////////////////////////////////////////////// LEFT - END ////////////////////////////////////////////////// -->";
echo "<div class=\"content_top_articles\">";
if ($_GET['action'] == "article" || $_GET['action'] == "msg"){
	$res_video = mysql_query("SELECT video_name, video_code FROM $db_videos WHERE video_show=1 AND NOW() BETWEEN video_date_from AND video_date_to ORDER BY video_date_from DESC, video_id DESC LIMIT 1") or die ("<strong>File:</strong> ".__FILE__."<br /><strong>Line:</strong>".__LINE__."<br />".mysql_error());
	$num_video = mysql_num_rows($res_video);
	if ($_GET['action'] != "cups" && $num_video < 1){
		echo "<!-- ///////////////////////// ARTICLES ///////////////////////// -->";
		echo "<!-- *** BEST ARTICLES *** -->";
		echo "<div class=\"content_top_articles_col\">";
		echo "	<div class=\"content_top_articles_col_cont\">";
		echo "		<div class=\"content_top_articles_col_text\">";
						for($i=0;$i<5;$i++){
							echo "<div id=\"article_".$i."\" class=\"content_top_articles_article\" "; if($i == 0){echo "style=\"visibility:visible;\"";} echo ">";
							ShowBest($magic_categories['magic_all_articles'],$i);
							$best_article_id[$i] = $article_id;
							echo "</div>";
						}
		echo "			<div id=\"content_top_articles_button\">";
						for ($i=0;$i<5;$i++){
							echo "<div class=\"content_top_articles_button\" id=\"top_article_button_".$i."\" onclick=\"document.location.href='".$eden_cfg['url']."index.php?action=clanek&amp;lang=".$_GET['lang']."&amp;id=".$best_article_id[$i]."&amp;page_mode='\" onmouseover=\"RotateBest('".$i."','off')\" onmouseout=\"RotateBest('".$i."','on')\">"; echo $i+1; echo "</div>";
						}
		echo "			<img src=\"images/bod.gif\" width=\"1\" height=\"1\" onload=\"RotateBest('0','on')\" alt=\".\">";
		echo "			</div>";
		echo "		</div>";
		echo "	</div>";
		echo "</div>";
		echo "	<!-- *** BEST ARTICLES - END *** -->";
	} elseif ($num_video == 1){
		$ar_video = mysql_fetch_array($res_video);
		echo "	<!-- *** VIDEO *** -->\n";
		echo "	<div class=\"content_video_col\">\n";
		echo "		<div class=\"content_video_cont\">\n";
		echo "<h2>".PrepareFromDB($ar_video['video_name'])."</h2>";
		echo PrepareFromDB($ar_video['video_code']);
		echo "		</div>\n";
		echo "	</div>\n";
		echo "	<!-- *** VIDEO - END *** --> ";
	}

	echo "<div class=\"content_article_col\">";
	echo "	<!-- *** ARTICLES *** -->";
	echo "	<div id=\"cat11\" style=\"margin-left:0px;width:348px;height:220px;background-color:#dedede;\">";
	echo "		<table width=\"348\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					ArticlesList($magic_categories['magic_all_articles'],3,10,0);
	echo "		</table>";
	echo "	</div>";
	echo "	<script type=\"text/javascript\">\n";
	echo "	<!--\n";
	echo "	var collapse11=new animatedcollapse(\"cat11\", 300, true);\n";
	echo "	if (animatedcollapse.getCookie(uniquepageid+\"_cat11\") == \"yes\"){\n";
	echo "		intImage['mnu_img_1'] = 2;\n";
	echo "	} else {\n";
	echo "		intImage['mnu_img_1'] = 1;\n";
	echo "	}\n";
	echo "	//-->\n";
	echo "</script>";
	$showtime = formatTime(time(),"YmdHis");
	/* Provereni zda je zadana nejaka TOP ARTICLES */
	$pieces = explode (":", $magic_categories['magic_all_articles']);
	$num1 = count($pieces);
	/* Nacteni nastaveni poctu zobrazovanych novinek */
	$i=0;
	$categories = FALSE;
	while($num1 > $i){
		$act_category_pieces = $pieces[$i];
		if ($i>0){$divider = ",";} else {$divider = "";}
		$categories .= $divider.(integer)$act_category_pieces;
		$i++;
	}
	$res = mysql_query("
	SELECT COUNT(*) 
	FROM $db_articles 
	WHERE article_category_id IN ($categories) AND article_public=0 AND article_publish=1 AND article_top_article=1 AND article_lang='".mysql_real_escape_string($_GET['lang'])."' AND $showtime BETWEEN article_date_on AND article_date_off 
	LIMIT 10") or die ("<strong>"._ERROR." 1</strong> ".mysql_error());
	$num = mysql_fetch_array($res);
	if ($num[0] > 0){
		$article_headline_first = "<div class=\"content_article_col_header\"><div class=\"content_article_col_title\">"._TOP_ARTICLES."</div></div>";
		$article_headline = "<div class=\"content_article_col_header\"><div class=\"content_article_col_title\">"._ARTICLES."</div></div>";
	} else {
		$article_headline_first = FALSE;
		$article_headline = "<div class=\"content_article_col_header\"><div class=\"content_article_col_title\">"._ARTICLES."</div></div>";
	}
	echo $article_headline_first;
	ZobrazeniNovFirst($magic_categories['magic_all_articles'],"cz");
	echo $article_headline;
	ZobrazeniNov(1,$magic_categories['magic_all_articles']);
	echo "<!-- *** ARTICLES - KONEC *** -->\n";
	echo "</div>\n";
	echo "<!-- ///////////////////////// ARTICLES - KONEC ///////////////////////// -->\n";
	echo "<!-- ///////////////////////// NEWS ///////////////////////// -->\n";
	echo "<div class=\"content_act_col\">";
	echo "	<div id=\"cat12\" style=\"margin-left:0px;width:251px;height:220px;background-color:#dedede;\">";
	echo "		<table width=\"251\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					NewsList($magic_categories['magic_all_news'],1,10);
	echo "		</table>";
	echo "	</div>\n";
	//************ REKLAMA 251x250 ************
	//echo "<div align=\"center\"><iframe name=\"reklama\" src=\"".$eden_cfg['url_edencms']."eden_iframe.php?imode=adds&amp;project=".$_SESSION['project']."&amp;rid=21\" width=\"251\" height=\"250\" frameborder=\"0\" marginwidth=\"0\" marginheight=\"0\"></iframe></div>";
	//************ REKLAMA 251x250 ************
	echo "<!-- *** NEWS *** -->\n";
	echo "<div class=\"content_act_col_header\">\n";
	echo "	<div class=\"content_act_col_title\">"._NEWS."</div>\n";
	echo "</div>\n";
	News($magic_categories['magic_all_news']);
	echo "<!-- *** NEWS - KONEC *** -->\n";
	echo "</div>\n";
	echo "<!-- ///////////////////////// NEWS - KONEC ///////////////////////// -->\n";
	echo "</div>\n";
} elseif ($_GET['action'] == "search"){
	echo "<div class=\"content_template_col\">\n";
	echo "	<div class=\"content_template_col_header\"><div id=\"content_forum_col_title\">"._SEARCH."</div></div>\n";
	echo "	<div id=\"content_template_col_cont\">\n";
	echo "			<div class=\"content_template_col_text\">\n";
						Search(30,0,1);
	echo "			<br>\n";
	echo "			</div>\n";
	echo "		</div>\n";
				SearchRes();
	echo "	</div>";
} elseif ($_GET['action'] == "forum"){
	echo "<div id=\"content_forum_col\">\n";
	echo "	<div id=\"content_forum_col_header\">\n";
	echo "		<div id=\"content_forum_col_title\">"._FORUM."</div>\n";
	echo "	</div>\n";
	echo "	<div id=\"content_forum_col_cont\">\n";
	echo "		<div id=\"content_forum_col_text\">";
					/* Pokud je vypnut pristup pro anonymy, tak se jim zobrazi jen login, nebo registrace */
					if ($_GET['faction'] == ""){ForumShowMain();}
					if ($_GET['faction'] == "tema"){ForumShowMain();}
					if ($_GET['faction'] == "topics"){ForumShowTopics($_GET['id1']);}
					if ($_GET['faction'] == "open"){ForumShowMain();}
					if ($_GET['faction'] == "close"){ForumShowMain();}
					if ($_GET['faction'] == "posts"){ForumPosts();}
					if ($_SESSION['u_status'] == "user" || $_SESSION['u_status'] == "admin"){
						if ($_GET['faction'] == "edit_f"){ForumAddTopic();}
						if ($_GET['faction'] == "del_f"){ForumDelForum();}
						if ($_GET['faction'] == "add_f"){ForumAddTopic();}
						if ($_GET['faction'] == "add_t"){ForumAddTopic();}
						if ($_GET['faction'] == "quote"){ForumPosts();}
						if ($_GET['faction'] == "post_preview"){ForumPosts();}
						if ($_GET['faction'] == "edit_post"){ForumPosts();}
						if ($_GET['faction'] == "del_post"){ForumPosts();}
						if ($_GET['faction'] == "pm"){ForumPM();}
						if ($_GET['faction'] == "pm_preview"){ForumPM();}
						if ($_GET['faction'] == "reportit"){ForumReportIt();}
						if ($_GET['faction'] == "otherusers"){ForumOtherUsers($_GET['sp_width'],$_GET['sp_mode']);}
						if ($_GET['faction'] == "friends"){ForumFriends($_GET['sp_width'],$_GET['sp_mode']);}
						if ($_GET['faction'] == "setup") { ForumUserSetup(); }
					}
	echo "		</div>";
	echo "	</div>";
} elseif ( $_GET['action'] == "playrooms" || 
	$_GET['action'] == "rules" || 
	$_GET['action'] == "market" || 
	$_GET['action'] == "fan_cards" || 
	$_GET['action'] == "fan_cards_comp" || 
	$_GET['action'] == "fan_cards_instr" || 
	$_GET['action'] == "decklist_show" || 
	$_GET['action'] == "decklists" || 
	$_GET['action'] == "decklist_add" || 
	$_GET['action'] == "decklist_edit" || 
	$_GET['action'] == "decklists_my" || 
	$_GET['action'] == "decklists_his" || 
	$_GET['action'] == "players_profiles" || 
	$_GET['action'] == "curiosity" || 
	$_GET['action'] == "online_magic" || 
	$_GET['action'] == "begining" ||
	$_GET['action'] == "card_list" || 
	$_GET['action'] == "browse_channel" || 
	$_GET['action'] == "player" || 
	$_GET['action'] == "playrooms_clubs" || 
	$_GET['action'] == "clubs" || 
	$_GET['action'] == "stream" || 
	$_GET['action'] == "eshops" || 
    $_GET['action'] == "tournaments"|| 
    $_GET['action'] == "tournament"){
		switch ($_GET['action']){
			case "player":
		   		$temp_title = "Hráčský účet";
			break;
			case "clanek":
				$temp_title = _ARTICLE;
			break;
			case "komentar":
				if ($_GET['modul'] == "news"){
					$temp_title = _TITLE_COMMENTS_ACT;
				} elseif ($_GET['modul'] == "poll"){
					$temp_title = _TITLE_COMMENTS_POLL;
				} elseif ($_GET['modul'] == "articles"){
					$temp_title = _TITLE_COMMENTS_ARTICLE;
				}
			break;
			case "browse_channel":
				$res_article_channel = mysql_query("SELECT article_channel_title FROM $db_articles_channel WHERE article_channel_id=".(float)$_GET['id']) or die ("<strong>"._ERROR."</strong> ".mysql_error());
				$ar_article_channel = mysql_fetch_array($res_article_channel);
				$temp_title = _TITLE_BROWSE_CHANNEL.' - '.$ar_article_channel['article_channel_title'];
				
			break;
			case "online_magic":
				$temp_title = "Online Magic";
			break;
			case "players_profiles":
				$temp_title = "Profily hráčů";
			break;
			case "card_list":
				$temp_title = "Seznam karet";
			break;
			case "curiosity":
				$temp_title = "Zajímavosti";
			break;
			case "begining":
				$temp_title = "Začínáme s Magic the Gathering";
			break;
			case "rules":
				$temp_title = "Pravidla";
			break;
			case "market":
				$temp_title = "Tržnice";
			break;
			case "tournaments":
				$temp_title = "Turnaje";
			break;
			case "tournament":
				$temp_title = "Turnaj";
			break;
			case "fan_cards":
				$temp_title = "Karty";
			break;
			case "fan_cards_comp":
				$temp_title = "Soutěže";
			break;
			case "fan_cards_instr":
				$temp_title = "Návod";
			break;
			case "decklist_show":
				$temp_title = "Decklist";
			break;
			case "decklists":
				$temp_title = "Decklisty";
			break;
			case "decklist_add":
				$temp_title = "Decklisty - Založit decklist";
			break;
			case "decklist_edit":
				$temp_title = "Decklisty - Editace decklistu";
			break;
			case "decklists_my":
				$temp_title = "Decklisty - Mé decklisty";
			break;
			case "decklists_his":
				$temp_title = "Decklisty - Decklisty uživatele ".GetNickName($_GET['aid'],1);
			break;
			case "playrooms_clubs":
				$temp_title = "Herny a Kluby";
			break;
			case "playrooms":
				$temp_title = "Herny";
			break;
			case "clubs":
				$temp_title = "Kluby";
			break;
			case "eshops":
				$temp_title = "eShopy";
			break;
			case "stream":
				$temp_title = "Streamy";
			break;
		}
		echo "<div class=\"content_article_home_col\">";
		echo "<div class=\"content_article_home_header\">";
		echo "	<div class=\"content_article_home_title\" style=\"text-align:center;\">".$temp_title."</div>";
		echo "</div>";
		$denied = "<div>\nPro zobrazení této funkce musíte být přihlášeni.\n</div>\n";
		switch ($_GET['action']){
			case "player":
				switch (AGet($_GET,'mode')){
					/*******************************************************
					*	PLAYER ACCOUNT
					*******************************************************/
					case "player_acc":
					   LeaguePlayerAcc($_GET['id'],578,583);
		   			break;
				}
   			break;
			case "browse_channel":
				ShowChannel($_GET['id'],1,0);
			break;
			case "":
				ZobrazeniNov(3,$magic_categories['magic_all_articles']);
			break;
			case "online_magic":
				ZobrazeniNov(3,15);
			break;
	        case "players_profiles":
				ZobrazeniNov(3,13);
			break;
			case "card_list":
				echo "doplnit!";
			break;
			case "curiosity":
				ZobrazeniNov(3,4);
			break;
			case "begining":
				ZobrazeniNov(3,11);
			break;
			case "rules":
				ZobrazeniNov(3,10);
			break;
			case "market":
				echo "doplnit!";
			break;
			case "fan_cards":
				ZobrazeniNov(3,17);
			break;
			case "fan_cards_comp":
				ZobrazeniNov(3,15);
			break;
			case "fan_cards_instr":
				ZobrazeniNov(3,16);
			break;
			case "decklist_show":
				$decklist = new MtGDecklists($eden_cfg);
				echo $decklist->showDecklist($_GET['did'], "standard");
				
				if ($_SESSION['loginid'] != ""){?>
					<div class="content_article_home_cont">
						<div class="content_article_home_text"><?php
							Comments($_GET['did'],"decklists",90,0,0,570,590,"DESC");?>
						</div>
					</div><?php
				} else {
					echo $denied;
				}
			break;
			case "decklists":
				$decklist = new MtGDecklists($eden_cfg);
				echo $decklist->showDecklists();
			break;
			case "decklist_add":?>
				<div class="content_article_home_cont">
					<div class="content_article_home_text" id="add_decklist_cards"><?php
				if ($_SESSION['loginid'] != ""){
			   		$decklist = new MtGDecklists($eden_cfg);
					echo $decklist->formAddDecklist();
				} else {
					echo $denied;
				}?>
					</div>
				</div><?php
			break;
			case "decklist_edit":?>
				<div class="content_article_home_cont">
					<div class="content_article_home_text" id="add_decklist_cards"><?php
				if ($_SESSION['loginid'] != ""){
					$decklist = new MtGDecklists($eden_cfg);
					echo $decklist->formEditDecklist($_GET['did']);
				} else {
					echo $denied;
				}?>
					</div>
				</div><?php
			break;
			case "decklists_my":
				if ($_SESSION['loginid'] != ""){
					$decklist = new MtGDecklists($eden_cfg);
					echo $decklist->showMyDecklists();
				} else {
					echo $denied;
				}
			break;
			case "decklists_his":
				$decklist = new MtGDecklists($eden_cfg);
				if ($_SESSION['loginid'] == $_GET['aid']){
					echo $decklist->showMyDecklists();
				} else {
					echo $decklist->showHisDecklists($_GET['aid']);
				}
			break;
			case "tournaments":
				$tournament = new Tournament($eden_cfg);
				echo $tournament->showTournaments();
			break;
			case "tournament":
				$tournament = new Tournament($eden_cfg);
				echo $tournament->showTournament($_GET['tid']);
			break;
			case "playrooms_clubs":
				echo ZobrazeniNov(3,"7:8:9");
			break;
			case "playrooms":
				echo ZobrazeniNov(3,7);
			break;
			case "clubs":
				ZobrazeniNov(3,8);
			break;
			case "eshops":
				ZobrazeniNov(3,9);
			break;
			case "stream":
				ZobrazeniNov(4,5,100);
			break;
			default:
				// Nic :)
		}
		echo '</div></div>';
	} else {
		echo "<div class=\"content_template_col\">\n";
	 		if($_GET['action'] != "msg"){
				switch ($_GET['action']){
					case "clanek":
						$temp_title = "Článek";
					break;
					case "komentar":
						$temp_title = "Komentář";
					break;
					case "dict":
						$temp_title = "Slovník pojmů";
					break;
					case "user_details":
						$temp_title = _TITLE_USER_PROFIL;
					break;
					case "user_edit":
						switch ($_GET['mode']){
							case "team_player_confirm":
								$temp_title = _USER_EDIT." - Vstup do teamu";
							break;
							default:
								$temp_title = _USER_EDIT;
						}
					break;
					case "whoisonline":
						$temp_title = _WHO_IS_ONLINE;
					break;
					case "mtg_show_card":
			   			$temp_title = "Detaily karty";
					break;
					case "mtg_card_list":
			   			$temp_title = "Seznam karet";
					break;
				}
			echo "	<div class=\"content_template_col_header\">\n";
			echo "		<div class=\"content_template_col_title\">".$temp_title."</div>\n";
			echo "	</div>\n";
			echo "	<div class=\"content_template_col_text\">\n";
				/*******************************************************
				*
				*	AKTUALITA
				*
				*******************************************************/
				if ($_GET['action'] == "aktualita"){Aktualita($_GET['id']);}
				/*******************************************************
				*
				*	ARCHIV & KAL ARCHIV
				*
				*******************************************************/
				if ($_GET['action'] == "archiv" || $_GET['action'] == "kal_archiv"){
					ArchivKalendar();
					if ($_GET['action'] == "archiv"){Archiv();}
				}
				/*******************************************************
				*
				*	BROWSE ARTICLES
				*
				*******************************************************/
				if ($_GET['action'] == "browse_articles"){
					echo "<div style=\"margin:0px 0px 5px 3px;\">";
					BrowseArticles();
					echo "</div>";
				}
				/*******************************************************
				*
				*	BROWSE TUTORIALS
				*
				*******************************************************/
				if ($_GET['action'] == "browse_articles_all"){
					echo "<div style=\"margin:0px 0px 5px 3px;\">";
					echo "<table width=\"588\" border=\"0\" cellspacing=\"2\" cellpadding=\"5\">";
					echo "	<tr id=\"blog_title\">";
					echo "		<td valign=\"top\"> </td>";
					echo "		<td width=\"60\" valign=\"top\">"._DATE."</td>";
					echo "		<td valign=\"top\">"._TITLE."</td>";
					echo "		<td width=\"40\">"._COMMENTS."</td>";
					echo "	</tr>";
						ArticlesList($magic_categories['cz_articles'],1,80,1);
					echo "</table>";
					echo "</div>";
				}
				/*******************************************************
				*
				*	BROWSE TUTORIALS
				*
				*******************************************************/
				if ($_GET['action'] == "browse_tutorials"){
					echo "<div style=\"margin:0px 0px 5px 3px;\">";
					echo "<table width=\"588\" border=\"0\" cellspacing=\"2\" cellpadding=\"5\">";
					echo "	<tr id=\"blog_title\">";
					echo "		<td valign=\"top\"> </td>";
					echo "		<td width=\"60\" valign=\"top\">"._DATE."</td>";
					echo "		<td valign=\"top\">"._TITLE."</td>";
					echo "		<td width=\"40\">"._COMMENTS."</td>";
					echo "	</tr>";
						ArticlesList($magic_categories['cz_tutorials'],1,80,1);
					echo "</table>";
					echo "</div>";
				}
				/*******************************************************
				*
				*	CLANEK
				*
				*******************************************************/
				if ($_GET['action'] == "clanek"){
					Clanek($_GET['id'],$_GET['par']);
				}
				/*******************************************************
				*
				*	DICTIONARY
				*
				*******************************************************/
				if ($_GET['action'] == "dict"){
					Dictionary();
				}
				/*******************************************************
				*
				*	SHOW LIST OF MTG CARDS
				*
				*******************************************************/
				if ($_GET['action'] == "mtg_card_list"){
					$mtg_list = new MtGShowCardList($eden_cfg);
					echo $mtg_list->showCardList($_GET['letter']);
				}
				/*******************************************************
				*
				*	SHOW MtG CARD
				*
				*******************************************************/
				if ($_GET['action'] == "mtg_show_card"){
					if ($_GET['card_id'] != ""){
						$card_id = $_GET['card_id'];
					}
					$mtg_card = new MtGShowCard($eden_cfg);
					echo $mtg_card->showCard($card_id);
				}
				/*******************************************************
				*
				*	FORGOTTEN PASS
				*
				*******************************************************/
				if ($_GET['action'] == "forgotten_pass"){ForgottenPass();}
				/*******************************************************
				*
				*	KOMENTAR
				*
				*******************************************************/
				if ($_GET['action'] == "komentar"){Comments($_GET['id'],$_GET['modul'],120,584,400,584,584);}
				/*******************************************************
				*
				*	TEAMS LIST
				*
				*******************************************************/
				if ($_GET['action'] == "teams_list"){
					echo "<table width=\"600\" border=\"0\" cellspacing=\"2\" cellpadding=\"1\"><p><strong>"._ADD_LINK_HELP."</strong></p>";
					AddLink(16,1);
					echo "	<tr>";
					echo "		<td colspan=\"2\">"; OdkazyKat(343,1); echo "</td>";
					echo "	</tr>";
					echo "</table>";
 				}
				/*******************************************************
				*
				*	POLLS - OLD
				*
				*******************************************************/
				if ($_GET['action'] == "oldpolls"){
					echo "<div style=\"margin:0px 0px 5px 3px;\">";
					$older_poll = new OlderPoll;
					$older_poll->poll_table_width = 588;
					$older_poll->poll_column_height = 10;
					$older_poll->poll_l_width = 500;
					$older_poll->poll_r_width = 40;
					$older_poll->poll_q_for = 2;
					$older_poll->poll_hits = 50;
					$older_poll->OlderPolls();
					echo "</div>";
				}
				/*******************************************************
				*
				*	REGISTRACE
				*
				*******************************************************/
				if ($_GET['action'] == "reg"){
					UserEdit("reg");
				}
				/*******************************************************
				*
				*	TEAM
				*
				*******************************************************/
				if ($_GET['action'] == "team"){
					$vysledek = mysql_query("SELECT admin_category_id, admin_category_topicimage, admin_category_topictext FROM $db_admin_category WHERE admin_category_shows=1 ORDER BY admin_category_topictext") or die ("<strong>"._ERROR." </strong> ".mysql_error());
					while ($ar = mysql_fetch_array($vysledek)){
						echo "<table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" id=\"eden_atc_01\">\n";
						echo "<tr>\n";
						echo "	<td colspan=\"5\" id=\"eden_atc_07\"><br><img src=\"".$url_category.$ar['admin_category_topicimage']."\" alt=\".\" width=\"16\" height=\"16\" border=\"0\">&nbsp;"; $category_name = explode ("]", $ar['admin_category_topictext']); if ($category_name[1] != ""){echo $category_name[1];} else {echo $category_name[0];} echo "</td>\n";
						echo "</tr>\n";
						ZobrazeniAdminTeam($ar['admin_category_id']);
						echo "</table>";
 					}
				}
				/*******************************************************
				*
				*	USER EDIT
				*
				*******************************************************/
				if ($_GET['action'] == "user_edit"){
					switch ($_GET['mode']){
						case "guids":
							UserEditGuid($_GET['mode']);
						break;
						case "guid_add":
							UserEditGuid($_GET['mode']);
						break;
						case "guid_edit":
							UserEditGuid($_GET['mode']);
						break;
						default:
							UserEdit("edit_user");
					}
					
				}
				/*******************************************************
				*
				*	USER DETAILS
				*
				*******************************************************/
				if ($_GET['action'] == "user_details"){
					if ($_SESSION['u_status'] == "user" || $_SESSION['u_status'] == "admin"){
						$user = new User($eden_cfg);
						echo $user->showUserDetails($_GET['user_id'], "basic");
						// Used not in template so template can be used somewhere else without comments
						echo "		<div id=\"eden_league_player_personal_comm\">";
		   				Comments($_GET['user_id'],"user",90,0,0,570,590,"DESC");
   						echo "		</div>";
					} else {
						echo _ONLY_FOR_USERS;
					}
				}
				/*******************************************************
				*
				*	USERS LIST
				*
				*******************************************************/
				if ($_GET['action'] == "users_list" || $_GET['action'] == "users"){
					echo "<!-- <form action=\"index.php?lang=".$_GET['lang']."&amp;action=users&amp;sa=form\" method=\"post\" enctype=\"text/plain\">";
					echo "<input name=\"ul_word\" type=\"text\" height=\"10\" maxlength=\"20\">";
					echo "</form> --><br><br>";
					Alphabeth('index.php?action=users&amp;lang='.$_GET['lang'].'&amp;filter='.$_GET['filter'].'&amp;sa=form&amp;ul_letter=',''); echo "<br><br>";
					if ($_GET['sa'] == "form"){ echo "<table>"; UsersList($_GET['ul_letter'],$ul_word); echo "</table>"; }
 				}
				/*******************************************************
				*
				*	WHO IS ONLINE
				*
				*******************************************************/
				if ($_GET['action'] == "whoisonline"){
					WhoIsOnline();
				}
			echo "</div>";
			echo "</div>";
		}
		if ($_GET['action'] == "kal_archiv"){
			ShowArchivKalendar();}
			echo "</div>";
		}
echo "<!-- //////////////////////////////////////////////////////// CENTER - END ////////////////////////////////////////////////// -->";
echo "<!-- //////////////////////////////////////////////////////// RIGHT ////////////////////////////////////////////////// -->";
if($_GET['action'] != "forum"){
	echo "	<!-- ///////////////////////// RIGHT ///////////////////////// -->\n";
	echo "	<div class=\"content_side_col\">\n";
	
	echo "<a href=\"http://www.magic-live.cz/index.php?action=decklist_add\" target=\"_self\"><img src=\"images/vlastni-decklist.gif\" width=\"177\" height=\"132\" alt=\"Vytvořte si vlastní decklist\" /></a>";
	
	echo "	<!-- *** DECKLISTY ZUZIVATELU *** -->\n";
	echo "	<div class=\"content_side_col_header\">\n";
	echo "		<div class=\"content_side_col_title\">Decklisty uživatelů</div>\n";
	echo "	</div>\n";
	echo "	<div class=\"content_side_col_cont\">\n";
					$decklist = new MtGDecklists($eden_cfg);
					echo $decklist->showDecklistsSmall(10);
					echo "<div style=\"margin-left:35px;\"><input type=\"button\" value=\"Přidat decklist\" onclick=\"window.open('index.php?action=decklist_add', '_self')\" class=\"eden_button\"/></div><br />";
	echo "	</div>\n";
	echo "	<!-- *** DECKLISTY UZIVATELU - KONEC *** -->\n";
	
	
	echo "	<!-- *** TURNAJE *** -->\n";
	echo "	<div class=\"content_side_col_header\">\n";
	echo "		<div class=\"content_side_col_title\">Turnaje</div>\n";
	echo "	</div>\n";
	echo "	<div class=\"content_side_col_cont\">\n";
				$tournaments = new Tournament($eden_cfg);
				echo $tournaments->showNajadaTournamentsSmall(10);
	echo "	</div>\n";
	echo "	<!-- *** TURNAJE - KONEC *** -->\n";
	
	
	echo "	<!-- *** CZ/SK HRACI *** -->\n";
	echo "	<div class=\"content_side_col_header\">\n";
	echo "		<div class=\"content_side_col_title\">CZ/SK Hráči</div>\n";
	echo "	</div>\n";
	echo "	<div class=\"content_side_col_cont\">\n";
	echo "		<div class=\"content_side_col_text\" style=\"min-height:130px;\">\n";
				   echo ShowProfile();
	echo "		</div>\n";
	echo "	</div>\n";
	echo "	<!-- *** CZ/SK HRACI - KONEC *** -->\n";
	
	
	echo "	<!-- *** PARTNERS *** -->\n";
	echo "	<div class=\"content_side_col_header\">\n";
	echo "		<div class=\"content_side_col_title\">Partneři webu</div>\n";
	echo "	</div>\n";
	echo "	<div class=\"content_side_col_cont\">\n";
	echo "		<div class=\"content_side_col_text\"><br>\n";
	echo "			<div class=\"content_side_col_text\" style=\"text-align:center; margin: 0px 0px 10px -6px; \">"; OdkazySamotneId(12); echo "<br></div> \n";
	echo "		</div>\n";
	echo "	</div>\n";
	echo "	<!-- *** PARTNERS - KONEC *** -->\n";
	
	
	echo "	<!-- *** NAHODNA KARTA *** -->\n";
	echo "	<div class=\"content_side_col_header\">\n";
	echo "		<div class=\"content_side_col_title\">Náhodná karta</div>\n";
	echo "	</div>\n";
	echo "	<div class=\"content_side_col_cont\">\n";
	echo "		<div style=\"width:163px; height: 234px; border:6px solid #000000;border-radius:10px;-moz-border-radius:6px;\">";
				$MtGRandomCard = new MtGRandomCards($eden_cfg);
				echo $MtGRandomCard->showRandomCard();
	echo "		</div>";
	echo "	</div>\n";
	echo "	<!-- *** NAHODNA KARTA - KONEC *** -->\n";
	
	
	echo "			<div>"; /*Reklama(48);*/ echo "<br></div> \n";
	echo "</div>\n";
	echo "<!-- ///////////////////////// RIGHT - KONEC ///////////////////////// -->\n";
}
echo "<!-- //////////////////////////////////////////////////////// RIGHT - END ////////////////////////////////////////////////// -->\n";
echo "<!-- //////////////////////////////////////////////////////// FOOTER ////////////////////////////////////////////////// -->\n";
echo "</div>\n";
echo "<div id=\"footer\">\n";
echo "	<div id=\"footer_text\">&copy; Magic-live.cz, ".date("Y")."&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "	<a href=\"mailto:".TransToASCII("redakce@magic-live.cz")."\">redakce</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "	<a href=\"mailto:".TransToASCII("inzerce@magic-live.cz")."\">inzerce</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "	<a href=\"mailto:".TransToASCII("webmaster@magic-live.cz")."\">webmaster</a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "	</div>\n";
//echo _SCRIPT_TIME; $time_end = getmicrotime(); $time = $time_end - $time_start; echo $time;
echo "</div>\n";
echo "<!-- hlavni -->\n";
if ($eden_cfg['misc_local'] == 0){
	echo "<!-- Google analytics - Start -->\n";?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40248557-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php
	echo "<!-- Google analytics - End -->\n";
}

echo "</div>\n";
echo "</body>\n";
echo "</html>";