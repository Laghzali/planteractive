(()=>{var e,t={80:()=>{var e=OpenSeadragon({visibilityRatio:1,constrainDuringPan:!0,gestureSettingsMouse:{clickToZoom:!1,dblClickToZoom:!0},defaultZoomLevel:1,zoomInButton:"zoom-in",zoomOutButton:"zoom-out",homeButton:"home",timeout:1e5,showNavigationControl:!0,id:"openseadragon"}),t=new OpenSeadragon.Point;function a(){$(".pulsate").jPulse({color:"#FF1414",size:150,speed:600,interval:2e3,left:0,top:0,zIndex:1})}new OpenSeadragon.MouseTracker({element:e.canvas,clickHandler:function(a){console.log(a);var o=a.position,n=e.viewport.windowToViewportCoordinates(o);t.x=n.x,t.y=n.y,a.shift&&$("#dataSend").modal("show")}}),jQuery(document).ready((function(){var t,o=function(t,o){return function(){loader=document.createElement("div"),loader.classList.add("spinner"),img=document.createElement("img"),img.src="loader.gif",img.width=150,img.height=150,loader.appendChild(img),document.body.appendChild(loader),loaded=!1,e.clearOverlays(),e.close(),e.open({type:"image",url:t}),e.world.addOnceHandler("add-item",(function(){sessionStorage.setItem("currentMap",o),function(){e.clearOverlays();var t=new XMLHttpRequest,a=sessionStorage.getItem("currentMap");t.onreadystatechange=function(){if(t.readyState==XMLHttpRequest.DONE){var a=JSON.parse(t.responseText);for(elm in a)if(console.log("drawing .. map_over_id : "+a[elm].map_overlay_id),sessionStorage.getItem("currentMap")===a[elm].map_overlay_id){var o=new OpenSeadragon.Point;div=document.createElement("div"),div.id=a[elm].id,document.body.appendChild(div),span=document.createElement("span"),span.setAttribute("style","color:"+a[elm].color),span.innerHTML='<i class="'+a[elm].symbol+' pulsate customSym" ></i>',span.setAttribute("id","renderer"+elm),div.appendChild(span),htmlx="<div id='parentModal' class='modal fade' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>",htmlx+="  <div class='modal-dialog'>",htmlx+="   <div class='modal-content'>",htmlx+="     <div class='modal-header'>",htmlx+="       <h4 id='nameField' class='modal-title nameField'>"+a[elm].name+"</h4> ",htmlx+="       <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>",htmlx+="      </div>",htmlx+="     <div  class='modal-body'><img src="+a[elm].image+"  style='max-width: 100%; max-height: 100%' id='imageField' class='img-responsive'> <p class='col-md-12' id='noteField'>"+a[elm].note+"</p> </div>",htmlx+="     <div class='modal-footer'>",htmlx+="  <button type='button' class='btn btn-danger' onclick='deleteOverlay("+a[elm].id+")' data-bs-dismiss='modal'>Delete</button>",htmlx+="   </div></div> </div></div>",o.x=a[elm].x,o.y=a[elm].y,document.body.insertAdjacentHTML("beforeend",htmlx),span.setAttribute("onclick","renderOverlay("+elm+")"),e.addOverlay(div,o,OpenSeadragon.Placement.CENTER),console.log(div+" "+o)}}},t.open("get","api/retrive/"+a,!0),t.setRequestHeader("Accept","application/json"),t.send()}(),loader.remove(),setTimeout(a,3e3)}))}};t=new XMLHttpRequest,ul=document.getElementById("mapsList"),t.onreadystatechange=function(){t.readyState==XMLHttpRequest.DONE&&JSON.parse(t.responseText).forEach((function(e){li=document.createElement("li"),li.id="map"+e.id,li.innerHTML+='<a class="dropdown-item" href="#">'+e.name+"</a>",li.onclick=o(e.path,e.id),ul.appendChild(li)}))},t.open("get","api/retrive/maps",!0),t.setRequestHeader("Accept","application/json"),t.send()}))},662:()=>{}},a={};function o(e){var n=a[e];if(void 0!==n)return n.exports;var i=a[e]={exports:{}};return t[e](i,i.exports,o),i.exports}o.m=t,e=[],o.O=(t,a,n,i)=>{if(!a){var l=1/0;for(m=0;m<e.length;m++){for(var[a,n,i]=e[m],d=!0,r=0;r<a.length;r++)(!1&i||l>=i)&&Object.keys(o.O).every((e=>o.O[e](a[r])))?a.splice(r--,1):(d=!1,i<l&&(l=i));if(d){e.splice(m--,1);var s=n();void 0!==s&&(t=s)}}return t}i=i||0;for(var m=e.length;m>0&&e[m-1][2]>i;m--)e[m]=e[m-1];e[m]=[a,n,i]},o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={773:0,170:0};o.O.j=t=>0===e[t];var t=(t,a)=>{var n,i,[l,d,r]=a,s=0;for(n in d)o.o(d,n)&&(o.m[n]=d[n]);if(r)var m=r(o);for(t&&t(a);s<l.length;s++)i=l[s],o.o(e,i)&&e[i]&&e[i][0](),e[l[s]]=0;return o.O(m)},a=self.webpackChunk=self.webpackChunk||[];a.forEach(t.bind(null,0)),a.push=t.bind(null,a.push.bind(a))})(),o.O(void 0,[170],(()=>o(80)));var n=o.O(void 0,[170],(()=>o(662)));n=o.O(n)})();