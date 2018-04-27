import layzr from 'layzr.js';

/*
Read more documentation here:
https://github.com/callmecavs/layzr.js
*/

$(function() {
  const instance = layzr();

  instance.on('src:after', (element) => {
    if (element.localName !== 'img') {
      element.style.backgroundImage = `url("${element.getAttribute('data-normal')}")`;
      element.removeAttribute('src');
    }
  });
  
  instance.update().check().handlers(true);
});
