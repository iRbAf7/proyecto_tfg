<div id="AssigG06"></div>
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
        data11 = <?php echo taula_resultats(connection(), "AssigG06", "$edicio", "$pla", "$assignatura"); ?>;
    } else {
        data11 = <?php echo taula_results_tots(connection(), "AssigG06", "$edicio", "$assignatura"); ?>;
    }

    if(<?php echo $grup?> != 0) {
        data11 = <?php echo taula_result_grup(connection(), "AssigG06", "$edicio", "$assignatura", "$grup"); ?>;
    }

    let sourceCount6 = [ 0, 0, 0, 0, 0];
    let totalresults5 = data11.map(function(item) {
        return item['resposta'];
    });

    for (i = 0; i < totalresults5.length; i++) {
        for (j = 0; j < sourceCount6.length; j++) {
            if(data11[i]['resposta'] == prelabels[j]) {
                sourceCount6[j] =  parseInt(data11[i]['totalAlumnes'], 10);
            }
        }
    }

    let data12 = {};
    sourceNames4.forEach((key, i) => data12[key] = sourceCount6[i]);

    // get graf
    let margin6 = {top: 30, right: 30, bottom: 90, left: 60};
    let svgWidth6 = 720, svgHeight6 = 300;
    let height6 = svgHeight6- margin6.top- margin6.bottom, width6 = 370;
    let x6 = d3.scaleBand().rangeRound([0, width6]).padding(0.1),
        y6 = d3.scaleLinear().rangeRound([height6, 0]);


    x6.domain(sourceNames4);
    y6.domain([0, 100]);

    let svg6 = d3.select("#AssigG06").append("svg");
    svg6.attr('height', svgHeight6)
        .attr('width', svgWidth6);

    svg6 = svg6.append("g")
        .attr("transform", "translate(" + margin6.left + "," + margin6.top + ")");

    svg6.append("g")
        .attr("transform", "translate(0," + height6 + ")")
        .call(d3.axisBottom(x6))
        .selectAll("text")
        .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end");

    svg6.append("g")
        .attr("class", "axis axis--y")
        .call(d3.axisLeft(y6).ticks(5))
    ;

    // Create rectangles
    let bars6 = svg6.selectAll('.bar')
        .data(sourceNames4)
        .enter()
        .append("g");

    bars6.append('rect')
        .attr('class', 'bar')
        .attr("x", function(d) { return x6(d); })
        .attr("y", function(d) { return y6(data12[d]); })
        .attr("width", x6.bandwidth())
        .attr("fill", "#69b3a2")
        .attr("height", function(d) { return height6 - y6(data12[d]); });

    bars6.append("text")
        .text(function(d) {
            return data12[d] + "%";
        })
        .attr("x", function(d){
            return x6(d) + x6.bandwidth()/2;
        })
        .attr("y", function(d){
            return y6(data12[d]) - 5;
        })
        .attr("text-anchor", "middle")
        .attr("font-size" , "12px");

</script>