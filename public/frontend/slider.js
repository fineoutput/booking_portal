

  document.addEventListener('DOMContentLoaded', function () {
    new Splide('#responsive-slider', {
        type      : 'loop', // Makes the slider loop
        perPage   : 1,      // One slide per view
        autoplay  : true,   // Auto-slide
        interval  : 3000,   // Interval for autoplay
        gap:10,
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
          perPage: 5, // Adjust based on screen size
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
          perPage: 5, // Adjust based on screen size
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
    new Splide('#tourSlider', {
        type: 'loop',  // Enables continuous loop scrolling
        perPage: 1,  // Shows 1 slide at a time
        perMove: 1,  // Moves 1 slide at a time
        autoplay: true,  // Enables auto sliding
        interval: 3000,  // 3 seconds interval
        speed: 800, // Transition speed
        arrows: true, // Enable navigation arrows
        pagination: true, // Enable dot indicators
        pauseOnHover: true, // Pause on hover
        lazyLoad: 'nearby', // Lazy load images
        breakpoints: {
            1024: { perPage: 1 },
            768: { perPage: 1 }
        }
    }).mount();
});

  document.addEventListener('DOMContentLoaded', function () {
    const mohanJodharo = new Splide('#mohanJodharoSlider', {
      type: 'loop',
      perPage: 3,
    //   gap: '1rem',
      autoplay: true,
      breakpoints: {
        768: {
          perPage: 1,
        },
        1024: {
          perPage: 2,
        },
      },
    });

    mohanJodharo.mount();
  });

// document.addEventListener('DOMContentLoaded', function() {
//     const searchInput = document.getElementById('city-search');
//     const cityListContainer = document.getElementById('city-list-container');
//     const cityItems = cityListContainer.getElementsByClassName('city_list_htotle');
//     const noResults = document.getElementById('no-results');

//     searchInput.addEventListener('input', function(e) {
//         const searchTerm = e.target.value.toLowerCase().trim();
//         let hasVisibleItems = false;

//         // Loop through all city items
//         Array.from(cityItems).forEach(item => {
//             const cityName = item.getAttribute('data-city-name');
//             const isMatch = cityName.includes(searchTerm);
            
//             item.style.display = isMatch ? 'block' : 'none';
//             if (isMatch) hasVisibleItems = true;
//         });

//         // Show/hide no results message
//         noResults.style.display = hasVisibleItems ? 'none' : 'block';
//     });

//     // Prevent form submission on enter key in search input
//     searchInput.addEventListener('keypress', function(e) {
//         if (e.key === 'Enter') {
//             e.preventDefault();
//         }
//     });
// });

// // Assuming you already have this function or similar
// function selectDestination(cityId) {
//     // Your existing destination selection logic
//     const selectedCity = document.querySelector(`#city_${cityId} + .city-label`).textContent;
//     document.getElementById('destination-value').textContent = selectedCity;
//     // Add any other logic you need when a city is selected
// }