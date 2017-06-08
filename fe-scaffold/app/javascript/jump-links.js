import jump from 'jump.js'

var jumpLinks = {
  links: document.querySelectorAll('.jump-link'),
  jumpScroll: function(e) {
    e.preventDefault();
    var dest = document.querySelector(e.target.hash);
    jump(dest, {
        duration: 1000,
        offset: -400,
        a11y: true
      }
    );
  },
  init: function() {
    for (var i = 0; i < this.links.length; i++) {
      this.links[i].addEventListener('click', this.jumpScroll);
    }
  }
}

export default jumpLinks
