$(document).ready(function(){
  $('.tnp-email').attr('placeholder','Enter your email');
});

/* Modal dialog script */
document.addEventListener('click', function (e) {
    e = e || window.event;
    var target = e.target || e.srcElement;
    e.preventDefault();

    if ((target.hasAttribute('data-toggle') && target.getAttribute('data-toggle') == 'modal') || (target.parentElement.hasAttribute ('data-toggle') && target.parentElement.getAttribute('data-toggle') == 'modal')) {
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

body.on ('click', function (e) {
  alert ()
});


/* commented 26-4-22
	$(function() {
		var Accordion = function(el, multiple) {
				this.el = el || {};
				this.multiple = multiple || false;

				var links = this.el.find('.article-title, .shoparticle-title');
				links.on('click', {
						el: this.el,
						multiple: this.multiple
				}, this.dropdown)
		}

		Accordion.prototype.dropdown = function(e) {
				var $el = e.data.el;
				$this = $(this),
						$next = $this.next();

				$next.slideToggle();
				$this.parent().toggleClass('open');

				if (!e.data.multiple) {
						$el.find('.accordion-content, .shopaccordion-content').not($next).slideUp().parent().removeClass('open');
				};
		}
		var accordion = new Accordion($('.accordion-container, .shopaccordion-container'), false);
	});
>>>>>>> 26b6fbb1b19c4db97b93c6ef93052a61c206c30b

	$(document).on('click', function (event) {
		if (!$(event.target).closest('#accordion, #shopaccordion').length) {
			//$this.parent().toggleClass('open');
		}
<<<<<<< HEAD
	});
});

=======
	});*/


//sidebar filter collapse - Side-Slide
$('.shopfilter').click(function() {
	$('.shopfilter-slide').animate({left: "0px"}, 200);
	 $('.shopfilter-slide').addClass('shopfilter-m');
});

$('.shopfilterclose').click(function() {
	$('.shopfilter-slide').animate({left: "-322px"}, 200);
	 $('.shopfilter-slide').removeClass('shopfilter-m');
});

function toggle_menu () {
  var x = document.getElementById("site-navigation");
  if (x.className === "navbar") {
    x.className += " responsive";
  } else {
    x.className = "navbar";
  }
}
