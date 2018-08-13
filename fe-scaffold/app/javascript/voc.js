var vocForm = {
    init: function() {
        var fileInput = document.getElementById('story-photo'),
            filePreview = document.getElementById('story-file-preview'),
            fileLabel = document.getElementById('story-filename'),
            stateSelect = document.getElementById('story-state');

            fileInput.onchange = function(event) {
                if (fileInput.files && fileInput.files[0]) {
                    var fullPath = event.target.value,
                        startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/')),
                        filename = fullPath.substring(startIndex),
                        reader = new FileReader();

                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                        filename = filename.substring(1);
                    }
                    reader.onload = function (e) {
                        filePreview.src =  e.target.result;
                        filePreview.style.opacity = 1;
                    };

                    fileLabel.innerHTML = filename;
                    fileLabel.style.color = '#000';
                    reader.readAsDataURL(fileInput.files[0]);
                }
            };

            stateSelect.onchange = function(event) {
                if(event.target.value === '') {
                    stateSelect.style.color = '#ccc';
                } else {
                    stateSelect.style.color = '#000';
                }
            };
    }
}



export default vocForm;