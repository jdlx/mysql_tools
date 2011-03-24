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

// ADDON IDENTIFIER AUS GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$myself = rex_request('addonname','string');


$REX['ADDON']['install'][$myself] = 0;
