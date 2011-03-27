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

// PARAMS
////////////////////////////////////////////////////////////////////////////////
$mypage      = rex_request('page'     ,'string');
$subpage     = rex_request('subpage'  ,'string');
$func        = rex_request('func'     ,'string');


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
if($func=='')
{
echo '
  <div class="rex-addon-output">
    <div class="rex-form">

    <form action="index.php" method="POST"">
      <input type="hidden" name="page"            value="'.$mypage.'" />
      <input type="hidden" name="subpage"         value="'.$subpage.'" />
      <input type="hidden" name="func"            value="adminerstart" />

          <fieldset class="rex-form-col-1">
            <legend>Adminer 3.2.1</legend>
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
  </div><!-- .rex-addon-output -->

  <div class="rex-addon-output">
    <div class="rex-form">

    <form action="index.php" method="POST"">
      <input type="hidden" name="page"            value="'.$mypage.'" />
      <input type="hidden" name="subpage"         value="'.$subpage.'" />
      <input type="hidden" name="func"            value="editorstart" />

          <fieldset class="rex-form-col-1">
            <legend>Adminer Editor 3.2.1</legend>
            <div class="rex-form-wrapper">

              <div class="rex-form-row rex-form-element-v2">
                <p class="rex-form-submit">
                  <input class="rex-form-submit" type="submit" id="submit" name="submit" value="Editor Session starten" />
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
if($func=='adminerstart')
{
  // SETUP HTACCESS
  $ht_file  = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/libs/adminer-3.2.1/adminer/.htaccess';
  $ht_conts = 'Order Deny,Allow
Deny from all
Allow from '.$_SERVER['REMOTE_ADDR'];
  rex_put_file_contents($ht_file,$ht_conts);

  echo '
  <div class="rex-addon-output">
    <div class="rex-form">
  
    <form id="openadminer" action="'.$domain.'/redaxo/include/addons/'.$mypage.'/libs/adminer-3.2.1/adminer/index.php" method="POST" target="adminer_'.$_REQUEST['PHPSESSID'].'">
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


// LAUNCH EDITOR
////////////////////////////////////////////////////////////////////////////////
if($func=='editorstart')
{
  // SETUP HTACCESS
  $adminer_ht  = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/libs/adminer-3.2.1/adminer/.htaccess';
  $editor_ht   = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/libs/adminer-3.2.1/editor/.htaccess';
  $ht_conts    = 'Order Deny,Allow
Deny from all
Allow from '.$_SERVER['REMOTE_ADDR'];
  rex_put_file_contents($adminer_ht,$ht_conts);
  rex_put_file_contents($editor_ht ,$ht_conts);

echo '
  <div class="rex-addon-output">
    <div class="rex-form">
  
    <form id="openeditor" action="'.$domain.'/redaxo/include/addons/'.$mypage.'/libs/adminer-3.2.1/editor/index.php" method="POST" target="adminereditor_'.$_REQUEST['PHPSESSID'].'">
      <input type="hidden" name="username"        value="'.$REX['DB']['1']['LOGIN'].'" />
      <input type="hidden" name="server"          value="'.$REX['DB']['1']['HOST'].'" />
      <input type="hidden" name="password"        value="'.$REX['DB']['1']['PSW'].'" />
      <input type="hidden" name="db"              value="'.$REX['DB']['1']['NAME'].'" />
      <input type="hidden" name="adminer_version" value="3.2.0" />
      <input type="hidden" name="driver"          value="server" />
      
          <fieldset class="rex-form-col-1">
            <legend>Adminer Editor Login..</legend>
            <div class="rex-form-wrapper">
  
              <div class="rex-form-row rex-form-element-v2">
                <p class="rex-form-submit">
                  <input class="rex-form-submit" type="submit" value="Adminer Editor Fenster öffnen" />
                </p>
              </div><!-- .rex-form-row -->
  
            </div><!-- .rex-form-wrapper -->
          </fieldset>
  
    </form>
  
    </div><!-- .rex-form -->
  </div><!-- .rex-addon-output -->

  <script type="text/javascript">
    document.getElementById("openeditor").submit();
  </script>
  ';
}