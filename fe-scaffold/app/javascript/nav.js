var nav = {
  init: function() {

    let $nav = document.querySelector('.site-nav'),
        $triggers = $nav.querySelectorAll('.menu-item > a'),
        $menuItems = $nav.querySelectorAll('.menu > li'),
        expandSubnav = function(e) {
          var $target = e.target;

          if ($target.parentNode.parentNode.classList.contains('sub-menu')) {
            return;
          }

          e.preventDefault();

          if (e.target.href) {
            $target = $target.parentNode;
          }

          for (var i = 0; i < $menuItems.length; i++) {
            if($target !== $menuItems[i]) {
              $menuItems[i].classList.remove('is-expanded');
              }
          }

          $target.classList.toggle('is-expanded');
        };


    for (var i = 0; i < $triggers.length; i++) {
      let trigger = $triggers[i];
      trigger.addEventListener('click', expandSubnav);
    }
  }
};

export default nav
