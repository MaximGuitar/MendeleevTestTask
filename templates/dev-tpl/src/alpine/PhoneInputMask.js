export default (placeholder = 'Номер', start_phone = '+7 ') => ({
  phoneNumber: '',
  isFocused: false,
  init() {
      this.phoneNumber = start_phone;
      this.$el.setAttribute('placeholder', placeholder);
      this.$el.addEventListener('focus', () => {
          this.isFocused = true;
          this.phoneNumber = start_phone;
          this.$el.setAttribute('placeholder', start_phone);
      });
      this.$el.addEventListener('blur', () => {
          this.isFocused = false;
          if (this.phoneNumber.replace(/\D/g, '').length === 1) {
              this.phoneNumber = '';
          }
          this.$el.setAttribute('placeholder', placeholder);
      });
  }
});
