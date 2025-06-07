
// document.addEventListener('DOMContentLoaded', function() {
//     var countryCodeSelect = document.getElementById('country-code');
//     var phoneCodeSpan = document.getElementById('phone_code');

//     if (countryCodeSelect && phoneCodeSpan) {
//         // Event listener for change on country code select
//         countryCodeSelect.addEventListener('change', function() {
//             var selectedOption = countryCodeSelect.options[countryCodeSelect.selectedIndex];
//             var countryCodeValue = selectedOption.value;
//             var countryCodeText = selectedOption.text;

//             // Update the phone_code span with the selected country code
//             phoneCodeSpan.textContent = countryCodeText;

//             // Optionally, you can set the value of the input based on the selected code
//             var phoneNumberInput = document.querySelector('.form-control[type="text"]');
//             // phoneNumberInput.placeholder = "Enter your phone number with " + countryCodeText;
//         });
//     }
// });



document.addEventListener('DOMContentLoaded', function() {
    var countryCodeSelect = document.getElementById('country-code');
    var phoneCodeSpan = document.getElementById('phone_code');
    var country_display = document.getElementById("country_display");

    if (countryCodeSelect && phoneCodeSpan) {
        // Event listener for change on country code select
        countryCodeSelect.addEventListener('change', function() {
            var countryCodeValue = countryCodeSelect.value;

            country_display.value = (this.options[this.selectedIndex].text);

            // Update the phone_code span with the selected country code
            phoneCodeSpan.textContent = countryCodeValue;

            // Optionally, you can set the value of the input based on the selected code
            var phoneNumberInput = document.querySelector('.form-control[type="text"]');
            // phoneNumberInput.placeholder = "Enter your phone number with " + countryCodeValue;
        });
    }
});











function validateForm() {
    const sectorCheckboxes = document.querySelectorAll('#sector-checkboxes input[type="checkbox"]');
    const checkedCheckboxes = Array.from(sectorCheckboxes).some(checkbox => checkbox.checked);
    
    if (!checkedCheckboxes) {
      alert('Please select at least one sector.');
      return false; // Prevent form submission
    }
    
    const selectedCheckboxes = Array.from(sectorCheckboxes).filter(checkbox => checkbox.checked);
    if (selectedCheckboxes.length > 3) {
      alert('You can select a maximum of 3 sectors.');
      return false; // Prevent form submission
    }

    return true; // Allow form submission
  }




document.addEventListener('DOMContentLoaded', function() {
    var checkboxes = document.querySelectorAll('#sector-checkboxes .form-check-input');
    var selectedSectorsList = document.getElementById('selected-sectors');
    var maxSelections = 3;

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var selectedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);

            // Ensure the number of selections does not exceed the limit
            if (selectedCheckboxes.length > maxSelections) {
                alert(`You can only select up to ${maxSelections} sectors.`);
                checkbox.checked = false;
                return;
            }

            selectedSectorsList.innerHTML = ''; // Clear the list before updating

            selectedCheckboxes.forEach(function(checkbox) {
                var listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.textContent = checkbox.value;

                var deleteButton = document.createElement('button');
                deleteButton.className = 'btn btn-danger btn-sm';
                deleteButton.textContent = 'Delete';
                deleteButton.addEventListener('click', function() {
                    selectedSectorsList.removeChild(listItem);
                    checkbox.checked = false;
                });

                listItem.appendChild(deleteButton);
                selectedSectorsList.appendChild(listItem);
            });
        });
    });
});


