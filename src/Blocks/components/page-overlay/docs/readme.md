# Page Overlay Component

A semi transparent page overlay. Used by the drawer component by default to cover the page while the menu is active. Can also be used for modals or other things (but you will probably have to modify the z-index for that).

## Dependencies

None

## Attributes

* _@param_ **blockClass** | `string` | default: `"hamburger"` | Component's class. If modifying make sure the provide the default class as well (see example call).

## Example call

```php
use Eightshift_Libs\Helpers\Components;

Components::render( 'page-overlay' ) );

// or

Components::render( 'page-overlay', [
	'blockClass' => 'page-overlay page-overlay--modifier',
] );
```

## Implementation

1. Copy/Paste component folder in your project (if it's not already there)
2. Rename `Eightshift_Boilerplate` namespace to your project's namespace..
3. Add or remove features you are going to use.
4. Implement project specific styles.
5. Implement in your block(s) by providing necessary attributes.
