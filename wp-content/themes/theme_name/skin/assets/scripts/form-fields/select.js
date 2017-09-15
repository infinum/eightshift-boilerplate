import $ from 'jquery';

const select = {
  focusClass: 'select__wrap--focus',

  init() {
    this.$select = $('.select');
    this.$selectFocus = $('.select:focus');

    this.setWrapper();
  },
  setWrapper() {
    this.$select.wrap('<div class="select__wrap"></div>');
  },
  setFocus(e) {
    e.parent().addClass(this.focusClass);
  },
  unsetFocus(e) {
    e.parent().removeClass(this.focusClass);
  }
};

export default select;

$(function() {
  select.init();

  select.$select.on('focus', function() {
    select.setFocus($(this));
  });

  select.$select.on('blur', function() {
    select.unsetFocus($(this));
  });

});
