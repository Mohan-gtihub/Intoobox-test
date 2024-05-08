// adding background to navigation
// $(window).on("scroll", function () {
//   var scroll = $(window).scrollTop();
//   if (scroll > 200) {
//     $(".navbar").addClass("nav-fixed");
//   } else {
//     $(".navbar").removeClass("nav-fixed");
//   }
// });
// navbar
$(document).ready(function () {
  $(".category-menu").click(function () {
    $("#navItems").toggleClass("show-nav");
    $("#closeNav").toggleClass("show-nav");
    $(".mobile-menu").toggleClass("open");
  });
  $("#closeNav").click(function () {
    $("#navItems").toggleClass("show-nav");
  });
  $("#closeMobileNav").click(function () {
    $(".mobile-menu").toggleClass("open");
  });
  $(".cs-nav-link").click(function () {
    $("#navItems").toggleClass("show-nav");
  });
});

$(".has-children > a").click(function (e) {
  e.preventDefault(); // Prevent the default behavior of the anchor tag

  var parentItem = $(this).parent();

  // Toggle the 'expanded' class
  parentItem.toggleClass("expanded");

  // Toggle the display of the child elements
  parentItem.find("ul").slideToggle();

  // Remove 'expanded' class from other elements
  $(".has-children").not(parentItem).removeClass("expanded");

  // Hide child elements of other elements
  $(".has-children").not(parentItem).find("ul").slideUp();
});

$(".show-mob-search").click(function () {
  $(".mob-search").addClass("show-mob-search");
});
$("#hideMobSearch").click(function () {
  $(".mob-search").removeClass("show-mob-search");
});

// active nav tab logic
$(document).ready(function () {
  $(".nav-tab-btn").click(function () {
    $(".nav-tab-btn").removeClass("nav-btn-active");
    $(this).addClass("nav-btn-active");
  });
});

// scroll to top

$(window).on("scroll", function () {
  var scroll = $(window).scrollTop();

  if (scroll > 40) {
    $(".scrollToTopBtn").addClass("showBtn");
  } else {
    $(".scrollToTopBtn").removeClass("showBtn");
  }
});

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}
$(".scrollToTopBtn").on("click", scrollToTop);

// faq js
$(document).ready(function () {
  var accordionParentClass = ".eachFaq";
  var accordionQuestionClass = ".eachFaq .title";
  var accordionContentClass = ".accordion-content";

  $(accordionParentClass).each(function () {
    $(this).addClass("close");
    $(this).find(accordionContentClass).hide();
  });

  $(accordionQuestionClass).click(function () {
    var faqClass = $(this).closest(accordionParentClass).attr("class");
    console.log(faqClass);

    if (faqClass.indexOf("close") != -1) {
      //WHEN CLOSED
      $(accordionParentClass).find(accordionContentClass).slideUp("slow"); //CLOSE ALL
      $(accordionParentClass).addClass("close").removeClass("open"); //set all faq as closed

      $(this).closest(accordionParentClass).removeClass("close");
      $(this).closest(accordionParentClass).addClass("open");
      $(this)
        .closest(accordionParentClass)
        .find(accordionContentClass)
        .slideDown("slow");
    } else {
      $(this).closest(accordionParentClass).addClass("close");
      $(this).closest(accordionParentClass).removeClass("open");
      $(this)
        .closest(accordionParentClass)
        .find(accordionContentClass)
        .slideUp("slow");
    }
  });
});

// progress bar

$(".container-progress > div").each(function () {
  var width = $(this).data("width");
  $(this).animate({ width: width }, 2500);
  $(this).after('<span class="perc">' + width + "</span>");
  $(".perc").delay(3000).fadeIn(1000);
});

// toggle menu
$(".menu-open").click(function () {
  $(".menu-close").addClass("show-close-icon");
  $(".custom-menu").addClass("show-menu");
});
$(".menu-close").click(function () {
  $(".menu-close").removeClass("show-close-icon");
  $(".custom-menu").removeClass("show-menu");
});

// toggling line in menu
$(".custom-menu-item").click(function (event) {
  //remove all pre-existing active classes
  $(".custom-menu-item").removeClass("active-item");
  $(".custom-menu").removeClass("show-menu");
  $(".menu-close").removeClass("show-close-icon");

  //add the active class to the link we clicked
  $(this).addClass("active-item");

  //Load the content
  //e.g.
  //load the page that the link was pointing to
  $("custom-menu-item").load($(this).find(a).attr("href"));

  event.preventDefault();
});

const swiper = new Swiper(".swiper", {
  autoplay: {
    delay: 3000,
  },
  direction: "horizontal",
  loop: true,

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
  },

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  // And if we need scrollbar
  scrollbar: {
    el: ".swiper-scrollbar",
  },
});

var mySwiper = new Swiper(".logo-swiper", {
  autoplay: {
    delay: 3000,
  },
  slidesPerView: 2,
  spaceBetween: 20,
  breakpoints: {
    768: {
      slidesPerView: 3,
    },
    991: {
      slidesPerView: 4,
    },
    1024: {
      slidesPerView: 5,
    },
  },
});

// aos init time
AOS.init({
  duration: 1200,
});

// display product toggle

$(".dispaly-product").click(function () {
  $(".dispaly-product").removeClass("active");
  $(this).addClass("active");
});
$(".product-toggle").click(function () {
  $(".product-toggle").removeClass("active");
  $(this).addClass("active");
});
$("#product-grid").click(function () {
  $(".prod-column").removeClass("col-12");
  $(".prod-column").addClass("col-md-6 col-lg-4");
  $(".product-content-wrap").addClass("flex-column");
  $(".product-content-wrap").removeClass("flex-row");
  $(".prod-info-content").removeClass("ms-6 ms-lg-8");
  $(".cat-prod-img").css({
    width: "100%",
  });
  $(".list-prod-content").css({
    display: "none",
  });
});
$("#product-list").click(function () {
  $(".prod-column").removeClass("col-md-6 col-lg-4");
  $(".prod-column").addClass("col-12");
  $(".product-content-wrap").removeClass("flex-column");
  $(".product-content-wrap").addClass("flex-row");
  $(".prod-info-content").addClass("ms-6 ms-lg-8");
  $(".price").removeClass("justify-content-center");
  $(".cat-prod-img").css({
    width: "45%",
  });
  $(".list-prod-content").css({
    display: "block",
  });
});

// filter

var i = document.querySelector(".ui-range-slider");
if (void 0 !== i && null !== i) {
  var j = parseInt(i.parentNode.getAttribute("data-start-min"), 10),
    k = parseInt(i.parentNode.getAttribute("data-start-max"), 10),
    l = parseInt(i.parentNode.getAttribute("data-min"), 10),
    m = parseInt(i.parentNode.getAttribute("data-max"), 10),
    n = parseInt(i.parentNode.getAttribute("data-step"), 10),
    o = document.querySelector(".ui-range-value-min span"),
    p = document.querySelector(".ui-range-value-max span"),
    q = document.querySelector(".ui-range-value-min input"),
    r = document.querySelector(".ui-range-value-max input");
  noUiSlider.create(i, {
    start: [j, k],
    connect: !0,
    step: n,
    range: {
      min: l,
      max: m,
    },
  }),
    i.noUiSlider.on("update", function (a, b) {
      var c = a[b];
      b
        ? ((p.innerHTML = Math.round(c)), (r.value = Math.round(c)))
        : ((o.innerHTML = Math.round(c)), (q.value = Math.round(c)));
    });
}

$(window).on("scroll", function () {
  var scroll = $(window).scrollTop();
  if (scroll > 300) {
    $(".cetner-category-nav").addClass("fixed-top");
    $(".cetner-category-nav").removeClass("w-lg-100");
    $(".cetner-category-nav").removeClass("py-3 py-lg-4");
    $(".cetner-category-nav").addClass("py-4 py-lg-6");
  } else {
    $(".cetner-category-nav").removeClass("fixed-top");
    $(".cetner-category-nav").addClass("w-lg-100");
    $(".cetner-category-nav").removeClass("py-4 py-lg-6");
    $(".cetner-category-nav").addClass("py-3 py-lg-4");
  }
});

// 11/13/2023 change product image on hover
$(".cat-prod-img").hover(
  function () {
      // On mouse enter
      var secondImage = $(this).data("src-2");
      if (secondImage) {
          $(this).data("src-original", $(this).attr("src")); // Store original source
          $(this).attr("src", secondImage);
      }
  },
  function () {
      // On mouse leave
      var originalImage = $(this).data("src-original");
      if (originalImage) {
          $(this).attr("src", originalImage);
      }
  }
);

//  11/13/2023 addding container to fluid classes on large screen
$(document).ready(function () {
  function checkWidth() {
    var screenWidth = $(window).width();
    if (screenWidth >= 1800) {
      $(".container").addClass("extra-wide");
    } else {
      $(".container").removeClass("extra-wide");
    }
  }
  // Check on page load
  checkWidth();
  // Check on window resize
  $(window).resize(function () {
    checkWidth();
  });
});

// 11/14/2023 product detail swiper
var thumbswiper = new Swiper(".mySwiper", {
  spaceBetween: 10,
  slidesPerView: 4,
});
var swiper2 = new Swiper(".mySwiper2", {
  spaceBetween: 0,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: thumbswiper,
  },
});


// 11/16/2023
$(document).ready(function () {
  $(".play-video").magnificPopup({
    type: "iframe",
    iframe: {
      patterns: {
        youtube: {
          index: "youtube.com/",
          id: "v=",
          src: "https://www.youtube.com/embed/Zzs6kLlkAUQ?si=Ey7Jrir4XKmqDVNy",
        },
      },
    },
    mainClass: "mfp-fade",
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false,
  });
});
$(document).ready(function () {
  $(".product-video").magnificPopup({
    type: "iframe",
    iframe: {
      patterns: {
        youtube: {
          index: "youtube.com/",
          id: "v=",
          src: "https://geniusdevs.com/codecanyon/omnimart40/product/CGtFace-Lift-Band-Facial-Beauty-Slimming-Double-Chin-Bandage-Strap-Weight1U",
        },
      },
    },
    mainClass: "mfp-fade",
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false,
  });
});

// leaflet map settings
document.addEventListener("DOMContentLoaded", function () {
  // making cutom icon
  var greenIcon = L.icon({
    iconUrl: "assets/frontend/images/contact-marker.png",
    shadowUrl: "assets/frontend/images/maker-shadow",

    iconSize: [34, 50], // size of the icon
    shadowSize: [50, 16], // size of the shadow
    iconAnchor: [17.72775328710475, 83.30915399818795], // point of the icon which will correspond to marker's location
    shadowAnchor: [51.1, -0.1], // the same for the shadow
    popupAnchor: [17.72775328710475, 83.30915399818795], // point from which the popup should open relative to the iconAnchor
  });
  // Initialize the map
  var map = L.map("contactMap").setView([17.72775328710475, 83.30915399818795], 13);

  // Add a tile layer (you can replace this with your desired tile layer)
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors",
  }).addTo(map);

  L.marker([17.72775328710475, 83.30915399818795], { icon: greenIcon }).addTo(map);

  // Add a marker with a popup
  var popup = L.popup([17.72775328710475, 83.30915399818795], {
    content:
      "<h5 class='heading-h5 fw-bold mb-0 text-center'>In Too Box</h5><p class='text-muted mb-0 mt-1 text-center'>Phone: 0891 - 2507678 <br/> D. No. 48-7-55/1, Srinagar, VIZAG - 530 016.</p>",
  }).openOn(map);
});

