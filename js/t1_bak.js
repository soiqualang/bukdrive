$().ready(function() {
// Vertical splitter. Set min/max/starting sizes for the left pane.
$("#MySplitter").splitter({
	splitVertical: true,
	outline: true,
	sizeLeft: 250, minLeft: 100, maxLeft: 550,
	anchorToWindow: true,
	accessKey: "L"
});
// First horizontal splitters, nested in the right pane of the vertical splitter.
$("#TopSplitter").splitter({
	splitVertical: true,
	outline: true,
	//sizeTop: 100, minTop: 50, maxTop: 200,
	sizeLeft: 400, minLeft: 100, maxLeft: 550,
	accessKey: "V"
});
// Second horizontal splitter, nested in bottom pane of first horizontal splitter
$("#BottomSplitter").splitter({
	splitHorizontal: true,
	outline: true,
	sizeBottom: 0, minTop: 0,
	accessKey: "J"
});
});

function photoinfo(photo_id){
	var flickrAPIinfo = '';
	flickrAPIinfo += 'redrose/auth/xuly.php';
	flickrAPIinfo += '?method=flickr.photos.getInfo';
	flickrAPIinfo += '&api_key=ccbdc96e79805d04973cb061d1ccb7a0';
	flickrAPIinfo += '&photo_id='+photo_id;
	flickrAPIinfo += '&redrose=photoinfo';
	flickrAPIinfo += '&format=json';
	flickrAPIinfo += '&nojsoncallback=1';

	var xhr= new XMLHttpRequest();
	xhr.open("GET",flickrAPIinfo,true);
	xhr.send();
	xhr.onreadystatechange=function(){
		if(xhr.readyState==4 && xhr.status==200) {
			var myArray = JSON.parse(xhr.responseText);
			console.log(myArray);
			var dataobj=myArray[0];
			var tit=dataobj.title._content;			
			var des=dataobj.description._content;
			var date=dataobj.dates.taken;
						
			var urlarr=dataobj.urls.url;
			var url=urlarr[0]._content;
			var urldown='https://www.flickr.com/video_download.gne?id='+photo_id;
			
			var desparr=des.split('|');
			var desinfo=desparr[0];			
			if(typeof desparr[1] != "undefined"){
				var img=desparr[1];
			}else{
				var img=DEFAULT_IMG;
			}
			
			document.getElementById('photoinfo').innerHTML='';
			document.getElementById('photoinfo').innerHTML+='<h1>'+tit+'</h1>';
			document.getElementById('photoinfo').innerHTML+='<i>'+date+'</i>';
			document.getElementById('photoinfo').innerHTML+='<br><br>';			
			document.getElementById('photoinfo').innerHTML+='Đường dẫn: <a href="'+url+'" target="_blank">'+url+'</a>';
			document.getElementById('photoinfo').innerHTML+='<br><br>';
			document.getElementById('photoinfo').innerHTML+='Download: <a href="'+urldown+'" target="_blank">'+urldown+'</a>';
			document.getElementById('photoinfo').innerHTML+='<br><br>';
			document.getElementById('photoinfo').innerHTML+=desinfo;
			document.getElementById('photoinfo').innerHTML+='<br><br>';
			document.getElementById('photoinfo').innerHTML+='<center><img src="'+img+'"></center>';
		}
	};
}

function listphoto(user_id,tags,idshow) {
	var flickrAPI = '';
	flickrAPI += 'redrose/auth/xuly.php';
	flickrAPI += '?method=flickr.photos.search';
	flickrAPI += '&api_key=ccbdc96e79805d04973cb061d1ccb7a0';
	flickrAPI += '&user_id='+user_id;
	flickrAPI += '&tags='+tags;
	flickrAPI += '&format=json';
	flickrAPI += '&redrose=listphoto';
	flickrAPI += '&per_page=500';
	flickrAPI += '&nojsoncallback=1';
	
    var xhr= new XMLHttpRequest();
    xhr.open("GET",flickrAPI,true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200) {
            var myArray = JSON.parse(xhr.responseText);
			console.log(myArray);
			var dataobj=myArray[0].photo;
			
			document.getElementById('photoinfo').innerHTML='';
			document.getElementById(idshow).innerHTML='';
			for (j=0;j<dataobj.length;j++){
				var title=dataobj[j].title;
				var photo_id=dataobj[j].id;
				document.getElementById(idshow).innerHTML+=('<li id="'+photo_id+'"><img src="img/text-file-5-16.gif"><a style="cursor:pointer" href="javascript:photoinfo(\''+photo_id+'\')">'+title+'</a></li>');
				
			}
        }
    };
};
function listtag() {
	var flickrAPI = '';
	flickrAPI += 'redrose/auth/xuly.php';
	flickrAPI += '?method=flickr.tags.getMostFrequentlyUsed';
	flickrAPI += '&api_key=ccbdc96e79805d04973cb061d1ccb7a0';
	flickrAPI += '&format=json';
	flickrAPI += '&redrose=listtag';
	flickrAPI += '&per_page=500';
	flickrAPI += '&nojsoncallback=1';
	
    var xhr= new XMLHttpRequest();
    xhr.open("GET",flickrAPI,true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200) {
            var myArray = JSON.parse(xhr.responseText);
			console.log(myArray);
			/*
			var dataobj=myArray[0].photo;
			
			document.getElementById('photoinfo').innerHTML='';
			document.getElementById(idshow).innerHTML='';
			for (j=0;j<dataobj.length;j++){
				var title=dataobj[j].title;
				var photo_id=dataobj[j].id;
				document.getElementById(idshow).innerHTML+=('<li id="'+photo_id+'"><img src="img/text-file-5-16.gif"><a style="cursor:pointer" href="javascript:photoinfo(\''+photo_id+'\')">'+title+'</a></li>');
				
			}
			*/
        }
    };
};
//listtag();

function album2photo(user_id,photoset_id,idshow){
	var flickrAPI = '';
	flickrAPI += 'redrose/auth/xuly.php';
	flickrAPI += '?method=flickr.photosets.getPhotos';
	flickrAPI += '&user_id='+user_id;
	flickrAPI += '&photoset_id='+photoset_id;
	flickrAPI += '&format=json';
	flickrAPI += '&redrose=album2photo';
	flickrAPI += '&per_page=500';
	
    var xhr= new XMLHttpRequest();
    xhr.open("GET",flickrAPI,true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200) {
            var myArray = JSON.parse(xhr.responseText);
			console.log(myArray);
			var dataobj=myArray[0].photo;
			
			document.getElementById('photoinfo').innerHTML='';
			document.getElementById(idshow).innerHTML='';
			for (j=0;j<dataobj.length;j++){
				var title=dataobj[j].title;
				var photo_id=dataobj[j].id;
				document.getElementById(idshow).innerHTML+=('<li id="'+photo_id+'"><img src="img/text-file-5-16.gif"><a style="cursor:pointer" href="javascript:photoinfo(\''+photo_id+'\')">'+title+'</a></li>');
				
			}
        }
    };
}

function list_album(user_id,idshow) {
	var flickrAPI = '';
	flickrAPI += 'redrose/auth/xuly.php';
	flickrAPI += '?method=flickr.photosets.getList';
	flickrAPI += '&redrose=list_album';
	flickrAPI += '&per_page=500';
	
    var xhr= new XMLHttpRequest();
    xhr.open("GET",flickrAPI,true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200) {
            var myArray = JSON.parse(xhr.responseText);
			console.log(myArray);
			var dataobj=myArray[0].photoset;
			//console.log(dataobj.length);
			//document.getElementById('photoinfo').innerHTML='';
			document.getElementById(idshow).innerHTML='';
			for (j=0;j<dataobj.length;j++){
				var photoset_id=dataobj[j].id;
				var photoset_title=dataobj[j].title._content;
				var photoset_description=dataobj[j].description;
				console.log(photoset_id+'|'+photoset_title+'|'+photoset_description._content);
				
				document.getElementById(idshow).innerHTML+='<li id="node'+j+'" onclick="javacript:album2photo(\''+user_id+'\',\''+photoset_id+'\',\'haha\');"><img src="img/dhtmlgoodies_minus.gif"><img src="img/dhtmlgoodies_folder.gif"><a  id="nodeATag'+j+'" style="cursor:pointer">'+photoset_title+'</a><ul id="tree_ul_'+j+'" style="display: block;"></ul></li>';		
			}
        }
    };
};

function timkiem(user_id,text,idshow){
	var flickrAPI = '';
	flickrAPI += 'redrose/auth/xuly.php';
	flickrAPI += '?method=flickr.photos.search';
	flickrAPI += '&user_id='+user_id;
	flickrAPI += '&text='+text;
	flickrAPI += '&format=json';
	flickrAPI += '&redrose=timkiem';
	flickrAPI += '&per_page=500';
	
    var xhr= new XMLHttpRequest();
    xhr.open("GET",flickrAPI,true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200) {
            var myArray = JSON.parse(xhr.responseText);
			console.log(myArray);
			var dataobj=myArray[0].photo;
			
			document.getElementById('photoinfo').innerHTML='';
			document.getElementById(idshow).innerHTML='';
			for (j=0;j<dataobj.length;j++){
				var title=dataobj[j].title;
				var photo_id=dataobj[j].id;
				document.getElementById(idshow).innerHTML+=('<li id="'+photo_id+'"><img src="img/text-file-5-16.gif"><a style="cursor:pointer" href="javascript:photoinfo(\''+photo_id+'\')">'+title+'</a></li>');
				
			}
        }
    };
}
function do_timkiem(){
	var txtkeyword=document.getElementById('txtkeyword').value;
	if(txtkeyword!=''){
		timkiem('146329215@N08',txtkeyword,'haha');
	}else{
		alert('Chưa nhập từ khóa!');
	}
}
list_album('146329215@N08','menu_cap1');