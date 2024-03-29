<html>
  @include('head')

<body id="body">
  @include('modals')

<div class="container-fluid">
    <div style="max-height: 100vh;" id="row-main" class="row">
      <div class="col-md-10" id="openseadragon">
        <!--COPYRIGHTV-->
        <div id="copyright" class="row">
            <p class="col-md-6 text-muted text-center justify-content-end">© OrderAid 2021</p>
            <p class="col-md-6 text-muted text-center justify-content-start">plan@orderaid.com.au</p>
        </div>
        <button class="btn button-default bottom-0 right-0 zIndex:10 icon" id="showContactButton"><i style="position:relative;right: 5px;" class="fas fa-paper-plane fa-2x"></i></button>
        <div id="sideToggle" class="right-0">
          <i class="arrow right" id="arrow"></i>
        </div> 
          <!--COPY RIGHT-->
      </div>
        <div class="col-md-2 shadow-lg  " id="sidebar">
              <div id="header" class="col-md-12 ">

                  <img class="mt-10" width=200 height=160 src='logo.png'>
                </div>
                <div class="input-group mb-3">
                  
                  <select id="searchFilter" style="max-width:20%" class="custom-select form-control">
                    <option value="name" selected>Name</option>
                    <option value="note">Note</option>
                    <option value="tag">Tag</option>
                  </select>
                 
                  <input type="search" id="searchInput" class="form-control" placeholder="What are you looking for?" />
                      <span id="clearSearch" class="input-group-btn">
                        <button onclick="draw()" class="btn btn-default" type="submit">
                            <i class="fas fa-sync"></i>
                        </button>
                    </span>
                </div>

                <hr>
                  <div  id="sideOverlays" class="list-group mt-2 ">

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
                    <li><a id='showUploadForm' class="dropdown-item" href="#">New Map.</a></li>
                    <li><a class="dropdown-item" href="#">Embed</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
          </div>
          <div style="width:fit-content;" id="dropdown" class="col-sm-auto mt-2 dropdown ">
                <span data-bs-toggle="dropdown" style="color:#002180" class="pt-3 icons" aria-expanded="false">
                <i style='font-size:22px' class=" far fa-clone fa-2x icon"></i>     
                </span>
                <ul id="mapsList" class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                </ul>
          </div>
                <!--MAPS-->    
                <!--SYMBOLE-->
                    <div style="width:fit-content;" id="dropdown" class="col-sm-auto mt-2 dropdown ">
                        <span data-bs-toggle="dropdown" style="color:#002180" class="pt-3 icons" aria-expanded="false">
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
