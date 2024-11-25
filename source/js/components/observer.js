import vars from "../_vars";
import {addCustomClass, removeCustomClass, removeClassInArray} from "../functions/customFunctions";
import {hideMenuHandler} from "./mobileMenu";
const {
  mainLinks,
  anchorLinks,
  observerSections,
  overlay,
  mobileMenu,
  burger,
  activeClass
 } = vars;

 const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      anchorLinks.forEach((link) => {
        link.addEventListener('click',function (e){
          mobileMenu.classList.contains(activeClass) && hideMenuHandler(overlay,mobileMenu,burger);
        });

        const id = link.getAttribute('href').match(/[a-zA-Z]+/g).join('');
  
        if (entry.isIntersecting && id === entry.target.id) {
          removeClassInArray(anchorLinks);
          addCustomClass(link, activeClass);
        } else if (!entry.isIntersecting && id === entry.target.id) {
          removeCustomClass(link, activeClass);
        }
      });
    });
  }, {
    threshold: 0.3
  });


observerSections.forEach(section => { observer.observe(section)} );