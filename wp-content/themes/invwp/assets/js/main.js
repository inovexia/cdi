$(document).ready(function(){
  $('.tnp-email').attr('placeholder','Enter your email');
});

/* Modal dialog script */
document.addEventListener('click', function (e) {
    e = e || window.event;
    var target = e.target || e.srcElement;

    if ((target.hasAttribute('data-toggle') && target.getAttribute('data-toggle') == 'modal') || (target.parentElement.hasAttribute ('data-toggle') && target.parentElement.getAttribute('data-toggle') == 'modal')) {
        e.preventDefault();
        if (target.hasAttribute('data-target')) {
            var m_ID = target.getAttribute('data-target');
            document.getElementById(m_ID).classList.add('open');
        } else if (target.parentElement.hasAttribute ('data-target')) {
					var m_ID = target.parentElement.getAttribute('data-target');
					document.getElementById(m_ID).classList.add('open');
				}
    }

    // Close modal window with 'data-dismiss' attribute or when the backdrop is clicked
    if ((target.hasAttribute('data-dismiss') && target.getAttribute('data-dismiss') == 'modal') || target.classList.contains('modal') ||
		   (target.parentElement.hasAttribute('data-dismiss') && target.parentElement.getAttribute('data-dismiss') == 'modal') || target.parentElement.classList.contains('modal')) {
        e.preventDefault();
        var modal = document.querySelector('[class="modal open"]');
        modal.classList.remove('open');
    }
}, false);

/* Offcanvas Sidepanel */
function openSidePanel() {
  document.getElementById("offcanvas-sidepanel").style.width = "250px";
}

function closeSidePanel() {
  document.getElementById("offcanvas-sidepanel").style.width = "0";
}


/* Accordions  */
const accordionBtns = document.querySelectorAll(".accordion .accordion-title");

accordionBtns.forEach((accordion) => {
  accordion.onclick = function () {
    this.classList.toggle("is-open");

    let content = this.nextElementSibling;
    ///console.log(content);

    if (content.style.maxHeight) {
      //this is if the accordion is open
      content.style.maxHeight = null;
    } else {
      //if the accordion is currently closed
      content.style.maxHeight = content.scrollHeight + "px";
      //console.log(content.style.maxHeight);
    }
  };
});

function toggle_menu () {
  var x = document.getElementById("site-navigation");
  if (x.className === "navbar") {
    x.className += " responsive";
  } else {
    x.className = "navbar";
  }
}
