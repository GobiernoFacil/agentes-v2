var dictionary = "/data/diccionario.csv",
    cards      = "/data/datos.csv",
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
    			cardAPP.makeSelector(data);
    			cardAPP.makeItems();
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


