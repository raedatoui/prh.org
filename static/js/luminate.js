(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :
	typeof define === 'function' && define.amd ? define(['exports'], factory) :
	(factory((global.luminateBundle = global.luminateBundle || {})));
}(this, (function (exports) { 'use strict';

/* Simple hide/show behavior,
	for long content with 'read more' breaks. */

var collapsible = {
	triggers: [],
	targets: [],
	init: function() {
		this.triggers = document.querySelectorAll('.collapse-link');
		this.targets = document.querySelectorAll('.collapsible');

		Array.prototype.forEach.call(this.targets, function(target) {
			target.setAttribute('aria-hidden', true);
		});

		Array.prototype.forEach.call(this.triggers, function (trigger) {
			trigger.addEventListener('click', function(e) {
				e.preventDefault();

				var t = document.querySelector(e.target.hash),
					oldState = t.getAttribute('aria-hidden'),
					newState = (oldState === 'true' ? 'false' : 'true');

				t.classList.toggle('is-collapsed');
				t.setAttribute('aria-hidden', newState);
			});
		});

	}
};

var nav = {
  init: function() {

    var $nav = document.querySelector('.site-nav'),
        $header = document.querySelector('.site-header'),
        $menuButton = document.querySelector('#menu-btn'),
        $triggers = $nav.querySelectorAll('.menu-item > a'),
        $menuItems = $nav.querySelectorAll('.menu > li'),
        $mask = document.querySelector('.nav-mask'),
        $searchButton = document.querySelector('#site-search-btn'),
        
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
        },

        // Toggle the visibility of the search bar when the [Q] is cicked

        toggleSearchBar = function() {
          $header.classList.toggle('search-open');
        };


    // Add event listeners

    for (var i = 0; i < $triggers.length; i++) {
      var trigger = $triggers[i];
      trigger.addEventListener('click', expandSubnav);
    }

    $focusables.forEach(function(item) {
      item.addEventListener('blur', handleBlur);
    });

    $menuButton.addEventListener('click', toggleNav);
    if ($searchButton) {
      $searchButton.addEventListener('click', toggleSearchBar);
    }
    $mask.addEventListener('click', closeNav);
    window.addEventListener('keyup', handleKeyup);
  }
};

function init(){
	nav.init();
	collapsible.init();
}

window.onload = function() {
	init();
};

Object.defineProperty(exports, '__esModule', { value: true });

})));

//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjpudWxsLCJzb3VyY2VzIjpbIi9Vc2Vycy9yYXRvdWkvU2l0ZXMvcHJoL3dvcmRwcmVzcy93cC1jb250ZW50L3RoZW1lcy9wcmgtd3AtdGhlbWUvZmUtc2NhZmZvbGQvYXBwL2phdmFzY3JpcHQvY29sbGFwc2libGUuanMiLCIvVXNlcnMvcmF0b3VpL1NpdGVzL3ByaC93b3JkcHJlc3Mvd3AtY29udGVudC90aGVtZXMvcHJoLXdwLXRoZW1lL2ZlLXNjYWZmb2xkL2FwcC9qYXZhc2NyaXB0L25hdi5qcyIsIi9Vc2Vycy9yYXRvdWkvU2l0ZXMvcHJoL3dvcmRwcmVzcy93cC1jb250ZW50L3RoZW1lcy9wcmgtd3AtdGhlbWUvZmUtc2NhZmZvbGQvYXBwL2phdmFzY3JpcHQvbHVtaW5hdGUuanMiXSwic291cmNlc0NvbnRlbnQiOlsiLyogU2ltcGxlIGhpZGUvc2hvdyBiZWhhdmlvcixcblx0Zm9yIGxvbmcgY29udGVudCB3aXRoICdyZWFkIG1vcmUnIGJyZWFrcy4gKi9cblxudmFyIGNvbGxhcHNpYmxlID0ge1xuXHR0cmlnZ2VyczogW10sXG5cdHRhcmdldHM6IFtdLFxuXHRpbml0OiBmdW5jdGlvbigpIHtcblx0XHR0aGlzLnRyaWdnZXJzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmNvbGxhcHNlLWxpbmsnKTtcblx0XHR0aGlzLnRhcmdldHMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuY29sbGFwc2libGUnKTtcblxuXHRcdEFycmF5LnByb3RvdHlwZS5mb3JFYWNoLmNhbGwodGhpcy50YXJnZXRzLCBmdW5jdGlvbih0YXJnZXQpIHtcblx0XHRcdHRhcmdldC5zZXRBdHRyaWJ1dGUoJ2FyaWEtaGlkZGVuJywgdHJ1ZSk7XG5cdFx0fSk7XG5cblx0XHRBcnJheS5wcm90b3R5cGUuZm9yRWFjaC5jYWxsKHRoaXMudHJpZ2dlcnMsIGZ1bmN0aW9uICh0cmlnZ2VyKSB7XG5cdFx0XHR0cmlnZ2VyLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xuXHRcdFx0XHRlLnByZXZlbnREZWZhdWx0KCk7XG5cblx0XHRcdFx0bGV0IHQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKGUudGFyZ2V0Lmhhc2gpLFxuXHRcdFx0XHRcdG9sZFN0YXRlID0gdC5nZXRBdHRyaWJ1dGUoJ2FyaWEtaGlkZGVuJyksXG5cdFx0XHRcdFx0bmV3U3RhdGUgPSAob2xkU3RhdGUgPT09ICd0cnVlJyA/ICdmYWxzZScgOiAndHJ1ZScpO1xuXG5cdFx0XHRcdHQuY2xhc3NMaXN0LnRvZ2dsZSgnaXMtY29sbGFwc2VkJyk7XG5cdFx0XHRcdHQuc2V0QXR0cmlidXRlKCdhcmlhLWhpZGRlbicsIG5ld1N0YXRlKTtcblx0XHRcdH0pO1xuXHRcdH0pO1xuXG5cdH1cbn07XG5cbmV4cG9ydCBkZWZhdWx0IGNvbGxhcHNpYmxlXG4iLCJ2YXIgbmF2ID0ge1xuICBpbml0OiBmdW5jdGlvbigpIHtcblxuICAgIGxldCAkbmF2ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnNpdGUtbmF2JyksXG4gICAgICAgICRoZWFkZXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuc2l0ZS1oZWFkZXInKSxcbiAgICAgICAgJG1lbnVCdXR0b24gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjbWVudS1idG4nKSxcbiAgICAgICAgJHRyaWdnZXJzID0gJG5hdi5xdWVyeVNlbGVjdG9yQWxsKCcubWVudS1pdGVtID4gYScpLFxuICAgICAgICAkbWVudUl0ZW1zID0gJG5hdi5xdWVyeVNlbGVjdG9yQWxsKCcubWVudSA+IGxpJyksXG4gICAgICAgICRtYXNrID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLm5hdi1tYXNrJyksXG4gICAgICAgICRzZWFyY2hCdXR0b24gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjc2l0ZS1zZWFyY2gtYnRuJyksXG4gICAgICAgIFxuICAgICAgICAvLyBUcmFjayB0aGUgZm9jdXNhYmxlIGVsZW1lbnRzIHNvIHdlIGNhbiB0cmFwIGZvY3VzIGluIHRoZSBtZW51XG4gICAgICAgICRmb2N1c2FibGVzID0gKGZ1bmN0aW9uIGdldEZvY3VzYWJsZXMoKSB7XG4gICAgICAgICAgdmFyIGZvY3VzYWJsZXMgPSBbJG1lbnVCdXR0b25dLFxuICAgICAgICAgICAgICAkbGlua3MgPSAkbmF2LnF1ZXJ5U2VsZWN0b3JBbGwoJ2EnKSxcbiAgICAgICAgICAgICAgJGJ1dHRvbnMgPSAkbmF2LnF1ZXJ5U2VsZWN0b3JBbGwoJ2J1dHRvbicpO1xuXG4gICAgICAgICAgQXJyYXkucHJvdG90eXBlLmZvckVhY2guY2FsbCgkbGlua3MsIGZ1bmN0aW9uKCRsaW5rKSB7IFxuICAgICAgICAgICAgZm9jdXNhYmxlcy5wdXNoKCRsaW5rKTsgXG4gICAgICAgICAgfSk7XG5cbiAgICAgICAgICBBcnJheS5wcm90b3R5cGUuZm9yRWFjaC5jYWxsKCRidXR0b25zLCBmdW5jdGlvbigkYnV0dG9uKSB7IFxuICAgICAgICAgICAgZm9jdXNhYmxlcy5wdXNoKCRidXR0b24pOyBcbiAgICAgICAgICB9KTtcblxuICAgICAgICAgIHJldHVybiBmb2N1c2FibGVzO1xuICAgICAgICB9KSgpLFxuXG4gICAgICAgIC8vIEhlcmUncyB0aGUgdHJhcCFcbiAgICAgICAgaGFuZGxlQmx1ciA9IGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgICBpZiggJGZvY3VzYWJsZXMubGFzdEluZGV4T2YoZS50YXJnZXQpID09ICRmb2N1c2FibGVzLmxlbmd0aCAtIDEpIHtcbiAgICAgICAgICAgICRtZW51QnV0dG9uLmZvY3VzKCk7XG4gICAgICAgICAgfVxuICAgICAgICB9LFxuXG4gICAgICAgIC8vIExpc3RlbiBmb3IgJ2VzYycgaWYgdGhlIG1lbnUncyBvcGVuXG4gICAgICAgIGhhbmRsZUtleXVwID0gZnVuY3Rpb24oZSkge1xuICAgICAgICAgIGlmIChlLmtleSA9PT0gXCJFc2NhcGVcIiB8IGUua2V5ID09PSBcIkVzY1wiKSB7XG4gICAgICAgICAgICBjbG9zZU5hdigpO1xuICAgICAgICAgIH1cbiAgICAgICAgfSxcblxuICAgICAgICAvLyBTaG93IG9yIGhpZGUgdGhlIHdob2xlIG1lbnVcbiAgICAgICAgdG9nZ2xlTmF2ID0gZnVuY3Rpb24oKSB7XG4gICAgICAgICAgJG1lbnVCdXR0b24uc2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJywgISRtZW51QnV0dG9uLmdldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcpKTtcbiAgICAgICAgICAkbmF2LmNsYXNzTGlzdC50b2dnbGUoJ2lzLWV4cGFuZGVkJyk7XG4gICAgICAgICAgJGhlYWRlci5jbGFzc0xpc3QudG9nZ2xlKCdpcy1leHBhbmRlZCcpO1xuICAgICAgICB9LFxuXG4gICAgICAgIC8vIEp1c3QgaGlkZSBpdFxuICAgICAgICAvLyBUT0RPOiBzaG91bGQgcHJvYmFibHkgcmVmYWN0b3IgdG9nZ2xlTmF2IHRvIHRha2UgYSBwYXJhbSBhbmQgdXNlIHRoYXRcbiAgICAgICAgY2xvc2VOYXYgPSBmdW5jdGlvbigpIHtcbiAgICAgICAgICAkbWVudUJ1dHRvbi5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCBmYWxzZSk7XG4gICAgICAgICAgJG5hdi5jbGFzc0xpc3QucmVtb3ZlKCdpcy1leHBhbmRlZCcpO1xuICAgICAgICAgICRoZWFkZXIuY2xhc3NMaXN0LnJlbW92ZSgnaXMtZXhwYW5kZWQnKTtcblxuICAgICAgICAgIGZvciAodmFyIGkgPSAwOyBpIDwgJG1lbnVJdGVtcy5sZW5ndGg7IGkrKykge1xuICAgICAgICAgICAgJG1lbnVJdGVtc1tpXS5jbGFzc0xpc3QucmVtb3ZlKCdpcy1leHBhbmRlZCcpO1xuICAgICAgICAgIH1cbiAgICAgICAgfSxcblxuICAgICAgICAvLyBFeHBhbmQgYSBzdWItbWVudSB3aGVuIGl0cyBzaWJsaW5nIDxhPiBpcyBjbGlja2VkXG4gICAgICAgIGV4cGFuZFN1Ym5hdiA9IGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgICB2YXIgJHRhcmdldCA9IGUudGFyZ2V0LnBhcmVudE5vZGUsXG4gICAgICAgICAgICAgIGk7XG5cbiAgICAgICAgICAvLyBEb24ndCBkbyBhbnl0aGluZyBzcGVjaWFsIGlmIHdlIGRpZG4ndCBjbGljayBhIHRvcC1sZXZlbCBsaW5rXG4gICAgICAgICAgaWYgKCR0YXJnZXQucGFyZW50Tm9kZS5jbGFzc0xpc3QuY29udGFpbnMoJ3N1Yi1tZW51JykpIHtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICB9XG5cbiAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICAgICAgICBmb3IgKGkgPSAwOyBpIDwgJG1lbnVJdGVtcy5sZW5ndGg7IGkrKykge1xuICAgICAgICAgICAgaWYoJHRhcmdldCAhPT0gJG1lbnVJdGVtc1tpXSkge1xuICAgICAgICAgICAgICAkbWVudUl0ZW1zW2ldLmNsYXNzTGlzdC5yZW1vdmUoJ2lzLWV4cGFuZGVkJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgfVxuXG4gICAgICAgICAgJHRhcmdldC5jbGFzc0xpc3QudG9nZ2xlKCdpcy1leHBhbmRlZCcpO1xuICAgICAgICB9LFxuXG4gICAgICAgIC8vIFRvZ2dsZSB0aGUgdmlzaWJpbGl0eSBvZiB0aGUgc2VhcmNoIGJhciB3aGVuIHRoZSBbUV0gaXMgY2lja2VkXG5cbiAgICAgICAgdG9nZ2xlU2VhcmNoQmFyID0gZnVuY3Rpb24oKSB7XG4gICAgICAgICAgJGhlYWRlci5jbGFzc0xpc3QudG9nZ2xlKCdzZWFyY2gtb3BlbicpO1xuICAgICAgICB9O1xuXG5cbiAgICAvLyBBZGQgZXZlbnQgbGlzdGVuZXJzXG5cbiAgICBmb3IgKHZhciBpID0gMDsgaSA8ICR0cmlnZ2Vycy5sZW5ndGg7IGkrKykge1xuICAgICAgbGV0IHRyaWdnZXIgPSAkdHJpZ2dlcnNbaV07XG4gICAgICB0cmlnZ2VyLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZXhwYW5kU3VibmF2KTtcbiAgICB9XG5cbiAgICAkZm9jdXNhYmxlcy5mb3JFYWNoKGZ1bmN0aW9uKGl0ZW0pIHtcbiAgICAgIGl0ZW0uYWRkRXZlbnRMaXN0ZW5lcignYmx1cicsIGhhbmRsZUJsdXIpO1xuICAgIH0pO1xuXG4gICAgJG1lbnVCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCB0b2dnbGVOYXYpO1xuICAgIGlmICgkc2VhcmNoQnV0dG9uKSB7XG4gICAgICAkc2VhcmNoQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgdG9nZ2xlU2VhcmNoQmFyKTtcbiAgICB9XG4gICAgJG1hc2suYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBjbG9zZU5hdik7XG4gICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ2tleXVwJywgaGFuZGxlS2V5dXApO1xuICB9XG59O1xuXG5leHBvcnQgZGVmYXVsdCBuYXZcbiIsIid1c2Ugc3RyaWN0JztcblxuaW1wb3J0IGNvbGxhcHNpYmxlIGZyb20gJy4vY29sbGFwc2libGUnO1xuaW1wb3J0IG5hdiBmcm9tICcuL25hdic7XG5cbmZ1bmN0aW9uIGluaXQoKXtcblx0bmF2LmluaXQoKTtcblx0Y29sbGFwc2libGUuaW5pdCgpO1xufVxuXG53aW5kb3cub25sb2FkID0gZnVuY3Rpb24oKSB7XG5cdGluaXQoKTtcbn1cbiJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7Ozs7QUFBQTs7O0FBR0EsSUFBSSxXQUFXLEdBQUc7Q0FDakIsUUFBUSxFQUFFLEVBQUU7Q0FDWixPQUFPLEVBQUUsRUFBRTtDQUNYLElBQUksRUFBRSxXQUFXO0VBQ2hCLElBQUksQ0FBQyxRQUFRLEdBQUcsUUFBUSxDQUFDLGdCQUFnQixDQUFDLGdCQUFnQixDQUFDLENBQUM7RUFDNUQsSUFBSSxDQUFDLE9BQU8sR0FBRyxRQUFRLENBQUMsZ0JBQWdCLENBQUMsY0FBYyxDQUFDLENBQUM7O0VBRXpELEtBQUssQ0FBQyxTQUFTLENBQUMsT0FBTyxDQUFDLElBQUksQ0FBQyxJQUFJLENBQUMsT0FBTyxFQUFFLFNBQVMsTUFBTSxFQUFFO0dBQzNELE1BQU0sQ0FBQyxZQUFZLENBQUMsYUFBYSxFQUFF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