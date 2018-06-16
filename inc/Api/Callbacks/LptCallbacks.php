<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Api\Callbacks;
use WP_Query;
class LptCallbacks extends WP_Query
{
	public function lptSectionManager()
	{
		echo 'Create as many Leagues as you want.';
	}

	public function lptSanitize( $input )
	{
		$output = get_option('dsports_plugin_lpt');

		//REMOOVE
		if (isset($_POST["remove"]) ){
			unset($output[$_POST["remove"]]);
			return $output;
		}

		if (count($output) == 0){
				$output[$input['league']] = $input;
				return $output;
		}

		foreach ($output as $key => $value) {
			if ($input['league'] === $key){
				$output[$key] = $input;
			}else {
				$output[$input['league']] = $input;

			}
		}

	return $output;
	}
	public function textField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$input = get_option( $option_name );
    $value = '';
    if (isset($_POST["edit_league"])){

      $input = get_option( $option_name );
      $value = $input[$_POST["edit_league"] ] [$name];
    }
		echo '<input type="text"  class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="'.$value.'" placeholder="' . $args['placeholder'] . '" required>';
	}
	public function textArea( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$input = get_option( $option_name );
    $value = '';
    if (isset($_POST["edit_league"])){

      $input = get_option( $option_name );
      $value = $input[$_POST["edit_league"] ] [$name];

    }

		echo '<textarea rows="4" cols="100" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="'.$value.'" placeholder="' . $args['placeholder'] . '" required> ' .$value. ' </textarea>';

	}
	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checkbox = get_option( $option_name );
		$checked = false;
		if (isset($_POST["edit_league"])){
			$input = get_option( $option_name );
			$checked = isset($checkbox[$_POST["edit_league"]][$name]) ?: false;
		}

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class=""' . ( $checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
	}

	public function image( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$input = get_option( $option_name );
		$value = '';
		if (isset($_POST["edit_league"])){

			$input = get_option( $option_name );
			$value = $input[$_POST["edit_league"] ] [$name];
		}
		//Image Dev
		if (! empty($instance['image'] ) ) {
			echo '<img src="'.esc_url($instance['image']).'" alt=""';
		}
		$image = !empty($instance['image']) ? $instance['image'] :'';

		echo '
		<p>
		<label for="' .esc_attr( $this->get_field_id( 'image' ) ).'">'.esc_attr_e( 'Url Image:', 'awps' ).'</label>
		<input class="widefat image-upload" id="' .esc_attr( $this->get_field_id( 'title' ) ). '" name="' .esc_attr( $this->get_field_name( 'title' ) ).'" type="text" value="' .esc_attr( $title ). '">
		</p>
		<button type ="button" class="button button-primary js-image-upload">Select Image</button>';









		//echo '<input type="text"  class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="'.$value.'" placeholder="' . $args['placeholder'] . '" required>';
	}
	public function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['image'] = sanitize_text_field( $new_instance['image']);
		return $instance;
	}
}
