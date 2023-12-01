window.vdv = window.vdv || {};

(() => {
	'use strict';

	const $  = (a, b = document) => b.querySelector(a);
	const $$ = (a, b = document) => b.querySelectorAll(a);
	const each = (arr, fn) => Array.prototype.forEach.call(arr, fn);
	const isVisible = (elem) => !(elem.offsetWidth === 0 && elem.offsetHeight === 0);
	const scrollTop = () => window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
	const scrollLeft = () => window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft || 0;

	vdv.Share = () => {
		const clickOutside = require('click-outside');
		const toggle = $$('.vdv-share__toggle');

		function init() {
			each(toggle, x => {

				let unbind, active = false;
				const toggle = event => {
					event.preventDefault();
					const target = event.currentTarget || event.target;
					const parent = target.parentNode;
					if (active) {
						parent.classList.remove('vdv-share--active');
						unbind();
					} else {
						parent.classList.add('vdv-share--active');
						unbind = clickOutside(parent, () =>
							active = !!parent.classList.remove('vdv-share--active') );
					}
					active = !active;
				};

				x.addEventListener('click', toggle);

			} );
		}

		return { init };
	}

	vdv.Menu = () => {
		const head          = $('.vdv-head');
		const groups        = $$('.vdv-menu > .menu-item > a');
		const compass       = $('.vdv-head__logo span:first-of-type');
		const plane         = $('.vdv-head__logo span:last-of-type');
		const header        = $('.vdv-post__header');
		const meta          = $('.vdv-post__meta');
		const search_form   = $('.vdv-search-form');
		const search_label  = $('.vdv-search-form__label');
		const search_input  = $('.vdv-search-form__input');
		const toggle_button = $('.vdv-head__toggle');

		let limit = 120;

		function init() {
			if (search_label) search_label.addEventListener('click', showSearch);
			if (search_input) search_input.addEventListener('focus', showSearch);
			if (search_input) search_input.addEventListener('blur', hideSearch);
			if (toggle_button) toggle_button.addEventListener('click', toggleMenu);
			if (groups) each(groups, x => x.addEventListener('click', toggleGroup));
			document.addEventListener('mousemove', onMouseMove);
			window.addEventListener('scroll', onScroll);
			onScroll();
		}

		function onScroll() {
			const scroll_now = scrollTop();
			if (scroll_now > limit) {
				head.classList.add('vdv-head--small');
			} else if (scroll_now <= limit) {
				head.classList.remove('vdv-head--small');
			}

			if (!header || !meta) return;

			const header_rect = header.getBoundingClientRect();
			if (scroll_now > header_rect.bottom + scroll_now) {
				meta.classList.add('vdv-post__meta--fixed');
			} else if (scroll_now <= header_rect.bottom + scroll_now) {
				meta.classList.remove('vdv-post__meta--fixed');
			}
		}

		function showSearch() {
			search_form.classList.add('vdv-search-form--show');
			setTimeout( () => search_input.focus(), 100 );
		}

		function hideSearch(event) {
			event.preventDefault();
			if (search_input.value == '') {
				search_form.classList.remove('vdv-search-form--show');
			}
		}

		function toggleMenu(event) {
			event.preventDefault();
			head.classList.toggle('vdv-head--active');
			each(groups, x => x.parentNode.classList.remove('menu-item--toggled'));
		}

		function toggleGroup(event) {
			if (!isVisible(toggle_button)) {
				return true;
			}
			event.preventDefault();
			const target = event.currentTarget || event.target;
			const parent = target.parentNode;
			const siblings = Array.prototype.filter.call(parent.parentNode.children,
				x => parent !== x );
			parent.classList.toggle('menu-item--toggled');
			each(siblings, x => x.classList.remove('menu-item--toggled'));
		}

		function onMouseMove(event) {
			const rect     = compass.getBoundingClientRect();
			const center_x = (rect.left + scrollLeft()) + compass.offsetWidth / 2;
			const center_y = (rect.top + scrollTop()) + compass.offsetHeight / 2;
			const mouse_x  = event.pageX;
			const mouse_y  = event.pageY;
			const radians  = Math.atan2(mouse_x - center_x, mouse_y - center_y);
			const degree   = (radians * (180 / Math.PI) * -1) + 180;
			rotate(plane, degree + 270);
			rotate(compass, -degree + 90);
		}

		function rotate(element, deg) {
			const style = [
				`-webkit-transform:rotate(${deg}deg)`,
				`-ms-transform:rotate(${deg}deg)`,
				`transform:rotate(${deg}deg)`
			];
			element.setAttribute('style', style.join(';'));
		}

		return { init };
	};

	// vdv.Target = () => {
	// 	const imagesLoaded = require('imagesloaded');
	// 	const smoothScroll = require('smoothscroll');
	// 	const post = $('.vdv-post');

	// 	function init() {
	// 		if (post) {
	// 			ready(jumpTo);
	// 			imagesLoaded(post, jumpTo);
	// 		}
	// 	}

	// 	function ready(fn) {
	// 		if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading"){
	// 			fn();
	// 		} else {
	// 			document.addEventListener('DOMContentLoaded', fn);
	// 		}
	// 	}

	// 	function jumpTo() {
	// 		const hash = window.location.hash;
	// 		const head = $('.vdv-head');
	// 		if (!hash || !head) return;

	// 		const elem = $(hash);
	// 		if (!elem) return;

	// 		const off = head.getBoundingClientRect().y + document.body.scrollTop;
	// 		smoothScroll(elem.offsetTop - off - 90);
	// 		console.log(elem.offsetTop - off - 90);
	// 	}

	// 	return { init };
	// }

	(() => {
		// const lazy = vdcv.Lazy();
		const menu = vdv.Menu();
		const share = vdv.Share();
		// const target = vdv.Target();
		// lazy.init();
		menu.init();
		share.init();
		// target.init();
	})();

})();
