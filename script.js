$(document).ready(function(){

    	var i = 1;
    	var n = 0;
  	var username = "<?php echo $_SESSION['username'] ?>";
	var fetch = setInterval(loadImages,30);
	var collectionNumber = 1;
	displayFirstImage();
	
	//mkdir("/images/users/test", 0700);
	//mkdir("/images/users/".test."/1", 0700);
	$(".side_menu_item").click(function(){
		collectionNumber = $(this).index()+1;
		$.post("/backend.php", {"coll": collectionNumber});
		clearImages();
		fetch = setInterval(loadImages, 30);
		displayFirstImage();
		var b = mkdir("/images/users/test");
		alert(b);
		//alert("collection #: <?php echo $_SESSION['coll'] ?>");
	});
	
    	$(".thumbnail").click(function(){
        	$("#mainimg").attr("src",$(this).find("img").attr("src"));
		$("#downloadbutton").attr("href", $(this).find("img").attr("src"));
    	});
    	
    	function displayFirstImage() {
        	//$("#mainimg").attr("src",$("#thumbs").find("img:first").attr("src"));
        	//$("#downloadbutton").attr("href",$("#thumbs").find("img:first").attr("src"));
        	$("#mainimg").attr("src","images/users/"+username+"/"+collectionNumber+"/"+i+".jpg");
        	$("#downloadbutton").attr("href","images/users/"+username+"/"+collectionNumber+"/"+i+".jpg");
    	}
    	
    	function clearImages() {
    		var j=0;
    		i=1;
    		n=0;
    		while( j < 16 ) {
    			$("#thumbs").find("img:eq("+j+")").attr("src", "");
    			j++;
    		}
    	}
    	
    	function loadImages() {
  		//alert(username);
    		//while (i >= 0) {
    			var url = "images/users/"+username+"/"+collectionNumber+"/"+i+".jpg";
    			//if(i > 6)
    			//alert(url);
    			
	    		$.ajax({url: url,
	  			success: function(data){
	    				//alert('exists');
	    				//i++;
	    				$("#thumbs").find("img:eq("+n+")").attr("src", url);
	    				n++;
	  			},
	  			error: function(data){
	    				//alert('does not exist');
	    				clearInterval(fetch);
	  			},
			});
		//}
		i++;
    	}
    });
