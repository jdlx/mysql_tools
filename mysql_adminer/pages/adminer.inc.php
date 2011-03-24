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
$myself      = rex_request('page'     ,'string');
$subpage     = rex_request('subpage'  ,'string');
$func        = rex_request('func'     ,'string');
$httpsdomain =  rex_request('httpsdomain'     ,'string');


// SAVE SETTINGS
////////////////////////////////////////////////////////////////////////////////
if($func=='savesettings')
{
  $httpsdomain = rtrim(trim($httpsdomain),'/');
  $httpsdomain = str_replace('https://','',$httpsdomain);

  $REX['ADDON'][$myself]['httpsdomain'] = $httpsdomain;

  $DYN = '$REX["ADDON"]["'.$myself.'"]["httpsdomain"] = \''.$httpsdomain.'\';';
  $file = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/config.inc.php';

  rex_replace_dynamic_contents($file, $DYN);
  echo rex_info('Einstellungen wurden gespeichert.');
}


// MAIN PAGE
////////////////////////////////////////////////////////////////////////////////
if($func=='' || $func=='savesettings')
{
echo '
  <div class="rex-addon-output">
    <div class="rex-form">

    <form action="index.php" method="POST"">
      <input type="hidden" name="page"            value="'.$myself.'" />
      <input type="hidden" name="subpage"         value="'.$subpage.'" />
      <input type="hidden" name="func"            value="savesettings" />
      

          <fieldset class="rex-form-col-1">
            <legend>Settings</legend>
            <div class="rex-form-wrapper">

              <div class="rex-form-row">
                <p class="rex-form-col-a rex-form-text">
                  <label for="httpsdomain">HTTPS Domain:</label>
                  <strong>https://</strong> <input style="width:200px;" id="httpsdomain" class="rex-form-text" type="text" name="httpsdomain" value="'.stripslashes($REX['ADDON'][$myself]['httpsdomain']).'" />
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
  </div><!-- .rex-addon-output -->

  <div class="rex-addon-output">
    <div class="rex-form">

    <form action="index.php" method="POST"">
      <input type="hidden" name="page"            value="'.$myself.'" />
      <input type="hidden" name="subpage"         value="'.$subpage.'" />
      <input type="hidden" name="func"            value="sessionstart" />

          <fieldset class="rex-form-col-1">
            <legend>Adminer 3.2.0</legend>
            <div class="rex-form-wrapper">

              <div class="rex-form-row rex-form-element-v2">
                <p class="rex-form-submit">
                  <input class="rex-form-submit" type="submit" id="submit" name="submit" value="Adminer Session starten" />
                </p>
              </div><!-- .rex-form-row -->

            </div><!-- .rex-form-wrapper -->
          </fieldset>

    </form>

    </div><!-- .rex-form -->
  </div><!-- .rex-addon-output -->';
}


// LAUNCH ADMINER
////////////////////////////////////////////////////////////////////////////////
if($func=='sessionstart')
{
  // ADD IP TO HTACCESS
  $ht_file  = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/libs/adminer-3.2.0/adminer/.htaccess';
  $ht_conts = 'Allow from '.$_SERVER['REMOTE_ADDR'];
  rex_put_file_contents($ht_file,$ht_conts);

  // SWITCH HTTP/HTTPS
  if($REX['ADDON'][$myself]['httpsdomain']!='')
  {
    $domain = 'https://'.$REX['ADDON'][$myself]['httpsdomain'];
  }
  else
  {
    $domain = 'http://'.$_SERVER['HTTP_HOST'];
  }

echo '
  <div class="rex-addon-output">
    <div class="rex-form">
  
    <form id="openadminer" action="'.$domain.'/redaxo/include/addons/'.$myself.'/libs/adminer-3.2.0/adminer/index.php" method="POST" target="'.$_REQUEST['PHPSESSID'].'">
      <input type="hidden" name="username"        value="'.$REX['DB']['1']['LOGIN'].'" />
      <input type="hidden" name="server"          value="'.$REX['DB']['1']['HOST'].'" />
      <input type="hidden" name="password"        value="'.$REX['DB']['1']['PSW'].'" />
      <input type="hidden" name="db"              value="'.$REX['DB']['1']['NAME'].'" />
      <input type="hidden" name="adminer_version" value="3.2.0" />
      <input type="hidden" name="driver"          value="server" />
      
          <fieldset class="rex-form-col-1">
            <legend>Adminer Login..</legend>
            <div class="rex-form-wrapper">
  
              <div class="rex-form-row rex-form-element-v2">
                <p class="rex-form-submit">
                  <input class="rex-form-submit" type="submit" value="Adminer Fenster öffnen" />
                </p>
              </div><!-- .rex-form-row -->
  
            </div><!-- .rex-form-wrapper -->
          </fieldset>
  
    </form>
  
    </div><!-- .rex-form -->
  </div><!-- .rex-addon-output -->

  <script type="text/javascript">
    document.getElementById("openadminer").submit();
  </script>
  ';
}
?>
