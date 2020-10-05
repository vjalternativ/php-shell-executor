var Ajax  = {};

Ajax.request = (url,method,data,callback) => {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      //document.getElementById("output").innerHTML = this.responseText;
	    	callback(this.responseText);
	    } 
	  };
	  xhttp.open(method, url, true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhttp.send(data);

};



Ajax.post = (url,data,callback) => {
	Ajax.request(url,"POST",data,callback);
}

Ajax.get = (url,callback) => {
	Ajax.request(url,"GET",null,callback);
};

function fetch(job_id) {
		Ajax.get("fetcher.php?job_id="+job_id,function(res){
				var resp = JSON.parse(res);
				if(resp.status=="success") {
					document.getElementById("output").innerHTML = resp.content;
				} else {
					setTimeout(function(){
				  		fetch(job_id);	
					},2000);
				}
		});
}

function executeCommand() {
  var command = document.getElementById("command").value;
  Ajax.post("executorapi.php","command="+command,function(res){
	  	var resp = JSON.parse(res); 
	  	if(resp.status=="success") {
		  	setTimeout(function(){
		  		fetch(resp.job_id);	
			},2000);
	  	}
  });
}