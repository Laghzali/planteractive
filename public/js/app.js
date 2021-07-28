/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

var clicked = false;
var loading = new Event('loading');
var notloading = new Event('notloading');
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
    if (clicked === true) {
      name = sessionStorage.getItem('name');
      image = sessionStorage.getItem('image');
      note = sessionStorage.getItem('note');
      color = sessionStorage.getItem('over_color');
      symbol = sessionStorage.getItem('over_symbol');
      map_id = sessionStorage.getItem('map_id');
      form = new FormData();
      form.append('note', note);
      form.append('name', name);
      form.append('symbol', symbol);
      form.append('color', color);
      form.append('x', point.x);
      form.append('y', point.y);
      form.append('map_id', map_id);
      form.append('image', image);
      var xhr = new XMLHttpRequest();

      xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
          clicked = false;
          draw();
        }
      };

      xhr.open("POST", 'api/save/existing', true);
      xhr.send(form);
    } else {
      $('#dataSend').modal('show');
    }
  }
};

sendForm = function sendForm(sym, color) {
  document.dispatchEvent(loading);
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
      document.dispatchEvent(notloading);
      draw();
    }
  };

  xhr.open("POST", 'api/save', true);
  xhr.send(form);
};

uploadPdf = function uploadPdf() {
  document.dispatchEvent(loading);
  var image = document.getElementById('map_pdf');
  var file = image.files[0];
  name = document.getElementById('map_name').value;
  form = new FormData();
  form.append('map_name', name);
  form.append('map_pdf', file);
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      document.dispatchEvent(notloading);
      drawLatest();
    }
  };

  xhr.open("POST", 'api/new/map', true);
  xhr.send(form);
};

new OpenSeadragon.MouseTracker({
  element: viewer.canvas,
  clickHandler: clickHandler
});

window.draw = function () {
  viewer.clearOverlays();
  var xhr = new XMLHttpRequest();
  var currentMap = sessionStorage.getItem('currentMap');
  sideOverlays = document.getElementById('sideOverlays');
  sideOverlays.innerHTML = null;

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      var data = JSON.parse(xhr.responseText);

      for (elm in data) {
        if (sessionStorage.getItem('currentMap') === data[elm].map_overlay_id) {
          var pointPosition = new OpenSeadragon.Point();
          div = document.createElement('div');
          div.id = data[elm].overlay_id;
          document.body.appendChild(div);
          span = document.createElement('span');
          span.setAttribute('style', 'z-index:12;color:' + data[elm].color + '');
          span.innerHTML = '<i class="' + data[elm].symbol + ' customSym"><i class=" dot pulsate"></i></i>';
          span.setAttribute('id', 'renderer' + data[elm].overlay_id);
          div.appendChild(span);
          htmlx = "<div id='parentModal" + data[elm].overlay_id + "' class='modal fade' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
          htmlx += "  <div class='modal-dialog'>";
          htmlx += "   <div class='modal-content'>";
          htmlx += "     <div class='modal-header'>";
          htmlx += "      <h4 id='nameField' class='modal-title nameField'>" + data[elm].name + "</h4> ";
          htmlx += "       <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
          htmlx += "      </div>";
          htmlx += "     <div  class='modal-body'><img src=" + data[elm].image + "  style='max-width: 100%; max-height: 100%' id='imageField' class='img-responsive'> <p class='col-md-12' id='noteField'>" + data[elm].note + "</p> </div>";
          htmlx += "     <div class='modal-footer'>";
          htmlx += "  <button type='button' class='btn btn-danger' onclick='deleteOverlay(" + data[elm].overlay_id + ")' data-bs-dismiss='modal'>Delete</button>";
          htmlx += "   </div></div> </div></div>";
          pointPosition.x = data[elm].x;
          pointPosition.y = data[elm].y;
          document.body.insertAdjacentHTML('beforeend', htmlx);
          viewer.addOverlay(div, pointPosition, OpenSeadragon.Placement.CENTER);
          span.setAttribute('onclick', "renderOverlay(" + data[elm].overlay_id + ")"); //FILLING RIGHT SIDE OVERLAYS

          a = document.createElement('a');
          a.id = "sideOver" + elm;
          div = document.createElement('div');
          a.setAttribute('class', 'list-group-item list-group-item-action ');
          a.setAttribute('aria-current', 'true');
          a.setAttribute('onclick', 'sideOverClicked(' + a.id + ',"' + data[elm].name + '","' + data[elm].image + '","' + data[elm].note + '","' + data[elm].color + '","' + data[elm].symbol + '","' + data[elm].map_overlay_id + '")');
          div.setAttribute('class', 'd-flex w-100 justify-content-between');
          div.innerHTML = '<h5 class="mb-1">' + data[elm].name + '</h5>';
          div.innerHTML += '<small><i style="color:' + data[elm].color + '" onclick="renderOverlay(' + data[elm].overlay_id + ')" class="' + data[elm].symbol + '  customSym"></small>';
          a.appendChild(div);
          a.innerHTML += '<p class="mb-1">' + data[elm].note + '</p>';
          a.innerHTML += '<small>And some small print.</small>';
          sideOverlays.appendChild(a);
        }
      }

      puls();
    }
  };

  xhr.open("get", 'api/retrive/' + currentMap, true);
  xhr.setRequestHeader('Accept', 'application/json');
  xhr.send();
};

seekAndDestroy = function seekAndDestroy() {
  searchField = document.getElementById('search');
  var xhr = new XMLHttpRequest();
  sideOverlays = document.getElementById('sideOverlays');

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      $(searchField).on('input', function () {
        sideOverlays.innerHTML = null;
        var data = JSON.parse(xhr.responseText);
        value = searchField.value;
        var searchTerm = new RegExp(value);
        data.forEach(function (array) {
          found = array.name.match(searchTerm);

          if (found && searchTerm != '/(?:)/') {
            name = array.name;
            color = array.color;
            symbol = array.symbol;
            note = array.note; //FILLING RIGHT SIDE OVERLAYS

            a = document.createElement('a');
            a.id = "sideOver" + array.overlay_id;
            div = document.createElement('div');
            a.setAttribute('class', 'list-group-item list-group-item-action ');
            a.setAttribute('aria-current', 'true');
            a.setAttribute('onclick', 'sideOverClicked(sideOver' + array.overlay_id + ',"' + array.name + '","' + array.image + '","' + array.note + '","' + array.color + '","' + array.symbol + '","' + array.map_overlay_id + '")');
            div.setAttribute('class', 'd-flex w-100 justify-content-between');
            div.innerHTML = '<h5 class="mb-1">' + name + '</h5>';
            div.innerHTML += '<small><i onclick="renderOverlay(' + array.overlay_id + ')" style="color:' + color + '" class="' + symbol + ' customSym" ></small>';
            a.appendChild(div);
            a.innerHTML += '<p class="mb-1">' + note + '</p>';
            a.innerHTML += '<small>And some small print.</small>';
            sideOverlays.appendChild(a);
          }
        });
      });
    }
  };

  xhr.open("get", 'api/retrive/' + sessionStorage.getItem('currentMap'), true);
  xhr.send();
};

renderOverlay = function renderOverlay(id) {
  $('#parentModal' + id).modal('show');
};

deleteOverlay = function deleteOverlay(id) {
  removeElem = document.getElementById(id);
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      removeElem.style = "display:none";
      removeElem.remove();
    }
  };

  xhr.open("DELETE", 'api/delete/' + id, true);
  xhr.send();
};

puls = function puls() {
  $(".pulsate").jPulse({
    color: "#FF1414",
    size: 150,
    speed: 600,
    interval: 2000,
    left: 0,
    top: 0,
    zIndex: 1
  });
};

jQuery(document).ready(function () {
  document.addEventListener('loading', function (e) {
    loader = document.createElement('div');
    loader.classList.add('spinner');
    loader.id = "timewaster";
    img = document.createElement('img');
    img.src = "loader.gif";
    img.width = 150;
    img.height = 150;
    loader.appendChild(img);
    document.body.appendChild(loader);
  }, false);
  document.addEventListener('notloading', function (e) {
    document.getElementById('timewaster').remove();
  }, false);

  populateMaps = function populateMaps() {
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
  };

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
      });
    };
  };

  populateMaps();
});

sideOverClicked = function sideOverClicked(id, name, image, note, color, symbol, map_id) {
  sessionStorage.setItem('name', name);
  sessionStorage.setItem('image', image);
  sessionStorage.setItem('note', note);
  sessionStorage.setItem('over_color', color);
  sessionStorage.setItem('over_symbol', symbol);
  sessionStorage.setItem('map_id', map_id); //sessionStorage.setItem('clicked' , true)

  if (clicked === false) {
    clicked = true;
    $(id).addClass("active");
  } else {
    $(id + '.active').removeClass("active");
    clicked = false;
  }
};

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