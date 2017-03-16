var appSearch = {
  initialize: function(config){
    this.searchBox.addEventListener("focus", this._enableKeyUp.bind(this));
    this.searchBox.addEventListener("blur", this._disableKeyUp.bind(this));
    this.searchUrl          = config.search_url;
    this.generalAspirantUrl = config.general_aspirant_url;
    this._token             = config.token;

    document.getElementById("search-input").addEventListener("submit", function(e){
      e.preventDefault();
    });
  },


  searchBox          : document.querySelector("input[name='searchBox']"),



  _enableKeyUp : function(e){
    window.addEventListener("keyup", this._search.bind(this));
  },

  _disableKeyUp : function(e){
    window.removeEventListener("keyup", this._search);
  },

  _clickOption: function(){

  },

  _renderOptions: function(d){
    document.getElementById("List").innerHTML = "";

    for (var i = 0; i < d.length; i++) {
      var tr = document.createElement("tr");
      //Aspirant name
      var a = document.createElement("A");
      a.href = this.generalAspirantUrl+"/"+d[i].id;
      var text = document.createTextNode(d[i].name+' '+d[i].surname+' '+d[i].lastname);
      a.appendChild(text);
      var aspirant = document.createElement("td");
      aspirant.appendChild(a);
      aspirant.appendChild(document.createElement("BR"));
      //Date
      var dat = new Date(d[i].updated_at);
      var dateD = document.createElement("SPAN");
      dateD.className ="note";
      var dateText = document.createTextNode("Actualizado: "+dat.getDate()+"-"+(dat.getMonth()+1)+"-"+dat.getFullYear());
      dateD.appendChild(dateText);
      aspirant.appendChild(dateD);
      var row = document.createElement("td");
      row.className ="row";
      row.appendChild(aspirant);
      // email
      var email = document.createElement("td");
      var emailText = document.createTextNode(d[i].email);
      email.appendChild(emailText);
      //City and State
      var location = document.createElement("td");
      var locationText = document.createTextNode(d[i].city+", "+d[i].state);
      location.appendChild(locationText);
      //Action
      var ac = document.createElement("A");
      ac.className ="btn xs view";
      ac.href = this.generalAspirantUrl+"/"+d[i].id;
      var text = document.createTextNode('Ver');
      ac.appendChild(text);
      tr.appendChild(row);
      tr.appendChild(email);
      tr.appendChild(location);
      tr.appendChild(ac);
      document.getElementById("List").appendChild(tr);
    }
    document.getElementById("boxResults").style.display ="block";
    document.getElementById("aspirants").style.display ="none";
  },

  _makeRequest : function(url){
    var request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.onerror = function() {
    };
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    return request;
  },

  _search : function(e){
    var _query   = this.searchBox.value;
    if(_query.length > 1){
      var type = this.searchBox.id;
      var url = this.searchUrl;
      var request = new this._makeRequest(url),
      that    = this,
      data    = "match=" + _query + "&_token=" + this._token;

      request.onload = function(){
        if (request.status >= 200 && request.status < 400) {
          var d = JSON.parse(request.responseText);
          if(d[0]==='false'){
            document.getElementById("boxResults").style.display ="block";
            document.getElementById("aspirants").style.display ="none";
            var resu = document.getElementById("List");
            resu.innerHTML = '';
            var tr  = document.createElement("tr");
            var not = document.createElement("td");
            var notText = document.createTextNode("No hay resultados");
            not.appendChild(notText);
            tr.appendChild(not);
            resu.appendChild(tr);
          }else{
            that._renderOptions(d);
          }
        } else {
          //console.log("algo falló en la respuesta");
          var resu = document.getElementById("List");
          resu.innerHTML = '';
        }
      };

      request.send(data);
    }
  },

};
