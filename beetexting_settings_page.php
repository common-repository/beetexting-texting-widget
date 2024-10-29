<?php
 // Exit if accessed directly

 if(!defined('ABSPATH')) {
  exit;
}
    global $chk;
    
    if(isset($_POST['wphw_submit']) && current_user_can('edit_pages')){

        // Validate the nounce
        if (!isset($_POST['my_wpbt_update_setting'])) 
          die("<br><br> Unauthorized ! ");
          if ( ! isset( $_POST['my_wpbt_update_setting'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['my_wpbt_update_setting'] ) ) , 'wpbt_update_setting' ) )
          die("<br><br>Hmm .. Unauthorized.. No CSRF for you! ");
  
        btwp_wphw_opt();
    }
    function btwp_wphw_opt(){

        $hellotxt = !empty($_POST['footertextname']) ? sanitize_text_field($_POST['footertextname']) :  '⚡️Text us to chat! ⚡️';
        $phoneNumber = !empty($_POST['phonenumber']) ? sanitize_text_field($_POST['phonenumber']) :  '(555) 555-5555';
        $primaryColor = !empty($_POST['primarycolor']) ? sanitize_hex_color($_POST['primarycolor']) :  '#5E4878';
        $secondaryColor = !empty($_POST['secondarycolor']) ? sanitize_hex_color($_POST['secondarycolor']) :  '#5E4878';

        global $chk;
        if( get_option('footer_text') != trim($hellotxt)){
            $chk = update_option( 'footer_text', trim($hellotxt));
        }
        if( get_option('phone_number') != trim($phoneNumber)){
            $chk = update_option( 'phone_number', trim($phoneNumber));
        }
        if( get_option('primary_color') != trim($primaryColor)){
            $chk = update_option( 'primary_color', trim($primaryColor));
        }
        if( get_option('secondary_color') != trim($secondaryColor)){
            $chk = update_option( 'secondary_color', trim($secondaryColor));
        }
    }
    
?>
<div class="wrap">
  <div id="icon-options-general" class="icon32"> <br>
  </div>
  <h2>BEETEXTING Widget Settings</h2>
  <?php if(isset($_POST['wphw_submit']) && $chk):?>
  <div id="message" class="updated below-h2">
    <p>Content updated successfully</p>
  </div>
  <?php endif;?>
  <div class="metabox-holder">
    <div class="postbox">
      <h3><strong>Enter your preferences for styling your texting widget.</strong></h3>
      <form method="post" action="">
      <input name="my_wpbt_update_setting" type="hidden" value="<?php echo esc_attr(get_option('wpbt-update-setting')); ?>" />

        <table class="form-table">
                  <!-- Primary Text -->
          <tr>
            <th scope="row" style="padding-left: 12px;">Primary Text</th>
            <td><input type="text" name="footertextname" placeholder="⚡️Text us to chat! ⚡️" 
value="<?php echo esc_attr(get_option('footer_text'));?>" style="width:350px;" /></td>
          </tr>

          <!-- Phone Number -->
          <tr>
            <th scope="row" style="padding-left: 12px;">Phone Number</th>
            <td><input type="text" name="phonenumber" placeholder="(555) 555-5555" 
value="<?php echo esc_attr(get_option('phone_number'));?>" style="width:350px;" /></td>
          </tr>

          <!-- Primary Color -->
          <tr>
            <th scope="row" style="padding-left: 12px;">Primary Color</th>
            <td><input type="text" name="primarycolor" placeholder="#5E4878" 
value="<?php echo esc_attr(get_option('primary_color'));?>" style="width:350px;" /></td>
          </tr>

          <!-- Secondary Color ( Message Box) -->
          <tr>
            <th scope="row" style="padding-left: 12px;">Secondary Color</th>
            <td><input type="text" name="secondarycolor" placeholder="#5E4878" 
value="<?php echo esc_attr(get_option('secondary_color'));?>" style="width:350px;" /></td>
          </tr>

          <tr>
            <th scope="row">&nbsp;</th>
            <td style="padding-top:10px;  padding-bottom:10px;">
<input type="submit" name="wphw_submit" value="Save changes" class="button-primary" />
</td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>