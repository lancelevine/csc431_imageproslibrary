    	function displayFirstImage() {
    	if (collectionSelected!=0){
    		$("#mainimg").attr("src","imageFileApi.php?"+"images/users/"+username+"/"+collectionNumber+"/"+i+".jpg?"+$.now());
        	$("#downloadbutton").attr("href","imageFileApi.php?"+"images/users/"+username+"/"+collectionNumber+"/"+i+".jpg?"+$.now());
     		firstImageUrl="imageFileApi.php?"+"images/users/"+username+"/"+collectionNumber+"/"+i+".jpg";
    	}else {
		$("#mainimg").attr("src",results[0]+ "?" +$.now());
        	$("#downloadbutton").attr("href",results[0]+ "?" +$.now());
        	firstImageUrl="imageFileApi.php?"+results[0];
        	}
        	
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
    		while ( z < 5 ) {
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
    	 url2=null;
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
    
    
    	 url2 = "images/users/"+username+"/"+(currTopCol+c)+"/1.jpg";
    	
    			//when it is the last collection to be shown (excpet the search box)
    			if (c==4)
    			clearInterval(fetch2);
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
	    				clearInterval(fetch2);
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
		//console.log(infos[i-1]+"\n");
		}}
	});
}
    	
    	
	function loadImages(){
    		var url;
    		if (collectionSelected!=0){
    	 url = "images/users/"+username+"/"+collectionNumber+"/"+(i+currTopImg-1)+".jpg";
    	 //alert(url);
    	} else if (results!=null) {
    		 url = results[i-1]; }
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
	    				clearInterval(fetch);
	  			},
			});
		//}
		i++;
	}