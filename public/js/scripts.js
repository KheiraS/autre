"use strict"; // utiliser le mode strict, permet de relever des erreurs pour structurer le code
/**************************
 * 1.VARIABLES
 **************************/

/**************************
 * 2.FONCTIONS
 **************************/

/**************************
 * 3.CODE PRINCIPAL
 **************************/
window.addEventListener("resize", function() {
    "use strict"; window.location.reload();
});


document.addEventListener("DOMContentLoaded", function(){

    /////// Prevent closing from click inside dropdown
    document.querySelectorAll('.dropdown-menu').forEach(function(element){
        element.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });

    // make it as accordion for smaller screens
    if (window.innerWidth < 992) {

        // close all inner dropdowns when parent is closed
        document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
            everydropdown.addEventListener('hidden.bs.dropdown', function () {
                // after dropdown is hidden, then find all submenus
                this.querySelectorAll('.megasubmenu').forEach(function(everysubmenu){
                    // hide every submenu as well
                    everysubmenu.style.display = 'none';
                });
            })
        });

        document.querySelectorAll('.has-megasubmenu a').forEach(function(element){
            element.addEventListener('click', function (e) {

                let nextEl = this.nextElementSibling;
                if(nextEl && nextEl.classList.contains('megasubmenu')) {
                    // prevent opening link if link needs to open dropdown
                    e.preventDefault();

                    if(nextEl.style.display == 'block'){
                        nextEl.style.display = 'none';
                    } else {
                        nextEl.style.display = 'block';
                    }

                }
            });
        })
    }
    // end if innerWidth
});
// DOMContentLoaded  end