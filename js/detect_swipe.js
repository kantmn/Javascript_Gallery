function detectswipe(el,func) {
    swipe_det = new Object();
    swipe_det.sX = 0;
    swipe_det.sY = 0;
    swipe_det.eX = 0;
    swipe_det.eY = 0;
    var min_x = 50;  //min x swipe for horizontal swipe
    var max_x = 499;  //max x difference for vertical swipe
    var min_y = 500;  //min y swipe for vertical swipe
    var max_y = 700;  //max y difference for horizontal swipe
    var direc = "";
    var ele = document.getElementById(el);
    
    if (!!ele){
        ele.addEventListener('touchstart',function(e){
          var t = e.touches[0];
          swipe_det.sX = t.screenX; 
          swipe_det.sY = t.screenY;
        },false);
        ele.addEventListener('touchmove',function(e){
          e.preventDefault();
          var t = e.touches[0];
          swipe_det.eX = t.screenX; 
          swipe_det.eY = t.screenY;    
        },false);
        ele.addEventListener('touchend',function(e){
          //horizontal detection
          if ((((swipe_det.eX - min_x > swipe_det.sX) || (swipe_det.eX + min_x < swipe_det.sX)) && ((swipe_det.eY < swipe_det.sY + max_y) && (swipe_det.sY > swipe_det.eY - max_y)))) {
            if(swipe_det.eX > swipe_det.sX) direc = 39;
            //direc = "r";
            //else direc = "l";
            else direc = 37;
          }
          //vertical detection
          if ((((swipe_det.eY - min_y > swipe_det.sY) || (swipe_det.eY + min_y < swipe_det.sY)) && ((swipe_det.eX < swipe_det.sX + max_x) && (swipe_det.sX > swipe_det.eX - max_x)))) {
            if(swipe_det.eY > swipe_det.sY) direc = 38;
            //direc = "d";
            //else direc = "u";
            else direc = 40;
          }
  
          if (direc != "") {
            //if(typeof func == 'function') func(el,direc);
            if(typeof func == 'function') func(direc);
          }
          direc = "";
        },false);
    }
  }
  
  function current_Screen_orientation(){
      if ( orientation == 0 ) {
          alert ('Portrait Mode, Home Button bottom');
      }
      else if ( orientation == 90 ) {
          alert ('Landscape Mode, Home Button right');
      }
      else if ( orientation == -90 ) {
          alert ('Landscape Mode, Home Button left');
      }
      else if ( orientation == 180 ) {
          alert ('Portrait Mode, Home Button top');
      }
  }
  //current_Screen_orientation();
  