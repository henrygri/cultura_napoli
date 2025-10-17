document.addEventListener('DOMContentLoaded', function () {
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
        console.warn('Impossibile ottenere l\'istanza Splide.');
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
});

