<?php
/**
 * Elementor pls_autocomplete one area control.
 *
 * A control for autocomplete field.
 *
 * @since 1.0.0
 */
use Elementor\Base_Data_Control;
class PLS_Autocomplete_Control extends Base_Data_Control {
	
	/**
	 * Get pls_autocomplete one area control type.
	 *
	 * Retrieve the control type, in this case `pls_autocomplete`.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Control type.
	 */
	public function get_type() {
		return 'pls_autocomplete';
	}
	
	/**
	 * Enqueue pls_autocomplete one area control scripts and styles.
	 *
	 * Used to register and enqueue custom scripts and styles used by the pls_autocomplete one
	 * area control.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue() {
		wp_register_script( 'pls-autocomplete-control', PLS_CORE_URL . 'inc/elementor/assets/js/autocomplete.js', array( 'jquery' ), '1.0.0', false );
		 wp_enqueue_script( 'pls-autocomplete-control' );
	}
	
	/**
	 * Render pls_autocomplete control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
        <div class="elementor-control-field">
            <label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <# var multiple = ( data.multiple ) ? 'multiple' : ''; #>
                <select
					id="<?php echo esc_attr( $control_uid ); ?>" 
					class="elementor-select2" 
					type="select2" 
					{{ multiple }} 
					data-setting="{{ data.name }}" 
					data-post-type="{{ data.post_type }}"
					data-taxonomy="{{ data.taxonomy }}"
					data-placeholder="<?php echo esc_attr__( 'Search', 'pls-core' ); ?>">
					
                    <# _.each( data.options, function( option_title, option_value ) {
						var value = data.controlValue;						
						if ( typeof value == 'string' ) {
							var selected = ( option_value === value ) ? 'selected' : '';
						} else if ( null !== value ) {
							var value = _.values( value );
							var selected = ( -1 !== value.indexOf( option_value ) ) ? 'selected' : '';
						}
						#>
						<option {{ selected }} value="{{ option_value }}">{{{ option_title }}}</option>
                    <# } ); #>
                </select>
            </div>
        </div>
        <# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
        <# } #>
		<?php
	}
	
	/**
	 * Get pls_autocomplete one area control default settings.
	 * @since 1.0.0
	 * @access protected
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'label_block' => true,
			'options'     => [],
			'multiple'    => false,						
			'taxonomy'    => false,
			'post_type'   => false,
			'callback'    => '',
		];
	}
}
