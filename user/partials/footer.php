        </div>
    </div>
</div>


<script>
  const animateTextElements = document.querySelectorAll('.animate-text');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('slide-in');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.5,
    rootMargin: '0px 0px -50px 0px'
  });

  animateTextElements.forEach((element) => {
    observer.observe(element);
  });
</script>
<script>

    function openDashboard() {
      window.open("<?= URL ?>user/dashboard.php");
    }

    function logoutUser() {
      if (confirm("Would you like to Log Out?")) {
          true;
      }

      else {
          event.preventDefault();
          event.stopPropagation();
      }
    }

    // When the user clicks on the button, scroll to the top of the document
    window.onscroll = function() {scrollFunction()};

      function scrollFunction() {
          var scrollToTopBtn = document.getElementById("scrollToTopBtn");
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
              scrollToTopBtn.style.display = "block";
          } else {
              scrollToTopBtn.style.display = "none";
          }
      }

      // When the user clicks on the button, scroll to the top of the document
      document.getElementById('scrollToTopBtn').addEventListener('click', function() {
          window.scrollTo({top: 0, behavior: 'smooth'});
      });

    document.addEventListener('DOMContentLoaded', function() {
      const select = document.getElementById('sectors');
      const selectedSectorsInput = document.getElementById('selected-sectors');
      const selectedSectorsContainer = document.getElementById('selected-sectors-container');
      
      select.addEventListener('change', function() {
        const selectedOptions = Array.from(select.selectedOptions).map(option => option.value);
        
        // Clear previous selections
        selectedSectorsContainer.innerHTML = '';
        
        selectedOptions.forEach(value => {
          // Create a new element for each selected sector
          const item = document.createElement('div');
          item.className = 'selected-item';
          item.innerHTML = `${value} <button onclick="removeSector('${value}')">x</button>`;
          selectedSectorsContainer.appendChild(item);
        });

        // Update the input field with the selected values
        selectedSectorsInput.value = selectedOptions.join(', ');
      });
      
      window.removeSector = function(value) {
        // Deselect the option
        Array.from(select.options).forEach(option => {
          if (option.value === value) {
            option.selected = false;
          }
        });

        // Trigger change event
        const event = new Event('change');
        select.dispatchEvent(event);
      }
    });



    // display a profile picture before its uploaded
    function showPreview(event) {
      var file = event.target.files[0];
      if (file) {
          // Check if the selected file is an image
          if (!file.type.startsWith('image/')) {
              alert('Please select a valid image file.');
              event.target.value = ''; // Clear the file input
              document.getElementById('preview').style.display = 'none'; // Hide the preview image
              return;
          }
          
          var reader = new FileReader();
          reader.onload = function(e) {
              var preview = document.getElementById('preview');
              preview.src = e.target.result;
              preview.style.display = 'block';
          };
          reader.readAsDataURL(file);
      }
    }
  </script>






<?php
    include __DIR__ . "/../../partials/footer.php";
?>
