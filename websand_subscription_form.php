<?php
  
  /**
  * Plugin Name: Websand Subscription Form
  * Plugin URI: http://www.websandhq.com
  * Description: Websand Subscription Form. Subscribe your WordPress site visitors in Websand with ease. 
  * Version: 1.0.3
  * Author: Websand
  * Author URI: http://www.websandhq.com
  */

  ///////////////////////////////////////////////////////
  // Widget class
  // https://codex.wordpress.org/Widget_API
  ///////////////////////////////////////////////////////

  class websand_subscription_form extends WP_Widget {
    
    // Set up the widget name and description.
    public function __construct() {
      $widget_options = array( 'classname' => 'websand_subscription_form', 'description' => 'This plugin creates a widget that can be used to capture and send subscriber information to WebsandHQ' );
      parent::__construct( 'websand_subscription_form', 'Websand Subscription Form', $widget_options );
    }
    
    // Create the widget output.
    public function widget( $args, $instance ) {
      // Set options/default vars
      $options = get_option('websand_options');

      if(empty($instance['wshq_source'])){
        $source = $options['default_source'];
      } else {
	      $source = $instance['wshq_source'];
      };

      if(empty($instance['wshq_redirect'])){
        $redirect = $options['default_redirect'];
      } else {
        $redirect = $instance['wshq_redirect'];
      };
    
      echo $args['before_widget'] . $args['before_title'] . $instance['title'] . $args['after_title']; ?>
      <form accept-charset="UTF-8" method="post" class="websand-subscription-form">
        <input type="hidden" id="wshq_subscribe_key" name="wshq_subscribe_key" value="<?php echo $options['api_key'] ?>">
        <input type="hidden" id="wshq_source" name="wshq_source" value="<?php echo $source ?>">
        <input type="hidden" id="wshq_domain" name="wshq_domain" value="<?php echo $options['domain'] ?>">
        <input type="hidden" id="wshq_redirect" name="wshq_redirect" value="<?php echo $redirect ?>">
        <div class="websand-form-group">
          <label for="subscriber_first">First name:</label>
          <input class="form-control" type="text" name="wshq_subscriber[first]" id="wshq_subscriber_first">
          <p>
            Your first name
          </p>
        </div>
        <div class="websand-form-group">
          <label for="subscriber_email">Your email address: </label>
          <input class="form-control" type="text" name="wshq_subscriber[email]" id="wshq_subscriber_email">
          <p>
            Your email address
          </p>
        </div>
        <div class="websand-form-group">
          <label><input type="checkbox" id="wshq_subscribe_confirmation">I am happy to receive your lovely email messages (<a target='new' href='<?php echo $options['terms']?>'>Here's our full policy</a>)</label>
        </div>
        <div class="websand-form-group">
          <input type="submit" name="wshq_subscribe_button" class="websand-submit button button-primary" value="Subscribe">
        </div>
      </form>
      <?php echo $args['after_widget'];

    }
    
    // Create the admin area widget settings form.
    public function form( $instance ) {
      $options = get_option('websand_options');
      $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
      $wshq_source = ! empty($instance['wshq_source']) ? $instance['wshq_source'] : $options['default_source'];
      $wshq_redirect = ! empty($instance['wshq_redirect']) ? $instance['wshq_redirect'] : $options['default_redirect'];;

      ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label><br />
        <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
      </p>
      <h4>Optional:</h4>
       <p>
        <label for="<?php echo $this->get_field_id('wshq_source'); ?>">Widget source code (letters, numbers and hyphens only):</label>
        <input type="text" id="<?php echo $this->get_field_id('wshq_source'); ?>" name="<?php echo $this->get_field_name('wshq_source'); ?>" value="<?php echo esc_attr($wshq_source); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('wshq_redirect'); ?>">Widget 'Thank You' URL:</label>
        <input type="text" id="<?php echo $this->get_field_id('wshq_redirect'); ?>" name="<?php echo $this->get_field_name('wshq_redirect'); ?>" value="<?php echo esc_attr($wshq_redirect); ?>" />
      </p>
      <?php
    }
    
    // Apply settings to the widget instance.
    public function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      $instance[ 'wshq_source' ] = strip_tags( $new_instance[ 'wshq_source' ] );
      $instance[ 'wshq_redirect' ] = strip_tags( $new_instance[ 'wshq_redirect' ] );
      return $instance;
    }
  }
 
  // Pull in JS 
  function websandhq_register_scripts() {
    wp_enqueue_script(
      'websand_subscription_form_js', 
      plugins_url( 'assets/js/websand-subscription-form.js', __FILE__ ), 
      array('jquery'),
      '0.1.5',
      true
    ); 
  }
 
  add_action('wp_enqueue_scripts', 'websandhq_register_scripts');
  add_action('widgets_init', function(){ register_widget('websand_subscription_form'); });

  
  ///////////////////////////////////////////////////////
  // Shortcode for use in posts/pages
  // https://codex.wordpress.org/Shortcode_API
  ///////////////////////////////////////////////////////

  add_shortcode('websand', 'websand_shortcode_handler');

  //[websand source_code="something" thank_you="http://www.example.com/thanks.html"]
  function websand_shortcode_handler($atts) {
    $options = get_option('websand_options');
    $params = shortcode_atts(array(
      'source_code' => $options['default_source'],
      'thank_you'   => $options['default_redirect']
    ), $atts);

   ob_start();
   ?>
     <form accept-charset="UTF-8" method="post" class="websand-subscription-form">
       <input type="hidden" id="wshq_subscribe_key" name="wshq_subscribe_key" value="<?php echo $options['api_key'] ?>">
       <input type="hidden" id="wshq_source" name="wshq_source" value="<?php echo $params['source_code'] ?>">
       <input type="hidden" id="wshq_domain" name="wshq_domain" value="<?php echo $options['domain'] ?>">
       <input type="hidden" id="wshq_redirect" name="wshq_redirect" value="<?php echo $params['thank_you'] ?>">
       <div class="websand-form-group">
         <label for="subscriber_first">First name:</label>
         <input class="form-control" type="text" name="wshq_subscriber[first]" id="wshq_subscriber_first">
        </div>
        <div class="websand-form-group">
          <label for="subscriber_email">Your email address: </label>
          <input class="form-control" type="text" name="wshq_subscriber[email]" id="wshq_subscriber_email">
        </div>
        <div class="websand-form-group">
          <label><input type="checkbox" id="wshq_subscribe_confirmation">I am happy to receive your lovely email messages (<a target='new' href='<?php echo $options['terms']?>'>Here's our full policy</a>)</label>
        </div>
        <div class="websand-form-group">
          <input type="submit" name="wshq_subscribe_button" class="websand-submit button button-primary" value="Subscribe">
        </div>
      </form>
   <?php
   return ob_get_clean(); 
  } 
 
  ///////////////////////////////////////////////////////
  // Admin settings page
  ///////////////////////////////////////////////////////
  add_action('admin_menu', 'websand_admin_add_page');
  add_action('admin_init', 'websand_admin_init');

  function websand_admin_add_page() {
    add_options_page(
      'Websand for WordPress', 
      'Websand for WordPress', 
      'manage_options', 
      'plugin', 
      'websand_options_page'
    );
  }

  function websand_options_page() {
    ?>
    <div class='wrap'>
      <h2>Websand for Wordpress</h2>
      <form action="options.php" method="post">
        <?php settings_fields('websand_options'); ?>
        <?php do_settings_sections('websand_for_wordpress'); ?>   
        <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
      </form>
    </div>
    <?php
  }
  
  function websand_admin_init(){
    register_setting( 'websand_options', 'websand_options', 'websand_options_validate' );
    add_settings_section('websand_main', 'Main Settings', 'websand_main_section_text', 'websand_for_wordpress');
    add_settings_field('websand_domain', 'Websand Account Domain', 'websand_domain_input', 'websand_for_wordpress', 'websand_main');
    add_settings_field('websand_api_token', 'Websand API Token', 'websand_api_token_input', 'websand_for_wordpress', 'websand_main');
    add_settings_field('websand_terms_url', 'Terms and Conditions URL', 'websand_terms_input', 'websand_for_wordpress', 'websand_main');
    add_settings_section('websand_default', 'Default Settings', 'websand_default_section_text', 'websand_for_wordpress');
    add_settings_field('websand_default_source', 'Source Code', 'websand_default_source_input', 'websand_for_wordpress', 'websand_default');
    add_settings_field('websand_default_redirect', 'Thank you URL', 'websand_default_redirect_input', 'websand_for_wordpress', 'websand_default');

  }

  function websand_main_section_text() {
    echo '<p>These three fields are global settings that are required for Websand for WordPress to function correctly.</p>';
  }

  function websand_api_token_input() {
    $options = get_option('websand_options');
    echo "<input id='websand_api_token_input' name='websand_options[api_key]' size='40' type='text' value='{$options['api_key']}' />";
    echo "<p>Enter your Websand API token. This can be found/generated on the 'API Tokens' page in your Websand instance.</p>";
  }

  function websand_domain_input() {
    $options = get_option('websand_options');
    echo "<input id='websand_domain_input' name='websand_options[domain]' size='40' type='text' value='{$options['domain']}' />";
    echo "<p>Enter your Websand domain here. Your Websand domain is the first part of the URL of your Websand instance. For example, if your instance is <strong>http://example.websandhq.com</strong> then you would enter <strong>example</strong> here.</p>";
  }

  function websand_terms_input() {
    $options = get_option('websand_options');
    echo "<input id='websand_terms_input' name='websand_options[terms]' size='40' type='text' value='{$options['terms']}' />";
    echo "<p>Enter a URL of your terms and conditions page. This will be linked from the opt-in checkbox on all Websand input forms on this site.</p>";
  }

  function websand_default_section_text() {
    echo "<p>These settings will be used as the defaults for shortcodes/widgets in case any others aren't specified when you come to adding the shortcodes/widgets to your site. These can be overridden on a case by case basis via the Widget options or through parameters provided to your shortcodes.</p>";
  }

  function websand_default_source_input() {
    $options = get_option('websand_options');
    echo "<input id='websand_default_source_input' name='websand_options[default_source]' size='40' type='text' value='{$options['default_source']}' />";
    echo "<p>Enter a default source code. This is sent to your Websand instance with the subscriber's other info so you can identify where your subscribers come from when segmenting your audience e.g. 'landing-page-one' or 'my-lovely-website'</p>";
  }

  function websand_default_redirect_input() {
    $options = get_option('websand_options');
    echo "<input id='websand_api_token_input' name='websand_options[default_redirect]' size='40' type='text' value='{$options['default_redirect']}' />";
    echo "<p>Create a thank you page to redirect your subscribers to after they've submitted the form. Enter the URL here.</p>";
  }


  function websand_options_validate($input) {
    $newinput['api_key'] = trim($input['api_key']);
    if(preg_match('/[^a-z_\-0-9]/i', $newinput['api_key'])) {
      $newinput['api_key'] = '';
    }

    $newinput['domain'] = trim($input['domain']);
    if(preg_match('/[^a-z_\-0-9]/i', $newinput['domain'])) {
      $newinput['domain'] = '';
    }

    $newinput['terms'] = trim($input['terms']);
      if(!filter_var($newinput['terms'], FILTER_VALIDATE_URL)) {
      $newinput['terms'] = '';
    }
    
    $newinput['default_source'] = trim($input['default_source']);
    if(!preg_match('/^([a-z0-9]+-)*[a-z0-9]+$/i', $newinput['default_source'])) {
      $newinput['default_source'] = '';
    }

    $newinput['default_redirect'] = trim($input['default_redirect']);
    if(!filter_var($newinput['default_redirect'], FILTER_VALIDATE_URL)) {
      $newinput['default_redirect'] = '';
    }
    return $newinput;
  }

?>
