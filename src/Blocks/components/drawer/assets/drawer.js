export class Drawer {
	constructor(
		selector = '.js-drawer',
		CLASS_IS_OPEN = 'menu-is-open',
		CLASS_OVERLAY_IS_SHOWING = 'page-overlay-shown',
		CLASS_NO_SCROLL = 'u-no-scroll'
	) {
		this.CLASS_IS_OPEN = CLASS_IS_OPEN;
		this.CLASS_OVERLAY_IS_SHOWING = CLASS_OVERLAY_IS_SHOWING;
		this.CLASS_NO_SCROLL = CLASS_NO_SCROLL;
		this.drawer = document.querySelector(selector);
		this.trigger = document.querySelector(`.${this.drawer.getAttribute('data-trigger')}`);
		this.overlay = null;

		// Set overlay only if there is one to select.
		if (this.drawer.getAttribute('data-overlay')) {
			this.overlay = document.querySelector(`.${this.drawer.getAttribute('data-overlay')}`);
		}
	}
	
	preventScroll() {
		document.body.style.top = `-${window.scrollY}px`;
		document.body.classList.add(this.CLASS_NO_SCROLL);
	}
	
	enableScroll() {
		const scrollY = document.body.style.top;
		document.body.classList.remove(this.CLASS_NO_SCROLL);
		document.body.style.top = '';
		window.scrollTo(0, parseInt(scrollY || '0', 10) * -1);
	}
	
	openMobileMenu() {
		if (this.overlay) {
			document.body.classList.add(this.CLASS_OVERLAY_IS_SHOWING);
		}
		document.body.classList.add(this.CLASS_IS_OPEN);
		this.preventScroll();
	}
	
	closeMobileMenu() {
		if (this.overlay) {
			document.body.classList.remove(this.CLASS_OVERLAY_IS_SHOWING);
		}
		document.body.classList.remove(this.CLASS_IS_OPEN);
		this.enableScroll();
	}
	
	closeMobileMenuOnOverlayClick() {
		if (this.overlay) {
			this.overlay.addEventListener('click', () => {
				this.closeMobileMenu();
			});
		}
	}

	drawerInit() {
		this.trigger.addEventListener('click', () => {
			if (document.body.classList.contains(this.CLASS_IS_OPEN)) {
				this.closeMobileMenu();
			} else {
				this.openMobileMenu();
			}
		});

		this.closeMobileMenuOnOverlayClick();
	}
}
