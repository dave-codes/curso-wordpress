<?php
/**
 * Dynamic-CSS handler - Inline CSS.
 *
 * @package Fusion-Library
 * @since 1.0.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Handle generating the dynamic CSS.
 *
 * @since 1.0.0
 */
class Fusion_Dynamic_CSS_Inline {

	/**
	 * An innstance of the Fusion_Dynamic_CSS object.
	 *
	 * @access private
	 * @since 1.0.0
	 * @var object
	 */
	private $dynamic_css;

	/**
	 * Constructor.
	 *
	 * @access public
	 * @since 1.0.0
	 * @param object $dynamic_css An instance of Fusion_DYnamic_CSS.
	 */
	public function __construct( $dynamic_css ) {

		$this->dynamic_css = $dynamic_css;

		if ( Avada()->settings->get( 'media_queries_async' ) ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_css' ) );
			add_action( 'wp_head', array( $this, 'add_custom_css_to_wp_head' ), 999 );
		} else {
			add_action( 'wp_head', array( $this, 'add_inline_css_wp_head' ), 999 );
		}
	}

	/**
	 * Add Inline CSS.
	 * CSS will be loaded after all Avada CSS except the media queries
	 * and W3TC can combine it correctly.
	 *
	 * @access public
	 * @return void
	 */
	public function add_inline_css() {
		wp_add_inline_style( 'avada-stylesheet', wp_strip_all_tags( apply_filters( 'fusion_library_inline_dynamic_css', $this->dynamic_css->make_css() ) ) );
	}

	/**
	 * Add Inline CSS.
	 * CSS will be loaded after all Avada CSS except the media queries
	 * and W3TC can combine it correctly.
	 *
	 * @since 5.9.1
	 * @access public
	 * @return void
	 */
	public function add_custom_css_to_wp_head() {
		$custom_css = apply_filters( 'fusion_library_inline_custom_css', '' );
		if ( $custom_css ) {
			echo '<style id="fusion-stylesheet-custom-css" type="text/css">';
			echo $custom_css; // WPCS: XSS ok.
			echo '</style>';
		}
	}

	/**
	 * Add Inline CSS in wp_head.
	 * We need this because it has to be loaded after all other Avada CSS
	 * and W3TC can combine it correctly.
	 *
	 * @access public
	 * @return void
	 */
	public function add_inline_css_wp_head() {
		echo '<style id="fusion-stylesheet-inline-css" type="text/css">';
		echo wp_strip_all_tags( apply_filters( 'fusion_library_inline_dynamic_css', $this->dynamic_css->make_css() ) ); // WPCS: XSS ok.
		echo '</style>';
	}
}

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
