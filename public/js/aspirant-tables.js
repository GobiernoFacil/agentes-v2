var with_out  = document.getElementById("aspirants_without_proof"),
    rejected  = document.getElementById("rejected_aspirants"),
    already   = document.getElementById("already_aspirants"),
    to_ev     = document.getElementById("aspirants_to_evaluate");

    with_out.addEventListener('click', function(e){
      e.preventDefault();
      render_table(aspirants_without_proof.data);
    });

    rejected.addEventListener('click', function(e){
      e.preventDefault();
      render_table(rejected_proof.data);
    });

    already.addEventListener('click', function(e){
      e.preventDefault();
      render_table(alrady_evaluated.data);
    });

    to_ev.addEventListener('click', function(e){
      e.preventDefault();
      render_table(initial_list.data);
    });

    function render_table(data) {
      table   = document.getElementById('table').getElementsByTagName('tbody')[0];
      $("#body_table tr").remove();
      for (var i = 0; i < data.length; i++) {
        console.log(data[i]);
        var row = table.insertRow(0),
        cell1 = row.insertCell(0),
        cell2 = row.insertCell(1),
        cell3 = row.insertCell(2),
        cell4 = row.insertCell(3),
        cell5 = row.insertCell(4);
        var a = document.createElement('a');
        var textA = document.createTextNode(data[i].name+' '+data[i].surname+' '+data[i].lastname);
            a.appendChild(textA);
            a.href = view_aspirant_url+'/'+data[i].id;
        var h = document.createElement('h4');
            h.appendChild(a);
        var  email  = document.createTextNode(data[i].email);
        cell1.appendChild(h);
        cell1.appendChild(email);
        var br    = document.createElement('br'),
            state = document.createTextNode(data[i].state),
            city  = document.createTextNode(data[i].city),
            strong = document.createElement('strong');
        cell2.appendChild(state);
        cell2.appendChild(br);
        strong.appendChild(city);
        cell2.appendChild(strong);
        var origin = document.createTextNode(data[i].origin);
        cell3.appendChild(origin);
        var br    = document.createElement('br'),
            dateC = new Date(data[i].created_at),
            date  = document.createTextNode(dateC.getDate()+'/'+(dateC.getMonth()+1)+'/'+dateC.getFullYear()),
            hours = document.createTextNode(dateC.getHours()+':'+(dateC.getMinutes()+1)+' hrs');
       cell4.appendChild(date);
       cell4.appendChild(br);
       cell4.appendChild(hours);
       var aView = document.createElement('a'),
           textA = document.createTextNode('Ver ');
           aView.appendChild(textA);
           aView.href = view_aspirant_url+'/'+data[i].id;
           aView.className = "btn xs view";
       var aEvaluate = document.createElement('a'),
           textA = document.createTextNode(' Evaluar');
           aEvaluate.appendChild(textA);
           aEvaluate.href = evaluate_aspirant_url+'/'+data[i].id;
           aEvaluate.className = "btn xs view ev";
      cell5.appendChild(aView);
      cell5.appendChild(aEvaluate);




      }
      $("#table_box").show();

    }
