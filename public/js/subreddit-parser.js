/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/subreddit-parser.js":
/*!******************************************!*\
  !*** ./resources/js/subreddit-parser.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

$(function () {
  var loaded = false;
  var $feed = $('#subreddit-feed');

  function timeSince(date) {
    if (_typeof(date) !== 'object') {
      date = new Date(date);
    }

    var seconds = Math.floor((new Date() - date) / 1000);
    var intervalType;
    var interval = Math.floor(seconds / 31536000);

    if (interval >= 1) {
      intervalType = 'year';
    } else {
      interval = Math.floor(seconds / 2592000);

      if (interval >= 1) {
        intervalType = 'month';
      } else {
        interval = Math.floor(seconds / 86400);

        if (interval >= 1) {
          intervalType = 'day';
        } else {
          interval = Math.floor(seconds / 3600);

          if (interval >= 1) {
            intervalType = 'hour';
          } else {
            interval = Math.floor(seconds / 60);

            if (interval >= 1) {
              intervalType = 'minute';
            } else {
              interval = seconds;
              intervalType = 'second';
            }
          }
        }
      }
    }

    if (interval > 1 || interval === 0) {
      intervalType += 's';
    }

    return interval + ' ' + intervalType;
  }

  ;
  $feed.html('<p>Loading posts...</p>');
  feednami.load('https://www.reddit.com/r/HaloOnline.rss').then(function (feed) {
    $feed.text('');
    loaded = true;
    var i = 0; // Skip the first two posts (pinned)

    $.each(feed.entries.slice(2), function (k, v) {
      i++;
      var output = "<a href=\"".concat(v.link, "\" target=\"_blank\" class=\"listview__item mb-2\">\n                                <div class=\"listview__content\">\n                                    <div class=\"listview__heading text-truncate\">").concat(v.title, "</div>\n                                    <p>by ").concat(v.author, ", ").concat(timeSince(v.date), " ago</p>\n                                </div>\n                            </a>");
      $feed.append(output);
      return i != 7;
    });
  });
  setTimeout(function () {
    if (!loaded) {
      $feed.html('<p>Oops, something happened. Couldn\'t load posts.</p>');
      var title = 'Error';
      var message = 'Couldn\'t load Reddit posts. Try refreshing this page.';
      var toast = "\n                <div class=\"toast toast--right\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\" data-autohide=\"true\" data-delay=\"3000\" data-animation=\"true\">\n                    <div class=\"toast-header\">\n                        <i class=\"zwicon-arrow-top-right text-orange\"></i>\n                        <strong>".concat(title, "</strong>\n                    </div>\n                    <div class=\"toast-body\">\n                        ").concat(message, "\n                    </div>\n                </div>\n            ");
      $('.content__inner').prepend(toast);
      $('.toast').toast('show');
    }
  }, 5000);
});

/***/ }),

/***/ 1:
/*!************************************************!*\
  !*** multi ./resources/js/subreddit-parser.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\Documents\Dev\Web\ElDewrito Services\resources\js\subreddit-parser.js */"./resources/js/subreddit-parser.js");


/***/ })

/******/ });