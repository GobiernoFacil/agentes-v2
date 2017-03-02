// BIG MAP APP
//
//
//

/*
 * [ V A R   D E F I N I T I O N ]
 * --------------------------------------------------------------------------------
 *
 *
 */

var appPNUD = {

  // los settings del mapa
  mapSettings : {
    div  : "map", // el id del div que contendrá el mapa
    lat  : 22.442167,
    lng  : -100.110350,
    scrollWheelZoom: false,
    zoom : 5,
    ///mapbox
	id      : 'mapbox.satellite',
	baseURL : 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=',
	token   : "", // no vino
	attribution_m : 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="http://mapbox.com">Mapbox</a>',
	//openstreemap
	osmapURL: 'http://korona.geog.uni-heidelberg.de/tiles/roads/x={x}&y={y}&z={z}', 
	attribution: 'Imagery from <a href="http://giscience.uni-hd.de/">GIScience Research Group @ University of Heidelberg</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'

  },
  // el CSS para cada estado
  stateStyle : {
    weight      : 1,
    opacity     : 0.9,
    color       : '#fff',
    fillOpacity : 0.7,         
    fillColor	: "#f15c44"
  },

  stateHoverStyle : {
	opacity     : 0.8,  
    fillOpacity : 0.9,
  },
  // se inician variables internas
  map          : null, // el mapa de leaflet
  states       : null, // un array con los estados
  brew         : null, // el objeto de color
  index        : null, // el indicador seleccionado
  year         : null, // el año seleccionado
  // las opciones del objeto de color
  brewSettings : {
    colorNum : 6, // el número de colores
    colorKey : 2,///22,//17,// 12, // la clave de color (BREW_COLORS)
    classify : "jenks" // el método para hacer la separación de color. Sepa :P
  },
  states_array : [], // el array con objetos, datos y geometrías.
  
  //
  // [ La función de inicio ]
  //
  initialize : function(estados){
    // se obtiene una referencia al appPNUD, para usarla dentro de las funciones de este método
    var that = this;
    // se crea el mapa de leaflet
    this.map = L.map(this.mapSettings.div,{scrollWheelZoom: this.mapSettings.scrollWheelZoom}).setView([
      this.mapSettings.lat, 
      this.mapSettings.lng
    ],this.mapSettings.zoom),
    /// O___o+
    /*
    L.tileLayer(this.mapSettings.baseURL + this.mapSettings.token, { id : this.mapSettings.id, 
	    attribution: this.mapSettings.attribution_m}).addTo(that.map);*/
	 L.tileLayer(this.mapSettings.osmapURL , { 
	    attribution: this.mapSettings.attribution}).addTo(that.map);    
	    

    // se carga el gejson de los estados
    d3.json(estados, function(error, json){
      // ya que cargó el geojson de los estados, configura algunas variables internas
      that.setStates(json);      
    });
  },

  // [ setStates --- COMENTAR DESPÚES ]
  //
  //
  setStates : function(estados){
    var that = this;
    this.states = L.geoJson(estados, {
      style         : this.stateStyle,
      onEachFeature : function(feature, layer) {
        that.states_array.push({
          id      : feature.properties.id,
          feature : feature,
          layer   : layer
        });

        layer.on({
          mouseover : function(){
            var stateName   = feature.properties.name,
                title       = that.panel._container.querySelector("h3"),
                current     = that.index.filter(function(d){
                  return that.year == d.year;
                })[0],
                val = feature.properties.data[current.key];
                
            layer.setStyle(that.stateHoverStyle);
            that.updateInfoPanel();
            that.updateInfoPanelState(stateName, val);
          },

          mouseout  : function(){
            var   title       = that.panel._container.querySelector("h3");
            
            layer.setStyle(that.stateStyle);
            title.innerHTML  = "";
          },
          //click     : this.zoomToFeature.bind(this)
        });
      },
    }).addTo(this.map);
  },



};

// INICIA EL MAPA
appPNUD.initialize("/js/json/estados.json");

