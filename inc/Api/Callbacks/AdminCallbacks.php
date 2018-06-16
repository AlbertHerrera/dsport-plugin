<?php
/**
* @package dsport-plugin
*/
namespace Inc\Api\Callbacks;
use Inc\Base\BaseController;
class AdminCallbacks extends BaseController{

  public function adminDashboard(){
   return require_once("$this->plugin_path/templates/store/admin.php");
  }
  public function adminCpt()
	{
		return require_once( "$this->plugin_path/templates/store/cpt.php" );
	}
	public function adminTaxonomy()
	{
		return require_once( "$this->plugin_path/templates/store/taxonomy.php" );
	}
	public function adminWidget()
	{
		return require_once( "$this->plugin_path/templates/store/widget.php" );
	}
  public function adminGallery(){
    return require_once("$this->plugin_path/templates/store/gallery.php");
  }
  public function adminTestimonial(){
    return require_once("$this->plugin_path/templates/store/testimonial.php");
  }
  public function adminTemplates(){
    return require_once("$this->plugin_path/templates/store/templates.php");
  }
  public function adminLogin(){
    return require_once("$this->plugin_path/templates/store/login.php");
  }
  public function adminMembership(){
    return require_once("$this->plugin_path/templates/store/membership.php");
  }
  public function adminChat(){
    return require_once( "$this->plugin_path/templates/store/chat.php" );

  }
  public function adminLpt(){
    return require_once( "$this->plugin_path/templates/store/leaguesManager.php" );
  }





  // public function  dsportsAdminSection(){
  // echo ' Check this beatiful section!';
  // }
  public function dsportsTextExample(){
    $value = esc_attr(get_option('text_example'));
    echo '<input type="text" class="regular-text" name="text_example" value="'. $value .'" placeholder="Write Something Here!">';
  }
  public function dsportsFirstName(){
    $value = esc_attr(get_option('first_name'));
    echo '<input type="text" class="regular-text" name="text_example" value="'. $value .'" placeholder="Write your First Name">';
  }




//Me
  public function adminLeagueManager(){
     return require_once("$this->plugin_path/templates/boxes/leaguesManager.php");
  }
}
 ?>
