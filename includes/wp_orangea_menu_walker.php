<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tiafeno
 * Date: 10/05/2018
 * Time: 00:27
 */

// Class walker pour le menu principal
class OG_Primary_Walker extends Walker_Nav_Menu {
	public $count = 0;
	var $db_fields = array(
		'parent' => 'menu_item_parent',
		'id'     => 'db_id'
	);


	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$post = get_post($item->object_id);
		$current = empty($output) ? "true" : "false";
		$output .= sprintf( "\n<li data-current=\"%s\"> <a class=\"anchorage\" href='#%s'> %s </a> \n",
			$current, $post->post_name, strtoupper($item->title));
		$this->count++;
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$output .= "</li>{$n}";

		// Inserer l'element pour la ligne à la fin de la liste
		if ($args instanceof stdClass)
			if ($args->menu->count === $this->count)
				$output .= "<div class=\"line\"></div>";
	}


}

// Class walker pour le menu principal en mode mobile (offcanvas)
class OG_offcanvas_Walker extends Walker_Nav_Menu {
	var $db_fields = array(
		'parent' => 'menu_item_parent',
		'id'     => 'db_id'
	);

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= sprintf( "\n<li> <a href='%s'> %s </a> \n",
			$item->url, strtoupper($item->title));
	}
}