    /*
     * La maroma del template
     *
     */

var dictionary   = "/data/diccionario.csv",
    cards        = "/data/datos.csv",
    mapColor     = "#20a6e7",
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
    			data: cardAPP.data,
          mounted : function(){
            navAPP.initialize();
          }
    		});

        graphAPP.initialize(cardAPP.data);
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

          //console.log(tabs, divs);

          for(var i = 0; i < tabs.length; i++){
            tabs[i].addEventListener("click", function(e){
              e.preventDefault();

              console.log("meh");

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
    },


    /*
     * La maroma de la gráfica
     *
     */

    Format         = d3.format(".3n"),
    poverty        = "Porcentaje de poblacion en situacion de pobreza",
    extremePoverty = "Porcentaje de población en situación de pobreza extrema",
    mediumPoverty  = "Porcentaje de población en situación de pobreza moderada",
    pieChartID     = "pie-chart",
    stackChartID   = "stack-chart",
    pieColors      = ["#ff7c80", "#fcb6bb"],
    stackMargins   = {top: 20, right: 260, bottom: 0, left: 70},

    graphAPP = {
      initialize : function(data){
        //console.log(data);
        graphAPP.data   = data;
        graphAPP.pov    = _.findWhere(cardAPP.data.values, {name : poverty});
        graphAPP.exPov  = _.findWhere(cardAPP.data.values, {name : extremePoverty});
        graphAPP.medPov = _.findWhere(cardAPP.data.values, {name : mediumPoverty});

        graphAPP.setupPie();
        graphAPP.setupStack(+graphAPP.pov.value * 100, +graphAPP.medPov.value * 100, +graphAPP.exPov.value * 100);
      },

      setupPie : function(){

        var svg    = d3.select("#" + pieChartID),
            width  = +svg.attr("width"),
            height = +svg.attr("height"),
            radius = Math.min(width, height) / 2,
            g      = svg.append("g").attr("transform", "translate(" + width/2 + ", " + height/2 + ")"),
            pov    = graphAPP.pov.value*100,
            notPov = 100-pov,
            color  = d3.scale.ordinal().range(pieColors),
            data   = [pov, notPov],
            pie    = d3.layout.pie().sort(null).value(function(d) { return d; }),
            path   = d3.svg.arc().outerRadius(radius - 10).innerRadius(0),
            label  = d3.svg.arc().outerRadius(radius - 40).innerRadius(radius - 40),
            arc    = g.selectAll(".arc").data(pie(data)).enter().append("g").attr("class", "arc");

        arc.append("path").attr("d", path).attr("fill", function(d){return color(d.data)});
        arc.append("text")
           .attr("transform", function(d) { return "translate(" + label.centroid(d) + ")"; })
           // aquí se definen las propiedades del texto
           .attr("dy", "0.35em")
           .attr("text-anchor", "middle")
           .text(function(d) { return Format(d.data) + '%'; });
      },

      setupStack : function(val1, val2, val3){

        var svg    = d3.select("#" + stackChartID), 
            width  = +svg.attr("width"),
            _width = width - stackMargins.left - stackMargins.right,
            height = +svg.attr("height"),
            range  = height - stackMargins.top - stackMargins.bottom,
            scale  = d3.scale.linear()
                      .domain([0, 100])
                      .range([0, range]),
            // bar1 y bar2, las barritas de color
            bar1   = svg.append("rect")
                      .attr("width", _width)
                      .attr("height", scale(val1))
                      .attr("transform", "translate(" + stackMargins.left +", "+ (range - scale(val1)) + ")")
                      .attr("fill", pieColors[1]),
            bar2   = svg.append("rect")
                      .attr("width", _width)
                      .attr("height", scale(val2))
                      .attr("transform", "translate(" + stackMargins.left +", "+ (range - scale(val2)) + ")")
                      .attr("fill", pieColors[0]),
            // text1 y text2 los valores en porentaje
            text1  = svg.append("text")
                      .attr("transform", "translate(" + (stackMargins.left + (_width/2)) +", "+ (range - scale(val1)- 20) + ")")
                      .attr("dy", "0.35em")
                      .attr("text-anchor", "middle")
                      .attr("style", "fill: black")
                      .text(Format(val3) + '%'),
            text2  = svg.append("text")
                      .attr("transform", "translate(" + (stackMargins.left + (_width/2)) +", "+ (range - scale(val2) + (scale(val2)/2)) + ")")
                      .attr("dy", "0.35em")
                      .attr("text-anchor", "middle")
                      .text(Format(val2) + '%'),

            // text3 y text 4 los letreros de pobreza
            text3  = svg.append("text")
                      .attr("transform", "translate(" + (stackMargins.left + (_width + 15)) +", "+ (range - scale(val1)- 20) + ")")
                      .attr("dy", "0.35em")
                      .attr("style", "fill: black")
                      //.attr("text-anchor", "middle")
                      .text("Pobreza extrema"),
            text4  = svg.append("text")
                      .attr("transform", "translate(" + (stackMargins.left + (_width + 15)) +", "+ (range - scale(val2) + (scale(val2) - 5)) + ")")
                      .attr("dy", "0.35em")
                      //.attr("text-anchor", "middle")
                      .attr("style", "fill: black")
                      .text("Pobreza moderada");

            console.log(val1, val2, val3);

      }
    };


cardAPP.initialize(dictionary, cards);



