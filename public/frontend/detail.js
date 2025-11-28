
  document.addEventListener('DOMContentLoaded', function () {
    // Ensure minDate is set to today's date at midnight so selecting today is allowed
    const today = new Date();
    today.setHours(0,0,0,0);
    const picker = new Litepicker({
      element: document.getElementById('date-range'),
      singleMode: false,
      numberOfMonths: 2,
      numberOfColumns: 2,
      format: 'MM-DD-YYYY',
      autoApply: true,
      showTooltip: true,
      // Disable selection of past dates (before today). Use midnight to avoid timezone issues.
      minDate: today,
      tooltipText: {
        one: 'day',
        other: 'days'
      },
      setup: (picker) => {
        picker.on('selected', (date1, date2) => {
          // When user selects, write values in the same format
          document.getElementById('start_date').value = date1.format('MM-DD-YYYY');
          document.getElementById('end_date').value = date2.format('MM-DD-YYYY');
        });

        // Add labels after calendar is rendered
        picker.on('render', () => {
          const months = picker.ui.querySelectorAll('.container__months > .month-item');
          if (months.length === 2) {
            months[0].insertAdjacentHTML('afterbegin', '<div class="month-label" style="text-align:center; font-weight:bold; padding:5px;">Start Date</div>');
            months[1].insertAdjacentHTML('afterbegin', '<div class="month-label" style="text-align:center; font-weight:bold; padding:5px;">End Date</div>');
          }
        });
      }
    });
  });






  //////


  function updateChildren(delta) {
    const countInput = document.getElementById('children-count');
    let count = parseInt(countInput.value) || 0;
    count = Math.max(0, count + delta);
    countInput.value = count;

    updateChildAgeDropdown(count);
}

function updateChildAgeDropdown(count) {
    const container = document.getElementById('children-ages');
    const label = document.getElementById('children-age-label');
  // Preserve existing selected values so user input isn't lost when count changes
  const previousValues = [];
  container.querySelectorAll('select').forEach((sel) => previousValues.push(sel.value));

  container.innerHTML = ''; // Clear old

  if (count > 0) {
    label.style.display = 'block';
    for (let i = 0; i < count; i++) {
      const select = document.createElement('select');
      select.id = `child-age-${i}`;
      select.name = `child_age_${i}`;
      select.classList.add('child-age-select');

      for (let age = 0; age <= 17; age++) {
        const option = document.createElement('option');
        option.value = age;
        option.textContent = `${age} years`;
        select.appendChild(option);
      }

      // Restore previous value if present (keep within bounds)
      if (previousValues[i] !== undefined) {
        // If previous value is a number-like string, ensure option exists
        const prev = previousValues[i];
        // If an option matches, set it
        const opt = Array.from(select.options).find(o => o.value == prev);
        if (opt) select.value = prev;
      }

      container.appendChild(select);
    }
  } else {
    label.style.display = 'none';
  }
}



//////////

 function togglePremiumFields() {
            const roomType = document.getElementById("room_type").value;
            const premiumFields = document.getElementById("premium-fields");

            if (roomType === "premium") {
                premiumFields.style.display = "block";
            } else {
                premiumFields.style.display = "none";

                // reset values if Deluxe is chosen again
                document.getElementById("meals").value = "";
                document.getElementById("extra_bed").value = 0;
                document.getElementById("child_no_bed").value = 0;
            }
        }





        //////////Hotel filter mobile toggle
         document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector(".filter-toggle-btn");
    const collapsibleContent = document.querySelector(".collapsible-content");

    toggleBtn.addEventListener("click", function () {
      collapsibleContent.classList.toggle("active");
      if (collapsibleContent.classList.contains("active")) {
        toggleBtn.textContent = "Hide Filters";
      } else {
        toggleBtn.textContent = "Show Filters";
      }
    });
  });