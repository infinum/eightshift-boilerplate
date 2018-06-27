import {ScrollToElement} from './scroll-to';
import {Lazyloading} from './lazyloading';

$(function() {
  const scrollTo = new ScrollToElement();
  const lazyLoading = new Lazyloading();

  // -------------------------------------------------------------
  // scrollTo
  scrollTo.scrolltoGlobalElement();
  scrollTo.scrolltoTopElement();

  // -------------------------------------------------------------
  // lazyLoading
  lazyLoading.init();
});
