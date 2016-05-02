<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Image Processing Library</title>
<div id="logo">
<h1>Image Processing Library</h1>
<div id="links"></div>
</div>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="style/colour.css" />
<link rel="stylesheet" type="text/css" href="style/image_viewer.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!--<script src="script.js" type="text/javascript"></script>-->
</head>
<body>

<div id ="phpContent">

<?php
    session_start();
    $_SESSION['coll'] = 1;
    if(!isset($_SESSION['username'])) {
        header( "refresh:2;url=login.php" );
        die( "Not logged in; redirecting.");
    }
    
    
    ?>

</div>

<script>
var fetch=[];
var fetch2=[];

$(document).ready(function(){
                  //-1 represents no thing is selected, 0 represents that search box is selected, 1 represents collection is selected
                  var collectionSelected=-1;
                  var results = <?php echo json_encode($_SESSION['results']); ?>;
                  if (results!=null)
                  collectionSelected=0;
                  
                  //console.log(collectionSelected);
                  
                  var fetchVar=0;
                  var fetch2Var=0;
                  
                  var interval1 = 150;
                  var interval2 = 150;
                  var i = 1;
                  var n = 0;
                  var currTopCol = 1;
                  var currTopImg = 1;
                  var c = 0;
                  var c1 = 0;
                  var username = "<?php echo $_SESSION['username'] ?>";
                  
                  var collectionNumber = 1;
                  var firstImageUrl;
                  
                  displayFirstImage();
                  fetch[fetchVar] = setInterval(loadImages,interval1);
                  fetchVar++;
                  fetch2[fetch2Var] = setInterval(loadCollections,interval2);
                  fetch2Var++;
                  loadSearchBox();
                  loadImageInfo();
                  
                  $('.side_menu_item').trigger('click');
                  $("#side_menu_up").trigger('click');
                  
                  $("#search_table").hide();
                  
                  $("#search_reveal").click(function(){
                                            $("#search_table").toggle();
                                            
                                            });
                  
                  $("#side_menu_up").click(function(){
                                           //alert("up clicked");
                                           clearCollections();
                                           currTopCol--;
                                           c1=0;
                                           c=0;
                                           if (currTopCol == 0){
                                           currTopCol = 1;
                                           }
                                           
                                           renameCollections();
                                           loadSearchBox();
                                           fetch2[fetch2Var] = setInterval(loadCollections, interval2);
                                           fetch2Var++;
                                           //load the serach results box
                                           
                                           });
                  
                  $("#side_menu_down").click(function(){
                                             //alert("up clicked");
                                             clearCollections();
                                             currTopCol++;
                                             c1=0;
                                             c=0;
                                             
                                             renameCollections();
                                             loadSearchBox();
                                             fetch2[fetch2Var] = setInterval(loadCollections, interval2);
                                             fetch2Var++;
                                             });
                  
                  function renameCollections(){
                  var z = 0;
                  while(z<5){
                  $(".side_menu_item span:eq("+z+")").html("Collection " + (currTopCol + z));
                  z++;
                  }
                  }
                  
                  $("#gallery_up").click(function(){
                                         clearImages();
                                         currTopImg = currTopImg - 3;
                                         if(currTopImg < 0){
                                         currTopImg = 1;
                                         }
                                         fetch[fetchVar] = setInterval(loadImages, interval1);
                                         fetchVar++;
                                         });
                  
                  $("#gallery_down").click(function(){
                                           clearImages();
                                           currTopImg = currTopImg + 3;
                                           fetch[fetchVar] = setInterval(loadImages, interval1);
                                           fetchVar++;
                                           });
                  
                  $(".side_menu_item").click(function(){
                                             console.log($(this).index());
                                             //if the user selects the search box, notice its 7 not 6 because side_menu_down counts as 1
                                             if ($(this).index()==7){
                                             collectionSelected=0;
                                             collectionNumber = $(this).index();
                                             } else {
                                             collectionSelected=1;
                                             currTopImg = 1;
                                             collectionNumber = $(this).index() + currTopCol - 1;}
                                             
                                             
                                             $(".side_menu_item > a").removeClass("selected");
                                             $(this).find("a").addClass("selected");
                                             $.post("/backend.php", {"coll": collectionNumber});
                                             clearImages();
                                             fetch[fetchVar] = setInterval(loadImages, interval1);
                                             fetchVar++;
                                             displayFirstImage();
                                             
                                             //var b = mkdir("/images/users/test");
                                             //alert(b);
                                             //alert("collection #: 1");
                                             });
                  
                  $(".thumbnail").click(function(){
                                        $("#mainimg").attr("src",$(this).find("img").attr("src"));
                                        var n =$(this).find("img").attr("src").length;
                                        
                                        firstImageUrl=$(this).find("img").attr("src").substring(0, n-14);
                                        console.log(firstImageUrl+" this is\n");
                                        $("#downloadbutton").attr("href", $(this).find("img").attr("src"));
                                        
                                        loadImageInfo();
                                        });
                  
                  
                  
                  
                  $("#updatebutton").click(function(){
                                           console.log("heresfaf\n");
                                           var pathUrl="updateImInfo.php";
                                           $.post(pathUrl, {name: document.getElementById("1").value, date: document.getElementById("2").value, photographer: document.getElementById("3").value, location: document.getElementById("4").value,people: document.getElementById("5").value,sharing: document.getElementById("6").value, tag: document.getElementById("7").value }, function(data){
                                                  //alert(data);
                                                  loadImageInfo();
                                                  });
                                           
                                           });
                  
                  
                  $("#deletebutton").click(function(){
                                           console.log("delete\n");
                                           console.log(firstImageUrl.substring(17)+"\n");
                                           var pathUrl="deleteImage.php";
                                           console.log(pathUrl+"\n");
                                           var value=firstImageUrl.substring(17);
                                           $.post(pathUrl, {path: value}, function(data){
                                                  fetch2[fetch2Var] = setInterval(loadCollections, interval2);
                                                  fetch2Var++;
                                                  clearImages();
                                                  fetch[fetchVar] = setInterval(loadImages, interval1);
                                                  fetchVar++;
                                                  displayFirstImage();
                                                  });
                                           });
                  
                  $("#downloadcollectionbutton").click(function(){
                                                       $.post("/zip.php", {"coll": collectionNumber, "username": username}).done(function(){
                                                                                                                                 console.log("get it?");
                                                                                                                                 window.open("http://imageproslibrary.x10host.com/downloadCollection.php?"+"images/users/"+username+"/"+collectionNumber+"/collection.zip");
                                                                                                                                 });
                                                       
                                                       });
                  
                  function displayFirstImage() {
                  if (collectionSelected!=0){
                  $("#mainimg").attr("src","imageFileApi.php?"+"images/users/"+username+"/"+collectionNumber+"/"+i+".jpg?"+$.now());
                  $("#downloadbutton").attr("href","imageFileApi.php?"+"images/users/"+username+"/"+collectionNumber+"/"+i+".jpg?"+$.now());
                  firstImageUrl="imageFileApi.php?"+"images/users/"+username+"/"+collectionNumber+"/"+i+".jpg"; //don't added .now
                  }else {
                  $("#mainimg").attr("src","imageFileApi.php?"+results[0]+ "?" +$.now());
                  $("#downloadbutton").attr("href","imageFileApi.php?"+results[0]+ "?" +$.now());
                  firstImageUrl="imageFileApi.php?"+results[0]; //don't added .now
                  }
                  loadImageInfo();
                  
                  }
                  
                  function clearImages() {
                  var j=0;
                  i=1;
                  n=0;
                  while( j < 18 ) {
                  $("#thumbs").find("img:eq("+j+")").attr("src", "");
                  j++;
                  }
                  }
                  
                  function clearCollections() {
                  var z=0;
                  while ( z <= 5) {
                  $("#side_menu").find("img:eq("+z+")").attr("src", "");
                  z++;
                  }
                  }
                  
                  function loadSearchBox() {
                  var url2;
                  
                  //notice the search box index in here is 5, not 7
                  if (results!=null)
                  url2 = results[0];
                  else {
                  return;
                  }
                  console.log("ddddcollection number: "+c+ " url: "+url2);
                  
                  
                  
                  //alert(url2);
                  url2 = "imageFileApi.php?"+ url2 + "?" + $.now();
                  var imgLoad = {url: url2, counter: c };
                  //alert("url: "+imgLoad.url+", counter: " + imgLoad.counter);
                  $.ajax({url: imgLoad.url,
                         success: function(data){
                         $("#side_menu").find("img:eq("+5+")").attr("src", imgLoad.url);
                         },
                         error: function(data){
                         },
                         });    	}
                  
                  
                  function loadCollections() {
                  var url2;
                  if (c>=4){
                  for (fd=0; fd<=fetch2Var; fd++)
                  window.clearInterval(fetch2[fd]);
                  
                  }
                  
                  url2 = "images/users/"+username+"/"+(currTopCol+c)+"/1.jpg";
                  
                  //when it is the last collection to be shown (excpet the search box)
                  
                  //alert(url2);
                  url2 = "imageFileApi.php?"+ url2 + "?" + $.now();
                  var imgLoad = {url: url2, counter: c };
                  //alert("url: "+imgLoad.url+", counter: " + imgLoad.counter);
                  $.ajax({url: imgLoad.url,
                         success: function(data){
                         $("#side_menu").find("img:eq("+imgLoad.counter+")").attr("src", imgLoad.url);
                         c1++;
                         },
                         error: function(data){
                         loadSearchBox();
                         for (fd=0; fd<fetch2Var; fd++){
                         console.log(fetch2[fd]+" collection\n");
                         
                         window.clearInterval(fetch2[fd]);}
                         },
                         });
                  c++;
                  }
                  
                  function loadImageInfo(){
                  console.log("here\n");
                  console.log(firstImageUrl.substring(17)+"\n");
                  var pathUrl="getImInfo.php";
                  console.log(pathUrl+"\n");
                  var value=firstImageUrl.substring(17);
                  $.post(pathUrl, {path: value}, function(data){
                         //alert(data);
                         
                         var infos = $.parseJSON(data);
                         var index=0;
                         if (infos!=null){
                         for (index = 1; index <8; index++) {
                         var textbox = document.getElementById(index);
                         textbox.value = infos[index-1];
                         }}
                         });
                  }
                  
                  
                  function loadImages(){
                  var url;
                  if (collectionSelected!=0){
                  url = "images/users/"+username+"/"+collectionNumber+"/"+(i+currTopImg-1)+".jpg";
                  //alert(url);
                  } else if (results!=null) {
                  
                  url = results[i-1+currTopImg-1];
                  if (results[i-1+currTopImg-1+1]==null) { for (fd=0; fd<fetchVar; fd++){
                  console.log(fetch[fd]+" loadImages\n");
                  window.clearInterval(fetch[fd]);}}
                  }
                  else if (results==null||results[0]==null) {
                  for (fd=0; fd<fetchVar; fd++){
                  console.log(fetch[fd]+" loadImages\n");
                  window.clearInterval(fetch[fd]);}
                  return;
                  }
                  
                  
                  
                  url = "imageFileApi.php?"+ url + "?"+$.now();
                  var imgLoad = {url: url, counter: i - 1, coll: collectionNumber};
                  //if(i > 6)
                  //alert(url);
                  $.ajax({url: imgLoad.url,
                         success: function(data){
                         //alert('exists');
                         //i++;
                         if(collectionNumber == imgLoad.coll){
                         $("#thumbs").find("img:eq("+imgLoad.counter+")").attr("src", imgLoad.url);
                         n++;
                         }
                         },
                         error: function(data){
                         //alert('does not exist');
                         for (fd=0; fd<fetchVar; fd++){
                         console.log(fetch[fd]+" loadImages\n");
                         window.clearInterval(fetch[fd]);}	    				//alert('does not exist');
                         
                         },
                         });
                  //}
                  i++;
                  }
                  
                  });
</script>

<!-----Aviary-------->
<script type="text/javascript" src="http://feather.aviary.com/js/feather.js"></script>

<script type="text/javascript">

var username = "ysi";
var coll = "1";
var saveurl;
var featherEditor = new Aviary.Feather({
                                       apiKey: '7f7e0091-f40d-4b2a-a92a-843a338aa8d5',
                                       apiVersion: 3,
                                       theme: 'dark',
                                       tools: 'all',
                                       appendTo: '',
                                       onSave: function(imageID, newURL) {
                                       var img = document.getElementById(imageID);
                                       img.src = newURL;
                                       $(function() {
                                         //alert(newURL);
                                         $.post("/backend.php", {"url": newURL});
                                         
                                         });
                                       /*$(function() { 
                                        $.ajax({
                                        url : newURL,
                                        type : "GET",
                                        data : {
                                        imagedata : imagedata
                                        },
                                        success : function() {
                                        alert("test");
                                        },
                                        error : function() {
                                        alert("error");
                                        }
                                        },"image/jpeg",1);
                                        });*/
                                       //alert("old: "+saveurl+"new: "+newURL);
                                       //save_image(newURL,saveurl);
                                       },
                                       onError: function(errorObj) {
                                       alert(errorObj.message);
                                       }
                                       });
function launchEditor(id, src) {
    saveurl = document.getElementById(id).src;
    featherEditor.launch({
                         image: id,
                         url: src
                         });
    return false;
}
function save_image($inPath,$outPath)
{ //Download images from remote server
    $in=    fopen($inPath, "rb");
    $out=   fopen($outPath, "wb");
    while ($chunk = fread($in,8192))
    {
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
}
function getImageUrl() {
    
    return "./images/users/"+username+"/"+coll+"/"+"1.jpg";
}

</script>
<!-----/Aviary------->


<div id="menu">
<ul>
<!--<li><a class="selected" href="#">Home</a></li>
<li><a href="about.php">Search</a></li>
<li><a href="contact.php">Uploaded Images</a></li>-->
</ul>
<div id="collection_new">
<form action="createCollection.php" method="post" enctype="multipart/form-data">
<input type="submit" value="Create New Collection" name="submit">
</form>
</div>
<div id="collection_share"> 
<form action="share.php" method="post" enctype="multipart/form-data">
Select user with which to share the active collection:
<input type="user" name="recvUser" id="recvUser">
<input type="submit" value="Share Collection" name="submit">
</form>
</div>
<div id="colours"></div>
</div>
<div id="site_content"> 
<div id="side_menu">
<button id="side_menu_up">&and;</button>
<div class="side_menu_item"> <a href="#"><img alt="" width="142" height="50" /></a> <span class="info">Collection 1</span> </div>
<div class="side_menu_item"> <a href="#"><img alt="" width="142" height="50" /></a> <span class="info">Collection 2</span> </div>
<div class="side_menu_item"> <a href="#"><img alt="" width="142" height="50" /></a> <span class="info">Collection 3</span> </div>
<div class="side_menu_item"> <a href="#"><img alt="" width="142" height="50" /></a> <span class="info">Collection 4</span> </div>
<div class="side_menu_item"> <a href="#"><img alt="" width="142" height="50" /></a> <span class="info">Collection 5</span> </div>
<button id="side_menu_down">&or;</button>

<div class="side_menu_item"> <a href="#"><img alt="" width="142" height="50" /></a> <span class="info">searching results</span> </div>

</div>
<div id="content">
<h1>Collection One Photographs<span class="sub">[click on thumbnails to view]</span></h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
Select image to upload:
<input type="file" name="fileToUpload" id="fileToUpload">
<input type="submit" value="Upload Image" name="submit">
</form>
<div id="gallery"> <img id="mainimg"/> <em id="thumbs"> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> 
<div id="gallery_nav">
<button id="gallery_up">&and;</button> 
<button id="gallery_down">&or;</button>
</div>

<table style="width:40%">
<table id="info_table" style="width: 40%">
<tr> <td> <div> <label for="name">Name</label> </div> </td> </tr> <tr> <td> <div> <input type="text" id=1 name="name"/> </div> </td> </tr> <tr> <td> <div> <label for="date">DateTaken</label> </div> </td> </tr> <tr> <td> <div> <input type="text" id=2 name="date"/> </div> </td> </tr> <tr> <td> <div> <label for="photographer">Photographer</label> </div> </td> </tr> <tr> <td> <div> <input type="text" id=3 name="photographer"/> </div> </td> </tr> <tr> <td> <div> <label for="location">Location</label> </div> </td> </tr> <tr> <td> <div> <input type="text" id=4 name="location"/> </div> </td> </tr> <tr> <td> <div> <label for="people">People</label> </div> </td> </tr> <tr> <td> <div> <input type="text" id=5 name="people"/> </div> </td> </tr> <tr> <td> <div> <label for="sharing">Sharing</label> </div> </td> </tr> <tr> <td> <div> <input type="text" id=6 name="sharing"/> </div> </td> </tr> <tr> <td> <div> <label for="tag">Tag</label> </div> </td> </tr> <tr> <td> <div> <input type="text" id=7 name="tag"/> </div> </td> </tr> 

</table>

<div class="button">
<a value="update" id="updatebutton"><button>update</button></a>  </div>
</em> </div>
<a value="delete" id="deletebutton"><button>delete</button></a>
<a value="download" id="downloadbutton" download><button>Download</button></a>
<a id="downloadcollectionbutton"><button>Download Collection</button></a>

<!-- adding the edit button //--->
<input type="image" src="http://images.aviary.com/images/edit-photo.png" value="Edit photo" onclick="return launchEditor('mainimg');" />
<!----------------------------->

</div>
</div>

<button id="search_reveal">Show search options</button>

<div  id="search_table">
<form action="search.php" method="post">
<table  style="width:40%">
<caption>search images by:</caption>
<tr> <td> <div> <label for="name">Name</label> </div> </td> <td> <div> <label for="date">DateTaken</label> </div> </td> <td> <div> <label for="photographer">Photographer</label> </div> </td> <td> <div> <label for="location">Location</label> </div> </td> <td> <div> <label for="people">People</label> </div> </td> <td> <div> <label for="sharing">Sharing</label> </div> </td> <td> <div> <label for="tag">Tag</label> </div> </td> </tr> <tr> <td> <div> <input type="text" name="name" /> </div> </td> <td> <div> <input type="text" name="date" /> </div> </td> <td> <div> <input type="text" name="photographer" /> </div> </td> <td> <div> <input type="text" name="location" /> </div> </td> <td> <div> <input type="text" name="people" /> </div> </td> <td> <div> <input type="text" name="sharing" /> </div> </td> <td> <div> <input type="text" name="tag" /> </div> </td> </tr>
</table>

<div id="search_button_div" class="button">
<button type="submit">search</button>
</div>
</div>

</form>



<!--Testing Share-->

<!--/Testing Share-->

<!---New Collection-->



<!--/New Collection-->

<table>
<form action="logout.php" method="POST">
<div class="marg">
<tr><td><input class="buttonstyle" type="submit" name="logout" value="logout" /></td></tr>
</div>

</form>
</table>

</body>
</html>