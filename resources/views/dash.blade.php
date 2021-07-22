<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
<style>
    .icon:active {
        color:Red;
        
    }
    .icon:hover {
        color:tomato;

        padding-bottom:3px;
    }
    .icon {filter:drop-shadow(1px 1px 1px rgb(10, 10, 10));background-color:transparent;}
    #profile {

            filter:drop-shadow(3px 3px 3px rgb(10, 10, 10));
    }
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

                margin-right: 0px;
                margin-bottom: 0px;
                z-index: 0;


                

        }
    .customSym:hover  {
        font-size:38px;
        color:purple;
        filter:drop-shadow(1px 1px 1px rgb(10, 10, 10));
    } 
      
    .customSym  {
        filter:drop-shadow(1px 1px 1px rgb(10, 10, 10));
    } 
  
    .customCircle:hover { 
    
    filter:drop-shadow(1px 1px 1px rgb(10, 10, 10));
    height:35px;
    width: 35px;
    padding: 5px;
    text-align: center; 
    border-radius: 50%;
    display: inline-block;
    color:rgb(0, 0, 0);
    font-size:1.1em;
    font-weight:600;
    background-color: rgba(240, 124, 124, 0.1);
    border: 2.5px solid rgb(119, 0, 255);;
}

    .modal-content {
        width:auto;
        height: auto;

    }
    #noteField {
        padding: 20px;
    }

    #copyright   {
        margin:5px;
        position: absolute;
        background-color: transparent;
        z-index: 100;
    }
    #sidebar {

        height: 100vh;
    }
    .customCircle { 
    filter:drop-shadow(1px 1px 1px rgb(10, 10, 10));
    height:30px;
    width: 30px;
    padding: 5px;
    text-align: center; 
    border-radius: 50%;
    display: inline-block;
    color:rgb(0, 0, 0);
    font-size:1.1em;
    font-weight:600;
    background-color: rgba(240, 124, 124, 0.1);
    border: 3px solid rgb(255, 0, 0);;
}



</style>
<script>

    sessionStorage.setItem('sym', 'customCircle');
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
        <button type="button" data-bs-dismiss="modal" onclick="sendForm(sessionStorage.getItem('symbol'),sessionStorage.getItem('color'))" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
    <div style="max-height: 100vh;"class="row">
        <!--OPENSEADRAGON MAP FIELD MAP DIV-->
        <div class="col-md-12 " id="openseadragon">
            <div id="copyright" class="row">
                <p class="col-md-6 text-muted text-center justify-content-end">© OrderAid 2021</p>
                <p class="col-md-6 text-muted text-center justify-content-start">© OrderAid 2021</p>            
            </div>
        </div>
        <!--OPENSEADRAGON MAP FIELD MAP DIV-->
        <footer  style="width:fit-content;" class="row position-absolute bottom-0">

                            <!--PROFILE-->
                            <div style="width:fit-content;" id="dropdown" class="col-sm-auto mx-0 dropdown ">
                        <a href="#" style="width:fit-content;" class="d-flex align-items-center text-white text-decoration-none " id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img id="profile" src="https://github.com/mdo.png" alt="" width="40" height="40" class="rounded-circle me-2">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow mb-2" aria-labelledby="dropdownUser1">
                            <li><a onclick='$("#dataSend").modal("show");' class="dropdown-item" href="#">New project...</a></li>
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
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a  class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                <!--MAPS-->    
                <!--SYMBOLE-->
                    <div style="width:fit-content;" id="dropdown" class="col-sm-auto mt-2 dropdown ">
                        <span data-bs-toggle="dropdown" style="color:grey" class="pt-3 icons" aria-expanded="false">
                        <i style='font-size:26px' class="fas fa-times icon fa-2x"></i>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-dark  text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a onclick='sessionStorage.setItem("symbol", "fas  fa-times fa-2x")' class="dropdown-item" href="#"><i style='color:tomato;font-size:22px' class="fas  fa-times m-2 mr-3"></i>Cross</a></li>
                            <li><a onclick='sessionStorage.setItem("symbol","customCircle")' class="dropdown-item" href="#"><i style='color:tomato' class="far   fa-circle m-2"></i>Circle</a></li>
                            <li><a onclick='sessionStorage.setItem("symbol","fas fa-crosshairs fa-2x")' class="dropdown-item" href="#"><i style='color:tomato' class="fas fa-crosshairs m-2"></i>Crosshair</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li ><a class="dropdown-item m-1 rounded rounded-cricle" href="#"><input type="color" onchange="sessionStorage.setItem('color', this.value)" name="symcolor"> Color</a></li>
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
        defaultZoomLevel : 1,
        showNavigationControl: false,
        id: "openseadragon",
        degree : -90,
        showRotationControl: true,
        gestureSettingsTouch: {
        pinchRotate: true
        },
        prefixUrl: "/files_0001",
        tileSources: "/0001.dzi",
    });



    var  point = new OpenSeadragon.Point()

	var clickHandler = (event) => {
        console.log(event)
    var webPoint = event.position;
    var viewportPoint = viewer.viewport.pointFromPixel(webPoint);
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
        form.append('image', file);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) { 
                draw()
            }}
        xhr.open("POST", 'http://127.0.0.1:8000/api/save', true);

        xhr.send(form);
        
    }


new OpenSeadragon.MouseTracker({
    element : viewer.canvas,

    clickHandler : clickHandler,
})

function draw() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                var data = JSON.parse(xhr.responseText);
                    for (elm in data) {
                        var  pointPosition =  new OpenSeadragon.Point()
                        div = document.createElement('div')
                        div.id = data[elm].id
                        document.body.appendChild(div)
                        span = document.createElement('span')
                        span.setAttribute('style', 'color:'+data[elm].color)
                            if(data[elm].symbo == 'customCircle'){
                            span.innerHTML= '<i id="pin" class="'+data[elm].symbol+'" ></i>'
                            } else {
                                span.innerHTML= '<i class="'+data[elm].symbol+' customSym" ></i>'
                            }
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
                        var overlay = viewer.addOverlay(div, pointPosition, OpenSeadragon.Placement.CENTER);
                    }
            }
        }

    xhr.open("get", 'http://127.0.0.1:8000/api/retrive', true); 
    xhr.setRequestHeader('Accept', 'application/json'); 
    xhr.send();

}
$( document ).ready(function() {
    draw()
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
        
        xhr.open("DELETE", 'http://127.0.0.1:8000/api/delete/'+id, true);
        xhr.send();
}

</script>

</body>
