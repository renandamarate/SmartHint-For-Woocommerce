
var smarthintkey = scriptParams["shcode"];

(function () {  
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.async = true;
    script.src = 'https://service.smarthint.co/Scripts/i/Woocommerce.min.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(script, s);
})();