export const generalHelpers = {
  escapeString(string) {
    return string.replace(/([;&,.+*~':"!^#$%@[\]()=>|])/g, '\\$1');
  },
};
