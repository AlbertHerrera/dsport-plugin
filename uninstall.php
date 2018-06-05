<?php

/**
*Trigger this file on Plugin uninstall
*
*@package Dsports-plugin
*/

//Security if
if(!defined( 'WP_UNINSTALL_PLUGIN' )) {
  die;
}

//Clear Database stored data.
$news = get_posts(array( 'post_type'=> 'news', 'numberposts' => -1 ))
foreach($news as $new){
  wp_delete_post($new->ID, true );
}
