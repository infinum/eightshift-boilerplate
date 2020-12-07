# Wrapper Component

Wrapper is a parent component that you can use inside your block. When you register a block in the `manifest.json` file you can specify do you want to use wrapper or not by setting `wrapperUse` key to true/false option (default is true). When creating you website layout you should think of every block as a specific section that spans from one end of the screen to another. When you structure you mindset like that you can use wrapper to provide layout specific styles to your block without having to add them manually to every block. With that in mind your block can now have option to set a background image, top/bottom spacing, container width, container spacing, anchor tag and all that inside multiple responsive braking points out fot he box. It automatically injects inside of you block with all its attributes.

## Dependencies

1. Child component

## Implementation

1. Copy/Paste block folder in your project.
2. Rename `eightshift-boilerplate` namespace to your project's namespace.
3. Add or remove features you are going to use.
4. Implement project specific styles.
