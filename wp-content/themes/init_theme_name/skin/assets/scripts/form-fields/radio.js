import {generalHelpers} from './../helpers/general';

export class Radio {
  constructor(containerSelector = '.js-radio') {
    this.containerSelector = containerSelector;
    this.checkedClass = 'radio--checked';
    this.disabledClass = 'radio--disabled';
    this.focusClass = 'radio--focus';
    this.$container = $(this.containerSelector);
    this.$link = this.$container.find('a');
    this.$input = this.$container.find('input[type=radio]');
  }
  escapeString(stringValue) {

    if (typeof stringValue === 'undefined') {
      return false;
    }

    return generalHelpers.escapeString(stringValue);
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
