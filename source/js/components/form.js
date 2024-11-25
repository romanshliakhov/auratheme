import {addCustomClass, fadeOut, removeCustomClass} from "../functions/customFunctions";
import vars from '../_vars'

const {formWrappers,activeMode, activeClass} = vars;

formWrappers.forEach(formWrapper => {
	const formSubmitBtn = formWrapper.querySelector('.main-form__btn');

	if (formWrapper && formSubmitBtn) {
		formSubmitBtn.addEventListener('click', function (){
			removeCustomClass(formWrapper, 'loaded');
			addCustomClass(formWrapper, 'loader');
		})
	
		formWrapper.addEventListener( 'wpcf7invalid', function( event ) {
			setTimeout(function (){
				addCustomClass(formWrapper, 'loaded')
			}, 1500)
		}, false );
	
	
		formWrapper.addEventListener( 'wpcf7mailsent', function( event ) {
			console.log('send');

			removeCustomClass(formWrapper, 'loader');
			removeCustomClass(formWrapper, 'loaded');
		}, false );
	
		formWrapper.addEventListener( 'wpcf7mailfailed', function( event ) {
			removeCustomClass(formWrapper, 'loader');
			removeCustomClass(formWrapper, 'loaded');
		}, false );
	}
})

