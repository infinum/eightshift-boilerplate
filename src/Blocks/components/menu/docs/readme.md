# Menu Component

A component used for rendering WordPress's menu. Comes in 2 variations - vertical and horizontal.

## Dependencies

None

## Attributes

* _@param_ **blockClass** | `string` | default: `"menu"` | Component's class. You shouldn't really override this.

* _@param_ **menu** | `string` | default: `"header_main_nav"` | Name of the WordPress menu you wish to render. Default's to the Boilerplate's default main menu name.

* _@param_ **modifier** | `string` | Modifier class to attach to the menu's top level `<ul>` element.

* _@param_ **variation** | `string` | **Required** | Variation of the menu, by the default the only 2 values that do anything are `horizontal` & `vertical`.

## Example call

```php
use Eightshift_Libs\Helpers\Components;

Components::render( 'menu', [ 'variation' => 'horizontal' ] ) );

// or

Components::render( 'menu', [
	'menu' => 'alternative_menu_name',
	'variation' => 'vertical',
	'modifier' => 'bem-modifier',
] );
```

## Implementation

1. Copy/Paste component folder in your project (if it's not already there)
2. Rename `Eightshift_Boilerplate` namespace to your project's namespace..
3. Add or remove features you are going to use.
4. Implement project specific styles.
5. Implement in your block(s) by providing necessary attributes.
