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
      <input type="hidden" name="func"            value="sqlbuddystart" />

          <fieldset class="rex-form-col-1">
            <legend>SQLBuddy 1.3.3</legend>
            <div class="rex-form-wrapper">

              <div class="rex-form-row rex-form-element-v2">
                <p class="rex-form-submit">
                  <input class="rex-form-submit" type="submit" id="submit" name="submit" value="SQLBuddy Session starten" />
                </p>
              </div><!-- .rex-form-row -->

            </div><!-- .rex-form-wrapper -->
          </fieldset>

    </form>

    </div><!-- .rex-form -->
  </div><!-- .rex-addon-output -->';
}


// LAUNCH SQLBUDDY
////////////////////////////////////////////////////////////////////////////////
if($func=='sqlbuddystart')
{
  // SETUP HTACCESS
  $ht_file  = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/libs/sqlbuddy-1.3.3/.htaccess';
  $ht_conts = 'Order Deny,Allow
Deny from all
Allow from '.$_SERVER['REMOTE_ADDR'];
  rex_put_file_contents($ht_file,$ht_conts);

  echo '
  <div class="rex-addon-output">
    <div class="rex-form">
  
    <form id="opensqlbuddy" action="'.$domain.'/redaxo/include/addons/'.$mypage.'/libs/sqlbuddy-1.3.3/login.php" method="POST" target="sqlbuddy_'.$_REQUEST['PHPSESSID'].'">
      <input type="hidden" name="USER"        value="'.$REX['DB']['1']['LOGIN'].'" />
      <input type="hidden" name="HOST"        value="'.$REX['DB']['1']['HOST'].'" />
      <input type="hidden" name="PASS"        value="'.$REX['DB']['1']['PSW'].'" />
      <input type="hidden" name="DATABASE"    value="'.$REX['DB']['1']['NAME'].'" />
      <input type="hidden" name="ADAPTER"     value="mysql" />

      
          <fieldset class="rex-form-col-1">
            <legend>SQLBuddy Login..</legend>
            <div class="rex-form-wrapper">
  
              <div class="rex-form-row rex-form-element-v2">
                <p class="rex-form-submit">
                  <input class="rex-form-submit" type="submit" value="SQLBuddy Fenster öffnen" />
                </p>
              </div><!-- .rex-form-row -->
  
            </div><!-- .rex-form-wrapper -->
          </fieldset>
  
    </form>
  
    </div><!-- .rex-form -->
  </div><!-- .rex-addon-output -->

  <script type="text/javascript">
    document.getElementById("opensqlbuddy").submit();
  </script>
  ';
}