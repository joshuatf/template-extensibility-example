<?php
/**
 * Plugin Name: Template Extensibility Example
 * Author: Joshua Flowers
 * Version: 0.1.0
 */

class TemplateExtensibilityExample {

    /**
     * Simple template
     */
    private $simple_template;

    /**
     * Set up the plugin.
     */
    public function __construct() {
        add_action( 'init', array( $this, 'init' ) );
    }

    /**
     * Initialize the template changes.
     */
    public function init() {
        if ( ! $this->has_minimum_requirements() ) {
            return;
        }

        $template_registry     = Automattic\WooCommerce\Admin\Features\ProductBlockEditor\ProductTemplates\ProductTemplateRegistry::get_instance();
        $this->simple_template = $template_registry->get_registered( 'simple' );
        if ( ! $this->simple_template ) {
            return;
        }

        include_once __DIR__ . '/template-extensibility-example-template.php';
        $this->add_custom_radio();
        $this->remove_description();
        $this->add_custom_template();
    }

    /**
     * Check if the minimum requirements exist.
     *
     * @return bool
     */
    public function has_minimum_requirements() {
        return class_exists( 'Automattic\WooCommerce\Admin\Features\ProductBlockEditor\ProductTemplates\ProductTemplateRegistry' );
    }
    
    /**
     * Add custom radio.
     */
    public function add_custom_radio() {
        $this->simple_template->add_field(
            array(
                'parent' => $this->simple_template::BASIC_DETAILS_SECTION,
                'blockName'  => 'woocommerce/product-radio-field',
                'attrs' => array(
                    'title'    => __( 'Custom radio', 'text-domain' ),
                    'description' => __( 'Custom radio field description.', 'text-domain' ),
                    'property' => 'product_property',
                    'options'  => array(
                        array(
                            'label' => __( 'Option A', 'text-domain' ),
                            'value' => 'a',
                        ),
                        array(
                            'label' => __( 'Option B', 'text-domain' ),
                            'value' => 'b',
                        ),
                        array(
                            'label' => __( 'Option C', 'text-domain' ),
                            'value' => 'c',
                        ),
                    ),
                ),
            )
        );
    }

    /**
     * Remove the description section from the simple template.
     */
    public function remove_description() {
        $this->simple_template->remove_block( $this->simple_template::DESCRIPTION_SECTION );
    }

    /**
     * Add a custom product template.
     */
    public function add_custom_template() {
        $template_registry     = Automattic\WooCommerce\Admin\Features\ProductBlockEditor\ProductTemplates\ProductTemplateRegistry::get_instance();
        $template_registry->register( 'my-custom-template', new TemplateExtensibilityExampleTemplate() );
    }
}

new TemplateExtensibilityExample();