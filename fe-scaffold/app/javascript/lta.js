const ltaForm = {
    storage: null,
    formId: '2',
    formName: 'nfForm-4',
    nav: document.getElementsByClassName( 'nf-mp-footer' ),
    ltaPage: false,
    checkInterval: null,
    saveMessage: null,
    messageInterval: null,

    init() {
        const bodyClassList =  document.body.classList;
        this.ltaPage = bodyClassList.contains('page-template-lta-application');
        if(this.ltaPage) {
            this.storage = window.localStorage;
            this.checkInterval = setInterval(() => {
                if(this.nav.length === 1) {
                    this.nav = this.nav[0];
                    clearInterval(this.checkInterval);
                    this.addSaveButton();
                }
            }, 100);
        }
    },

    addSaveButton() {
        const saveButton = document.createElement('input'),
            saveButtonRow = document.createElement('div'),
            saveMessage = document.createElement('span');

        saveButton.classList.add('nf-save-item');
        saveButton.value = 'Save';
        saveButton.type = 'button';

        saveMessage.classList.add('nf-save-label');

        saveButtonRow.classList.add('nf-save-container');
        saveButtonRow.appendChild(saveButton);
        saveButtonRow.appendChild(saveMessage);

        this.nav.insertBefore(saveButtonRow, this.nav.childNodes[0]);

        saveButton.addEventListener('click', this.onSaveClick.bind(this));
        this.saveMessage = saveMessage;
    },

    onSaveClick() {
        const fieldData = Backbone.Radio.channel( 'forms' ).request( 'save:fieldAttributes', this.formId);
        this.storage.setItem(this.formName, JSON.stringify(fieldData));
        this.saveMessage.innerHTML= 'Your progress is saved';
        this.messageInterval = setInterval(() => {
            this.saveMessage.innerHTML = '';
        }, 3000);
    }
};

export default ltaForm;
