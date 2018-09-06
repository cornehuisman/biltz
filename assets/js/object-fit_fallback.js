jQuery( document ).ready(function($) {
    // Detect objectFit support
    if('objectFit' in document.documentElement.style === false) {
      var container = document.getElementsByClassName('object-fit__container');
      for(var i = 0; i < container.length; i++) {
        var imageSource = container[i].querySelector('img').src
        container[i].querySelector('img').style.display = 'none';
        container[i].style.backgroundSize = 'cover';
        container[i].style.backgroundImage = 'url(' + imageSource + ')';
        container[i].style.backgroundPosition = 'center center';
      }
    }

    // This is internet explorer 10
    if (/MSIE 10/i.test(navigator.userAgent)) {
      $(".object-fit__container img").remove();
    }

    // This is internet explorer 9 or 11
    if (/MSIE 9/i.test(navigator.userAgent) || /rv:11.0/i.test(navigator.userAgent)) {
       $(".object-fit__container img").remove();
    }

    // This is Microsoft Edge
    if (/Edge\/\d./i.test(navigator.userAgent)){
       $(".object-fit__container img").remove();
    }
});
