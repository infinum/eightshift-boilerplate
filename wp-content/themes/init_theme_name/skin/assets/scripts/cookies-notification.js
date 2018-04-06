import {cookies} from './helpers/cookies';

$(function() {
  $('.js-cookies-notification-btn').on('click', function(e) {
    e.preventDefault();

    $('.js-cookies-notification').slideUp();

    cookies.setCookie('cookie-law', 'true', cookies.setOneMonth(), '/');
  });
});
