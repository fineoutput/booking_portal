document.addEventListener('DOMContentLoaded', function () {
    new Splide('#image-slider', {
      type: 'loop',        // Infinite loop slider
      autoplay: false,      // Auto-slide
      interval: 3000,      // Interval between slides (ms)
      arrows: true,        // Show navigation arrows
      pagination: true,    // Show pagination bullets
      perPage: 1,          // 1 image per slide
      heightRatio: 0.75,   // Adjust height relative to width
    }).mount();
  });

////active tabs
  document.getElementById('tab1-btn').addEventListener('click', function() {
    document.getElementById('tab1-content').style.display = 'block';
    document.getElementById('tab2-content').style.display = 'none';
  });
  
  document.getElementById('tab2-btn').addEventListener('click', function() {
    document.getElementById('tab2-content').style.display = 'block';
    document.getElementById('tab1-content').style.display = 'none';
  });

  ////button active
  const tab1Btn = document.getElementById('tab1-btn');
const tab2Btn = document.getElementById('tab2-btn');


function setActiveTab(activeBtn) {
  // Remove active class from both buttons
  tab1Btn.classList.remove('active');
  tab2Btn.classList.remove('active');

  activeBtn.classList.add('active');
}

tab1Btn.addEventListener('click', () => setActiveTab(tab1Btn));
tab2Btn.addEventListener('click', () => setActiveTab(tab2Btn));

//////////Custom slider///////////
  (function ($) {
$.fn.stack_slider = function (options) {
// Sldier core functions
$("#slider-next").click(function () {
var total = $(".intro-slide").length;
$("#intro-slider .intro-slide:first-child")
  .hide()
  .appendTo("#intro-slider")
  .fadeIn();
$.each($(".intro-slide"), function (index, dp_item) {
  $(dp_item).attr("data-position", index + 1);
});
});
$("body").on(
"click",
"#intro-slider .intro-slide:not(:first-child)",
function () {
  var get_slide = $(this).attr("data-class");
  console.log(get_slide);
  $("#intro-slider .intro-slide[data-class=" + get_slide + "]")
    .hide()
    .prependTo("#intro-slider")
    .fadeIn();
  $.each($(".intro-slide"), function (index, dp_item) {
    $(dp_item).attr("data-position", index + 1);
  });
}
);
// Drag
$.fn.swipe = function (callback) {
var touchDown = false,
  originalPosition = null,
  $el = jQuery(this);

function swipeInfo(event) {
  var x = event.originalEvent.pageX,
    y = event.originalEvent.pageY,
    dx;

  dx = x > originalPosition.x ? "right" : "left";

  return {
    direction: {
      x: dx
    },
    offset: {
      x: x - originalPosition.x
    }
  };
}

$el.on("touchstart mousedown", function (event) {
  touchDown = true;
  originalPosition = {
    x: event.originalEvent.pageX,
    y: event.originalEvent.pageY
  };
});

$el.on("touchend mouseup", function () {
  touchDown = false;
  originalPosition = null;
  flag = true;
});

$el.on("touchmove mousemove", function (event) {
  if (!touchDown) {
    return;
  }
  var info = swipeInfo(event);
  callback(info.direction, info.offset);
});

return true;
};
// disabel image drag
$("#slider img").on("dragstart", function (event) {
event.preventDefault();
});
// Slider Methods
// This is the easiest way to have default options.
var settings = $.extend(
{
  // These are the defaults.
  color: "transparent",
  background: "transparent",
  autoPlay: true,
  autoPlaySpeed: 3000,
  dots: true,
  arrows: true,
  drag: true,
  direction: "horizontal"
},
options
);

// dots
if (settings.dots !== true) {
$("#dp-dots").hide();
}
// drag
if (settings.drag == true) {
// trigger next prev on drag
var flag = true;
jQuery(".intro-slide").swipe(function (direction, offset) {
  if (offset.x > 30 && flag) {
    flag = false;
    $("#slider-next").click();
  }
  if (offset.x < -30 && flag) {
    flag = false;
    $("#slider-prev").click();
  }
});
}
// arrows
if (settings.arrows !== true) {
$("#slider-next, #slider-prev").hide();
}
// slider autoplay
if (settings.autoPlay == true) {
setInterval(function () {
  $("#slider-next").click();
}, settings.autoPlaySpeed);
}

//slider direction
if (settings.direction == "vertical") {
$(".slider-wrap").addClass("vertical");
}

// stack_slider the collection based on the settings variable.
return this.css({
color: settings.color,
background: settings.background
});
};
})(jQuery);

$("#slider").stack_slider({
autoPlaySpeed: 6000,
autoPlay: false,
dots: true,
arrows: true,
drag: true,
direction: "vertical"
});





/////////travel slider
document.addEventListener('DOMContentLoaded', function () {
  new Splide('#name .splide', {
    type: 'loop',
    autoplay: false,
    interval: 3000,
    arrows: true,  // Show navigation arrows
    pagination: true, // Show pagination dots
    perPage: 1, // Show one slide at a time
  }).mount();
});

///////////////////////////////////List page
function toggleAccordion() {
  const content = document.querySelector('.accordion-content');
  const icon = document.getElementById('accordion-icon');

  if (content.classList.contains('open')) {
      content.classList.remove('open');
      content.style.display = 'none';
      icon.classList.remove('fa-angle-up');
      icon.classList.add('fa-angle-down');
  } else {
      content.classList.add('open');
      content.style.display = 'flex';
      icon.classList.remove('fa-angle-down');
      icon.classList.add('fa-angle-up');
  }
}










/////////////////////select state and city
const states = {
  "Rajasthan": ["Jaipur", "Udaipur", "Jodhpur"],
  "Tamil nadu": ["Chennai", "madras", "ille"],
  "Punjab": ["Multan", "Chandigarh", "Amritsar"],
  "Maharashtra": ["Goa", "Mumbai", "Pune"]
};

const stateList = document.getElementById('stateList');
const cityList = document.getElementById('cityList');
const locationInput = document.getElementById('location');

// Populate states
for (const state in states) {
  const li = document.createElement('li');
  li.textContent = state;
  li.classList.add('list-group-item');
  li.onclick = () => selectState(state);
  stateList.appendChild(li);
}

function selectState(state) {
  // Clear and populate cities
  cityList.innerHTML = '';
  states[state].forEach(city => {
    const li = document.createElement('li');
    li.textContent = city;
    li.classList.add('list-group-item');
    li.onclick = () => selectCity(state, city);
    cityList.appendChild(li);
  });

  // Close state modal and open city modal
  const stateModal = bootstrap.Modal.getInstance(document.getElementById('stateModal'));
  stateModal.hide();
  const cityModal = new bootstrap.Modal(document.getElementById('cityModal'));
  cityModal.show();
}

function selectCity(state, city) {
  // Set the selected location in the input field
  locationInput.value = `${city}, ${state}`;
  const cityModal = bootstrap.Modal.getInstance(document.getElementById('cityModal'));
  cityModal.hide();
}




/////////////////////Select car type
const selectCar = (carType) => {
  document.getElementById('car').value= carType
  var modal = document.getElementById('carmodal');
  var bootstrapmodal = bootstrap.Modal.getInstance(modal);
  bootstrapmodal.hide();
  
}

console.log('..............................................');
// // Toggle the dropdown body visibility
// document.querySelector('.custom-dropdown').addEventListener('click', function (e) {
//   const body = this.querySelector('.dropdown-body');
//   body.style.display = body.style.display === 'block' ? 'none' : 'block';
// });

// // Handle selecting a package and close the dropdown
// document.querySelectorAll('.dropdown-item').forEach(item => {
//   item.addEventListener('click', function (e) {
//     e.stopPropagation(); // Prevent the dropdown from toggling immediately

//     const selected = document.querySelector('#selected-package');
    
//     // Extract package name using `.type_xtxt` if it exists, otherwise use the item's text
//     const packageName = this.querySelector('.type_xtxt') 
//       ? this.querySelector('.type_xtxt').innerText.trim()
//       : this.textContent.trim();

//     // Update the selected package text and data-value attribute
//     selected.textContent = packageName;
//     selected.dataset.value = this.dataset.value;

//     // Close the dropdown body
//     const dropdownBody = document.querySelector('.dropdown-body');
//     dropdownBody.style.display = 'none';
//   });
// });

// // Optional: Update selected package if dropdown is linked to a native select element
// function updateSelectedPackage() {
//   const select = document.getElementById('package');
//   const selectedOption = select.options[select.selectedIndex];
//   const textLimit = 25; // Limit for the text length
//   const truncatedText = selectedOption.text.length > textLimit 
//       ? selectedOption.text.slice(0, textLimit) + '...' 
//       : selectedOption.text;
//   document.getElementById('selected-package').innerText = truncatedText;
// }



////////////////////////select car type

