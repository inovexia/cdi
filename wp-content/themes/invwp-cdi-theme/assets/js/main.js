(function () {
  /* Modal dialog script */
  document.addEventListener(
    "click",
    function (e) {
      e = e || window.event;
      var target = e.target || e.srcElement;

      if (
        (target.hasAttribute("data-toggle") &&
          target.getAttribute("data-toggle") == "modal") ||
        (target.parentElement.hasAttribute("data-toggle") &&
          target.parentElement.getAttribute("data-toggle") == "modal")
      ) {
        e.preventDefault();
        if (target.hasAttribute("data-target")) {
          var m_ID = target.getAttribute("data-target");
          document.getElementById(m_ID).classList.add("open");
        } else if (target.parentElement.hasAttribute("data-target")) {
          var m_ID = target.parentElement.getAttribute("data-target");
          document.getElementById(m_ID).classList.add("open");
        }
      }

      // Close modal window with 'data-dismiss' attribute or when the backdrop is clicked
      if (
        (target.hasAttribute("data-dismiss") &&
          target.getAttribute("data-dismiss") == "modal") ||
        target.classList.contains("modal") ||
        (target.parentElement.hasAttribute("data-dismiss") &&
          target.parentElement.getAttribute("data-dismiss") == "modal") ||
        target.parentElement.classList.contains("modal")
      ) {
        e.preventDefault();
        var modal = document.querySelector('[class="modal open"]');
        modal.classList.remove("open");
      }
    },
    false
  );
})();

/* Offcanvas Sidepanel */
function openNav() {
  document.getElementById("minicart-nav").style.right = "0";
}

function closeNav() {
  document.getElementById("minicart-nav").style.right = "-100%";
}

jQuery(function ($) {
  // Add to cart functionality on all  products page
  $(document.body).on("added_to_cart", function (response) {
    // Show mini cart
    openNav();
  });
});

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

jQuery(document).ready(function () {
  // jQuery("#desktopSearch input, .mobile-search-box .search-field").attr(
  //   "placeholder",
  //   "Search for brand, product, category..."
  // );
  jQuery("#menu-toggler").click(function () {
    jQuery(".mob-mega-menu").toggleClass("left-0");
  });
  jQuery(".mob-menu-header .close-btn").click(function () {
    jQuery(".mob-mega-menu").removeClass("left-0");
  });
});

jQuery(document).ready(function () {
  var curr_link = jQuery(".tab-link-hidden").attr("key");

  jQuery(".tab-link").each(function () {
    var cl = jQuery(this).attr("data");
    if (cl == curr_link) {
      jQuery(".tab-link").removeClass("active");
      jQuery(this).addClass("active");
    }
  });

  jQuery("#product-search-icon").click(function () {
    jQuery("#desktopSearch").fadeIn();
  });
  jQuery("#desktopSearch .close").click(function () {
    jQuery("#desktopSearch").fadeOut();
  });
  jQuery(".tnp-email").attr("placeholder", "Email");
});

/* Collapsible/Accordion */
var collapse = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < collapse.length; i++) {
  collapse[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight) {
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    }
  });
}
