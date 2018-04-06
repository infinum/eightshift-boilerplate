export const cookies = {
  setCookie(key, value, time, path) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (time));
    let pathValue = '';

    if (typeof path !== 'undefined') {
      pathValue = `path=${path};`;
    }

    document.cookie = `${key}=${value};${pathValue}expires=${expires.toUTCString()}`;
  },
  getCookie(key) {
    const keyValue = document.cookie.match(`(^|;) ?${key}=([^;]*)(;|$)`);
    return keyValue ? keyValue[2] : null;
  },
  setHalfDay() {
    return 43200000;
  },
  setOneDay() {
    return 86400000;
  },
  setOneYear() {
    return 31540000000;
  },
  setHalfAnHour() {
    return 1800000;
  },
  setOneMonth() {
    return 2628000000;
  },
};
