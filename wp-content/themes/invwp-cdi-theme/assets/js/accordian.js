$(document).ready(function () {
  $(".accordion .group a").click(function () {
    if ($(this).closest(".accordion").hasClass("active")) {
      $(this).closest(".accordion").removeClass("active");
      $(this).closest(".accordion").find(".body-part").slideUp();
    } else {
      $(".accordion").removeClass("active");
      $(".accordion").find(".body-part").slideUp();
      $(this).closest(".accordion").addClass("active");
      $(this).closest(".accordion").find(".body-part").slideDown();
    }
  });
});
