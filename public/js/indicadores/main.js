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
    };


cardAPP.initialize(dictionary, cards);


