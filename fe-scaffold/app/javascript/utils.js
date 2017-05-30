var utils = {
  debounce: function(method, delay) {
    clearTimeout(method._tId);
    method._tId= setTimeout(function(){
        method();
    }, delay);
  }
}

export default utils
