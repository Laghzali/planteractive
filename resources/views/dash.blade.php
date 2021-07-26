<html>
  @include('head')

<body id="body">
  @include('modals')

<div class="container-fluid">
    <div style="max-height: 100vh;" id="row-main" class="row">
      <div class="col-md-9" id="openseadragon">
        <!--COPYRIGHTV-->
        <div id="copyright" class="row">
            <p class="col-md-6 text-muted text-center justify-content-end">© OrderAid 2021</p>
            <p class="col-md-6 text-muted text-center justify-content-start">© OrderAid 2021</p>    
        </div>
        <div id="sideToggle" class="right-0">
          <i class="arrow right" id="arrow" 
            onclick='$("#sidebar").toggleClass("collapsed");$("#arrow").toggleClass("left right");$("#openseadragon").toggleClass("col-md-12 col-md-9");'></i>
        </div> 
          <!--COPY RIGHT-->
      </div>
        <div class="col-md-3 shadow-lg  " id="sidebar">
              <div id="header" class="col-md-12 ">

                  <di class="text-center "><img class="mt-10 shadow rounded" width=200 height=160 src='logo.png'></div>
                   <input type="search" id="address" class="form-control" placeholder="What are you looking for?" />
                  <div class="list-group mt-2">
                      <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">Overlay Name</h5>
                          <small>3 days ago</small>
                        </div>
                        <p class="mb-1">Overlay Note</p>
                        <small>And some small print.</small>
                      </a>
                      <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">Overlay Name</h5>
                          <small class="text-muted">3 days ago</small>
                        </div>
                        <p class="mb-1">Overlay Note</p>
                        <small class="text-muted">And some muted small print.</small>
                      </a>

                    </div>
                </div>
              
      </div>

        <div id="controls" style="width:43px;height:200px;padding-left:10px" class="row m-2 position-absolute bottom-0 rounded-pill">
            <div id="home" class="col-sm-auto pt-2"><i style="font-size:25px" class="row  fas fa-search icon controls"></i></div>
            <div id="zoom-in" class="col-sm-auto"><i style="font-size:25px;" class="row  fas fa-search-plus icon controls"> </i></div>
            <div id="zoom-out" class="col-sm-auto  mb-5 "><i style="font-size:25px;" class="row  fas fa-search-minus icon controls"> </i></div>   
        </div>
        
        <footer  style="width:200px;height:40;margin-bottom: 10px;margin-left: 10px;padding-left:0" class=" profile row position-absolute bottom-0 rounded-pill">
          <div style="width:fit-content;padding:0" id="dropdown" class="col-sm-auto mx-0 dropdown ">
              <a href="#" style="width:fit-content;" class="d-flex align-items-center text-white text-decoration-none " id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
               <img id="profile" src="https://img.icons8.com/ios-filled/50/000000/job.png" alt="" width="40" height="40" class="rounded-circle me-2"> </a>
               <ul class="dropdown-menu dropdown-menu-dark text-small shadow mb-2" aria-labelledby="dropdownUser1">
                    <li><a onclick='$("#uploadPdf").modal("show");' class="dropdown-item" href="#">New Map.</a></li>
                    <li><a class="dropdown-item" href="#">Embed</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
          </div>
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
                            <li><a onclick='sessionStorage.setItem("sym", "fas  fa-times fa-2x")' class="dropdown-item" href="#"><i style='color:tomato;font-size:22px' class="fas  fa-times m-2 mr-3"></i>Cross</a></li>
                            <li><a onclick='sessionStorage.setItem("sym","far fa-circle fa-2x")' class="dropdown-item" href="#"><i style='color:tomato' class="far   fa-circle m-2"></i>Circle</a></li>
                            <li><a onclick='sessionStorage.setItem("sym","fas fa-crosshairs fa-2x")' class="dropdown-item" href="#"><i style='color:tomato' class="fas fa-crosshairs m-2"></i>Crosshair</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li ><a class="dropdown-item m-1 rounded rounded-cricle" href="#"><input type="color" onchange="sessionStorage.setItem('color', this.value)" name="symcolor"> <span class='mb-4' >Color</span></a></li>
                        </ul>
                    </div>
                <!--SYMBOLE--> 
              
        </footer>

    </div>
</div>
<script src="openseadragon.min.js"></script>
<script src= "js/app.js"></script>
</body>
