var vocForm = {
    fileInput: document.getElementById('story-photo'),
    filePreview: document.getElementById('story-file-preview'),
    fileLabel: document.getElementById('story-filename'),
    stateSelect: document.getElementById('story-state'),
    storieSearchTerm: document.getElementById('stories-search-term'),
    storiesSearchState: document.getElementById('stories-search-state'),
    storyCategories: document.getElementsByClassName('voc-category'),
    storiesContainer: document.getElementById('aggregate-macy-voc'),

    searchStories: function(method, formaData) {
                // set up a request
                var request = new XMLHttpRequest();
                // keep track of the request
                request.onreadystatechange = (function() {
                    // check if the response data send back to us
                    if(request.readyState === 4) {
                        // check if the request is successful
                        if(request.status === 200) {
                            // update the HTML of the element
                            var storiesData = JSON.parse(request.responseText),
                                stories = storiesData['stories'],
                                generated = '';

                            for (var i = 0; i < stories.length; i++) {
                                var image = '';
                                if ( stories[i].image) {
                                    image = '<div class="tile__source"><img alt="" src="https://prh.org/wp-content/uploads/2017/09/VOC-No.-2.png"/></div>';
                                }
                                generated += 
                                '<a class="aggregate-tile col-xs-12 col-md-4 voc" href="#" aria-label="title" target="_blank">' + 
                                    '<div class="tile__container">' +
                                        '<div><img alt="" src="https://prh.org/wp-content/uploads/2017/09/VOC-No.-2.png"/></div>' +
                                    '</div>' +
                                '</a>';
                            }
                            this.storiesContainer.innerHTML = generated;
                            window.macyInstances[0].recalculate();
                            setTimeout( function() {
                                window.macyInstances[0].reInit();
                            }, 250 );
                        } else {
                            console.log(request.status + ' ' + request.statusText);
                        }
                    }
                }).bind(this);

                request.open(method, 'https://prh.org/wp-admin/admin-ajax.php');
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
                this.searchStories('POST', data);
            }
        }
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

    onCategoryClick: function(event) {
        var category = event.currentTarget.dataset.category,
            data = new FormData();
        data.append('action', 'search_stories_by_category');
        data.append('category', category);
        this.searchStories('POST', data);
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

        if (this.storyCategories) {
            for (var i = 0; i < this.storyCategories.length; i++) {
                this.storyCategories[i].addEventListener('click', this.onCategoryClick.bind(this));
            }
        }
    }
}

export default vocForm;