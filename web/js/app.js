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

  // append the map
  $('#map-canvas--js').append(
    '<object data="http://www.openstreetmap.org/export/embed.html?bbox=6.84631,51.47322,6.85432,51.47813&layer=mapnik&marker=51.47569,6.85032" type="text/html" style="width: 100%; height: 100%;"></object>' +
    '<br />' +
    '<small>' +
    '<a target="_blank" href="http://www.openstreetmap.org/?lat=51.475675&lon=6.850315&zoom=17&layers=B000FTFTT&mlat=51.47569&mlon=6.85032">Grö&szlig;ere Karte anzeigen</a>' +
    '</small>'
  );
  
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
      duration: 300 // don't foget to change the duration also in CSS
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
