import $ from 'jquery';
import generalHelpers from './../helpers/general';

export default class Checkbox {
  constructor(containerSelector = '.js-checkbox') {
    this.containerSelector = containerSelector;
    this.checkedClass = 'checkbox--checked';
    this.disabledClass = 'checkbox--disabled';
    this.focusClass = 'checkbox--focus';
    this.$container = $(this.containerSelector);
    this.$link = this.$container.find('a');
    this.$input = this.$container.find('input[type=checkbox]');
  }
  escapeString(string) {
    return generalHelpers.escapeString(string);
  }
  getInputById(id) {
    return $(`input[type="checkbox"]#${id}`);
  }
  getContainerByInput(id) {
    return this.getInputById(id).closest(this.containerSelector);
  }
  check(id) {
    this.getContainerByInput(id).addClass(this.checkedClass);
  }
  uncheck(id) {
    this.getContainerByInput(id).removeClass(this.checkedClass);
  }
  setDisabled(id) {
    this.getContainerByInput(id).addClass(this.disabledClass);
  }
  unsetDisabled(id) {
    this.getContainerByInput(id).removeClass(this.disabledClass);
  }
  setFocus(id) {
    this.getContainerByInput(id).addClass(this.focusClass);
  }
  unsetFocus(id) {
    this.getContainerByInput(id).removeClass(this.focusClass);
  }
  resetAll(formID) {
    formID.find(this.containerSelector).removeClass(this.checkedClass);
    formID.find('input[type="checkbox"]').prop('checked', false);
  }
  toggle(id) {
    const escapedID = this.escapeString(id);
    const $input = this.getInputById(escapedID);

    if (!$input.is(':disabled')) {
      if ($input.prop('checked')) {
        this.check(escapedID);
      } else {
        this.uncheck(escapedID);
      }
    } else {
      this.setDisabled(escapedID);
    }
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
// <label for="checkbox1" class="checkbox js-checkbox">
//   <i class="checkbox__icon"></i>
//   Checkbox Title 1
//   <input type="checkbox" id="checkbox1" name="checkbox1" class="checkbox__input" />
// </label>

$(function() {

  const checkbox = new Checkbox();

  // On page load set
  checkbox.$input.each(function() {
    const id = $(this).attr('id');
    checkbox.init(id);
  });

  // On click action
  checkbox.$container.on('change', function() {
    const id = $(this).attr('for');
    checkbox.toggle(id);
  });

  // On space click action
  checkbox.$input.keypress(function(e) {
    if (e.keyCode === 0 || e.keyCode === 32) {
      const id = $(this).attr('id');
      checkbox.toggle(id);
    }
  });

  // Stop checkbox from activating if there is a link in label
  checkbox.$link.on('click', function(e) {
    e.stopPropagation();
  });

  // On focus
  checkbox.$input.bind('focus', function() {
    const id = $(this).attr('id');
    checkbox.setFocus(id);
  });

  // On blur
  checkbox.$input.bind('blur', function() {
    const id = $(this).attr('id');
    checkbox.unsetFocus(id);
  });
});
