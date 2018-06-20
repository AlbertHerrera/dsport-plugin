<?php
/**
 * @package  DsportsPlugin
 */
namespace Inc\Base;
use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\LptCallbacks;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Querys\LeaguesQuerys;




/**
*
*/
class LeaguesController extends BaseController{
  public $callbacks;
  public $settings;
  public $lpt_callbacks;
  public $leagues = array();
  public $subpages = array();
  public $custom_post_types = array();
  public $query;

  public function register(){


    $option = get_option( 'dsports_plugin' );
    $activated = isset($option['lpt_manager']) ? $option['lpt_manager'] : false;
    if (! $activated){
      return;
    }
    $this->settings = new SettingsApi();
    $this->lpt_callbacks = new LptCallbacks();
    $this->callbacks = new AdminCallbacks();
    $this->dsport = new LeaguesQuerys();
    $this->setSubpages();
    $this->setSettings();
    $this->setSections();
    $this->setFields();
    $this->settings->addSubPages( $this->subpages )->register();

    $this->dsport->getDb();
    $this->storePost($this->dsport);
    //$this->storeCustomPostTypes();

    // if (!empty( $this->custom_post_types)){
    //   add_action('init', array($this, 'registerCpt'));
    //
    // }
  }
  public function setSubpages(){
    $this->subpages = array(
      array(
        'parent_slug' => 'dsports_plugin',
        'page_title' => 'League Post Types',
        'menu_title' => 'LPT Manager' ,
        'capability' => 'manage_options',
        'menu_slug' => 'dsports_lpt',
        'callback' => array( $this->callbacks, 'adminLpt' )
      )
    );
  }
  public function setSettings(){
    //store our settings
     $args = array(
             array(
               'option_group' => 'dsports_plugin_lpt_settings',
               'option_name' => 'dsports_plugin_lpt',
               'callback' => array( $this->lpt_callbacks, 'lptSanitize' )

             )
      );
      $this->settings->setSettings($args);
  }
  public function setSections(){
    //store our Sections
    $args = array(
      array(
        'id' => 'dsports_lpt_index',
        'title' => 'Leagues Manager',
        'callback' => array( $this->lpt_callbacks, 'lptSectionManager' ),
        'page' => 'dsports_lpt'
      )
    );
    //populate the Settings
    $this->settings->setSections($args);

  }
  public function setFields(){
    //store our Fields
    //singular names
    //plural names
    // public
    // has_archive
    $args = array(
      array(
        'id' => 'league',
        'title' => 'League ID',
        'callback' => array( $this->lpt_callbacks, 'textField' ),
        'page' => 'dsports_lpt',
        'section' => 'dsports_lpt_index',
        'args' => array(
          'option_name' => 'dsports_plugin_lpt',
          'label_for' => 'league',
          'placeholder' => ''
        )
      ),
      array(
        'id' => 'singular_name',
        'title' => 'Singular Name',
        'callback' => array( $this->lpt_callbacks, 'textField' ),
        'page' => 'dsports_lpt',
        'section' => 'dsports_lpt_index',
        'args' => array(
          'option_name' => 'dsports_plugin_lpt',
          'label_for' => 'singular_name',
          'placeholder' => ''
        )
      ),
      array(
        'id' => 'description',
        'title' => 'Description',
        'callback' => array( $this->lpt_callbacks, 'textArea' ),
        'page' => 'dsports_lpt',
        'section' => 'dsports_lpt_index',
        'args' => array(
          'option_name' => 'dsports_plugin_lpt',
          'label_for' => 'description',
          'placeholder' => ''
        )
      ),
      array(
        'id' => 'image',
        'title' => 'Image',
        'callback' => array( $this->lpt_callbacks, 'image' ),
        'page' => 'dsports_lpt',
        'section' => 'dsports_lpt_index',
        'args' => array(
          'option_name' => 'dsports_plugin_lpt',
          'label_for' => 'image',
          'class' => 'image-upload'
        )
      )
    );



    $this->settings->setFields($args);

  }
  public function storePost($dsport){
      $options = get_option( 'dsports_plugin_lpt');
      $dsport_content .= "<div style='display: inline-flex;'>";
      $i = 0;
      foreach ($options as $option) {
        $dsport_content .= "

        <div class='card' style='width: 30rem; margin-right:15rem;'>
      <img class='card-img-top' src={$option['image']} alt='Card image cap' height=300 width=300>
      <div class='card-body'>
      <h5 class='card-title'>{$option['singular_name']}</h5>
        <p class='card-text'>{$option['description']}</p>
        <a href='#' class='btn btn-primary'>Go {$option['singular_name']} League</a>
      </div>
    </div>

        ";
        $i++;
        if($i==3){
          $dsport_content .= "</div>";
        }
      }
$dsport_content .= "</div>";

      $dsport_post = array(
         'ID'           => 231,
         'post_title'   => 'Dsports',
         'post_content' =>   $dsport_content
     );
     wp_update_post($dsport_post);
     wp_reset_postdata();



  }

  }
