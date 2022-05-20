"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_App_js"],{

/***/ "./resources/js/App.js":
/*!*****************************!*\
  !*** ./resources/js/App.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _App_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./App.vue */ "./resources/js/App.vue");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./router */ "./resources/js/router/index.js");


__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");




var app = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createApp)(_App_vue__WEBPACK_IMPORTED_MODULE_1__["default"]);
app.config.globalProperties.$axios = (axios__WEBPACK_IMPORTED_MODULE_2___default());
app.use(_router__WEBPACK_IMPORTED_MODULE_3__["default"]);
app.mount('#app');

/***/ })

}]);