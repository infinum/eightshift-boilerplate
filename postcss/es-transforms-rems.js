const postcss = require('postcss');

module.exports = postcss.plugin('es-transform-rems', () => {
	return (css) => {
		css.walkDecls((decl) => {
			decl.value = decl.value.replace(/([0-9.-]+rem)/g, 'calc($1 * var(--base-font-size, 1))');
		});
	};
});
