$(document).ready(function () {

  // our main-navbar
  var nav = $('.main-navbar');

  // affix the navbar after scroll below header
  nav.affix({
    offset: {
      top: $('header').height() - nav.height()
    }
  });

  // highlight the top nav as scrolling occurs
  $('body').scrollspy({target: '.main-navbar'});

  // smooth scrolling for scroll to top
  $('.scroll-top').click(function (e) {
    e.preventDefault();
    $('body,html').animate({scrollTop: 0}, 1000);
  });

  // smooth scrolling for nav sections
  $("body.tpl_index").find('.navbar-nav li>a.js-animate').click(function (e) {
    e.preventDefault();
    var link = $(this).attr('href');
    var pos = $(link).offset().top - 20;
    $('body,html').animate({scrollTop: pos}, 700);
  });

  // image-popup
  $('.without-caption').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
    image: {
      verticalFit: true
    },
    zoom: {
      enabled: true,
      duration: 300 // don't forget to change the duration also in CSS
    }
  });

  $('.with-caption').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    mainClass: 'mfp-with-zoom mfp-img-mobile',
    image: {
      verticalFit: true,
      titleSrc: function(item) {
        return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
      }
    },
    zoom: {
      enabled: true
    }
  });


});
