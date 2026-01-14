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
  var el = document.querySelector('.slider_itinerari');
  if (!el) return;

  var BI = window.bootstrap;

  if (BI && typeof BI.CarouselBI === 'function') {
    BI.CarouselBI.getOrCreateInstance(el);
    return;
  }

  if (window.Splide) {
    new Splide(el).mount();
    return;
  }

  console.warn('Né Bootstrap Italia CarouselBI né Splide disponibili.');
}

document.addEventListener('DOMContentLoaded', function () {
    initSliderHome();
    initSliderItinerari();
});
