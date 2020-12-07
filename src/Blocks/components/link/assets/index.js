import domReady from '@wordpress/dom-ready';

domReady(() => {
	const selector = '.js-scroll-to-target';
	const elements = document.querySelectorAll(selector);

	[...elements].forEach((element) => {
		element.addEventListener('click', (event) => {
			event.preventDefault();
			const target = document.querySelector(event.currentTarget.getAttribute('href'));

			window.scrollTo({
				top: target.offsetTop,
				left: 0,
				behavior: 'smooth',
			});
		});
	});
});
