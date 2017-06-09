import jump from 'jump.js'

var jumpLinks = {
  links: document.querySelectorAll('.jump-link'),
  adminBar: document.querySelector('#wpadminbar'),
  nav: document.querySelector('#site-header'),
  baseOffset: -100,
  jumpScroll: function(e) {

    e.preventDefault();
    var dest = document.querySelector(e.target.hash),
        offset = this.baseOffset;

    offset -= this.nav.clientHeight;
    if (this.adminBar) {
      offset -= this.adminBar.clientHeight;
    }

    jump(dest, {
        duration: 1000,
        offset: offset,
        a11y: true
      }
    );
  },
  init: function() {
    for (var i = 0; i < this.links.length; i++) {
      this.links[i].addEventListener('click', this.jumpScroll.bind(this));
    }
  }
}

export default jumpLinks
