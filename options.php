<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $gr_image_path = plugins_url('/img/', __FILE__);
?>

<style>

#gr-tsid-mismatch-error strong, #gr-domain-mismatch-error strong {
  font-size: 140%;
}

  .css-only-spinner > div {
    width: 10px;
    height: 10px;
    background-color: #333;

    border-radius: 100%;
    display: inline-block;
    -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
    animation: bouncedelay 1.4s infinite ease-in-out;
    /* Prevent first frame from flickering when animation starts  */
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
  }

  .css-only-spinner .bounce1 {
    -webkit-animation-delay: -0.32s;
    animation-delay: -0.32s;
  }

  .css-only-spinner .bounce2 {
    -webkit-animation-delay: -0.16s;
    animation-delay: -0.16s;
  }

  @-webkit-keyframes bouncedelay {
    0%, 80%, 100% { -webkit-transform: scale(0.0) }
    40% { -webkit-transform: scale(1.0) }
  }

  @keyframes bouncedelay {
    0%, 80%, 100% {
      transform: scale(0.0);
      -webkit-transform: scale(0.0);
    } 40% {
        transform: scale(1.0);
        -webkit-transform: scale(1.0);
      }
  }
  /* End CSS css-only-spinner.  */


  .gr-step-area {
    width: 445px;
    border-radius: 3px;
    background: rgba(255,255,255,.5);
    border: 1px solid rgba(0,0,0,.1);
    padding: 10px 20px 10px 20px;
    min-height: 48px;
    margin-bottom: 3px;
  }
  .gr-step-area strong {
    font-size: 14px;
  }

  .gr-step-area a:link, .gr-step-area a:visited {
    text-decoration: none;
  }


  .gr-step-complete .gr-step-number {
    border: 2px solid #00b9ee;
    color: #00b9ee;
    background-color: #ffffff;
  }

  .gr-step-info {
    margin: 5px 0 10px 65px;
  }

  #connect-gr-api-form {
    margin-top: 20px;
  }

  .gr-georiot-logo {
    vertical-align: -13%;
    border: none;
  }

  .gr-bygr {
    font-size: 55%;
  }


  h3 {
    font-size: 22px;
    color: #999;
    margin-top: 30px;
    font-weight: normal;
  }

  h4 {
    padding-top: 45px;
    margin-top: 0;
  }

  .gr-intro {
    max-width: 500px;
  }

  #gr-advanced-options {
    position: relative;
    min-height: 0;
  }

  .gr-advanced-options-fields {
    overflow: hidden;
    transition: height .3s;
    height: 0;
  }

  .expanded .gr-advanced-options-fields {
    height: 120px;
    transition: height .3s;
  }



  .expanded .gr-collapse {
    display: inline-block;
  }
  .expanded .gr-expand, .expanded .hidden-expanded {
    display: none;
  }


  #gr-advanced-options h5{
    font-size: 14px;
    margin: 0;
  }

  #installus_ile_site_id, #installus_ile_ext{
    width: 300px;
  }



  #installus_ile_site_id, #installus_ile_api_secret {
    font-family: "Courier New", monospace;
  }

</style>


<div class="wrap">
  <h2>Installus links <span class="gr-bygr">by </span>
    <a href="https://installus.net/" target="_blank"><img class='gr-georiot-logo' src="<?php print $gr_image_path ?>installus_ile_logo.png" /></a></h2>
  <p class="gr-intro">This plugin has added code that converts all file
    URLs on your site to installus.net partner program.
  </p>

  <h3>Setup</h3>


  <form method="post" action="options.php" id="connect-gr-api-form" class="<?php print 'gr-status-loaded-tsid'; ?>">
    <?php settings_fields('installus-links'); ?>



    <div class="gr-step-area">


        SiteID: <br>
        <input maxlength="34" type="number" placeholder="Paste your site's ID" id="installus_ile_site_id"
               required="required"
               name="installus_ile_site_id" value="<?php echo get_option('installus_ile_site_id'); ?>" /></td>

        <br><br>
        Replace links with file extensions:<br>
        <input maxlength="255"  type="text" placeholder="File extensions"
               required="required"
               id="installus_ile_ext" name="installus_ile_ext"
               value="<?php echo get_option('installus_ile_ext'); ?>" />

      <br><br>

      <input type="checkbox" name="installus_ile_api_remind" value="yes" id="installus_ile_api_remind"
          <?php if (get_option('installus_ile_api_remind') == 'yes') print "checked" ?> />
      <label for="installus_ile_api_remind">Show Wordpress alert on dashboard if link replacing is not enabled</label>


    </div>







    <br><br>

    <input type="hidden" name="installus_ile_db_version" id="installus_ile_db_version" value="<?php echo get_option('installus_ile_db_version'); ?>" />
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
  </form>

  <style>
    .faq {
      border-top: 1px solid #cccccc;
      margin-top: 80px;
      padding-top: 0px;
      max-width: 500px;
      margin-bottom: 400px;
    }

    .faq h4 {
      margin: 30px 5px 0 0;
      font-size: 16px;
    }

	.faq-list > li {
		list-style-type: disc;
		margin-left: 30px;
	}
  </style>


</div>