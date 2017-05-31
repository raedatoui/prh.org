import jump from 'jump.js'

var jumpLinks = {
  links: document.querySelectorAll('.jump-link'),
  jumpScroll: function(e) {
    e.preventDefault();

    jump(e.target.hash, {
        duration: 1000,
        offset: -100,
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
