const generalHelpers = {
  escapeString(string) {
    return string.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, '\\$1');
  }
};

export default generalHelpers;
