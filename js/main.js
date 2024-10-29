window.addEventListener('load', function() {
    let desktopTrigger = document.querySelector('#desktop-trigger');
    let desktopMessage = document.querySelector('.desktop-message');

	jQuery(desktopTrigger).on('click', function(e) {
      jQuery(desktopMessage).fadeToggle();
      jQuery(desktopMessage).toggleClass("add-styles");
    });
})
