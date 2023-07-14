# Template extensibility example

This is a plugin to demo potential extensibility work being done with WooCommerce templates.

It makes use of the product template registry and template extensibility methods in [this POC PR](https://github.com/woocommerce/woocommerce/pull/39129).  

## Setup

1. Build, install, and activate [this branch](https://github.com/woocommerce/woocommerce/pull/39129) of WooCommerce.
2. Enable the new product editing experience under WooCommerce -> Settings -> Advanced -> Features.
3. Install and activate this plugin.
4. Navigate to Products -> Add new.
5. See the custom field added to the simple product template and removed description field.
6. Use the dropdown at the top of the page to toggle between product templates.

## Usage

### Extending an existing template

In the current POC, templates can be extended with the following methods:

```php
// Add a group to the template.  Currently this takes the shape of a tab in the new product UI.
$template->add_group(
	array(
		'id'    => string | null,
		'title' => string,
		'order' => integer | null,
	)
);

// Add a section to the template.  Sections can also be subsections if added to a respective section parent.
$template->add_section(
	array(
		'id'          => string | null,
		'parent'      => string,
		'title'       => string | null,
		'description' => string | null,
		'order'       => integer | null,
	)
);

// Add a field to the template.
$template->add_field(
	array(
		'id'        => string | null,
		'parent'    => string,
		'blockName' => string,
		'attrs'     => array | null,
		'order'     => integer | null,
	)
);
```

### Getting an existing template

Templates can be retrieved from the registry using the registry class and methods:

```
$template_registry = Automattic\WooCommerce\Admin\Features\ProductBlockEditor\ProductTemplates\ProductTemplateRegistry::get_instance();
$template = $template_registry->get_registered( 'simple' );
```

### Creating a new template

Or you can create a new custom template by extending the `AbstractProductTemplate` class or `BaseProductTemplate` class if you want the base fields.

```php
class MyCustomTemplate extends AbstractProductTemplate {
	public function __construct() {
		$this->add_group( ... );
		$this->add_section( ... );
		$this->add_field( ... );
	}
}

$template_registry = Automattic\WooCommerce\Admin\Features\ProductBlockEditor\ProductTemplates\ProductTemplateRegistry::get_instance();

$template_registry->register( 'my-custom-template', new MyCustomTemplate() );
```

### Using templates

Templates registered with the product template registry will automatically be accessible via REST API: `wp-json/wp/v2/templates?post_type=woocommerce_product_editor_template`

The POC PR also includes a dropdown that shows registered product templates in a list for easy testing.