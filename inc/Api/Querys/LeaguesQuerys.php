<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Api\Querys;

/**
*
*/
class LeaguesQuerys
{
  public function getDb(){
  //
  global $wpdb;
  $dsport = $wpdb->get_row("SELECT post_content,post_title FROM $wpdb->posts WHERE ID = 	231");
  return $dsport;
  }

}
