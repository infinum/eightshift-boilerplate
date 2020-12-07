# Logo Component

A component used for rendering site's logo. Should be usable without any parameters (but you can still override things if needed)
## Dependencies

None

## Attributes

* _@param_ **blockClass** | `string` | default: `"logo"` | Component's class. If modifying make sure the provide the default class as well (see example call).

* _@param_ **src** | `string` | default: _Path to the default Infinum logo in `assets`_ | Logo's src URL (used as `<img src="$src" ...>`), should be an image or SVG (if using svg make sure it's not being filtered out by `wp_kses_post()`)

* _@param_ **alt** | `string` | default: `get_bloginfo( 'name' ) . ' logo'` | Alt tag for the logo `<img>` element. 

* _@param_ **href** | `string` | default: `get_bloginfo( 'url' )` | URL that the logo links to. Defaults to site url.

## Example call

```php
use Eightshift_Libs\Helpers\Components;

Components::render( 'logo' )

// or

Components::render( 'logo', [
	'blockClass' => 'logo logo--modifier',
	'src' => 'http://your-site/your-logo.jpg',
	'alt' => 'Some alternative alt tag',
	'href' => 'http://your-alternative-link.com',
] );
```

## Implementation

1. Copy/Paste component folder in your project (if it's not already there)
2. Rename `Eightshift_Boilerplate` namespace to your project's namespace..
3. Add or remove features you are going to use.
4. Implement project specific styles.
5. Implement in your block(s) by providing necessary attributes.
