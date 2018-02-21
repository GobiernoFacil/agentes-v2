var dictionary   = "/data/diccionario.csv",
    cards        = "/data/datos.csv",
    mapColor     = "grey",
    stateUrlToId = [
      {estado : "campeche",idLocal : "1", id : "04"},
      {estado : "chihuahua",idLocal : null, id : "08"},
      {estado : "durango",idLocal : "2", id : "10"},
      {estado : "estado-de-mexico",idLocal : "4", id : "15"},
      {estado : "guanajuato",idLocal : "3", id : "11"},
      {estado : "morelos",idLocal : null, id : "17"},
      {estado : "nuevo-leon",idLocal : null, id : "19"},
      {estado : "oaxaca",idLocal : null, id : "20"},
      {estado : "quintana-roo",idLocal : "5", id : "23"},
      {estado : "san-luis-potosi",idLocal : "6", id : "24"},
      {estado : "sinaloa",idLocal : "7", id : "25"},
      {estado : "sonora",idLocal : null, id : "26"},
      {estado : "tabasco",idLocal : "8", id : "27"},
      {estado : "tlaxcala",idLocal : "9", id : "29"},
      {estado : "veracruz",idLocal : "10", id : "30"},
    ],
    currentID  = _.findWhere(stateUrlToId, {estado : currentState}).idLocal,
    currentLoc = _.findWhere(stateUrlToId, {estado : currentState}).id,
    nationalID = "11",
    container  = "card-selector-app-container",
    selector   = "card-selector-app-select",
    cardAPP    = {
    	dictionary : null,
    	cards : null,
    	data : null,
    	vueTemplate : null,
    	initialize : function(dictionary, cards){
    		cardAPP.getDictionary(dictionary, cards);
        cardAPP.colorizeMap();
    	}, 

      colorizeMap : function(){
        var geom = document.getElementById(currentLoc);
        geom.style.fill = mapColor;
      },

    	getDictionary : function(dictionary, cards){
    		d3.csv(dictionary, function(error, data){
    			cardAPP.dictionary = data;
    			cardAPP.getCards(cards);
    		});
    	},

    	getCards : function(cards){
    		d3.csv(cards, function(error, data){
    			cardAPP.cards = data;
    			// cardAPP.makeSelector(data);
    			cardAPP.makeItems(currentID);
    		});
    	},

    	makeItems : function(id){

    		var current  = id || "1",
    		    row      = _.findWhere(cardAPP.cards, {ID : current}),
    		    national = _.findWhere(cardAPP.cards, {ID : nationalID}),
    		    item     = {};

    		item.state  = row.Estado;
    		item.values = cardAPP.dictionary.map(function(el){
    			return {
    				name : el.Nombre,
    				source : el.Fuente,
    				value : row[el.ID],
    				national : national[el.ID],
    				year : el["Año"]
    			};
    		});

    		cardAPP.data = item;

    		if(!cardAPP.vueTemplate){
    			cardAPP.renderCard();
    		}
    		else{

    			cardAPP.vueTemplate.state = item.state;
    			cardAPP.vueTemplate.values = item.values;
    		}
    		
    	},

    	makeSelector : function(cards){

    		var select = document.getElementById(selector);

    		cards.forEach(function(card){
    			if(!card.Estado || card.ID == nationalID) return;

    			var option = document.createElement("option");
    			option.innerHTML = card.Estado;
    			option.value = card.ID;

    			select.appendChild(option);
    		});

    		select.addEventListener("change", function(e){
    			e.target.value
    			cardAPP.makeItems(e.target.value);
    		});
    	},

    	renderCard : function(){
    		cardAPP.vueTemplate =  new Vue({
    			el: '#' + container,
    			data: cardAPP.data
    		});

    	}
    },

    /*
     * La maroma de la navegación por tabs 
     *
     */

    activeClass        = "active",
    mainTabClass       = "main-tab",
    secondTabClass     = "second-tab",
    mainContentClass   = "main-docker",
    secondContentClass = "second-docker",
    navAPP = {
        initialize : function(){
          navAPP.enableTabs(mainTabClass, mainContentClass);
          navAPP.enableTabs(secondTabClass, secondContentClass);
        },

        enableTabs : function(tclass, cclass){
          var tabs = document.querySelectorAll("." + tclass),
              divs = document.querySelectorAll("." + cclass);

          for(var i = 0; i < tabs.length; i++){
            tabs[i].addEventListener("click", function(e){
              e.preventDefault();
              var _div = e.target.getAttribute("data-container"),
                   div = document.getElementById(_div);

              navAPP._removeActiveClass(tabs);
              e.target.classList.add(activeClass);

              navAPP._hideItems(divs);
              div.style.display = "block";
            });
          }
        },

        _removeActiveClass : function(items){
          for(var j = 0; j < items.length; j++){
            items[j].classList.remove(activeClass);
          }
        },

        _hideItems : function(items){
          for(var j = 0; j < items.length; j++){
            items[j].style.display = "none";
          }
        }
    }


cardAPP.initialize(dictionary, cards);
navAPP.initialize();


