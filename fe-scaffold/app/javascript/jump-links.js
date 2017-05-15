var jumpLinks = {
  links: document.querySelectorAll('.jump-link'),
  jumpScroll: function(e) {

    e.preventDefault();

    let $target = document.querySelector(e.target.hash),
        targetPos = $target.offsetTop,
        offset = 50;
  
    window.scrollTo(0, targetPos - offset);
  },
  init: function() {
    for (var i = 0; i < this.links.length; i++) {
      this.links[i].addEventListener('click', this.jumpScroll);
    }
  }
}

export default jumpLinks
