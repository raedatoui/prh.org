var accordion = {
	triggers: [],
	targets: [],
	init: function() {
		this.triggers = document.querySelectorAll('.accordion-title');
		this.targets = document.querySelectorAll('.accordion-content');

		var toggleAccordion = function(ev) {
			var button = ev.target,
					target = d.querySelector('[aria-labelledby=accordion-label-' + button.getAttribute('aria-controls') + ']'),
					state = (button.getAttribute('aria-expanded') == 'false' || false)? true : false;

			target.classList.toggle('is-active');
			button.setAttribute('aria-expanded', state);
		}

		for (var i = 0; i < triggers.length; i++) {
			let trigger = triggers[i],
					index = 'collapsible--'+i,
					button = document.createElement('button'),
					target = trigger.nextElementSibling,
					state = !!trigger.getAttribute('data-state');

			button.id = 'accordion-label-'+index;
			button.setAttribute('aria-controls', index);
			button.setAttribute('aria-expanded', state);
			button.innerHTML = trigger.innerHTML;
			button.addEventListener('click', toggleAccordion, false);

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
