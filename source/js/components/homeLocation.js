import vars from '../_vars';

import {removeCustomClass, removeClassInArray} from '../functions/customFunctions';
const {
	mobileMenu,
	anchorLinks,
	activeClass} = vars;

window.addEventListener('DOMContentLoaded', function() {
    anchorLinks.forEach(function(item){
        item.addEventListener('click', function(e){
            let clickValue = item.getAttribute('href');

            if(!document.body.classList.contains('home')) {
                window.location.href = `${window.location.origin}/${clickValue}`;

                removeCustomClass(mobileMenu,activeClass);
                removeClassInArray(burger,activeClass);
                removeCustomClass(overlay,activeClass);
            }
        });
    });
});