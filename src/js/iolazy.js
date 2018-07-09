/* Disable minification (remove `.min` from URL path) for more info */

(function (undefined) { }).call('object' === typeof window && window || 'object' === typeof self && self || 'object' === typeof global && global || {});

var _createClass = function () { function t(t, e) { for (var r = 0; r < e.length; r++) { var n = e[r]; n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n) } } return function (e, r, n) { return r && t(e.prototype, r), n && t(e, n), e } }(); function _classCallCheck(t, e) { if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function") } "IntersectionObserver" in window && "IntersectionObserverEntry" in window && "intersectionRatio" in window.IntersectionObserverEntry.prototype && !("isIntersecting" in IntersectionObserverEntry.prototype) && Object.defineProperty(window.IntersectionObserverEntry.prototype, "isIntersecting", { get: function () { return this.intersectionRatio > 0 } }), window.NodeList && !NodeList.prototype.forEach && (NodeList.prototype.forEach = function (t, e) { e = e || window; for (var r = 0; r < this.length; r++)t.call(e, this[r], r, this) }); var IOlazy = function () { function t() { var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {}, r = e.image, n = void 0 === r ? ".lazyload" : r, i = e.threshold, o = void 0 === i ? .006 : i, s = e.rootMargin, a = void 0 === s ? "0px" : s; _classCallCheck(this, t), this.threshold = o, this.rootMargin = a, this.image = document.querySelectorAll(n), this.observer = new IntersectionObserver(this.handleChange.bind(this), { threshold: [this.threshold], rootMargin: this.rootMargin }), this.lazyLoad() } return _createClass(t, [{ key: "handleChange", value: function (t) { var e = this; t.forEach(function (t) { t.isIntersecting && (t.target.classList.add("fade-in"),  t.target.getAttribute("data-srcset") && (t.target.srcset = t.target.getAttribute("data-srcset")), t.target.getAttribute("data-src") && (t.target.src = t.target.getAttribute("data-src")), e.observer.unobserve(t.target)) }) } }, { key: "lazyLoad", value: function () { var t = this; this.image.forEach(function (e) { t.observer.observe(e) }) } }]), t }();


//t.target.parentNode.getElementsByClassName('loader-2')[0].style.display = 'none',
document.addEventListener("DOMContentLoaded", function () {

    const allLazyLoad = document.querySelectorAll('.lazyload');

    var isIE11 = /Trident.*rv[ :]*11\./.test(navigator.userAgent);
    var IE = (function () {
        "use strict";

        var ret, isTheBrowser,
            actualVersion,
            jscriptMap, jscriptVersion;

        isTheBrowser = false;
        jscriptMap = {
            "5.5": "5.5",
            "5.6": "6",
            "5.7": "7",
            "5.8": "8",
            "9": "9",
            "10": "10"
        };
        jscriptVersion = new Function("/*@cc_on return @_jscript_version; @*/")();

        if (jscriptVersion !== undefined) {
            isTheBrowser = true;
            actualVersion = jscriptMap[jscriptVersion];
        }

        ret = {
            isTheBrowser: isTheBrowser,
            actualVersion: actualVersion
        };

        return ret;
    }());
//window.innerWidth <= 960 &&  window.innerWidth > 860
    Array.from(allLazyLoad).forEach(item => {
        if ( window.innerWidth <= 340 ) {
            item.setAttribute('width', item.getAttribute('data-mobile-width'));
            item.setAttribute('height', item.getAttribute('data-mobile-height'));
            // (max-width: 320px) 205px,
            // (max-width: 860px) 255px,
            // (max-width: 960px) 205px,
            // (max-width: 1060px) 255px,
        }
        if (isIE11 || IE.isTheBrowser) {
            item.setAttribute('src', item.getAttribute('data-ie'));
            item.parentNode.getElementsByClassName('loader-2')[0].style.display = 'none';
            item.setAttribute('class', '');
        }
    });

    new IOlazy({
        image: '.lazyload',
        threshold: 0.06
    });
});

