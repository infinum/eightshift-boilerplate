import $ from 'jquery';
import generalHelpers from './../helpers/general';

export default class Radio {
  constructor(containerSelector = '.js-radio') {
    this.containerSelector = containerSelector;
    this.checkedClass = 'radio--checked';
    this.disabledClass = 'radio--disabled';
    this.focusClass = 'radio--focus';
    this.$container = $(this.containerSelector);
    this.$link = this.$container.find('a');
    this.$input = this.$container.find('input[type=radio]');
  }
  escapeString(string) {
    return generalHelpers.escapeString(string);
  }
  getInputById(id) {
    return $(`input[type="radio"]#${id}`);
  }
  getInputNameById(id) {
    return $(`input[type="radio"]#${id}`).attr('name');
  }
  getContainerByInput(id) {
    return this.getInputById(id).closest(this.containerSelector);
  }
  check(id) {
    this.getContainerByInput(id).addClass(this.checkedClass);
  }
  uncheck(id) {
    const inputName = this.getInputNameById(id);
    this.$container.find(`input[name="${inputName}"]`).closest(this.containerSelector).removeClass(this.checkedClass);
  }
  setDisabled(id) {
    this.getContainerByInput(id).addClass(this.disabledClass);
  }
  setFocus(id) {
    this.getContainerByInput(id).addClass(this.focusClass);
  }
  unsetFocus(id) {
    this.getContainerByInput(id).removeClass(this.focusClass);
  }
  resetAll(formID) {
    formID.find(this.containerSelector).removeClass(this.checkedClass);
    formID.find('input[type="radio"]').prop('checked', false);
  }
  toggle(id) {
    const escapedID = this.escapeString(id);
    
    this.uncheck(escapedID);
    this.check(escapedID);
  }
  init(id) {
    const escapedID = this.escapeString(id);
    const $input = this.getInputById(escapedID);

    if ($input.prop('checked')) {
      this.check(escapedID);
    }

    if ($input.is(':disabled')) {
      this.setDisabled(escapedID);
    }
  }
}

// Layout example
// <label for="radio1" class="radio js-radio">
//   <i class="radio__icon"></i>
//   Radio title 1
//   <input type="radio" id="radio1" name="test_radio" class="radio__input"  />
// </label>
// <label for="radio2" class="radio js-radio">
//   <i class="radio__icon"></i>
//   Radio title 2
//   <input type="radio" id="radio2" name="test_radio" class="radio__input" disabled checked />
// </label>

$(function() {

  const radio = new Radio();

  // On page load set
  radio.$input.each(function() {
    const id = $(this).attr('id');
    radio.init(id);
  });

  // // On click action
  radio.$container.on('change', function() {
    const id = $(this).attr('for');
    radio.toggle(id);
  });

  // Stop radio from activating if there is a link in label
  radio.$link.on('click', function(e) {
    e.stopPropagation();
  });

  // On focus
  radio.$input.bind('focus', function() {
    const id = $(this).attr('id');
    radio.setFocus(id);
  });

  // On blur
  radio.$input.bind('blur', function() {
    const id = $(this).attr('id');
    radio.unsetFocus(id);
  });
});
