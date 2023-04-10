
window.addEventListener("load", function() {
	document.querySelector('.bars').addEventListener('click', ()=>{
		document.querySelector('.main-menu').classList.add('main-menu__show');
		document.querySelector('.dark-back').classList.add('dark-back__show');
	});
	document.querySelector('.exit').onclick = document.querySelector('.dark-back').onclick = function() {
		document.querySelector('.main-menu').classList.remove('main-menu__show');
		document.querySelector('.dark-back').classList.remove('dark-back__show');
	}

	if(document.querySelector('.admin-car-price__container')) {
	    const table = document.querySelector('.admin-car-price__container');
	    table.addEventListener('click', function(e) {
	        let target = e.target;
	        if(target.className !== 'admin-car-price__form-btn') return;
	        e.preventDefault();
            let form = target.closest('.admin-car-price__form');

            let orderUrl = form.getAttribute('action');
            let formData = new FormData(form);
            let json = JSON.stringify(Object.fromEntries(formData));

            fetch(orderUrl, {
                headers    : {
                    "Content-Type"    : "application/json",
                    "Accept"          : "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                },
                method     : 'post',
                credentials: "same-origin",
                body: json,
            })
            .then(() => {
                target.classList.add('admin-car-price__form-btn-ajax');
                target.innerHTML = 'Сохраненно';
                let inputs = form.querySelectorAll('input');
                for (input of inputs) {
                    input.classList.add('admin-car-price__input-ajax');
                }
                setTimeout(function() {
                    target.classList.remove('admin-car-price__form-btn-ajax');
                    target.innerHTML = 'Редактировать';
                    for (input of inputs) {
                        input.classList.remove('admin-car-price__input-ajax');
                    }
                }, 1000);
            })
            .catch(function (error) {
                target.classList.add('admin-car-price__form-btn-ajax__error');
                target.innerHTML = 'Ошибка';
                for (input of inputs) {
                    input.classList.add('admin-car-price__input-ajax__error');
                }
                setTimeout(function() {
                    target.classList.remove('admin-car-price__form-btn-ajax__error');
                    target.innerHTML = 'Редактировать';
                    for (input of inputs) {
                        input.classList.remove('admin-car-price__input-ajax__error');
                    }
                }, 1000);
            });
        });
    }

});
