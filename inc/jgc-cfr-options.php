<?php

//Estilos
add_action('admin_enqueue_scripts', 'jgccfr_enqueue_css_options');
function jgccfr_enqueue_css_options() {
	
	$url_css = plugins_url( '../css/jgc-cfr-options-style.css', __FILE__ );
	
	wp_enqueue_style( 'jgccfr-options-style', $url_css, '', JGC_CFR_VERSION );
	
}

//Crear menú
add_action ( 'admin_menu', 'jgccfr_crear_menu' );
function jgccfr_crear_menu() {
	
	//Submenú en Ajustes
	add_options_page ( 'JGC Content for Registered Users', 'JGC Content for Registered Users', 'manage_options', 'jgccfr_settings', 'jgccfr_setting_page' );
	
	add_action ( 'admin_init', 'jgccfr_register_setting' );
	
}

function jgccfr_register_setting() {
	
	register_setting ( 'jgccfr_grupo_opciones', 'jgccfr_opciones', 'jgccfr_sanitize_options' );
	
}

function jgccfr_sanitize_options($input) {
	
	$input['texto_mensaje'] = sanitize_text_field( $input['texto_mensaje'] );
	$input['color_mensaje'] = ( in_array( $input['color_mensaje'], array( 'azul', 'verde', 'rojo', 'naranja', 'negro' ) ) ) ? $input['color_mensaje'] : 'azul';
	
	return $input;
}

function jgccfr_setting_page() { ?>
    
    <div class="wrapper-options">
    <h1 class="title_options">JGC Content for Registered Users | <?php _e( 'Options', 'jgccfr-plugin' ); ?></h1>
    
	<form id="frm_cfr_opt" name="frm_cfr_opt" method="post" action="options.php" >
		<?php settings_fields('jgccfr_grupo_opciones'); ?>
		<?php $jgccfr_opciones = get_option('jgccfr_opciones'); ?>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Message text', 'jgccfr-plugin' ); ?></th>
				<td>
					<input type="text"
					name="jgccfr_opciones[texto_mensaje]" 
					value="<?php echo __( esc_attr($jgccfr_opciones['texto_mensaje'] ), 'jgccfr-plugin'); ?>" 
					size="80" >
					
					<p><i>(<?php _e('Message to be displayed to users not registered replacing the post content', 'jgccfr-plugin'); ?>)</i></p>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><?php _e( 'Message color', 'jgccfr-plugin' ); ?></th>
				<td>
					<input type="radio" 
					name="jgccfr_opciones[color_mensaje]"
					<?php echo checked( $jgccfr_opciones['color_mensaje'], 'azul', false ); ?>
					value="azul" /> <?php _e( 'Blue', 'jgccfr-plugin' ); ?>&nbsp;&nbsp;&nbsp;
					
					<input type="radio" 
					name="jgccfr_opciones[color_mensaje]"
					<?php echo checked( $jgccfr_opciones['color_mensaje'], 'verde', false ); ?>
					value="verde" /> <?php _e( 'Green', 'jgccfr-plugin' ); ?>&nbsp;&nbsp;&nbsp;
					
					<input type="radio" 
					name="jgccfr_opciones[color_mensaje]"
					<?php echo checked( $jgccfr_opciones['color_mensaje'], 'naranja', false ); ?>
					value="naranja" /> <?php _e( 'Orange', 'jgccfr-plugin' ); ?>&nbsp;&nbsp;&nbsp;
					
					<input type="radio" 
					name="jgccfr_opciones[color_mensaje]"
					<?php echo checked( $jgccfr_opciones['color_mensaje'], 'rojo', false ); ?>
					value="rojo" /> <?php _e( 'Red', 'jgccfr-plugin' ); ?>&nbsp;&nbsp;&nbsp;
					
					<input type="radio" 
					name="jgccfr_opciones[color_mensaje]"
					<?php echo checked( $jgccfr_opciones['color_mensaje'], 'negro', false ); ?>
					value="negro" /> <?php _e( 'Black', 'jgccfr-plugin' ); ?>&nbsp;&nbsp;&nbsp;
				</td>
			</tr>
		</table>
			
		<hr />
		
		<div class="btn-save">
			<p><input type="submit" class="button-primary" value="<?php _e( 'Save changes', 'jgccfr-plugin' ); ?>" /></p>
		</div>
		
	</form>
	
	</div><!-- .wrapper-options -->
	<?php
} ?>