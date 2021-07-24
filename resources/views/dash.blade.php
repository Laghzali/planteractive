<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
<script type="text/javascript" src="jQuery.jPulse.min.js"></script>
<style>
    input[type="color"] {

	width: 32px;
	height: 32px;
}

    .profile {
      
        
    }
    .controls  {

        color:grey;
    } 
    .controls:hover  {
    font-size:30px;
    color:tomato;
    } 

    #controls {
        
    }
    .icon:active {
        color:Red;
        
    }
    .icon:hover {
        color:tomato;


    }
    .icon {filter:drop-shadow(1px 1px 1px rgb(10, 10, 10));background-color:transparent;}

    #dropdown{
        
            background:transparent;
            margin:0px;
            margin-bottom:15px;
            padding-right:0px;
            padding-left:15px;
            

    }

        #openseadragon {

                height: 100vh;
                position: relative;
                padding: 0px;
                z-index: auto;
                margin-right: 0px;
                margin-bottom: 0px;
                


                

        }

    .customSym:hover  {
        z-index: 100;
        cursor:pointer;
        font-size:43px;
        filter:drop-shadow(1px 1px 1px rgb(10, 10, 10));
    }     
    .customSym  {
        z-index: 100;
        filter:drop-shadow(1px 1px 1px rgb(10, 10, 10));
    } 


    .modal-content {
        width:auto;
        height: auto;

    }
    #noteField {
        padding: 20px;
    }

    #copyright   {
        z-index: 1;
        margin:5px;
        position: absolute;
        background-color: transparent;
        
    }
    #sidebar {

        height: 100vh;
    }


</style>
<script>

    sessionStorage.setItem('sym', 'far fa-circle fa-3x');
    sessionStorage.setItem('color', 'tomato');
</script>
</head>
<body id="body">

<!-- Modal -->
<div class="modal fade" id="dataSend" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Point</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" id="formData" action="/api/save" enctype="multipart/form-data"></form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="">
                <input type="text" hidden id="x">
                <input type="text" hidden id="y">
              </div>

              <div class="form-group">
                <label for="image">Upload Image</label>
                <input class="form-control" type="file"  id="image">
              </div>

            <div class="form-group">
                <label for="note">Note</label>
                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" data-bs-dismiss="modal" onclick="sendForm(sessionStorage.getItem('sym'),sessionStorage.getItem('color'))" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- UPLOAD PDF -->
<div class="modal fade" id="uploadPdf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Map</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post"  action="/api/save" enctype="multipart/form-data"></form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="map_name" placeholder="">
                <input type="text" hidden id="x">
                <input type="text" hidden id="y">
              </div>

              <div class="form-group">
                <label for="image">Upload PDF</label>
                <input class="form-control" type="file"  id="map_pdf">
              </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" data-bs-dismiss="modal" onclick="uploadPdf()" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- UPLOAD PDF -->

<div class="container-fluid">
    <div style="max-height: 100vh;"class="row ">
        <!--COPYRIGHTV-->
        <div class="col-md-12 " id="openseadragon">
            <div id="copyright" class="row">
                <p class="col-md-6 text-muted text-center justify-content-end">© OrderAid 2021</p>
                <p class="col-md-6 text-muted text-center justify-content-start">© OrderAid 2021</p>            
            </div>
        </div>
        <!--COPY RIGHT-->
        <!--CONTROLS-->
        <div id="controls" style="width:43px;height:200px;margin-bottom:10px;padding-left:10px" class="row m-2 position-absolute bottom-0 rounded-pill">
                    <div id="home" class="col-sm-auto pt-2"><i style="font-size:25px" class="row  fas fa-search icon controls"></i></div>
                    <div id="zoom-in" class="col-sm-auto"><i style="font-size:25px;" class="row  fas fa-search-plus icon controls"> </i></div>
                    <div id="zoom-out" class="col-sm-auto  mb-5 "><i style="font-size:25px;" class="row  fas fa-search-minus icon controls"> </i></div> 
                    
                    </div>
        <!--CONTROLS-->            
        <footer  style="width:200px;height:40;margin-bottom: 10px;margin-left: 10px;padding-left:0" class=" profile row position-absolute bottom-0 rounded-pill">

                        <!--PROFILE-->
                        <div style="width:fit-content;padding:0" id="dropdown" class="col-sm-auto mx-0 dropdown ">
                            <a href="#" style="width:fit-content;" class="d-flex align-items-center text-white text-decoration-none " id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img id="profile" src="https://img.icons8.com/ios-filled/50/000000/job.png" alt="" width="40" height="40" class="rounded-circle me-2">

                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow mb-2" aria-labelledby="dropdownUser1">
                                <li><a onclick='$("#uploadPdf").modal("show");' class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Embed</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </div>
                        <!--PROFILE-->
                <!--MAPS-->
                <div style="width:fit-content;" id="dropdown" class="col-sm-auto mt-2 dropdown ">
                        <span data-bs-toggle="dropdown" style="color:grey" class="pt-3 icons" aria-expanded="false">
                        <i style='font-size:22px' class=" far fa-clone fa-2x icon"></i>
                        
                        </span>
                        <ul id="mapsList" class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">

                        </ul>
                    </div>
                <!--MAPS-->    
                <!--SYMBOLE-->
                    <div style="width:fit-content;" id="dropdown" class="col-sm-auto mt-2 dropdown ">
                        <span data-bs-toggle="dropdown" style="color:grey" class="pt-3 icons" aria-expanded="false">
                        <i style='font-size:26px' class="fas fa-times icon fa-2x"></i>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-dark  text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a onclick='sessionStorage.setItem("sym", "fas  fa-times fa-3x")' class="dropdown-item" href="#"><i style='color:tomato;font-size:22px' class="fas  fa-times m-2 mr-3"></i>Cross</a></li>
                            <li><a onclick='sessionStorage.setItem("sym","far fa-circle fa-3x")' class="dropdown-item" href="#"><i style='color:tomato' class="far   fa-circle m-2"></i>Circle</a></li>
                            <li><a onclick='sessionStorage.setItem("sym","fas fa-crosshairs fa-3x")' class="dropdown-item" href="#"><i style='color:tomato' class="fas fa-crosshairs m-2"></i>Crosshair</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li ><a class="dropdown-item m-1 rounded rounded-cricle" href="#"><input type="color" onchange="sessionStorage.setItem('color', this.value)" name="symcolor"> <span class='mb-4' >Color</span></a></li>
                        </ul>
                    </div>
                <!--SYMBOLE--> 
              
        </footer>

    </div>
</div>
<script src="openseadragon.min.js"></script>
<script type="text/javascript">
    var viewer = OpenSeadragon({
        visibilityRatio: 1.0,
        constrainDuringPan: true,
        gestureSettingsMouse : {
            clickToZoom: false,
            dblClickToZoom: true

        },
        defaultZoomLevel : 1,
        zoomInButton:   "zoom-in",
        rotateLeftButton : "rotate-left",
        rotateRightButton : "rotate-right",
        zoomOutButton:   "zoom-out",
        homeButton:   "home",
        timeout: 100000, 
        showNavigationControl: true,
        imageLoaderLimit: 1,
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
    function loadMap(url) {
        viewer.addTiledImage({
            tileSource: url,
        });
    }
    function unloadMap() {
        viewer.addTiledImage({
            tileSource: url,
        });
    }
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
        form.append('image', file);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) { 
                drawLatest();
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

function drawLatest(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                var data = JSON.parse(xhr.responseText);
                        var  pointPosition =  new OpenSeadragon.Point()
                        div = document.createElement('div')

                        div.id = data.id
                        document.body.appendChild(div)
                        span = document.createElement('span')
                        span.setAttribute('style', 'color:'+data.color)
                        span.innerHTML= '<i class="'+data.symbol+' pulsate customSym" ></i>'
                        span.setAttribute('id','renderer')
                        div.appendChild(span)
                        htmlx = "<div id='parentModal"+data.id+"' class='modal fade' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>"
                        htmlx += "  <div class='modal-dialog'>"
                        htmlx += "   <div class='modal-content'>"
                        htmlx += "     <div class='modal-header'>"
                        htmlx += "       <h4 id='nameField' class='modal-title nameField'>"+data.name+"</h4> "
                        htmlx += "       <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>"
                        htmlx += "      </div>"
                        htmlx += "     <div  class='modal-body'><img src="+data.image+"  style='max-width: 100%; max-height: 100%' id='imageField' class='img-responsive'> <p class='col-md-12' id='noteField'>"+data.note+ "</p> </div>"
                        htmlx += "     <div class='modal-footer'>"
                        htmlx += "  <button type='button' class='btn btn-danger' onclick='deleteOverlay("+data.id+")' data-bs-dismiss='modal'>Delete</button>"
                        htmlx += "   </div></div> </div></div>"
                        pointPosition.x = data.x 
                        pointPosition.y = data.y
                        document.body.insertAdjacentHTML('beforeend', htmlx)
                        span.setAttribute('onclick', "renderOverlay("+data.id+")")
                        viewer.addOverlay(div, pointPosition, OpenSeadragon.Placement.CENTER)
                    

            }
        }

    xhr.open("get", 'api/retrive/last', true); 
    xhr.setRequestHeader('Accept', 'application/json'); 
    xhr.send();

}


function draw() {
    viewer.clearOverlays()
    overlays = []
    positions = []
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                var data = JSON.parse(xhr.responseText);
                        console.log(data)
                    for (elm in data) {
                        console.log(elm)
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
                        overlays.push(div)
                        positions.push(pointPosition)
                    }

            }

            overlays.forEach((element , index) =>{
                viewer.addOverlay(element, positions[index], OpenSeadragon.Placement.CENTER)
            })
        }

    xhr.open("get", 'api/retrive', true); 
    xhr.setRequestHeader('Accept', 'application/json'); 
    xhr.send();

}
jQuery( document ).ready(function() {
        draw()
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
        setTimeout(puls, 1000);

        function populateMaps() {
            var xhr = new XMLHttpRequest();
            ul = document.getElementById('mapsList')
            xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        var data = JSON.parse(xhr.responseText);
                        for(elm in data){
                           
                            ul.innerHTML += '<li><a  class="dropdown-item" href="#">'+data[elm].name+'</a></li>'
                        }
                    }
                }
            xhr.open("get", 'api/retrive/maps', true); 
            xhr.setRequestHeader('Accept', 'application/json'); 
            xhr.send();

        }
        populateMaps()

});

function renderOverlay(id){
    $('#parentModal'+id).modal('show');
    console.log(id)
    

}

function deleteOverlay(id) {
    var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) { 
                removeElem = document.getElementById(id)
                removeElem.style="display:none"
                
                
            }}
        
        xhr.open("DELETE", 'api/delete/'+id, true);
        xhr.send();
}

</script>



</body>
