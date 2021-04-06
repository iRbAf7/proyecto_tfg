<div id="AssigG01"></div>
<script type="text/javascript" src="https://mbostock.github.com/d3/d3.js?2.1.3"></script>
<script src="https://d3js.org/d3.v4.js"></script>
<script>

    var w = 300,                        //width
        h = 300,                            //height
        r = 130;                            //radius

    var color = d3.scaleOrdinal()
        .range(["#69B3A2", "#A0EBD9"]);



    <?php
    require_once("models/connection.php");
    require_once("models/taula_resultats.php");
    require_once("models/taula_result_grup.php");
    require_once("models/taula_results_tots.php");

    $edicio = $_GET['ed'];
    $pla = $_GET['pla'];
    $assignatura = $_GET['as'];
    $grup = $_SESSION['grup'];

    if($grup == NULL) {
        $grup = 0;
    }

    ?>
    // si el pla es tots el valor de pla es 0
    if(<?php echo $pla?> != 0) {
        data0 = <?php echo taula_resultats(connection(), "AssigG01", "$edicio", "$pla", "$assignatura"); ?>;
    } else {
        data0 = <?php echo taula_results_tots(connection(), "AssigG01", "$edicio", "$assignatura"); ?>;
    }

    if(<?php echo $grup?> != 0) {
        data0 = <?php echo taula_result_grup(connection(), "AssigG01", "$edicio", "$assignatura", "$grup"); ?>;
    }

    let sourceCountSiNo = [ 0, 0 ];
    let totalresultsSiNo = data0.map(function(item) {
        return item['resposta'];
    });

    cat = ['SI', 'NO'];
    ang = ['YES', 'DO NOT'];
    for (i = 0; i < totalresultsSiNo.length; i++) {
        for (j = 0; j < sourceCountSiNo.length; j++) {
            if(data0[i]['resposta'] == cat[j]) {
                sourceCountSiNo[j] +=  parseInt(data0[i]['totalAlumnes'], 10);
            }
        }
    }
    for (i = 0; i < totalresultsSiNo.length; i++) {
        for (j = 0; j < sourceCountSiNo.length; j++) {
            if(data0[i]['resposta'] == ang[j]) {
                sourceCountSiNo[j] +=  parseInt(data0[i]['totalAlumnes'], 10);
            }
        }
    }

    if(sourceCountSiNo[1] == 0) {
        data = [
            {
                "resposta": "Si",
                "totalAlumnes": sourceCountSiNo[0]
            }
        ];
    } else {
        data = [
            {
                "resposta": "Si",
                "totalAlumnes": sourceCountSiNo[0]
            },
            {
                "resposta": "No",
                "totalAlumnes": sourceCountSiNo[1]
            }
        ];
    }

    var vis = d3.select("#AssigG01")
        .append("svg:svg")              //create the SVG element inside the <body>
        .data([data])                   //associate our data with the document
        .attr("width", w)           //set the width and height of our visualization (these will be attributes of the <svg> tag
        .attr("height", h)
        .append("svg:g")                //make a group to hold our pie chart
        .attr("transform", "translate(" + r + "," + r + ")");   //move the center of the pie chart from 0, 0 to radius, radius

    var arc = d3.svg.arc()              //this will create <path> elements for us using arc data
        .outerRadius(r);

    var pie = d3.layout.pie()           //this will create arc data for us given a list of values
        .value(function(d) { return d.totalAlumnes; });    //we must tell it out to access the value of each element in our data array

    var arcs = vis.selectAll("g.slice")     //this selects all <g> elements with class slice (there aren't any yet)
        .data(pie)                          //associate the generated pie data (an array of arcs, each having startAngle, endAngle and value properties)
        .enter()                            //this will create <g> elements for every "extra" data element that should be associated with a selection. The result is creating a <g> for every object in the data array
        .append("svg:g")                //create a group to hold each slice (we will have a <path> and a <text> element associated with each slice)
        .attr("class", "slice");    //allow us to style things in the slices (like text)

    arcs.append("svg:path")
        .attr("fill", function(d, i) { return color(i); } ) //set the color for each slice to be chosen from the color function defined above
        .attr("d", arc);                                    //this creates the actual SVG path using the associated data (pie) with the arc drawing function

    arcs.append("svg:text")                                     //add a label to each slice
        .attr("transform", function(d) {                    //set the label's origin to the center of the arc
            //we have to make sure to set these before calling arc.centroid
            d.innerRadius = 0;
            d.outerRadius = r;
            return "translate(" + arc.centroid(d) + ")";        //this gives us a pair of coordinates like [50, 50]
        })
        .attr("text-anchor", "middle")                          //center the text on it's origin
        .text(function(d, i) { return data[i].resposta + "-" +  data[i].totalAlumnes + "%"; });        //get the label from our original data array



</script>