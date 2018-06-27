import {ScrollToElement} from './scroll-to';

$(function() {
  const scrollTo = new ScrollToElement();

  scrollTo.scrolltoGlobalElement();
  scrollTo.scrolltoTopElement();
});
