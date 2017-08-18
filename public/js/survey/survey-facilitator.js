var svg = d3.select("#fac_1"),
		svg2 = d3.select("#fac_2"),
		svg3 = d3.select("#fac_3"),
		svg4 = d3.select("#fac_4"),
		svg5 = d3.select("#fac_5"),
		svg6 = d3.select("#fac_6"),
		svg9 = d3.select("#fac_9"),
    margin = {top: 50, right: 40, bottom: 30, left: 40},
    width = +svg.attr("width") - margin.left - margin.right,
    height = +svg.attr("height") - margin.top - margin.bottom,
		aspect = width / height;

var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
    y = d3.scaleLinear().rangeRound([height, 0]);

		var tool_tip = d3.tip()
	       .attr("class", "d3-tip")
	       .offset([-8, 0])
	       .html(function(d) { return "Total: " + d.values +"</br>"+ ((d.values*100)/total) +"%" });
	     svg.call(tool_tip);
			 svg2.call(tool_tip);
			 svg3.call(tool_tip);
			 svg4.call(tool_tip);
			 svg5.call(tool_tip);
			 svg6.call(tool_tip);
			 svg9.call(tool_tip);

var g = svg.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

		d3.select(window)
			  .on("resize", function() {
			    var targetWidth = svg.node().getBoundingClientRect().width;
			    svg.attr("width", targetWidth);
			    svg.attr("height", targetWidth / aspect);
			  });
		d3.csv(url_1, function(error, data) {
		  if (error) throw error;

		  // format the data
		  data.forEach(function(d) {
		    d.values = +d.values;
		  });

		  // Scale the range of the data in the domains
		  x.domain(data.map(function(d) { return d.options; }));
		  y.domain([0, d3.max(data, function(d) { return d.values; })]);

		  // append the rectangles for the bar chart
		  svg.selectAll(".bar")
		      .data(data)
		    .enter().append("rect")
		      .attr("class", "bar")
		      .attr("x", function(d) { return x(d.options); })
		      .attr("width", x.bandwidth())
		      .attr("y", function(d) { return y(d.values); })
		      .attr("height", function(d) { return height - y(d.values); })
					.on('mouseover', tool_tip.show)
      	  .on('mouseout', tool_tip.hide);

		  // add the x Axis
		  svg.append("g")
		      .attr("transform", "translate(0," + height + ")")
		      .call(d3.axisBottom(x));

		  // add the y Axis
		  svg.append("g")
		      .call(d3.axisLeft(y));

		});
		var g = svg2.append("g")
				 .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
		d3.csv(url_2, function(error, data) {
		  if (error) throw error;

		  // format the data
		  data.forEach(function(d) {
		    d.values = +d.values;
		  });

		  // Scale the range of the data in the domains
		  x.domain(data.map(function(d) { return d.options; }));
		  y.domain([0, d3.max(data, function(d) { return d.values; })]);

		  // append the rectangles for the bar chart
		  svg2.selectAll(".bar")
		      .data(data)
		    .enter().append("rect")
		      .attr("class", "bar")
		      .attr("x", function(d) { return x(d.options); })
		      .attr("width", x.bandwidth())
		      .attr("y", function(d) { return y(d.values); })
		      .attr("height", function(d) { return height - y(d.values); })
					.on('mouseover', tool_tip.show)
      	  .on('mouseout', tool_tip.hide);

		  // add the x Axis
		  svg2.append("g")
		      .attr("transform", "translate(0," + height + ")")
		      .call(d3.axisBottom(x));

		  // add the y Axis
		  svg2.append("g")
		      .call(d3.axisLeft(y));

		});


		var g = svg3.append("g")
		 .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

		d3.csv(url_3, function(error, data) {
		  if (error) throw error;

		  // format the data
		  data.forEach(function(d) {
		    d.values = +d.values;
		  });

		  // Scale the range of the data in the domains
		  x.domain(data.map(function(d) { return d.options; }));
		  y.domain([0, d3.max(data, function(d) { return d.values; })]);

		  // append the rectangles for the bar chart
		  svg3.selectAll(".bar")
		      .data(data)
		    .enter().append("rect")
		      .attr("class", "bar")
		      .attr("x", function(d) { return x(d.options); })
		      .attr("width", x.bandwidth())
		      .attr("y", function(d) { return y(d.values); })
		      .attr("height", function(d) { return height - y(d.values); })
					.on('mouseover', tool_tip.show)
      	  .on('mouseout', tool_tip.hide);

		  // add the x Axis
		  svg3.append("g")
		      .attr("transform", "translate(0," + height + ")")
		      .call(d3.axisBottom(x));

		  // add the y Axis
		  svg3.append("g")
		      .call(d3.axisLeft(y));

		});

		var g = svg4.append("g")
		 .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

		d3.csv(url_4, function(error, data) {
		  if (error) throw error;

		  // format the data
		  data.forEach(function(d) {
		    d.values = +d.values;
		  });

		  // Scale the range of the data in the domains
		  x.domain(data.map(function(d) { return d.options; }));
		  y.domain([0, d3.max(data, function(d) { return d.values; })]);

		  // append the rectangles for the bar chart
		  svg4.selectAll(".bar")
		      .data(data)
		    .enter().append("rect")
		      .attr("class", "bar")
		      .attr("x", function(d) { return x(d.options); })
		      .attr("width", x.bandwidth())
		      .attr("y", function(d) { return y(d.values); })
		      .attr("height", function(d) { return height - y(d.values); })
					.on('mouseover', tool_tip.show)
      	  .on('mouseout', tool_tip.hide);

		  // add the x Axis
		  svg4.append("g")
		      .attr("transform", "translate(0," + height + ")")
		      .call(d3.axisBottom(x));

		  // add the y Axis
		  svg4.append("g")
		      .call(d3.axisLeft(y));

		});


		var g = svg5.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

		d3.csv(url_5, function(error, data) {
			if (error) throw error;

			// format the data
			data.forEach(function(d) {
				d.values = +d.values;
			});

			// Scale the range of the data in the domains
			x.domain(data.map(function(d) { return d.options; }));
			y.domain([0, d3.max(data, function(d) { return d.values; })]);

			// append the rectangles for the bar chart
			svg5.selectAll(".bar")
					.data(data)
				.enter().append("rect")
					.attr("class", "bar")
					.attr("x", function(d) { return x(d.options); })
					.attr("width", x.bandwidth())
					.attr("y", function(d) { return y(d.values); })
					.attr("height", function(d) { return height - y(d.values); })
					.on('mouseover', tool_tip.show)
      	  .on('mouseout', tool_tip.hide);

			// add the x Axis
			svg5.append("g")
					.attr("transform", "translate(0," + height + ")")
					.call(d3.axisBottom(x));

			// add the y Axis
			svg5.append("g")
					.call(d3.axisLeft(y));

		});

		var g = svg6.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
		d3.csv(url_6, function(error, data) {
			if (error) throw error;

			// format the data
			data.forEach(function(d) {
				d.values = +d.values;
			});

			// Scale the range of the data in the domains
			x.domain(data.map(function(d) { return d.options; }));
			y.domain([0, d3.max(data, function(d) { return d.values; })]);

			// append the rectangles for the bar chart
			svg6.selectAll(".bar")
					.data(data)
				.enter().append("rect")
					.attr("class", "bar")
					.attr("x", function(d) { return x(d.options); })
					.attr("width", x.bandwidth())
					.attr("y", function(d) { return y(d.values); })
					.attr("height", function(d) { return height - y(d.values); })
					.on('mouseover', tool_tip.show)
      	  .on('mouseout', tool_tip.hide);

			// add the x Axis
			svg6.append("g")
					.attr("transform", "translate(0," + height + ")")
					.call(d3.axisBottom(x));

			// add the y Axis
			svg6.append("g")
					.call(d3.axisLeft(y));

		});


		var g = svg9.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
		d3.csv(url_9, function(error, data) {
			if (error) throw error;

			// format the data
			data.forEach(function(d) {
				d.values = +d.values;
			});

			// Scale the range of the data in the domains
			x.domain(data.map(function(d) { return d.options; }));
			y.domain([0, d3.max(data, function(d) { return d.values; })]);

			// append the rectangles for the bar chart
			svg9.selectAll(".bar")
					.data(data)
				.enter().append("rect")
					.attr("class", "bar")
					.attr("x", function(d) { return x(d.options); })
					.attr("width", x.bandwidth())
					.attr("y", function(d) { return y(d.values); })
					.attr("height", function(d) { return height - y(d.values); })
					.on('mouseover', tool_tip.show)
      	  .on('mouseout', tool_tip.hide);

			// add the x Axis
			svg9.append("g")
					.attr("transform", "translate(0," + height + ")")
					.call(d3.axisBottom(x));


			// add the y Axis
			svg9.append("g")
					.call(d3.axisLeft(y));
		});
