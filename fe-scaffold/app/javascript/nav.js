var nav = {
  init: function() {

    let $nav = document.querySelector('.site-nav'),
        $header = document.querySelector('.site-header'),
        $menuButton = document.querySelector('#menu-btn'),
        $triggers = $nav.querySelectorAll('.menu-item > a'),
        $menuItems = $nav.querySelectorAll('.menu > li'),
        $mask = document.querySelector('.nav-mask'),
        
        // Track the focusable elements so we can trap focus in the menu
        $focusables = (function getFocusables() {
          var focusables = [$menuButton],
              $links = $nav.querySelectorAll('a'),
              $buttons = $nav.querySelectorAll('button');

          Array.prototype.forEach.call($links, function($link) { 
            focusables.push($link); 
          });

          Array.prototype.forEach.call($buttons, function($button) { 
            focusables.push($button); 
          });

          return focusables;
        })(),

        // Here's the trap!
        handleBlur = function(e) {
          if( $focusables.lastIndexOf(e.target) == $focusables.length - 1) {
            $menuButton.focus();
          }
        },

        // Listen for 'esc' if the menu's open
        handleKeyup = function(e) {
          if (e.key === "Escape" | e.key === "Esc") {
            closeNav();
          }
        },

        // Show or hide the whole menu
        toggleNav = function() {
          $menuButton.setAttribute('aria-expanded', !$menuButton.getAttribute('aria-expanded'));
          $nav.classList.toggle('is-expanded');
          $header.classList.toggle('is-expanded');
        },

        // Just hide it
        // TODO: should probably refactor toggleNav to take a param and use that
        closeNav = function() {
          $menuButton.setAttribute('aria-expanded', false);
          $nav.classList.remove('is-expanded');
          $header.classList.remove('is-expanded');

          for (var i = 0; i < $menuItems.length; i++) {
            $menuItems[i].classList.remove('is-expanded');
          }
        },

        // Expand a sub-menu when its sibling <a> is clicked
        expandSubnav = function(e) {
          var $target = e.target.parentNode,
              i;

          // Don't do anything special if we didn't click a top-level link
          if ($target.parentNode.classList.contains('sub-menu')) {
            return;
          }

          e.preventDefault();

          for (i = 0; i < $menuItems.length; i++) {
            if($target !== $menuItems[i]) {
              $menuItems[i].classList.remove('is-expanded');
            }
          }

          $target.classList.toggle('is-expanded');
        };


    // Add event listeners

    for (var i = 0; i < $triggers.length; i++) {
      let trigger = $triggers[i];
      trigger.addEventListener('click', expandSubnav);
    }

    $focusables.forEach(function(item) {
      item.addEventListener('blur', handleBlur);
    });

    $menuButton.addEventListener('click', toggleNav);
    $mask.addEventListener('click', closeNav);
    window.addEventListener('keyup', handleKeyup);
  }
};

export default nav
