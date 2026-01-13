function initSliderHome() {
    var sliderHome = document.querySelector('.slider_home');

    if (!sliderHome) {
        return;
    }

    var bootstrapItalia = window.bootstrap;

    if (!bootstrapItalia || typeof bootstrapItalia.CarouselBI !== 'function') {
        console.warn('Bootstrap Italia CarouselBI non disponibile');
        return;
    }

    var carouselInstance = bootstrapItalia.CarouselBI.getOrCreateInstance(sliderHome);

    if (!carouselInstance || !carouselInstance._splide) {
        console.warn('Impossibile ottenere l\'istanza Splide per slider_home.');
        return;
    }

    var splideInstance = carouselInstance._splide;

    splideInstance.options = Object.assign({}, splideInstance.options || {}, {
        type: 'loop',
        perMove: 1,
        arrows: false
    });

    if (typeof splideInstance.refresh === 'function') {
        splideInstance.refresh();
    } else {
        splideInstance.mount();
    }
}

function initSliderItinerari() {
    var sliderItinerari = document.querySelector('.slider_itinerari');

    if (!sliderItinerari) {
        return;
    }

    var bootstrapItalia = window.bootstrap;

    if (bootstrapItalia && typeof bootstrapItalia.CarouselBI === 'function') {
        var carouselInstance = bootstrapItalia.CarouselBI.getOrCreateInstance(sliderItinerari);

        if (!carouselInstance || !carouselInstance._splide) {
            console.warn('Impossibile ottenere l\'istanza Splide per slider_itinerari.');
            return;
        }

        var splideInstance = carouselInstance._splide;

        splideInstance.options = Object.assign({}, splideInstance.options || {}, {
            type: 'slide',
            perPage: 2,
            perMove: 1,
            gap: 24,
            arrows: false,
            pagination: true,
            breakpoints: {
                992: { perPage: 1 },
            }
        });

        if (typeof splideInstance.refresh === 'function') {
            splideInstance.refresh();
        } else {
            splideInstance.mount();
        }
        return;
    }

    if (window.Splide) {
        new Splide(sliderItinerari, {
            type: 'slide',
            perPage: 2,
            perMove: 1,
            gap: 24,
            arrows: false,
            pagination: true,
            breakpoints: {
                992: { perPage: 1 },
            }
        }).mount();
    } else {
        console.warn('Splide non disponibile per slider_itinerari.');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    initSliderHome();
    initSliderItinerari();
});
