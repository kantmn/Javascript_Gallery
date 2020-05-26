<?
header( 'Content-Type: text/html; charset=utf-8' );
ini_set('display_errors',1); 
setlocale(LC_ALL,'en_EN.UTF-8');
$thumb_size = 100;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gallery v3</title>
		<script src="js/icons.js"></script> 
		<script src="js/detect_swipe.js"></script> 
		<script src="js/jquery.3.5.1.min.js"></script> 
		<meta charset="UTF-8" name="viewport">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" />
		<link rel="icon" type="image/png" href="favicon.png">
		<script type='text/javascript'>
			var docHead = document.getElementsByTagName('head')[0];
			var newLink = document.createElement('link');
			newLink.rel = 'shortcut icon';
			newLink.type = 'image/x-icon';
			newLink.href = 'data:image/png;base64,'+favIcon;
			docHead.appendChild(newLink);

			var jsFiles = null;
			var item_index = 0;
			var folder_index = 0;
			var index_size = 0;
		</script>
		<link rel="stylesheet" type="text/css" href="css/loading_atom.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/orientation.css">
		<link rel="stylesheet" type="text/css" href="css/normalize.8.0.1.css">
		<script type='text/javascript'>

			// berechnet durchschnittliche farbe eines bildes
			function getAverageRGB(name) {
				var imgEl = document.getElementById(name);

				var blockSize = 5, // only visit every 5 pixels
					defaultRGB = {r:0,g:0,b:0}, // for non-supporting envs
					canvas = document.createElement('canvas'),
					context = canvas.getContext && canvas.getContext('2d'),
					data, width, height,
					i = -4,
					length,
					rgb = {r:0,g:0,b:0},
					count = 0;

				if( imgEl == null || !context || imgEl.tagName != 'IMG') {
					return defaultRGB;
				}

				height = canvas.height = imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
				width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;
				context.drawImage(imgEl, 0, 0);

				try {
					data = context.getImageData(0, 0, width, height);
				} catch(e) {
					/* security error, img on diff domain */
					return defaultRGB;
				}

				length = data.data.length;

				while ( (i += blockSize * 4) < length ) {
					++count;
					rgb.r += data.data[i];
					rgb.g += data.data[i+1];
					rgb.b += data.data[i+2];
				}

				// ~~ used to floor values
				rgb.r = ~~(rgb.r/count);
				rgb.g = ~~(rgb.g/count);
				rgb.b = ~~(rgb.b/count);

				return rgb;
			}
			// kümmert sich um die bearbeitung von swipes und keypresses
			function handle(e){
				// swipe function what to if direction X
				//e.preventDefault(); // Ensure it is only this code that runs
				
				// 37 = weiter also nächstes item
				if(e === 37) {
					$("#link_prev").click();
				}
				// 39 = zurück also vorheriges item
				if(e === 39) {
					$("#link_next").click();
				}
				// 38+40 = hoch/runter also home, wenn esc -> home
				if(e === 38 || e === 40 || e === 27) {
					$("#link_home").click();
				}		
			}
			// holt sich die url parameter auf nachfrage entweder aus definierter oder browser url
			function getURLParameter(url = window.location.href) {
				var vars = {};
				var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
					vars[key] = value;
				});
				return vars;
			}
			// passt die index_size also rastergröße an wenn rotated
			function updateIndexSize(){
				var tmp = Math.floor( window.innerWidth / 102) * Math.floor( (window.innerHeight - 50) / 110);
				return index_size = tmp;
			}

			function displayFolder(link = window.location.href){
				$('#viewport').hide();
				$('#loading').show();
				$('#nav_help').hide();

				let item = getURLParameter(link)["item"];
				let folder = getURLParameter(link)["folder"];
				let item_index = getURLParameter(link)["start"];

				if( folder == null || folder == "" || folder == "undefined" ){
					folder = "items";
					item_index = 0;
				}

				document.title = "Gallery displaying: "+folder;
				history.pushState(null, null, location.href);
				index_size = updateIndexSize();
				
				// wechsel einzelansicht zu liste
				$('#viewport_item').hide();

				// clear old fullscreen item bevor going back
				$('#ajax_load').html('');

				//load overview
				$('#viewport_index').fadeIn('slow');
				
				// set background to black again as we are viewing the list
				$('body').css("background-color", "black");
				$("body").css('background-image', 'url(img/background.jpg)'); 
				
				$.ajax({
					url:"a_load_folder.php", 
					method: "POST",
					data: { folder: folder},
					success:function(data) {
						var result = $.parseJSON(data);
						var array_divider_position = result.indexOf("");
						var folders = result.slice(0, array_divider_position);
						var files = result.slice(array_divider_position + 1, result.length);

						// lade das file array für andere functionen auf
						jsFiles = files;

						// stelle sicher dass der angefragte ordner gespeichert wird
						var folder_link = folder;
						
						// passe den angefragte ordner an damit er intern als unterordner geladen werden kann
						if( folder != "items" && folder){
							folder = "items/"+ folder;
						}

						if( !item_index || item_index < 0 ){
							item_index = 0;
						}else if( (item_index * index_size) > files.length){
							item_index = Math.floor(files.length / index_size);
						}

						if( folders.length > index_size || files.length > index_size ){
							var prev = parseInt(item_index) - 1;
							var next = parseInt(item_index) + 1;
							
							$("#link_first").attr("href","?folder="+folder_link+"&start="+ 0);
							$("#link_prev").attr("href","?folder="+folder_link+"&start="+ prev );
							$("#link_home").attr("href","?folder=items");
							$("#link_next").attr("href","?folder="+folder_link+"&start="+ next );
							$("#link_last").attr("href","?folder="+folder_link+"&start="+ (Math.floor(files.length / index_size)) );
							$("[id^=link_]").show();
						}else{
							$("#link_home").attr("href","?folder=items");
							$("[id^=link_]").hide();
							$('#link_home').show();
						}

						//leere alte inhalte
						$("#folders").html('');
						$("#files").html('');

						//for (var i=0; i < folders.length; i++) {
						for (var i = 0; i < folders.length ; i++) {
							$("#files").append('<div class="index_item"><a class="nav" href="?folder='+folders[i]+'"><img id="item_'+folders[i]+'" class="thumb folder" src="'+thumb_folder+'" border="0" /></a>'+folders[i].substring(0, 10) + '...</div>');
						}

						//for (var i=0; i < files.length; i++) {
						for (var i= (item_index * index_size); i < (item_index * index_size + index_size); i++) {
							if( i >= files.length ){
								break;
							}

							if( files[i].split('.').pop() == 'mp4' ){
								$("#files").append('<div class="index_item"><a class="nav" href="?folder='+folder_link+'&item='+files[i]+'&start='+item_index+'"><img class="thumb video" src="'+thumb_video+'" alt="No Preview" border="0" /></a>'+files[i].substring(0, 10) + '...</div>');
							}else{
								$("#files").append('<div class="index_item"><a class="nav" href="?folder='+folder_link+'&item='+files[i]+'&start='+item_index+'"><img class="thumb picture" id="item_'+files[i]+'" src="'+thumb_picture+'" data-src="/thumbs/'+files[i]+'.jpg" border="0" /></a>'+files[i].substring(0, 10) + '...</div>');
							}
						}

						// lazy loading images
						var images= document.getElementsByClassName('picture');
						for (var i=0; i<images.length; i++) {
							if (images[i].getAttribute('data-src')) {
								images[i].setAttribute('src', images[i].getAttribute('data-src'));
							}
						}
						$('#loading').delay(50).fadeOut('slow');
						$('#viewport').fadeIn('slow');
					}
				});
			}
			
			function displayItem(link = window.location.href ){
				$('#viewport').hide();
				$('#loading').show();
				$("[id^=link_]").show();
				$('#nav_help').show();
				
				// wechsel Liste zu einzelansicht
				$('#viewport_index').hide();
				$('#viewport_item').fadeIn('slow');

				index_size = updateIndexSize();

				var item = getURLParameter(link)["item"];
				var folder = getURLParameter(link)["folder"];
				var start = getURLParameter(link)["start"];

				$.ajax({
					url:"a_load_folder.php", 
					method: "POST",
					cache: true,
					data: { folder: folder},
					success:function(data) {
						var result = $.parseJSON(data);
						var array_divider_position = result.indexOf("");
						var folders = result.slice(0, array_divider_position);
						var files = result.slice(array_divider_position + 1, result.length);

						// lade das file array für andere functionen auf
						jsFiles = files;

						// sucht den aktuellen index von unserem item
						index = jsFiles.indexOf(decodeURI(item));

						if( index >= index_size ){
							start = Math.trunc( index / index_size );
						}

						var item_first = jsFiles[0];
						var item_last = jsFiles[jsFiles.length - 1];
						var index_human = index + 1;

						// aktualisiert den websiten titel basierend auf den zahlen der dateien
						document.title = "Folder item "+index_human+" of "+jsFiles.length;

						// berechne den neuen link für das nächste item
						var item_next = index + 1;
						
						// wenn wir am ende der liste sind und weiter wollen -> von vorne
						if( item_next > (jsFiles.length - 1) ){
							item_next = 0;
						}
						item_next = jsFiles[item_next];

						// berechne den vorherigen link für das vorherige item
						var item_prev = index - 1;

						// wenn wir am anfang der liste sind und weiter zurück wollen -> nach hinten
						if(item_prev < 0 ){
							item_prev = jsFiles.length - 1;
						}
						item_prev = jsFiles[item_prev];

						// adaptiere die neuen links bevor folderpath angepasst wird
						$("#link_first").attr("href","?folder="+folder+"&item="+item_first+"&start="+start);
						$("#link_last").attr("href","?folder="+folder+"&item="+item_last+"&start="+start);
						$("#link_prev").attr("href","?folder="+folder+"&item="+item_prev+"&start="+start);
						$("#link_next").attr("href","?folder="+folder+"&item="+item_next+"&start="+start);
						$("#link_home").attr("href","?folder="+folder+"&start="+item_index+"&start="+start);

						// stelle sicher dass der angefragte ordner gespeichert wird
						var folder_link = folder;
						
						// passe den angefragte ordner an damit er intern als unterordner geladen werden kann
						if( folder != "items" && folder){
							folder = "items/"+ folder;
						}

						// clear old background image
						$("body").css('background-image', 'none');
						$('body').css("background-color", 'rgb(0,0,0)' );

						// prüfe ob es sich bei der dateiendung um mp4 handelt
						if( item.split('.').pop().toLowerCase() == 'mp4'){
							$('#ajax_load').html('<video id="fullscreen_element" controls="controls" autoplay="autoplay"><source src="/'+folder+'/'+item+'" type="video/mp4">Your browser does not support the video tag.</video>');
						}else{
							$('#ajax_load').html('<a class="nav" href="?folder='+folder_link+'&item='+item_next+'"><img id="fullscreen_element" src="/'+folder+'/'+item+'"></a>');
							$('#fullscreen_element').on('load', function() { 
								// finde die hauptfarbe des bildes und setze diese als background
								var rgb = getAverageRGB("fullscreen_element");

								$('body').css("background-color", 'rgb('+rgb.r+','+rgb.g+','+rgb.b+')' );
							});
						}

						$('#loading').delay(50).fadeOut('slow');
						$('#viewport').fadeIn('slow');
					}
				});
			}
					
			// starting jquery procedures
			$(document).ready(function() {
				$('#nav_arrows').attr("src", nav_arrows);
				$('#nav_fingers').attr("src", nav_fingers);

				// prüfe ob in browser url ein folder /item eingegeben wurde
				if (getURLParameter()["item"] != null) {
					displayItem();
				}else{	
					displayFolder();
				}

				history.pushState(null, null, location.href);
				window.onpopstate = function () {
					event.preventDefault();
					var link = $("#link_home").attr("href");
					displayFolder(link);
				}

				$(document).on("click","a.nav",function() {					
					event.preventDefault();

					// extrahiere aktuelles item was angezeigt werden soll
					var link = $(this).attr("href");

					if( getURLParameter(link)["item"] != null ){
						displayItem(link);
					}else{
						displayFolder(link);
					}
				});
				
				// catch arrow key input
				document.onkeydown = function(event) {
					event = event || window.event;
					handle(event.which);
				};

				// make sure on orientation change to adjust layout for folder and index_size
				window.addEventListener("orientationchange", function() {
					// nur neuladen wenn kein image offen is
					if( !document.getElementById("fullscreen_element") ){
						var folder = getURLParameter( $("#link_prev").attr("href") )["folder"];
						var start = parseInt( getURLParameter( $("#link_prev").attr("href") )["start"] ) + 1;

						setTimeout(function(){
							switch(window.orientation) {  
							case -90: case 90:
								displayFolder( "?folder="+folder+"&start="+start );
								break; 
							default:
								displayFolder( "?folder="+folder+"&start="+start );
								break; 
							}
						}, 250);
						//clearTimeout() ;
					}
				});
			});
		</script>
	</head>
	<body onload="detectswipe('viewport',handle)">
		<div id="loading">
			<div class="cssload-loader">
				<div class="cssload-inner cssload-one"></div>
				<div class="cssload-inner cssload-two"></div>
				<div class="cssload-inner cssload-three"></div>
			</div>
		</div>
		<div id="viewport">
			<!-- TOP NAVIGATION -->
			<div id="navigation" class="center">
				<span><a class="nav" id="link_first">[ First ]</a>&nbsp;</span>
				<span><a class="nav" id="link_prev">[ <<< ]</a>&nbsp;</span>
				<span><a class="nav" id="link_home">[ Home ]</a>&nbsp;</span>
				<span><a class="nav" id="link_next">[ >>> ]</a>&nbsp;</span>
				<span><a class="nav" id="link_last">[ Last ]</a></span>

				<div id="nav_help">
					Use arrow keys <img id="nav_arrows" height="18px"> on your keyboard or your fingers <img id="nav_fingers" height="18px"> to swipe between images.
				</div>
			</div>
			<!-- FULLSCREEN ITEM -->
			<div id="viewport_item">
				<div class="center">
					<div id="ajax_load"></div>
				</div>		
			</div>
			<!-- ITEM LIST / INDEX -->
			<div id="viewport_index">
				<div class="center">
					<div id="folders" class="table tabindex"></div>
					<div class="linebreak"></div>
					<div id="files" class="table tabindex"></div>
				</div>
			</div>
		</div>
	</body>
</html>