<div id="AssigG09"></div>
<script src="https://d3js.org/d3.v5.min.js"></script>
<script>
    // get data
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
        data17 = <?php echo taula_resultats(connection(), "AssigG09", "$edicio", "$pla", "$assignatura"); ?>;
    } else {
        data17 = <?php echo taula_results_tots(connection(), "AssigG09", "$edicio", "$assignatura"); ?>;
    }

    if(<?php echo $grup?> != 0) {
        data17 = <?php echo taula_result_grup(connection(), "AssigG09", "$edicio", "$assignatura", "$grup"); ?>;
    }

    let sourceCount9 = [ 0, 0, 0, 0, 0];
    let totalresults9 = data17.map(function(item) {
        return item['resposta'];
    });

    for (i = 0; i < totalresults9.length; i++) {
        for (j = 0; j < sourceCount9.length; j++) {
            if(data17[i]['resposta'] == prelabels[j]) {
                sourceCount9[j] =  parseInt(data17[i]['totalAlumnes'], 10);
            }
        }
    }

    let data18 = {};
    sourceNames4.forEach((key, i) => data18[key] = sourceCount9[i]);




    // get graf
    let margin9 = {top: 30, right: 30, bottom: 90, left: 60};
    let svgWidth9 = 720, svgHeight9 = 300;
    let height9 = svgHeight9- margin9.top- margin9.bottom, width9 = 370;
    let x9 = d3.scaleBand().rangeRound([0, width9]).padding(0.1),
        y9 = d3.scaleLinear().rangeRound([height9, 0]);


    x9.domain(sourceNames4);
    y9.domain([0, 100]);

    let svg9 = d3.select("#AssigG09").append("svg");
    svg9.attr('height', svgHeight9)
        .attr('width', svgWidth9);

    svg9 = svg9.append("g")
        .attr("transform", "translate(" + margin9.left + "," + margin9.top + ")");

    svg9.append("g")
        .attr("transform", "translate(0," + height9 + ")")
        .call(d3.axisBottom(x9))
        .selectAll("text")
        .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end");

    svg9.append("g")
        .attr("class", "axis axis--y")
        .call(d3.axisLeft(y9).ticks(5))
    ;

    // Create rectangles
    let bars9 = svg9.selectAll('.bar')
        .data(sourceNames4)
        .enter()
        .append("g");

    bars9.append('rect')
        .attr('class', 'bar')
        .attr("x", function(d) { return x9(d); })
        .attr("y", function(d) { return y9(data18[d]); })
        .attr("width", x9.bandwidth())
        .attr("fill", "#69b3a2")
        .attr("height", function(d) { return height9 - y9(data18[d]); });

    bars9.append("text")
        .text(function(d) {
            return data18[d] + "%";
        })
        .attr("x", function(d){
            return x9(d) + x9.bandwidth()/2;
        })
        .attr("y", function(d){
            return y9(data18[d]) - 5;
        })
        .attr("text-anchor", "middle")
        .attr("font-size" , "12px");

</script>