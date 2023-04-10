import Swiper, { Navigation } from 'swiper';
import 'swiper/css';
Swiper.use([Navigation]);

window.addEventListener("load",()=>{
    let body = document.body;

    let nameInput = document.querySelector("#user-name");
    let loader = document.querySelector('.load-order');
    let phoneInput = document.querySelector("#user-phone");
    let orderBtn = document.querySelector('#order-submit');

    let inputDatePicker = document.getElementById('input-id');
    let carPriceCurrent = document.querySelector('.car-price__current');

    let carPriceShort = +carDefaultPrice.price3;

    let servicesPrice = document.querySelector('#services_price');
    let deliveryPrice = document.querySelector('#delivery_price');
    let deliveryPriceBack = document.querySelector('#delivery_price_back');
    let totalPrice = document.querySelector('#rent-total_price');

    let daysMath = document.querySelector('#price-item__day-count');
    let daysCountPrice = document.querySelector('#day_count');

    let startPlace = document.querySelector('#start_place');
    let startTime = document.querySelector('#start_time');

    let endPlace = document.querySelector('#end_place');
    let endTime = document.querySelector('#end_time');

    let serviceText = document.querySelector('#service-input__text');
    let serviceItem = document.querySelectorAll('.service-item');
    let serviceContainer = document.querySelector('#service-container');

    let extraTime = 0;
    let startExtraTime = 0;
    let endExtraTime = 0;


    let datePicker = new HotelDatepicker(inputDatePicker, {
        format: 'DD.MM.YYYY',
        minNights: 2,
        startOfWeek: 'monday',
        i18n: {
            selected: 'Даты:',
            night: 'сутки',
            nights: 'суток',
            button: 'Применить',
            'checkin-disabled': 'Бронирование запрещено',
            'checkout-disabled': 'Бронирование запрещено',
            'day-names-short': ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            'day-names': ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
            'month-names-short': ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
            'month-names': ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            'error-more': 'Бронирование должно быть не больше 1 дня',
            'error-more-plural': 'Бронирование должно быть не больше %d дней',
            'error-less': 'Бронирование должно быть не менее 1 дней',
            'error-less-plural': 'Бронирование должно быть не менее %d дней',
            'info-more': 'Выберите даты',
            'info-more-plural': 'Бронирование от %d дней',
            'info-range': 'Выберите даты между %d и %d днями',
            'info-default': 'Выберите даты',
        }
    });

    let startId;
    let endId;
    let customDeliveryPriceBack = 0;


    let customPlace = false;
    if(document.querySelector('.place-selector-default')) {
        customPlace = true;
        startId = document.querySelector('.place-selector-default').dataset.id;
        endId = startId;
        customDeliveryPriceBack = placeData[startId].delivery_price;
        for(let spot in placeData) {
            if(placeData[spot].delivery_price === 0) {
                placeData[spot].delivery_price = placeData[startId].delivery_price;
            }
        }
        placeData[startId].delivery_price = 0;

    } else {
        startId = startPlace.options[startPlace.selectedIndex].value;
        endId = endPlace.options[endPlace.selectedIndex].value;
    }


    let prices = {
        'deliveryPrice': placeData[startId].delivery_price,
        'extraPrice': 0,
        'deliveryPriceBack': placeData[endId].delivery_price,
        'extraPriceBack': 0,
        'dayPrice': carPriceShort,
        'extraTime': 0,
        'services': 0,
        'serviceAmount': 0,
        'days': +datePicker.getNights(),
    };

    if(!customPlace) {
        NiceSelect.bind(document.getElementById("start_place"));
    }
    NiceSelect.bind(document.getElementById("start_time"));
    NiceSelect.bind(document.getElementById("end_place"));
    NiceSelect.bind(document.getElementById("end_time"));


    let checkList = document.getElementById('list1');
    checkList.getElementsByClassName('anchor')[0].onclick = function() {
        if (checkList.classList.contains('visible'))
            checkList.classList.remove('visible');
        else
            checkList.classList.add('visible');
    }
    body.onclick = function(elem) {
        if (!checkList.contains(elem.target)) {  // проверяем, что клик не по элементу и элемент виден
            checkList.classList.remove('visible');
        }
    }

    if(document.querySelector('#price-table'))
    {
        let extraTime = 0;
        let startExtraTime = 0;
        let endExtraTime = 0;


        function setPrices() {
            if(customPlace) {
                startId = document.querySelector('.place-selector-default').dataset.id;
            } else {
                startId = startPlace.options[startPlace.selectedIndex].value;
            }

            endId = endPlace.options[endPlace.selectedIndex].value;

            prices.deliveryPrice = placeData[startId].delivery_price;
            prices.deliveryPriceBack = placeData[endId].delivery_price;

            prices.extraPrice = (startExtraTime === 1) ? placeData[startId].extra_price : 0;

            prices.extraPriceBack = (endExtraTime === 1) ? placeData[endId].extra_price : 0;
            prices.days = +datePicker.getNights() + extraTime;

            if(prices.days <= placeData[startId].min_days) {
                prices.extraPrice += +placeData[startId].min_days_price;
            }
            if(prices.days <= placeData[endId].min_days && endId === startId) {
                prices.extraPriceBack += +placeData[endId].min_days_price;
            }

            let totalCountPrice = countPrice();

            prices.dayPrice = Math.floor(totalCountPrice / +datePicker.getNights());
            if( extraTime > 0 ) {
                totalCountPrice += +prices.dayPrice;
            }
            carPriceCurrent.innerHTML = prices.dayPrice;

            if(prices.serviceAmount > 0) {
                serviceText.innerHTML = 'Доп. услуги: ' + prices.serviceAmount;
            } else {
                serviceText.innerHTML = 'Нет выбранных доп. услуг';
            }

            daysMath.innerHTML = prices.dayPrice + ' руб. x ' + prices.days + ' суток';
            servicesPrice.innerHTML = +prices.services;
            deliveryPrice.innerHTML = +prices.deliveryPrice + +prices.extraPrice;
            deliveryPriceBack.innerHTML = +prices.deliveryPriceBack + +prices.extraPriceBack;
            daysCountPrice.innerHTML = Math.floor(prices.dayPrice * prices.days);
            totalPrice.innerHTML = Math.floor(prices.dayPrice * prices.days +
                +prices.deliveryPrice + +prices.extraPrice +
                +prices.deliveryPriceBack + +prices.extraPriceBack  +
                +prices.services);
        }

        let totalService = 0;
        let countService = 0;
        for (let item of serviceItem) {
            if(item.checked) {
                totalService += +item.dataset.price;
                countService += 1;
            }
        }
        prices.serviceAmount = countService;
        prices.services = totalService;

        setPrices();


        serviceContainer.onclick = function (e){
            let target = e.target;
            if(!target.classList.contains('service-item')) return;
            let total = 0;
            let count = 0;
            for (let item of serviceItem) {
                if(item.checked) {
                    total += +item.dataset.price;
                    count += 1;
                }
            }
            prices.serviceAmount = count;
            prices.services = total;

            setPrices();
        }

        function countPrice() {
            let dates = datePicker.getValue().split(' - ');
            dates[0] = dates[0].split('.');
            dates[1] = dates[1].split('.');

            let orderDate = [];
            orderDate[0] = new Date(dates[0][2], dates[0][1] - 1 , dates[0][0]);
            orderDate[1] = new Date(dates[1][2], dates[1][1] - 1, dates[1][0]);
            let totalPriceCount = 0;
            if(orderDate[0].getFullYear() === orderDate[1].getFullYear()) {
                let year = orderDate[0].getFullYear();

                for (let item in carPrices) {
                    carPrices[item]['start'] = new Date(carPrices[item]['start']).setFullYear(year);
                    carPrices[item]['end'] = new Date(carPrices[item]['end']).setFullYear(year);
                    carPrices[item]['end'] = new Date(carPrices[item]['end']).setHours(23,59,59);
                }
                let custom = false;
                for (let day = new Date(dates[0][2], dates[0][1] - 1 , dates[0][0]); day < orderDate[1]; day.setDate(day.getDate() + 1)) {
                    for (let item in carPrices) {
                        custom = false;
                        if(day.getTime() >= carPrices[item]['start'] && day.getTime() <= carPrices[item]['end']) {
                            if(prices.days > 9) {
                                totalPriceCount += +carPrices[item]['price'];
                            } else if(prices.days > 3) {
                                totalPriceCount += +carPrices[item]['price2'];
                            } else {
                                totalPriceCount += +carPrices[item]['price3'];
                            }
                            custom = true;

                            break;
                        }
                    }
                    if(custom === false) {
                        if(prices.days > 9) {
                            totalPriceCount += +carDefaultPrice.price;
                        } else if(prices.days > 3) {
                            totalPriceCount += +carDefaultPrice.price2;
                        } else {
                            totalPriceCount += +carDefaultPrice.price3;
                        }
                    }
                }

            } else {
                for (let item in carPrices) {
                    carPrices[item]['end'] = new Date(carPrices[item]['end']).setHours(23,59,59);
                }
                let custom = false;
                for (let day = new Date(dates[0][2], dates[0][1] - 1 , dates[0][0]); day < orderDate[1]; day.setDate(day.getDate() + 1)) {
                    for (let item in carPrices) {
                        custom = false;
                        let year = day.getFullYear();
                        carPrices[item]['start'] = new Date(carPrices[item]['start']).setFullYear(year);
                        carPrices[item]['end'] = new Date(carPrices[item]['end']).setFullYear(year);
                        if(day.getTime() >= carPrices[item]['start'] && day.getTime() <= carPrices[item]['end']) {
                            if(prices.days > 9) {
                                totalPriceCount += +carPrices[item]['price'];
                            } else if(prices.days > 3) {
                                totalPriceCount += +carPrices[item]['price2'];
                            } else {
                                totalPriceCount += +carPrices[item]['price3'];
                            }
                            custom = true;
                            break;
                        }
                    }
                    if(custom === false) {
                        if(prices.days > 9) {
                            totalPriceCount += +carDefaultPrice.price;
                        } else if(prices.days > 3) {
                            totalPriceCount += +carDefaultPrice.price2;
                        } else {
                            totalPriceCount += +carDefaultPrice.price3;
                        }
                    }
                }

            }
            return totalPriceCount;
        }

        inputDatePicker.addEventListener('afterClose', function () {
            setPrices();
        }, false);



        startTime.onchange = endTime.onchange = function() {
            let diffTime = +endTime.value.slice(0,2) - +startTime.value.slice(0,2);
            if(diffTime > 2) {
                extraTime = 1;
            } else {
                extraTime = 0;
            }
            if(+startTime.value.slice(0,2) < 8 || +startTime.value.slice(0,2) > 19) {
                startExtraTime = 1;
            } else {
                startExtraTime = 0;
            }
            if(+endTime.value.slice(0,2) < 8 || +endTime.value.slice(0,2) > 19) {
                endExtraTime = 1;
            } else {
                endExtraTime = 0;
            }
            setPrices();
        }
        if(!customPlace) {
            startPlace.addEventListener('change', setPrices);
        }
        endPlace.addEventListener('change', setPrices);


        // })
        // .catch(function (error) {
        //     //Сделать вывод ошибки сервера
        //     console.log(error);
        // });
        if (orderBtn) {
            orderBtn.addEventListener('click', fetchOrder);
        }

    }

    if(document.querySelector('#price-list'))
    {
        let carPriceLong = +document.querySelector('.price-long').innerHTML;
        let carPriceMedium = +document.querySelector('.price-medium').innerHTML;
        let carPriceShort = +document.querySelector('.price-short').innerHTML;

        let carPriceLongItem = document.querySelector('.price-list__item-long');
        let carPriceMediumItem = document.querySelector('.price-list__item-medium');
        let carPriceShortItem = document.querySelector('.price-list__item-short');

        let carPriceOld = document.querySelector('.car-price__old');

        function setPrices() {
            if(customPlace) {
                startId = document.querySelector('.place-selector-default').dataset.id;
            } else {
                startId = startPlace.options[startPlace.selectedIndex].value;
            }

            endId = endPlace.options[endPlace.selectedIndex].value;

            prices.deliveryPrice = placeData[startId].delivery_price;
            prices.deliveryPriceBack = placeData[endId].delivery_price;

            prices.extraPrice = (startExtraTime === 1) ? placeData[startId].extra_price : 0;
            prices.extraPriceBack = (endExtraTime === 1) ? placeData[endId].extra_price : 0;
            prices.days = +datePicker.getNights() + extraTime;

            if(prices.days <= placeData[startId].min_days) {
                prices.extraPrice += +placeData[startId].min_days_price;
            }
            if(prices.days <= placeData[endId].min_days && endId === startId) {
                prices.extraPriceBack += +placeData[endId].min_days_price;
            }

            if(prices.days > 9) {
                prices.dayPrice = carPriceLong;
                carPriceCurrent.innerHTML = carPriceLong;
                carPriceOld.innerHTML = carPriceShort+'руб.';
                document.querySelector('.price-list__item-active').classList.remove('price-list__item-active');
                carPriceLongItem.classList.add('price-list__item-active');
            } else if(prices.days > 3) {
                prices.dayPrice = carPriceMedium;
                carPriceOld.innerHTML = carPriceShort+'руб.';
                carPriceCurrent.innerHTML = carPriceMedium;
                document.querySelector('.price-list__item-active').classList.remove('price-list__item-active');
                carPriceMediumItem.classList.add('price-list__item-active');
            } else {
                prices.dayPrice = carPriceShort;
                carPriceOld.innerHTML = '';
                carPriceCurrent.innerHTML = prices.dayPrice;
                document.querySelector('.price-list__item-active').classList.remove('price-list__item-active');
                carPriceShortItem.classList.add('price-list__item-active');
            }

            if(prices.serviceAmount > 0) {
                serviceText.innerHTML = 'Доп. услуги: ' + prices.serviceAmount;
            } else {
                serviceText.innerHTML = 'Нет выбранных доп. услуг';
            }

            daysMath.innerHTML = prices.dayPrice + ' руб. x ' + prices.days + ' суток';
            servicesPrice.innerHTML = +prices.services;
            deliveryPrice.innerHTML = +prices.deliveryPrice + +prices.extraPrice;
            deliveryPriceBack.innerHTML = +prices.deliveryPriceBack + +prices.extraPriceBack;
            daysCountPrice.innerHTML = Math.floor(prices.dayPrice * prices.days);
            totalPrice.innerHTML = Math.floor(prices.dayPrice * prices.days +
                +prices.deliveryPrice + +prices.extraPrice +
                +prices.deliveryPriceBack + +prices.extraPriceBack  +
                +prices.services);
        }
        let totalService = 0;
        let countService = 0;
        for (let item of serviceItem) {
            if(item.checked) {
                totalService += +item.dataset.price;
                countService += 1;
            }
        }
        prices.serviceAmount = countService;
        prices.services = totalService;

        setPrices();


        serviceContainer.onclick = function (e){
            let target = e.target;
            if(!target.classList.contains('service-item')) return;
            let total = 0;
            let count = 0;
            for (let item of serviceItem) {
                if(item.checked) {
                    total += +item.dataset.price;
                    count += 1;
                }
            }
            prices.serviceAmount = count;
            prices.services = total;

            setPrices();
        }

        inputDatePicker.addEventListener('afterClose', function () {
            setPrices();
        }, false);

        startTime.onchange = endTime.onchange = function() {
            let diffTime = +endTime.value.slice(0,2) - +startTime.value.slice(0,2);
            if(diffTime > 2) {
                extraTime = 1;
            } else {
                extraTime = 0;
            }
            if(+startTime.value.slice(0,2) < 8 || +startTime.value.slice(0,2) > 19) {
                startExtraTime = 1;
            } else {
                startExtraTime = 0;
            }
            if(+endTime.value.slice(0,2) < 8 || +endTime.value.slice(0,2) > 19) {
                endExtraTime = 1;
            } else {
                endExtraTime = 0;
            }
            setPrices();
        }
        if(!customPlace) {
            startPlace.addEventListener('change', setPrices);
        }
        endPlace.addEventListener('change', setPrices);


        // })
        // .catch(function (error) {
        //     //Сделать вывод ошибки сервера
        //     console.log(error);
        // });

        if (orderBtn) {
            orderBtn.addEventListener('click', fetchOrder);
        }


    }



    function fetchOrder (e) {
        e.preventDefault();
        if(nameInput.value.length < 1) {
            nameInput.classList.add('input-error');
            return;
        }
        nameInput.classList.remove('input-error');
        if(phoneInput.value.length < 16 || phoneInput.value.length > 19) {
            phoneInput.classList.add('input-error');
            return;
        }
        phoneInput.classList.remove('input-error');
        orderBtn.setAttribute('disabled', '');

        loader.classList.remove('loader-hide');

        let form = document.querySelector('#order-form');
        let orderUrl = form.getAttribute('action');
        let service = '';
        for(let item of serviceItem) {
            if(item.checked === true) {
                service += item.value+',';
            }
        }
        let formData = new FormData(form);
        formData.append('service', service);
        if(customPlace) {
            formData.append('start_place', +startId);
        }
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
            .then(response => response.json())
            .then(data => {
                console.log(data);
                loader.innerHTML = data.result;
            })
            .catch(function (error) {
                console.log(error);
            });

    }

    let checkoutButton = document.querySelector('#checkout-button');
    if(checkoutButton) {
        let checkoutClose = document.querySelector('.order-contact__close-btn');
        let orderContact = document.querySelector('.order-contact__container');
        let darkBack = document.querySelector('.dark-back-car');
        let startDelivery = document.querySelector('.order-main__start-place');
        let endDelivery = document.querySelector('.order-main__end-place');

        checkoutButton.addEventListener('click',function() {
            let orderDate = datePicker.getValue().split(' - ');
            orderContact.classList.add('order-contact__container-show');
            darkBack.classList.add('dark-back__show');
            body.style.overflow = 'hidden';
            startDelivery.innerHTML = placeData[startId].name + ' ' + orderDate[0];
            endDelivery.innerHTML = placeData[endId].name + ' ' + orderDate[1];
        } );
        checkoutClose.onclick = darkBack.onclick = function() {
            orderContact.classList.remove('order-contact__container-show');
            darkBack.classList.remove('dark-back__show');
            body.style.overflow = '';
        }
    }

    let prefixNumber = (str) => {
        if (str === "7") {
            return "7 (";
        }
        if (str === "8") {
            return "8 (";
        }
        if (str === "9") {
            return "7 (9";
        }
        return "7 (";
    };

    // ======================================
    phoneInput.addEventListener("input", (e) => {
        let value = phoneInput.value.replace(/\D+/g, "");
        let numberLength = 11;

        let result;
        if (phoneInput.value.includes("+8") || phoneInput.value[0] === "8") {
            result = "";
        } else {
            result = "+";
        }

        //
        for (let i = 0; i < value.length && i < numberLength; i++) {
            switch (i) {
                case 0:
                    result += prefixNumber(value[i]);
                    continue;
                case 4:
                    result += ") ";
                    break;
                case 7:
                    result += "-";
                    break;
                case 9:
                    result += "-";
                    break;
                default:
                    break;
            }
            result += value[i];
        }
        //
        phoneInput.value = result;
    });

});

if(document.querySelector('.car-image__slider')) {
    const swiper = new Swiper('.car-image__slider', {
        slidesPerView: 1,
        loop: false,
        speed: 300,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

    });
}
