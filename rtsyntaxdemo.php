<?php
/**
 * Created by PhpStorm.
 * User: rtcamp
 * Date: 14/2/18
 * Time: 3:10 PM
 *
 * Plugin Name: Language Syntax Highlighter
 * Author     : Mittesh
 */

class RtSyntaxDemo {
	public function __construct() {
		add_action( 'init', array( &$this, 'register_rtsyntax_block' ) );
	}

	public function register_rtsyntax_block() {
		$pluginPath = plugin_dir_path( __FILE__ ) . 'css/';
		$themes     = null;
		if ( is_dir( $pluginPath ) ) {
			if ( $openDir = opendir( $pluginPath ) ) {
				while ( ( $file = readdir( $openDir ) ) !== false ) {
					if ( $file !== '.' && $file !== '..' && $file != ' ' ) {
						$filename = explode( '.', $file );
						$themes[] = $filename[0];
					}
				}
			}
		}
		wp_enqueue_style(
			'highlights-css',
			plugins_url( 'css/highlight.min.css', __FILE__ )
		);
		wp_enqueue_script(
			'highlights-js',
			plugins_url( 'js/highlight.min.js', __FILE__ )
		);
		wp_register_script(
			'rtsyntax-gutenberg-blocks',
			plugins_url( 'js/block.build.js', __FILE__ ),
			array( 'wp-blocks', 'wp-element', 'wp-i18n' )
		);
		register_block_type(
			'rtsyntaxdemo/syntaxhighlighter', array(
				'script' => [ 'highlights-js', 'rtsyntax-gutenberg-blocks' ],
				'style'  => 'highlights-css',
			)
		);
		wp_localize_script(
			'rtsyntax-gutenberg-blocks', 'rtsyntax', array(
				'path'   => plugin_dir_url( __FILE__ ),
				'themes' => $themes,
			)
		);
	}

}
$rtsyntaxdemo = new RtSyntaxDemo();