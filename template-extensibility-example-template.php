<?php

use Automattic\WooCommerce\Admin\Features\ProductBlockEditor\ProductTemplates\AbstractProductTemplate;
use Automattic\WooCommerce\Admin\Features\ProductBlockEditor\ProductTemplates\ProductTemplateInterface;

class TemplateExtensibilityExampleTemplate extends AbstractProductTemplate {

    /**
     * Set up the template.
     */
    public function __construct() {
        $this->add_group(
            array(
                'id'    => 'custom-group-1',
                'title' => 'Custom group 1',
                'order' => 10,
            )
        );
        $this->add_section(
            array(
                'parent' => 'custom-group-1',
                'id'     => 'custom-section-1',
                'title'  => 'Custom section 1',
                'order'  => 10,
            )
        );
        $this->add_field(
            array(
                'parent'    => 'custom-section-1',
                'blockName' => 'woocommerce/product-name-field',
                'attrs'     => array(
                    'name'  => 'Product name',
                ),
            ),
        );
        $this->add_group(
            array(
                'id'    => 'custom-group-2',
                'title' => 'Custom group 2',
                'order' => 10,
            )
        );
        $this->add_section(
            array(
                'parent' => 'custom-group-2',
                'id'     => 'custom-section-2',
                'title'  => 'Custom section 2',
                'order'  => 10,
            )
        );
        $this->add_field(
            array(
                'parent' => 'custom-section-2',
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
	 * Get the slug of the template.
	 *
	 * @return string Template slug
	 */
    public function get_slug() {
        return 'my-custom-template';
    }

    /**
	 * Get the title of the template.
	 *
	 * @return string Template title
	 */
    public function get_title() {
        return __( 'Template extensibility example template.', 'woocommerce' );
    }

    /**
	 * Get the description for the template.
	 *
	 * @return string Template description
	 */
    public function get_description() {
        return __( 'Product template for showcasing template extensibility.', 'woocommerce' );
    }

}