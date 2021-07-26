

    var viewer = OpenSeadragon({
      visibilityRatio: 1.0,
      constrainDuringPan: true,
      gestureSettingsMouse : {
          clickToZoom: false,
          dblClickToZoom: true

      },
      defaultZoomLevel : 1,
      zoomInButton:   "zoom-in",

      zoomOutButton:   "zoom-out",
      homeButton:   "home",
      timeout: 100000, 
      showNavigationControl: true,
      id: "openseadragon",

  });



  var  point = new OpenSeadragon.Point()

var clickHandler = (event) => {
      console.log(event)
  var webPoint = event.position;
  var viewportPoint = viewer.viewport.windowToViewportCoordinates(webPoint);
  var element = "overlay";
  var element_position = viewportPoint;  
      point.x = element_position.x
      point.y = element_position.y

  if (event.shift) {
      $('#dataSend').modal('show');
      //viewer.addOverlay(element, point, OpenSeadragon.Placement.CENTER);
  }
};

  function sendForm(sym, color) {
      var image = document.getElementById('image');
      var file = image.files[0];
      note =  document.getElementById('note').value
      name =  document.getElementById('name').value 
      form = new FormData()
      form.append('note', note)
      form.append('name', name)
      form.append('symbol', sym)
      form.append('color', color)
      form.append('x', point.x)
      form.append('y', point.y)
      form.append('map_id', sessionStorage.getItem('currentMap'))
      form.append('image', file);
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
          if (xhr.readyState == XMLHttpRequest.DONE) { 
              draw();
          }}
      xhr.open("POST", 'api/save', true);

      xhr.send(form);
      
  }


  function uploadPdf() {
      var image = document.getElementById('map_pdf');
      var file = image.files[0];
      name =  document.getElementById('map_name').value 
      form = new FormData()
      form.append('map_name', name)
      form.append('map_pdf', file);
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
          if (xhr.readyState == XMLHttpRequest.DONE) { 
              drawLatest()
              
          }}
      xhr.open("POST", 'api/new/map', true);
      xhr.send(form);
      
  }


new OpenSeadragon.MouseTracker({
  element : viewer.canvas,

  clickHandler : clickHandler,
})


function draw() {
  viewer.clearOverlays()
  var xhr = new XMLHttpRequest();
  var currentMap = sessionStorage.getItem('currentMap')
  xhr.onreadystatechange = function() {
          if (xhr.readyState == XMLHttpRequest.DONE) {
              var data = JSON.parse(xhr.responseText);
                     
                  for (elm in data) {

                  console.log('drawing .. map_over_id : ' + data[elm].map_overlay_id)
                  if(sessionStorage.getItem('currentMap') === data[elm].map_overlay_id) {
                      var  pointPosition =  new OpenSeadragon.Point()
                      div = document.createElement('div')
                      div.id = data[elm].id
                      document.body.appendChild(div)
                      span = document.createElement('span')
                      span.setAttribute('style', 'color:'+data[elm].color)
                      span.innerHTML= '<i class="'+data[elm].symbol+' pulsate customSym" ></i>'
                      span.setAttribute('id','renderer'+elm)
                      div.appendChild(span)
                      htmlx = "<div id='parentModal"+elm+"' class='modal fade' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>"
                      htmlx += "  <div class='modal-dialog'>"
                      htmlx += "   <div class='modal-content'>"
                      htmlx += "     <div class='modal-header'>"
                      htmlx += "       <h4 id='nameField' class='modal-title nameField'>"+data[elm].name+"</h4> "
                      htmlx += "       <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>"
                      htmlx += "      </div>"
                      htmlx += "     <div  class='modal-body'><img src="+data[elm].image+"  style='max-width: 100%; max-height: 100%' id='imageField' class='img-responsive'> <p class='col-md-12' id='noteField'>"+data[elm].note+ "</p> </div>"
                      htmlx += "     <div class='modal-footer'>"
                      htmlx += "  <button type='button' class='btn btn-danger' onclick='deleteOverlay("+data[elm].id+")' data-bs-dismiss='modal'>Delete</button>"
                      htmlx += "   </div></div> </div></div>"
                      pointPosition.x = data[elm].x 
                      pointPosition.y = data[elm].y
                      document.body.insertAdjacentHTML('beforeend', htmlx)
                      span.setAttribute('onclick', "renderOverlay("+elm+")")
                      viewer.addOverlay(div, pointPosition, OpenSeadragon.Placement.CENTER)
                      console.log(div + ' ' + pointPosition )
                  }
                  }


          }

      }


  xhr.open("get", 'api/retrive/'+ currentMap , true); 
  xhr.setRequestHeader('Accept', 'application/json'); 
  xhr.send();

}
function renderOverlay(id){
  $('#parentModal'+id).modal('show');
  console.log(id)
}

function deleteOverlay(id) {
  var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
          if (xhr.readyState == XMLHttpRequest.DONE) { 
              removeElem = document.getElementById(id)
              // removeElem.style="display:none"
              removeElem.remove()
              
              
          }}
      
      xhr.open("DELETE", 'api/delete/'+id, true);
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
          zIndex:1

          
  });
      }

jQuery( document ).ready(function() {

      function populateMaps() {
          var xhr = new XMLHttpRequest();
          ul = document.getElementById('mapsList')
          xhr.onreadystatechange = function() {
                  if (xhr.readyState == XMLHttpRequest.DONE) {
                      var data = JSON.parse(xhr.responseText);
                      data.forEach(array =>{
                          li = document.createElement('li')
                          li.id = "map"+array.id
                          li.innerHTML += '<a class="dropdown-item" href="#">'+array.name+'</a>'
                          li.onclick = loadMap(array.path, array.id)
                          ul.appendChild(li)
                          
                      })
                  }
              }
          xhr.open("get", 'api/retrive/maps', true); 
          xhr.setRequestHeader('Accept', 'application/json'); 
          xhr.send();

      }


      var loadMap = function(imgUrl, mapId) {
      return function() { 
          loader = document.createElement('div')
          loader.classList.add('spinner')
          img = document.createElement('img')
          img.src = "loader.gif"
          img.width=150;
          img.height=150;
          loader.appendChild(img)
          document.body.appendChild(loader)
          
          loaded = false
          viewer.clearOverlays()
          viewer.close()
          viewer.open({
              type : 'image',
              url : imgUrl,
          });

          viewer.world.addOnceHandler('add-item', function (){
                  sessionStorage.setItem('currentMap', mapId);
                  draw()
                  loader.remove()
                  setTimeout(puls, 3000)
          });
       };
      }

populateMaps()
});