# Header Component

A component used for setting the site's header. Should be used (only once) in `header.php`

## Dependencies

None.

_Default usage in Eightshift Boilerplate's `header.php` is dependant on the following components:_
```
components/hamburger
components/menu
components/logo
components/drawer
```

## Attributes

* _@param_ **blockClass** | `string` | default: `"header"` | Component's class. If modifying make sure the provide the default class as well (see example call).
* _@param_ **left** | `string|array` | Component (html string or array of html strings) to render on the **left** side of the header.
* _@param_ **center** | `string|array` | Component (html string or array of html strings) to render in the **center** of the header.
* _@param_ **right** | `string|array` | Component (html string or array of html strings) to render on the **right** side of the header.

## Example

```php
use Eightshift_Libs\Helpers\Components;

Components::render( 'header', [
	'left' => [
		Components::render( 'hamburger' ),
		Components::render( 'drawer', [
			'trigger' => 'js-hamburger',
			'overlay' => 'js-page-overlay',
			'drawerPosition' => 'left',
			'menu' => Components::render( 'menu', [ 'variation' => 'vertical' ] ),
		] ),
	],
	'center' => Components::render( 'logo' ),
	'right' => Components::render( 'menu', [ 'variation' => 'horizontal' ] ),
] )
```

## Implementation

1. Copy/Paste component folder in your project (if it's not already there)
2. Rename `Eightshift_Boilerplate` namespace to your project's namespace..
3. Add or remove features you are going to use.
4. Implement project specific styles.
5. Implement in your block(s) by providing necessary attributes.
