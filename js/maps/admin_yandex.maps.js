ymaps.ready(init);
myMap = false,myPlacemark = false;

	yamarkers = [];

function init(){ 
	myMap = new ymaps.Map ("map", {
		center: [51.46598,46.11820],
		zoom: 12
	}); 
	
	// Создание экземпляра элемента управления
	myMap.controls.add(
	   new ymaps.control.ZoomControl()
	);
	
	myMap.events.add('click', function (e) {
		try{
			for (i in yamarkers) myMap.geoObjects.remove(yamarkers[i]);
			
			var coords = e.get('coordPosition');
			//alert(coords);
			
			document.getElementById("addres_coord").value = '('+coords+')';
			var patern = /\((.*),(.*)\)/i;
			var str = document.getElementById("addres_coord").value;
			var array = str.match(patern)
			//alert(array[1]);
			myPlacemark = new ymaps.Placemark([array[1],array[2]], {
				content: ''
			});
			
			//if(center) myMap.setCenter([array[1],array[2]],12);
			
			yamarkers.push(myPlacemark);
			myMap.geoObjects.add(myPlacemark);
			
		} catch(er) {
			return false;
		}
	}); 
	
	//showPlacesAll(array_place);
	/*myPlacemark = new ymaps.Placemark([51.46598,46.11820], {
		content: 'Энгельс!',
		balloonContent: '<b><span style="from-size:14px">Бавария</span></b> <a href="/mesta/bary/bavarija/">подробнее</a><br><div style="float:left;">г. Энгельс, ул. М.Расковой, д.12</div><div style="float:right;padding-left: 10px;"><img width="50" src="/images/sitemodul/1134/100_80_P1150324.JPG"></div>'
	});
	
	myMap.geoObjects.add(myPlacemark);*/
}

function initAllPlace(){
	showPlacesAll(array_place);
}

function addPlace(item,open_informer,center){
	try{
		if(!open_informer) open_informer = false
		if(!center) center = false
		
		var patern = /\((.*),(.*)\)/i;
		var str = item['addres_coord'];
		var array = str.match(patern)
		
		myPlacemark = new ymaps.Placemark([array[1],array[2]], {
			content: item['name']
		});
		
		if(center) myMap.setCenter([array[1],array[2]],12);
		
		yamarkers.push(myPlacemark);
		myMap.geoObjects.add(myPlacemark);
		
	} catch(e) {
		return false;
	}
}

function showPlaces(id_cat,array){
	document.getElementById("query_google_map").value = '';
	var items = array[id_cat];
	for (i in yamarkers) myMap.geoObjects.remove(yamarkers[i]);

	for(var i in items){
		addPlace(items[i]);
	}
	if(array[id_cat]['multi_parent']){
		items = array[id_cat]['multi_parent'];
		for(var i in items){
			addPlace(items[i]);
		}
	}
}

function showPlacesAll(array){
	document.getElementById("query_google_map").value = '';
	//initialize();
	//ymaps.ready(init);
	for(var i in array){
		for(var j in array[i]){
			addPlace(array[i][j]);
		}
	}
}

function searchPlaces(array){
	$('#preloader_google_maps').show();
	var query = (document.getElementById("query_google_map").value).toLowerCase();
	
	for (i in yamarkers) myMap.geoObjects.remove(yamarkers[i]);
	
	if(query!=''){
		for(var i in array){
			for(var j in array[i]){
				//alert(query);
				var name = array[i][j]['name'];
				if (name) {
					var addres = array[i][j]['addres'];
					if(((name.toLowerCase()).indexOf(query)+1) || ((addres.toLowerCase()).indexOf(query)+1)){
						addPlace(array[i][j]);
					}
				}
			}
		}
	} else {
		showPlacesAll(array);
	}
	$('#preloader_google_maps').hide();
}