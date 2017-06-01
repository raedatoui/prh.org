import utils from './utils';

var alertBanner = {
  banner: document.getElementById('alert-banner'),
  closeBtn: document.getElementById('close-alert'),
  getAlertId: function() {
    return this.banner.getAttribute('data-timestamp');
  },
  hideBanner: function() {
    this.banner.classList.add('is-hidden');
    utils.setCookie('alertClosed', true)
    utils.setCookie('alertID', this.getAlertId());
  },
  init: function() {
    if (this.closeBtn) {
      this.closeBtn.addEventListener('click', this.hideBanner.bind(this));
    }
  }
}

export default alertBanner
