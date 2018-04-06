import {Checkbox} from './checkbox';
import {Radio} from './radio';

$(function() {

  // Checkbox
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

  // -------------------------------------------------------------
  // Radio
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
