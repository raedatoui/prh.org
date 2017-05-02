var nav = {
  init: function() {

    let $nav = document.querySelector('.site-nav'),
        $menuButton = document.querySelector('#menu-btn'),
        $triggers = $nav.querySelectorAll('.menu-item > a'),
        $menuItems = $nav.querySelectorAll('.menu > li'),
        toggleNav = function() {
          $menuButton.setAttribute('aria-expanded', !$menuButton.getAttribute('aria-expanded'));
          $nav.classList.toggle('is-expanded');
        },
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


    $menuButton.addEventListener('click', toggleNav);

    for (var i = 0; i < $triggers.length; i++) {
      let trigger = $triggers[i];
      trigger.addEventListener('click', expandSubnav);
    }
  }
};

export default nav
