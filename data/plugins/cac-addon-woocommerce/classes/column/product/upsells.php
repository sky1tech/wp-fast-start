<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit when accessed directly

/**
 * @since 1.1
 */
class CPAC_WC_Column_Post_Upsells extends CPAC_Column {

	/**
	 * @see CPAC_Column::init()
	 * @since 1.1
	 */
	public function init() {

		parent::init();

		// Properties
		$this->properties['type']	= 'column-wc-upsells';
		$this->properties['label']	= __( 'Upsells', 'cpac' );
		$this->properties['group']	= 'woocommerce-custom';
	}

	/**
	 * @see CPAC_Column::get_value()
	 * @since 1.1
	 */
	public function get_value( $post_id ) {

		$upsell_ids = $this->get_raw_value( $post_id );
		$upsells = array();

		foreach ( $upsell_ids as $id ) {
			if ( ! $id ) {
				continue;
			}

			$title = get_the_title( $id );

			if ( $link = get_edit_post_link( $id ) ) {
				$title = "<a href='{$link}'>{$title}</a>";
			}

			$upsells[] = $title;
		}

		return implode( ', ', $upsells );
	}

	/**
	 * @see CPAC_Column::get_raw_value()
	 * @since 1.1
	 */
	public function get_raw_value( $post_id ) {

		$product = get_product( $post_id );

		return $product->get_upsells();
	}

}