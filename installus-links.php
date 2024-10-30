<?php
/*
Plugin Name: Installus links
Plugin URI:
Description: Automatically replace .EXE links for your global audience and allows you to earn commissions on installus.net.
Version: 1.0
Author: installus.net
Author URI: https://installus.net
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//Change this if you need to run a migration (eg change setting names, dbm etc). See installus_ile_update_db_check()
global $installus_ile_db_version;
$installus_ile_db_version = '1.0';

// OPTIONS

function activate_installus_ile() {
  global $installus_ile_db_version;

  add_option('installus_ile_site_id', '');
  add_option('installus_ile_ext', 'exe,zip,doc,pdf');
  add_option('installus_ile_api_remind', 'yes');
  add_option('installus_ile_db_version', $installus_ile_db_version);
  add_option('installus_ile_install_date', time());

}

function deactivate_installus_ile() {

  delete_option('installus_ile_site_id');
  delete_option('installus_ile_ext');
  delete_option('installus_ile_api_remind');
  delete_option('installus_ile_db_version');

}

function admin_init_installus_ile() {

  register_setting('installus-links', 'installus_ile_site_id');
  register_setting('installus-links', 'installus_ile_ext');
  register_setting('installus-links', 'installus_ile_api_remind');
  register_setting('installus-links', 'installus_ile_db_version');

}

function admin_menu_installus_ile() {
  add_options_page('Installus links', 'Installus links', 'manage_options', 'installus-links', 'options_page_installus_ile');
}

function options_page_installus_ile() {
  $dir = plugin_dir_path( __FILE__ );
  include($dir.'options.php');
}



// Show notice in dashboard home page and plugin page if API isn't connected
function installus_ile_admin_notice(){

  if (strpos($_SERVER['PHP_SELF'],'wp-admin/index.php') !== false  || strpos($_SERVER['PHP_SELF'],'wp-admin/plugins.php') !== false ) {
    if (get_option('installus_ile_api_remind') == 'yes' && !get_option('installus_ile_site_id')) {
      ?>
      <div class="update-nag">
        <p><?php _e('<strong>Installus Plugin is installed. Want to earn commissions? </strong>
        <br> Please <a href="'.admin_url().'options-general.php?page=installus-links">enter your SiteID</a>. Or, you can <a href="'.admin_url().'options-general.php?page=installus-links">disable this reminder</a>'); ?>.</p>
      </div>
    <?php
    }
  }
}

// BEGIN FUNCTION TO SHOW installusLINK JS

function installus_ile()
{

?>
  <script>
    (function () {
      var getUrl = function (filename, filelink) {
        var siteid = "<?php echo get_option('installus_ile_site_id'); ?>";
        var filesize = '20 Mb';
        return 'http://installus.net/downloader2.php?h=' + btoa(JSON.stringify({
              siteid: siteid, postbackparam: '0', filename: filename,
              filelink: filelink, filesize: filesize
            })).replace('+', '-').replace('/', '_').replace('=', ',');
      };
      var installus_ext = "<?php echo get_option('installus_ile_ext'); ?>".split(',');
      var a = document.getElementsByTagName("a"), aLen = a.length;
      for (var i = 0; i < aLen; i++)
        if (a[i].href.indexOf('http') === 0) {
          var ext_found = false;
          for (var j = 0; j < installus_ext.length && !ext_found; j++) {
            var r = new RegExp('([a-z0-9_а-я]+)\.' + installus_ext[j], 'i');
            var match = a[i].href.match(r);
            if (match) {
              ext_found = true;
              a[i].href = getUrl(match[1], a[i].href);
            }
          }
        }
    })();
  </script>

<?php
}
// END FUNCTION TO SHOW installus JS

register_activation_hook(__FILE__, 'activate_installus_ile');
register_deactivation_hook(__FILE__, 'deactivate_installus_ile');

if (is_admin()) {
  add_action('admin_init', 'admin_init_installus_ile');
  add_action('admin_menu', 'admin_menu_installus_ile');
  add_action('admin_notices', 'installus_ile_admin_notice');
}


add_action('wp_footer', 'installus_ile', 9999);


// SHOW SETTINGS OPTION IN THE PLUGIN PAGE
// Settings link
function installusILEAddSettingsLink($actions) {
  $actions = array('settings' => sprintf('<a href="%s" title="%s">%s</a>', admin_url().'options-general.php?page=installus-links', __('Configure this plugin'), __('Settings'))) + $actions;
  return $actions;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'installusILEAddSettingsLink');


?>