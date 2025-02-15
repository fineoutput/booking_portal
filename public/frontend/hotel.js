   // Toggle dropdowns
   function toggleDropdown(type) {
    const dropdowns = document.querySelectorAll('.dropdown_hotels');
    dropdowns.forEach(dropdown => dropdown.classList.remove('active'));

    const dropdown = document.querySelector(`.${type}-dropdown_hotels`);
    if (dropdown) {
      dropdown.classList.toggle('active');
    }
  }

  // Close dropdowns when clicking outside
  document.addEventListener('click', (event) => {
    const dropdowns = document.querySelectorAll('.dropdown_hotels');
    dropdowns.forEach(dropdown => {
      if (!dropdown.contains(event.target) && !event.target.closest('.filter-item_hotels')) {
        dropdown.classList.remove('active');
      }
    });
  });

  // Update destination value when a city is selected
  function selectDestination(city) {
    document.getElementById('destination-value').textContent = city;
    console.log(city, 'this is the selected');
    
    // Close the destination dropdown
    document.getElementById('destination-dropdown').classList.remove('active');
  }

  // Update guests value
  let guests = {
    adults: 1,
    children: 0,
    infants: 0
  };

  function updateGuests(type, delta) {
    guests[type] = Math.max(0, guests[type] + delta);

    if (type === 'adults' || type === 'children' || type === 'infants') {
        document.getElementById(`${type}-count`).value = guests[type]; // Update input field value
    } else {
        document.getElementById(`${type}-count`).textContent = guests[type]; // Update span text
    }

    const totalGuests = guests.adults + guests.children;
    document.getElementById('guests-value').textContent =
      `${totalGuests} guest${totalGuests !== 1 ? 's' : ''}`;
}




document.addEventListener('DOMContentLoaded', function () {
  var sliders = document.querySelectorAll('.alocate_slider');
  
  sliders.forEach(function (slider) {
    new Splide(slider, {
      type: 'fade', // or 'loop' for infinite scroll
      perPage: 1,
      autoplay: true,
      interval: 3000, // 3 seconds delay
      arrows: false, 
      pagination: true,
    }).mount();
  });
});

// Function to select time and update the display
function selectTiming(time) {
  document.getElementById('timing-value').textContent = time;
  console.log(time, 'this is the selected time');
  
  // Close the timing dropdown
  document.getElementById('timing-dropdown').classList.remove('active');
}
