var vocForm = {
    fileInput: document.getElementById('story-photo'),
    filePreview: document.getElementById('story-file-preview'),
    fileLabel: document.getElementById('story-filename'),
    stateSelect: document.getElementById('story-state'),
    storieSearchTerm: document.getElementById('stories-search-term'),
    storiesSearchState: document.getElementById('stories-search-state'),
    storyCategories: document.getElementsByClassName('voc-category'),
    storiesContainer: document.getElementById('aggregate-macy-voc'),
    storiesSearchLabel: document.getElementById('stories-search-label'),
    storiesReadMore: document.getElementById('stories-read-more'),
    currentSearch: null,
    currentSearchLabel: '',

    searchStories: function(formaData, searchLabel, appendResults) {
                // set up a request
                var request = new XMLHttpRequest();
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

                request.open('POST', 'https://prh.org/wp-admin/admin-ajax.php');
                if (formaData !== null) { request.send(formaData); }
    },

    searchByTerm: function(event) {
        if (event.keyCode === 13) {
            var term = this.storieSearchTerm.value,
                data;
            if (term !== '') {
                data = new FormData();
                data.append('keyword', term);
                data.append('action', 'search_stories_by_term');
                this.searchStories(data, term, false);
                this.storiesSearchState.value = '';
            }
        }
    },

    searchByState: function(event) {
        if (event.keyCode === 13) {
            var term = this.storiesSearchState.value,
                data;
            if (term !== '') {
                data = new FormData();
                data.append('tag', term);
                data.append('action', 'search_stories_by_tag');
                this.searchStories(data, term, false);
                this.storieSearchTerm.value = '';
            }
        }
    },

    searchByCategory: function(event) {
        var category = event.currentTarget.dataset.category,
            data = new FormData();
        data.append('action', 'search_stories_by_category');
        data.append('category', category);
        this.searchStories(data, category, false);
        this.storieSearchTerm.value = '';
        this.storiesSearchState.value = '';
    },

    onFileInputChange: function(event) {
        if (this.fileInput.files && this.fileInput.files[0]) {
            var fullPath = event.target.value,
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
        var paged = parseInt(this.storiesContainer.lastElementChild.dataset.paged);
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
            this.storieSearchTerm.addEventListener( 'keyup', this.searchByTerm.bind( this ) );
        }

        if ( this.storiesSearchState ) {
            this.storiesSearchState.addEventListener( 'keyup', this.searchByState.bind( this ) );
        }

        if (this.storyCategories) {
            for (var i = 0; i < this.storyCategories.length; i++) {
                this.storyCategories[i].addEventListener('click', this.searchByCategory.bind(this));
            }
        }

        if (this.storiesReadMore) {
            this.storiesReadMore.addEventListener('click', this.onReadMoreClick.bind(this));
        }

        this.currentSearch = new FormData();
        this.currentSearch.append('s', '');
        this.currentSearch.append('per_page', 9);
        this.currentSearch.append('action', 'search_stories_by_term');
    }
}

export default vocForm;