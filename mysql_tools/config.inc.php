<?php
/**
* MySQL Tools Addon
*
* @author http://rexdev.de
*
* @package redaxo4.3
* @version 0.1
* $Id$:
*/

//fb($REX['USER']->getValue('identifier'));

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


// STATIC ADDON SETTINGS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$mypage]['ht_files']    = array(
 'sqlbuddy' => $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/libs/sqlbuddy-1.3.3/.htaccess',
 'adminer'  => $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/libs/adminer-3.2.1/adminer/.htaccess',
 'editor'   => $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/libs/adminer-3.2.1/editor/.htaccess'
);
$REX['ADDON'][$mypage]['params_cast'] = array (
  'page'        => 'unset',
  'subpage'     => 'unset',
  'func'        => 'unset',
  'submit'      => 'unset',
  'sendit'      => 'unset',
  'httpsdomain' => 'https',
  );


// ADDON SUBPAGES
//////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$mypage]['SUBPAGES'] = array (
  //     subpage    ,label                         ,perm   ,params               ,attributes
  array (''         ,'Settings'                    ,''     ,''                   ,''),
  array ('sqlbuddy' ,'SQLBuddy'                    ,''     ,''                   ,''),
  array ('adminer'  ,'Adminer'                     ,''     ,''                   ,''),
  array ('editor'   ,'Adminer Editor'              ,''     ,''                   ,''),
  array ('help'     ,'Hilfe'                       ,''     ,''                   ,''),
);


// DYN SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX["ADDON"]["mysql_tools"]["settings"] = array (
  'httpsdomain' => '',
  'sessions' => array ()
);
// --- /DYN


// INCLUDES
////////////////////////////////////////////////////////////////////////////////
require_once $myroot.'functions/function.a895_commons.inc.php';


// DUMP ALL HTACCESS ON LOGOUT
//////////////////////////////////////////////////////////////////////////////
if($REX['REDAXO'] && !isset($REX['USER']))
{
  a895_logoutCleanup();
}