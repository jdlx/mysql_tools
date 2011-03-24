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


// ADDON IDENTIFIER AUS ORDNERNAMEN ABLEITEN
////////////////////////////////////////////////////////////////////////////////
$myself = explode('/redaxo/include/addons/',str_replace(DIRECTORY_SEPARATOR, '/' ,__FILE__));
$myself = explode('/',$myself[1]);
$myself = $myself[0];
$myroot = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/';


// ADDON REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['rxid'][$myself]        = '720';
$REX['ADDON']['page'][$myself]        = $myself;
$REX['ADDON']['name'][$myself]        = 'MySQL Adminer';
$Revision = '';
$REX['ADDON'][$myself]['VERSION'] = array
(
'VERSION'      => 0,
'MINORVERSION' => 1,
'SUBVERSION'   => preg_replace('/[^0-9]/','',"$Revision$")
);
$REX['ADDON']['version'][$myself]     = implode('.', $REX['ADDON'][$myself]['VERSION']);
$REX['ADDON']['author'][$myself]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself]        = $myself.'[]';
$REX['PERM'][]                        = $myself.'[]';


// SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX["ADDON"]["mysql_adminer"]["httpsdomain"] = '';
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
$header = '  <link rel="stylesheet" type="text/css" href="../files/addons/'.$myself.'/backend.css" media="screen, projection, print" />';

if ($REX['REDAXO']) {
  rex_register_extension('PAGE_HEADER', 'rexdev_header_add',array($header));
}


// SUBPAGES
//////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$myself]['SUBPAGES'] = array (
  //     subpage    ,label                         ,perm   ,params               ,attributes
  array (''         ,'Adminer'                     ,''     ,''                   ,''),
  array ('help'     ,'Hilfe'                       ,''     ,''                   ,''),
);


// DUMP HTACCESS FILES
//////////////////////////////////////////////////////////////////////////////
$adminer_ht  = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/libs/adminer-3.2.1/adminer/.htaccess';
$editor_ht   = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/libs/adminer-3.2.1/editor/.htaccess';

if($REX['REDAXO'] && !isset($REX['USER']))
{
  if(file_exists($adminer_ht))
    unlink($adminer_ht);
  if(file_exists($editor_ht))
    unlink($editor_ht);
}