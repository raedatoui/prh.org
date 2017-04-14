var collapsible = {
  triggers: [],
  targets: [],
  init: function() {
    this.triggers = document.querySelectorAll('.collapse-link');
    this.targets = document.querySelectorAll('.collapsible');

    Array.prototype.forEach.call(this.triggers, function (item) {
      item.addEventListener('click', function(e) {
        e.preventDefault();

        let t = document.querySelector(e.target.hash);
        t.classList.toggle('is-collapsed');
      });
    });

  }
};

export default collapsible
