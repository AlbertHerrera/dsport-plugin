<?php
/**
 * @package  DsportsPlugin
 */
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

/**
*
*/
class Dashboard extends Basecontroller{
  public $settings;
  public $callbacks;
  public $callbacks_mngr;

  public $pages = array();
  //public $subpages = array();

 public function register(){
  $this->settings = new SettingsApi();
  $this->callbacks = new AdminCallbacks();
  $this->callbacks_mngr = new ManagerCallbacks();
  $this->setPages();
//  $this->setSubpages();
  $this->setSettings();
  $this->setSections();
  $this->setFields();

     $this->settings->addPages( $this->pages )->withSubPage()->register();

  }
  public function setPages(){
    $this->pages = array(
      array(
        'page_title' =>'Dsports Plugin Admin',
        'menu_title' => 'Dsports' ,
        'capability' => 'manage_options',
        'menu_slug' => 'dsports_plugin',
        'callback' => array($this->callbacks, 'adminDashboard'),
        'icon_url' => 'dashicons-store',
        'position' => 110
      )
    );

  }
//SET SUBPAGES OLD.
  public function setSettings(){
    //store our settings

     $args = array(
             array(
               'option_group' => 'dsports_plugin_settings',
               'option_name' => 'dsports_plugin',
               'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )

             )
      );
      $this->settings->setSettings($args);
    }

  public function setSections(){
    //store our Sections
    $args = array(
      array(
        'id' => 'dsports_admin_index',
        'title' => 'Settings Manager',
        'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
        'page' => 'dsports_plugin'
      )
    );
    //populate the Settings
    $this->settings->setSections($args);

  }
  public function setFields(){
    //store our Fields
    $args = array();

      foreach ($this->managers as $key => $manager) {
      $args[] = array(
        'id' => $key,
        'title' => $manager,
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'dsports_plugin',
        'section' => 'dsports_admin_index',
        'args' => array(
          'option_name' => 'dsports_plugin',
          'label_for' => $key,
          'class' => 'ui-toggle'
        )
      );
      }

    $this->settings->setFields($args);

  }

 }



 ?>
