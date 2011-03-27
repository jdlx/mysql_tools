<?php
/**
* Addon_Template
*
* @author http://rexdev.de
* @link   http://www.redaxo.de/180-0-addon-details.html?addon_id=720
*
* @package redaxo4.3
* @version 0.1
* $Id$:
*/



// ADDON VARS
////////////////////////////////////////////////////////////////////////////////
$mypage = 'mysql_tools';
$myroot = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/';


// ADDON REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['rxid'][$mypage]        = '895';
$REX['ADDON']['page'][$mypage]        = $mypage;
$REX['ADDON']['name'][$mypage]        = 'MySQL Tools';
$Revision = '';
$REX['ADDON'][$mypage]['VERSION'] = array
(
'VERSION'      => 0,
'MINORVERSION' => 1,
'SUBVERSION'   => preg_replace('/[^0-9]/','',"$Revision$")
);
$REX['ADDON']['version'][$mypage]     = implode('.', $REX['ADDON'][$mypage]['VERSION']);
$REX['ADDON']['author'][$mypage]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$mypage]        = $mypage.'[]';
$REX['PERM'][]                        = $mypage.'[]';


// SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX["ADDON"]["mysql_tools"]["httpsdomain"] = '';
// --- /DYN


// AUTO INCLUDE FUNCTIONS & CLASSES
////////////////////////////////////////////////////////////////////////////////
if ($REX['REDAXO'])
{
  foreach (glob($myroot.'functions/function.*.inc.php') as $include)
  {
    require_once $include;
  }

  foreach (glob($myroot.'classes/class.*.inc.php') as $include)
  {
    require_once $include;
  }
}


// BACKEND CSS
////////////////////////////////////////////////////////////////////////////////
$header = '  <link rel="stylesheet" type="text/css" href="../files/addons/'.$mypage.'/backend.css" media="screen, projection, print" />';

if ($REX['REDAXO']) {
  rex_register_extension('PAGE_HEADER', 'rexdev_header_add',array($header));
}


// SUBPAGES
//////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$mypage]['SUBPAGES'] = array (
  //     subpage    ,label                         ,perm   ,params               ,attributes
  array (''         ,'Settings'                    ,''     ,''                   ,''),
  array ('adminer'  ,'Adminer'                     ,''     ,''                   ,''),
  array ('sqlbuddy' ,'SQLBuddy'                    ,''     ,''                   ,''),
  array ('help'     ,'Hilfe'                       ,''     ,''                   ,''),
);


// DUMP HTACCESS FILES
//////////////////////////////////////////////////////////////////////////////
$adminer_ht  = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/libs/adminer-3.2.1/adminer/.htaccess';
$editor_ht   = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/libs/adminer-3.2.1/editor/.htaccess';
$sqlbuddy_ht = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/libs/sqlbuddy-1.3.3/.htaccess';

if($REX['REDAXO'] && !isset($REX['USER']))
{
  if(file_exists($adminer_ht))
    unlink($adminer_ht);
  if(file_exists($editor_ht))
    unlink($editor_ht);
  if(file_exists($sqlbuddy_ht))
    unlink($sqlbuddy_ht);
}