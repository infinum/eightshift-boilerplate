# Copyright Component

A component used for rendering site's copyright.

## Dependencies

None

## Attributes

* _@param_ **blockClass** | `string` | default: `"header"` | Component's class. If modifying make sure the provide the default class as well (see an example call).
* _@param_ **by** | `string` | default: `"Infinum"` | Name of copyright holder. Generally should be your website / company's name.
* _@param_ **year** | `int` | default: `gmdate( 'Y' ) (current year)` | Year of the copyright, defaults to current year.

## Example call

```php
use EightshiftLibs\Helpers\Components;

Components::render( 'copyright' );

// or... 

Components::render( 'copyright', [
	'by' => 'Your site name',
] );
```

## Implementation

1. Copy/Paste component folder in your project..
2. Rename `eightshift-boilerplate` namespace to your project's namespace..
3. Add or remove features you are going to use.
4. Implement project specific styles.
5. Implement in your block(s) by providing necessary attributes.
