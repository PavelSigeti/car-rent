window.addEventListener("load",()=>{

    let body = document.body;

    let menuBtn = document.querySelector('.menu-header-button');
    let menuCloseBtn = document.querySelector('.menu-close-btn');
    let headerMenu = document.querySelector('.header-menu');
    let darkBack2 = document.querySelector('.dark-back');

    if(menuBtn) {
        menuBtn.onclick = function() {
            headerMenu.classList.add('header-menu__show');
            darkBack2.classList.add('dark-back__show');
            body.style.overflow = 'hidden';
        }
        menuCloseBtn.onclick = darkBack2.onclick = function() {
            headerMenu.classList.remove('header-menu__show');
            darkBack2.classList.remove('dark-back__show');
            body.style.overflow = '';
        }
        window.addEventListener('resize', function(event) {
            if(window.innerWidth > 991.98 && headerMenu.classList.contains('header-menu__show')) {
                headerMenu.classList.remove('header-menu__show');
                darkBack2.classList.remove('dark-back__show');
                body.style.overflow = '';
            }
        }, true);
    }

});
