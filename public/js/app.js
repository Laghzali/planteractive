/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

var viewer = OpenSeadragon({
  visibilityRatio: 1.0,
  constrainDuringPan: true,
  gestureSettingsMouse: {
    clickToZoom: false,
    dblClickToZoom: true
  },
  defaultZoomLevel: 1,
  zoomInButton: "zoom-in",
  zoomOutButton: "zoom-out",
  homeButton: "home",
  timeout: 100000,
  showNavigationControl: true,
  id: "openseadragon"
});
var point = new OpenSeadragon.Point();

var clickHandler = function clickHandler(event) {
  console.log(event);
  var webPoint = event.position;
  var viewportPoint = viewer.viewport.windowToViewportCoordinates(webPoint);
  var element = "overlay";
  var element_position = viewportPoint;
  point.x = element_position.x;
  point.y = element_position.y;

  if (event.shift) {
    $('#dataSend').modal('show'); //viewer.addOverlay(element, point, OpenSeadragon.Placement.CENTER);
  }
};

function sendForm(sym, color) {
  var image = document.getElementById('image');
  var file = image.files[0];
  note = document.getElementById('note').value;
  name = document.getElementById('name').value;
  form = new FormData();
  form.append('note', note);
  form.append('name', name);
  form.append('symbol', sym);
  form.append('color', color);
  form.append('x', point.x);
  form.append('y', point.y);
  form.append('map_id', sessionStorage.getItem('currentMap'));
  form.append('image', file);
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      drawLatest();
    }
  };

  xhr.open("POST", 'api/save', true);
  xhr.send(form);
}

function uploadPdf() {
  var image = document.getElementById('map_pdf');
  var file = image.files[0];
  name = document.getElementById('map_name').value;
  form = new FormData();
  form.append('map_name', name);
  form.append('map_pdf', file);
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      drawLatest();
    }
  };

  xhr.open("POST", 'api/new/map', true);
  xhr.send(form);
}

new OpenSeadragon.MouseTracker({
  element: viewer.canvas,
  clickHandler: clickHandler
});

function renderOverlay(id) {
  $('#parentModal' + id).modal('show');
  console.log(id);
}

function drawLatest() {
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      var data = JSON.parse(xhr.responseText);
      var pointPosition = new OpenSeadragon.Point();
      div = document.createElement('div');
      div.id = data.id;
      document.body.appendChild(div);
      span = document.createElement('span');
      span.setAttribute('style', 'color:' + data.color);
      span.innerHTML = '<i class="' + data.symbol + ' pulsate customSym" ></i>';
      span.setAttribute('id', 'renderer');
      div.appendChild(span);
      htmlx = "<div id='parentModal" + data.id + "' class='modal fade' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
      htmlx += "  <div class='modal-dialog'>";
      htmlx += "   <div class='modal-content'>";
      htmlx += "     <div class='modal-header'>";
      htmlx += "       <h4 id='nameField' class='modal-title nameField'>" + data.name + "</h4> ";
      htmlx += "       <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
      htmlx += "      </div>";
      htmlx += "     <div  class='modal-body'><img src=" + data.image + "  style='max-width: 100%; max-height: 100%' id='imageField' class='img-responsive'> <p class='col-md-12' id='noteField'>" + data.note + "</p> </div>";
      htmlx += "     <div class='modal-footer'>";
      htmlx += "  <button type='button' class='btn btn-danger' onclick='deleteOverlay(" + data.id + ")' data-bs-dismiss='modal'>Delete</button>";
      htmlx += "   </div></div> </div></div>";
      pointPosition.x = data.x;
      pointPosition.y = data.y;
      document.body.insertAdjacentHTML('beforeend', htmlx);
      span.setAttribute('onclick', "renderOverlay(" + data.id + ")");
      viewer.addOverlay(div, pointPosition, OpenSeadragon.Placement.CENTER);
    }
  };

  xhr.open("get", 'api/retrive/last', true);
  xhr.setRequestHeader('Accept', 'application/json');
  xhr.send();
}

function draw() {
  viewer.clearOverlays();
  var xhr = new XMLHttpRequest();
  var currentMap = sessionStorage.getItem('currentMap');

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      var data = JSON.parse(xhr.responseText);

      for (elm in data) {
        console.log('drawing .. map_over_id : ' + data[elm].map_overlay_id);

        if (sessionStorage.getItem('currentMap') === data[elm].map_overlay_id) {
          var pointPosition = new OpenSeadragon.Point();
          div = document.createElement('div');
          div.id = data[elm].id;
          document.body.appendChild(div);
          span = document.createElement('span');
          span.setAttribute('style', 'color:' + data[elm].color);
          span.innerHTML = '<i class="' + data[elm].symbol + ' pulsate customSym" ></i>';
          span.setAttribute('id', 'renderer' + elm);
          div.appendChild(span);
          htmlx = "<div id='parentModal' class='modal fade' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
          htmlx += "  <div class='modal-dialog'>";
          htmlx += "   <div class='modal-content'>";
          htmlx += "     <div class='modal-header'>";
          htmlx += "       <h4 id='nameField' class='modal-title nameField'>" + data[elm].name + "</h4> ";
          htmlx += "       <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
          htmlx += "      </div>";
          htmlx += "     <div  class='modal-body'><img src=" + data[elm].image + "  style='max-width: 100%; max-height: 100%' id='imageField' class='img-responsive'> <p class='col-md-12' id='noteField'>" + data[elm].note + "</p> </div>";
          htmlx += "     <div class='modal-footer'>";
          htmlx += "  <button type='button' class='btn btn-danger' onclick='deleteOverlay(" + data[elm].id + ")' data-bs-dismiss='modal'>Delete</button>";
          htmlx += "   </div></div> </div></div>";
          pointPosition.x = data[elm].x;
          pointPosition.y = data[elm].y;
          document.body.insertAdjacentHTML('beforeend', htmlx);
          span.setAttribute('onclick', "renderOverlay(" + elm + ")");
          viewer.addOverlay(div, pointPosition, OpenSeadragon.Placement.CENTER);
          console.log(div + ' ' + pointPosition);
        }
      }
    }
  };

  xhr.open("get", 'api/retrive/' + currentMap, true);
  xhr.setRequestHeader('Accept', 'application/json');
  xhr.send();
}

function deleteOverlay(id) {
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      removeElem = document.getElementById(id); // removeElem.style="display:none"

      removeElem.remove();
    }
  };

  xhr.open("DELETE", 'api/delete/' + id, true);
  xhr.send();
}

function puls() {
  $(".pulsate").jPulse({
    color: "#FF1414",
    size: 150,
    speed: 600,
    interval: 2000,
    left: 0,
    top: 0,
    zIndex: 1
  });
}

jQuery(document).ready(function () {
  function populateMaps() {
    var xhr = new XMLHttpRequest();
    ul = document.getElementById('mapsList');

    xhr.onreadystatechange = function () {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        var data = JSON.parse(xhr.responseText);
        data.forEach(function (array) {
          li = document.createElement('li');
          li.id = "map" + array.id;
          li.innerHTML += '<a class="dropdown-item" href="#">' + array.name + '</a>';
          li.onclick = loadMap(array.path, array.id);
          ul.appendChild(li);
        });
      }
    };

    xhr.open("get", 'api/retrive/maps', true);
    xhr.setRequestHeader('Accept', 'application/json');
    xhr.send();
  }

  var loadMap = function loadMap(imgUrl, mapId) {
    return function () {
      loader = document.createElement('div');
      loader.classList.add('spinner');
      img = document.createElement('img');
      img.src = "loader.gif";
      img.width = 150;
      img.height = 150;
      loader.appendChild(img);
      document.body.appendChild(loader);
      loaded = false;
      viewer.clearOverlays();
      viewer.close();
      viewer.open({
        type: 'image',
        url: imgUrl
      });
      viewer.world.addOnceHandler('add-item', function () {
        sessionStorage.setItem('currentMap', mapId);
        draw();
        loader.remove();
        setTimeout(puls, 3000);
      });
    };
  };

  populateMaps();
});

/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) var result = runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;