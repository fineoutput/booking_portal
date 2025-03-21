

  document.addEventListener('DOMContentLoaded', function () {
    new Splide('#responsive-slider', {
        type      : 'loop', // Makes the slider loop
        perPage   : 1,      // One slide per view
        autoplay  : true,   // Auto-slide
        interval  : 3000,   // Interval for autoplay
        breakpoints: {
            768: {
                perPage: 1,
            },
        },
    }).mount();
});











  document.addEventListener('DOMContentLoaded', function () {
      new Splide('#popularCitiesSlider', {
          type: 'loop',
          perPage: 3, // Adjust based on screen size
          perMove: 1,
          gap: '20px',
          autoplay: true,
          interval: 3000,
          breakpoints: {
              1024: { perPage: 2 },
              768: { perPage: 1 }
          }
      }).mount();
  });






  document.addEventListener('DOMContentLoaded', function () {
      new Splide('#popularCitiesSlider2', {
          type: 'loop',
          perPage: 3, // Adjust based on screen size
          perMove: 1,
          gap: '20px',
          autoplay: true,
          interval: 3000,
          breakpoints: {
              1024: { perPage: 2 },
              768: { perPage: 1 }
          }
      }).mount();
  });