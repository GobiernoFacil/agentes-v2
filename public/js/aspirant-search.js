var search  = document.getElementById("search-aspirant");
//buscador
search.addEventListener("keyup",function(){
	var _query   = this.value.toUpperCase();
	var box = document.getElementById("search-results");
	if(_query.length==0){
		box.innerHTML = '';
	}
});
search.addEventListener("focusout",function(){
	var box = document.getElementById("search-results");
	setTimeout(function() { box.innerHTML = ''; search.value = '';}, 100);
});

search.addEventListener("keydown",function(){
	//busqueda estado
	var _query   = this.value.toUpperCase();

	var search_state = aspirants.filter(function (el) {
 	   return (el.state.toUpperCase().indexOf(_query) > -1);
 	}),
	//busqueda ciudad
	search_city = aspirants.filter(function (el) {
		 return (el.city.toUpperCase().indexOf(_query) > -1);
	}),
	search_name = aspirants.filter(function (el) {
		 return (el.name.toUpperCase().indexOf(_query) > -1 || el.surname.toUpperCase().indexOf(_query) > -1 || el.lastname.toUpperCase().indexOf(_query) > -1 );
	}),

  search_words = _query.split(" ");
		console.log(search_state);

	if(search_words.length === 2){
		search_name_sur = aspirants.filter(function (el) {
			 return (el.name.toUpperCase().indexOf(search_words[0]) > -1 && el.surname.toUpperCase().indexOf(search_words[1]) > -1);
		});
	}else if(search_words.length === 3){
		search_name_sur = aspirants.filter(function (el) {
			 return (el.name.toUpperCase().indexOf(search_words[0]) > -1 && el.surname.toUpperCase().indexOf(search_words[1]) > -1 && el.lastname.toUpperCase().indexOf(search_words[2]) > -1);
		});
	}else{
		search_name_sur = [];
	}



 if(search_state && search_city){
	 result = search_1.concat(search_state,search_city,search_name_sur);
 }else if(search_city){
	 result = search_city.concat(search_name,search_name_sur);
 }else{
	 result = search_name.concat(search_name_sur);
 }

	result = result.filter(function (el,index,self){
				return self.indexOf(el)===index;
	});
	render_search(result);
});


//muestra resultados
	function render_search(results){
		var box = document.getElementById("search-results");
		box.innerHTML = '';
		if(results.length>0){
				for (i=0; i<results.length; i++){
					p       = document.createElement('p');
					atag    = document.createElement('a');
					atag.setAttribute('class','selected-search');
					atag.setAttribute('href','');
					newText = document.createTextNode(results[i].state+" "+results[i].city+results[i].name+" "+results[i].surname+" "+results[i].lastname);
					atag.setAttribute('id',results[i].id);
					atag.appendChild(newText);
					atag.addEventListener("click",function(e){
						e.preventDefault();
						var value = this.id;
						changeTable(value);
					});
					p.appendChild(atag);
					box.appendChild(p);
				}
		}else{
			p       = document.createElement('p');
			newText = document.createTextNode("Sin resultados");
			p.appendChild(newText);
			box.appendChild(p);
		}
		box.style.visibility='visible';
  }

//cambia tabla de acuerdo a seleccion de busqueda

 function changeTable(ev){
	 var box = document.getElementById("search-results");
	 box.innerHTML = '';
	 search.value = '';
	 box.style.visibility='hidden';
	 //filtro de aspirantes
 	var n_aspirants = aspirants.filter(function (el) {
 	   return (el.id === parseInt(ev));
 	});

 }
