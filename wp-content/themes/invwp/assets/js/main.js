$(document).ready(function(){
  $('.tnp-email').attr('placeholder','Enter your email');
  $('.tnp-submit').attr('value','SIGN UP');
  $('#s').attr('placeholder','Search');
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
  document.getElementById("offcanvas-sidepanel").style.width = "350px";
}

function closeSidePanel() {
  document.getElementById("offcanvas-sidepanel").style.width = "0";
}

/* Offcanvas Sidepanel 
function openSidePanel1() {
  document.getElementById("offcanvas-sidepanel").style.right = "0";
}

function closeSidePanel1() {
  document.getElementById("offcanvas-sidepanel").style.right = "-100%";
}*/

/* Tabbed View */
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpenTab" and click on it
document.getElementById("defaultOpenTab").click();

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
