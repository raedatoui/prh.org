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

				let t = document.querySelector(e.target.hash),
					oldState = t.getAttribute('aria-hidden'),
					newState = (oldState === 'true' ? 'false' : 'true');

				t.classList.toggle('is-collapsed');
				t.setAttribute('aria-hidden', newState);
			});
		});

	}
};

export default collapsible
