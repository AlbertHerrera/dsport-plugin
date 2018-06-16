<?php
/**
 * @package  dsportsPlugin
 */
namespace Inc\Base;
use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use Inc\Api\Widgets\MediaWidget;
/**
*
*/
class ActivateMediaManagerController extends BaseController{
public $callbacks;
public $subpages = array();
public function register(){

    $option = get_option( 'dsports_plugin' );
    $activated = isset($option['media_widget']) ? $option['media_widget'] : false;
    if (! $activated){
      return;
    }
    $media_widget = new MediaWidget();
		$media_widget->register();




}
}
