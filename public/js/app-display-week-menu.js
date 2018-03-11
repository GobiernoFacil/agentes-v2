(function(){
	var togglBtnId = "display-week-menu",
	    menuDivId  = "week-menu-shalala",
	    togglBtn   = document.getElementById(togglBtnId), 
	    menuDiv    = document.getElementById(menuDivId);

	togglBtn.addEventListener("click", function(e){
		e.preventDefault();
		//console.log("yoooo");

		if(menuDiv.style.display == "none"){
			menuDiv.style.display = "block";
			menuDiv.classList.add("open");
		}
		else{
			menuDiv.style.display = "none";
			menuDiv.classList.remove("open");
		}
	});
	   
})();