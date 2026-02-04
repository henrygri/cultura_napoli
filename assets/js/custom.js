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

  console.warn('Ne Bootstrap Italia CarouselBI ne Splide disponibili.');
}

function initSliderLuoghi() {
  var el = document.querySelector('.slider_luoghi');
  if (!el) return;

  var BI = window.bootstrap;

  if (BI && typeof BI.CarouselBI === 'function') {
    var instance = BI.CarouselBI.getOrCreateInstance(el);
    attachBandiArrows(instance && instance._splide, el);
    return;
  }

  if (window.Splide) {
    var splide = new Splide(el);
    splide.mount();
    attachBandiArrows(splide, el);
    return;
  }

  console.warn('Ne Bootstrap Italia CarouselBI ne Splide disponibili (slider_bandi).');
}

function initSliderBandi() {
  var el = document.querySelector('.slider_bandi');
  if (!el) return;

  var BI = window.bootstrap;

  if (BI && typeof BI.CarouselBI === 'function') {
    var instance = BI.CarouselBI.getOrCreateInstance(el);
    attachBandiArrows(instance && instance._splide, el);
    return;
  }

  if (window.Splide) {
    var splide = new Splide(el);
    splide.mount();
    attachBandiArrows(splide, el);
    return;
  }

  console.warn('Ne Bootstrap Italia CarouselBI ne Splide disponibili (slider_bandi).');
}

function attachBandiArrows(splideInstance, el) {
  if (!splideInstance) return;

  var placeholder = document.querySelector('.slider_bandi_arrows_placeholder');
  if (!placeholder) return;

  var arrows = el.querySelector('.splide__arrows');
  if (!arrows) return;

  placeholder.innerHTML = '';
  placeholder.appendChild(arrows);
}

document.addEventListener('DOMContentLoaded', function () {
    initSliderHome();
    initSliderItinerari();
    initSliderLuoghi();
    initSliderBandi();
});
