import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var closeBtn = document.getElementsByClassName("modal-btn")[0];

// When the user clicks on <closeBtn> , close the modal
closeBtn.onclick = function() {
  modal.style.display = "none";
}

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
