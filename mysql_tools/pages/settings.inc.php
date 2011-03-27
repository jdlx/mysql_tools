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

// PARAMS
////////////////////////////////////////////////////////////////////////////////
$mypage      = rex_request('page'     ,'string');
$subpage     = rex_request('subpage'  ,'string');
$func        = rex_request('func'     ,'string');
$httpsdomain = rex_request('httpsdomain'     ,'string');


// SAVE SETTINGS
////////////////////////////////////////////////////////////////////////////////
if($func=='savesettings')
{
  $httpsdomain = rtrim(trim($httpsdomain),'/');
  $httpsdomain = str_replace('https://','',$httpsdomain);

  $REX['ADDON'][$mypage]['httpsdomain'] = $httpsdomain;

  $DYN = '$REX["ADDON"]["'.$mypage.'"]["httpsdomain"] = \''.$httpsdomain.'\';';
  $file = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/config.inc.php';

  rex_replace_dynamic_contents($file, $DYN);
  echo rex_info('Einstellungen wurden gespeichert.');
}


// SWITCH HTTP/HTTPS
if($REX['ADDON'][$mypage]['httpsdomain']!='')
{
  $domain = 'https://'.$REX['ADDON'][$mypage]['httpsdomain'];
}
else
{
  $domain = 'http://'.$_SERVER['HTTP_HOST'];
}


// MAIN PAGE
////////////////////////////////////////////////////////////////////////////////
if($func=='' || $func=='savesettings')
{
echo '
  <div class="rex-addon-output">
    <div class="rex-form">

    <form action="index.php" method="POST"">
      <input type="hidden" name="page"            value="'.$mypage.'" />
      <input type="hidden" name="subpage"         value="'.$subpage.'" />
      <input type="hidden" name="func"            value="savesettings" />
      

          <fieldset class="rex-form-col-1">
            <legend>Addon Settings</legend>
            <div class="rex-form-wrapper">

              <div class="rex-form-row">
                <p class="rex-form-col-a rex-form-text">
                  <label for="httpsdomain">HTTPS Domain:</label>
                  <strong>https://</strong> <input style="width:200px;" id="httpsdomain" class="rex-form-text" type="text" name="httpsdomain" value="'.stripslashes($REX['ADDON'][$mypage]['httpsdomain']).'" />
                </p>
              </div><!-- .rex-form-row -->

              <div class="rex-form-row rex-form-element-v2">
                <p class="rex-form-submit">
                  <input class="rex-form-submit" type="submit" id="submit" name="submit" value="Einstellungen sichern" />
                </p>
              </div><!-- .rex-form-row -->

            </div><!-- .rex-form-wrapper -->
          </fieldset>

    </form>

    </div><!-- .rex-form -->
  </div><!-- .rex-addon-output -->';
}
