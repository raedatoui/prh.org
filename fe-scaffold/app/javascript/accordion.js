var accordion = {
	triggers: [],
	targets: [],
	init: function() {
		this.triggers = document.querySelectorAll('.accordion-title');
		this.targets = document.querySelectorAll('.accordion-content');

		var closeAll = function() {
			for (var i = 0; i < this.triggers.length; i++) { 
				let button = this.triggers[i].firstElementChild,
						target = this.targets[i];

				target.classList.remove('is-active');
				button.setAttribute('aria-expanded', 'false');
			}
		};

		var toggle = function(ev) {


			let button = ev.target,
					target = document.querySelector('[aria-labelledby=accordion-label-' + button.getAttribute('aria-controls') + ']'),
					state = (button.getAttribute('aria-expanded') == 'false' || false)? true : false;

			// closeAll(button);
			target.classList.toggle('is-active');
			button.setAttribute('aria-expanded', state);

		};

		for (var i = 0; i < this.triggers.length; i++) {
			let trigger = this.triggers[i],
					index = 'collapsible--'+i,
					button = document.createElement('button'),
					target = trigger.nextElementSibling,
					state = !!trigger.getAttribute('data-state');

			button.id = 'accordion-label-'+index;
			button.setAttribute('aria-controls', index);
			button.setAttribute('aria-expanded', state);
			button.innerHTML = trigger.innerHTML;
			button.addEventListener('click', toggle, false);

			trigger.innerHTML = '';
			trigger.appendChild(button);

			if (state) {
				target.classList.add('is-active');
			}

			target.id = index;
			target.setAttribute('aria-labelledby', 'accordion-label-' + index);    
		};
	}
};

export default accordion
