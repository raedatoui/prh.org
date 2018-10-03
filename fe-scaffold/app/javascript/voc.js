const vocForm = {
	fileInput: document.getElementById('story-photo'),
	filePreview: document.getElementById('story-file-preview'),
	fileLabel: document.getElementById('story-filename'),
	stateSelect: document.getElementById('story-state'),
	
	storieSearchTerm: document.getElementById('stories-search-term'),
	storiesSearchState: document.getElementById('stories-search-state'),
	storyCategories: document.getElementsByClassName('story-category'),
	storySearchButton: document.getElementById('strories-search-btn'),
	
	storiesSearchLabel: document.getElementById('stories-search-label'),
	storiesContainer: document.getElementById('aggregate-macy-voc'),
	storiesReadMore: document.getElementById('stories-read-more'),
	currentSearch: null,
	currentSearchLabel: '',

	searchStories: function(formaData, searchLabel, appendResults) {
				// set up a request
				const request = new XMLHttpRequest();
				// keep track of the request
				request.onreadystatechange = (function() {
					// check if the response data send back to us
					if(request.readyState === 4) {
						// check if the request is successful
						if(request.status === 200) {
							this.currentSearch = formaData;
							if (appendResults) {
								this.storiesContainer.innerHTML = this.storiesContainer.innerHTML + request.responseText;
							} else {
								this.storiesContainer.innerHTML = request.responseText;
							}
							if (searchLabel !== '') {
								this.currentSearchLabel = searchLabel;
								this.storiesSearchLabel.innerHTML = 'Searching for: ' + searchLabel;
							}
							window.macyInstances[0].recalculate();
							setTimeout( function() {
								window.macyInstances[0].reInit();
							}, 250 );
						} else {
							console.log(request.status + ' ' + request.statusText);
						}
					}
				}).bind(this);

				request.open('POST', 'http://74x.8f7.mwp.accessdomain.com/wp-admin/admin-ajax.php');
				if (formaData !== null) { request.send(formaData); }
	},

	onSearchFieldKeyUp: function(event) {
		if (event.keyCode === 13) {
			this.doSearch();
		}
	},

	onSearchButtonClick: function(event) {
		event.stopPropagation();
		event.preventDefault();
		this.doSearch();
	},

	doSearch() {
		const term = this.storieSearchTerm.value,
				state = this.storiesSearchState.value;
		let data;
		if (term !== '' && state === '') {
			data = new FormData();
			data.append('keyword', term);
			data.append('action', 'search_stories_by_term');
			this.searchStories(data, term, false);
		} else if (state !== '' && term === '') {
			data = new FormData();
			data.append('tag', state);
			data.append('action', 'search_stories_by_tag');
			this.searchStories(data, state, false);
		} else if (term !== '' && state != '') {
			data = new FormData();
			data.append('keyword', term);
			data.append('tag', state);
			data.append('action', 'search_stories_by_tag_and_term');
			const searchLabel = term + ' in ' + state; 
			this.searchStories(data, searchLabel, false);
		}		
	},

	searchByCategory: function(event) {
		const category = event.currentTarget.dataset.category;
		let data = new FormData();
		data.append('action', 'search_stories_by_category');
		data.append('category', category);
		this.searchStories(data, category, false);
		this.storieSearchTerm.value = '';
		this.storiesSearchState.value = '';
	},

	onFileInputChange: function(event) {
		if (this.fileInput.files && this.fileInput.files[0]) {
			let fullPath = event.target.value,
				startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/')),
				filename = fullPath.substring(startIndex),
				reader = new FileReader(),
				readerLoad = function (e) {
					this.filePreview.src =  e.target.result;
					this.filePreview.style.opacity = 1;
				};

			if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
				filename = filename.substring(1);
			}

			reader.onload = readerLoad.bind(this);
			this.fileLabel.innerHTML = filename;
			this.fileLabel.style.color = '#000';
			reader.readAsDataURL(this.fileInput.files[0]);
		}
	},

	onStateInputChange: function(event) {
		if (event.target.value === '') {
			this.stateSelect.style.color = '#ccc';
		} else {
			this.stateSelect.style.color = '#000';
		}
	},

	onReadMoreClick: function(event) {
		event.stopPropagation();
		event.preventDefault();
		const paged = parseInt(this.storiesContainer.lastElementChild.dataset.paged);
		this.currentSearch.set('paged', paged+1);
		this.currentSearch.set('per_page', 3);
		this.searchStories(this.currentSearch, this.currentSearchLabel, true);
	},

	init: function() {
		if (this.fileInput) {
			this.fileInput.onchange = this.onFileInputChange.bind( this );
		}

		if (this.stateSelect) {
			this.stateSelect.onchange = this.onStateInputChange.bind( this );
		}

		if ( this.storieSearchTerm ) {
			this.storieSearchTerm.addEventListener( 'keyup', this.onSearchFieldKeyUp.bind( this ) );
		}

		if ( this.storiesSearchState ) {
			this.storiesSearchState.addEventListener( 'keyup', this.onSearchFieldKeyUp.bind( this ) );
		}

		if (this.storyCategories) {
			for (let i = 0; i < this.storyCategories.length; i++) {
				this.storyCategories[i].addEventListener('click', this.searchByCategory.bind(this));
			}
		}

		if (this.storiesReadMore) {
			this.storiesReadMore.addEventListener('click', this.onReadMoreClick.bind(this));
		}

		if (this.storySearchButton) {
			this.storySearchButton.addEventListener('click', this.onSearchButtonClick.bind(this));
		}
		this.currentSearch = new FormData();
		this.currentSearch.append('s', '');
		this.currentSearch.append('per_page', 9);
		this.currentSearch.append('action', 'search_stories_by_term');
	}
}

export default vocForm;