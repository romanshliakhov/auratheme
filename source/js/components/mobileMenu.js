import { disableScroll } from '../functions/disable-scroll';
import { enableScroll } from '../functions/enable-scroll';
import vars from '../_vars';

import {toggleClassInArray, toggleCustomClass, removeCustomClass, removeClassInArray, addCustomClass} from '../functions/customFunctions';
const {
	overlay,
	burger,
	mobileMenu,
	header,
	anchorLinks,
	activeClass} = vars;

const mobileMenuHandler = function(overlay, mobileMenu, burger) {
	burger.forEach((btn) => {
		btn.addEventListener('click', function(e){
			console.log('here')
			
			e.preventDefault();

			toggleCustomClass(mobileMenu, activeClass);
			toggleClassInArray(burger, activeClass);
			toggleCustomClass(overlay, activeClass);

			if (mobileMenu.classList.contains(activeClass)) {
				disableScroll();
				addCustomClass(header, 'bg');
			} else {
				enableScroll();
			}
		})
	});
}

export const hideMenuHandler = function(overlay, mobileMenu, burger) {
	enableScroll()
	removeCustomClass(mobileMenu,activeClass);
	removeClassInArray(burger,activeClass);
	removeCustomClass(overlay,activeClass);
}

if (overlay) {
	mobileMenuHandler(overlay,mobileMenu,burger);

	overlay.addEventListener('click', function(e){
		if (e.target.classList.contains('overlay')) {
			hideMenuHandler(overlay,mobileMenu,burger);
		}
	});

}






