<div id="AssigG05"></div>
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
        data9 = <?php echo taula_resultats(connection(), "AssigG05", "$edicio", "$pla", "$assignatura"); ?>;
    } else {
        data9 = <?php echo taula_results_tots(connection(), "AssigG05", "$edicio", "$assignatura"); ?>;
    }

    if(<?php echo $grup?> != 0) {
        data9 = <?php echo taula_result_grup(connection(), "AssigG05", "$edicio", "$assignatura", "$grup"); ?>;
    }

    let sourceCount5 = [ 0, 0, 0, 0, 0];
    let totalresults4 = data9.map(function(item) {
        return item['resposta'];
    });

    for (i = 0; i < totalresults4.length; i++) {
        for (j = 0; j < sourceCount5.length; j++) {
            if(data9[i]['resposta'] == prelabels[j]) {
                sourceCount5[j] =  parseInt(data9[i]['totalAlumnes'], 10);
            }
        }
    }

    let data10 = {};
    sourceNames4.forEach((key, i) => data10[key] = sourceCount5[i]);

    // get graf
    let margin5 = {top: 30, right: 30, bottom: 90, left: 60};
    let svgWidth5 = 720, svgHeight5 = 300;
    let height5 = svgHeight5- margin5.top- margin5.bottom, width5 = 370;
    let x5 = d3.scaleBand().rangeRound([0, width5]).padding(0.1),
        y5 = d3.scaleLinear().rangeRound([height5, 0]);


    x5.domain(sourceNames4);
    y5.domain([0, 100]);

    let svg5 = d3.select("#AssigG05").append("svg");
    svg5.attr('height', svgHeight5)
        .attr('width', svgWidth5);

    svg5 = svg5.append("g")
        .attr("transform", "translate(" + margin5.left + "," + margin5.top + ")");

    svg5.append("g")
        .attr("transform", "translate(0," + height5 + ")")
        .call(d3.axisBottom(x5))
        .selectAll("text")
        .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end");

    svg5.append("g")
        .attr("class", "axis axis--y")
        .call(d3.axisLeft(y5).ticks(5))
    ;

    // Create rectangles
    let bars5 = svg5.selectAll('.bar')
        .data(sourceNames4)
        .enter()
        .append("g");

    bars5.append('rect')
        .attr('class', 'bar')
        .attr("x", function(d) { return x5(d); })
        .attr("y", function(d) { return y5(data10[d]); })
        .attr("width", x5.bandwidth())
        .attr("fill", "#69b3a2")
        .attr("height", function(d) { return height5 - y5(data10[d]); });

    bars5.append("text")
        .text(function(d) {
            return data10[d] + "%";
        })
        .attr("x", function(d){
            return x5(d) + x5.bandwidth()/2;
        })
        .attr("y", function(d){
            return y5(data10[d]) - 5;
        })
        .attr("text-anchor", "middle")
        .attr("font-size" , "12px");

</script>