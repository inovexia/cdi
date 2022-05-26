(function ($) {
  $(document).ready(function () {
    // Home Blogs Slider
    new Swiper(".home-industry-slider", {
      slidesPerView: 3,
      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-prev",
        prevEl: ".swiper-button-next",
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });

    // Homepage product category slider
    new Swiper(".home-product-category-slider", {
      slidesPerView: 2,
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-prev",
        prevEl: ".swiper-button-next",
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
      },
    });

    // related product slider
    new Swiper(".single-product-related-slider", {
      slidesPerView: 1,
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-prev",
        prevEl: ".swiper-button-next",
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
      },
    });

    // featured product slider
    new Swiper(".shop-page-featured-product-slider", {
      slidesPerView: 1,
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-prev",
        prevEl: ".swiper-button-next",
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
      },
    });

    // swiper - modal
    new Swiper(".recommendSwiper1", {
      slidesPerView: 1,
      loop: true,
      spaceBetween: 10,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-prev01",
        prevEl: ".swiper-button-next01",
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
      },
    });

    // Homepage slider
    var recSwiper = new Swiper(".home-recommendSwiper", {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      observer: true,
      observeParents: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
      },
    });

    new Swiper(".productvatSwiperhome", {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
      },
    });

    // Home Blogs Slider
    new Swiper(".blogSwiper", {
      slidesPerView: 3,
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-prev01",
        prevEl: ".swiper-button-next01",
      },
      breakpoints: {
        640: {
          slidesPerView: 1.4,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });

    // two column Slider
    new Swiper(".two-column-slider", {
      slidesPerView: 1,
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-prev01",
        prevEl: ".swiper-button-next01",
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
      },
    });

    // three column Slider
    new Swiper(".three-column-slider", {
      slidesPerView: 1,
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-prev01",
        prevEl: ".swiper-button-next01",
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });

    // three column Slider
    new Swiper(".one-column-slider", {
      slidesPerView: 1,
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-prev01",
        prevEl: ".swiper-button-next01",
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 1,
        },
        1024: {
          slidesPerView: 1,
        },
      },
    });

    /*single product gallery product_title*/
    var galleryThumbs = new Swiper(".gallery-thumbs", {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
      loop: true,
      //autoHeight: true, //enable auto height
      // Enable lazy loading
      preloadImages: false,
      lazy: true,
      lazy: {
        loadPrevNext: true,
      },
    });

    var swiper = new Swiper(".swiper-container-main", {
      autoHeight: true, //enable auto height

      //runCallbacksOnInit: true,
      observer: true,
      observeParents: true,
      observeChildren: true,
      spaceBetween: 0,

      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      loop: true,
      preloadImages: false,
      // Enable lazy loading
      lazy: true,
      lazy: {
        loadPrevNext: true,
      },

      keyboard: {
        enabled: true,
      },

      effect: "coverflow",
      coverflowEffect: {
        rotate: 60,
        slideShadows: false,
      },
      loop: true,
      thumbs: {
        swiper: galleryThumbs,
      },
    });

    // swiper - modal
    var swiperModal = new Swiper(".swiper-container-modal", {
      observer: true,
      observeParents: true,
      observeChildren: true,
      spaceBetween: 0,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      zoom: {
        maxRatio: 2,
        toggle: true, // enable zoom-in by double tapping slide
      },
      loop: true,
      preloadImages: false,
      // Enable lazy loading
      lazy: true,
      lazy: {
        loadPrevNext: true,
        //loadOnTransitionStart: true,
      },

      effect: "coverflow",
      coverflowEffect: {
        rotate: 60,
        slideShadows: false,
      },
      loop: true,
    });
  });
})(jQuery);
