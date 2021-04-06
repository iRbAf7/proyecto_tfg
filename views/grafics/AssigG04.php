<div id="AssigG04"></div>
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
        data8 = <?php echo taula_resultats(connection(), "AssigG04", "$edicio", "$pla", "$assignatura"); ?>;
    } else {
        data8 = <?php echo taula_results_tots(connection(), "AssigG04", "$edicio", "$assignatura"); ?>;
    }

    if(<?php echo $grup?> != 0) {
        data8 = <?php echo taula_result_grup(connection(), "AssigG04", "$edicio", "$assignatura", "$grup"); ?>;
    }

    let prelabels = [0, 1, 2, 3, 4];
    let sourceNames4 = ["Molt desacord", "Desacord", "Indiferent", "D'acord", "Molt d'acord"];

    let sourceCount4 = [ 0, 0, 0, 0, 0];
    let totalresults3 = data8.map(function(item) {
        return item['resposta'];
    });

    for (i = 0; i < totalresults3.length; i++) {
        for (j = 0; j < sourceCount4.length; j++) {
            if(data8[i]['resposta'] == prelabels[j]) {
                sourceCount4[j] =  parseInt(data8[i]['totalAlumnes'], 10);
            }
        }
    }

    let data7 = {};
    sourceNames4.forEach((key, i) => data7[key] = sourceCount4[i]);

    // get graf
    let margin4 = {top: 30, right: 30, bottom: 90, left: 60};
    let svgWidth4 = 720, svgHeight4 = 300;
    let height4 = svgHeight4- margin4.top- margin4.bottom, width4 = 370;
    let x4 = d3.scaleBand().rangeRound([0, width4]).padding(0.1),
        y4 = d3.scaleLinear().rangeRound([height4, 0]);


    x4.domain(sourceNames4);
    y4.domain([0, 100]);

    let svg4 = d3.select("#AssigG04").append("svg");
    svg4.attr('height', svgHeight4)
        .attr('width', svgWidth4);

    svg4 = svg4.append("g")
        .attr("transform", "translate(" + margin4.left + "," + margin4.top + ")");

    svg4.append("g")
        .attr("transform", "translate(0," + height4 + ")")
        .call(d3.axisBottom(x4))
        .selectAll("text")
        .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end");

    svg4.append("g")
        .attr("class", "axis axis--y")
        .call(d3.axisLeft(y4).ticks(5))
    ;

    // Create rectangles
    let bars4 = svg4.selectAll('.bar')
        .data(sourceNames4)
        .enter()
        .append("g");

    bars4.append('rect')
        .attr('class', 'bar')
        .attr("x", function(d) { return x4(d); })
        .attr("y", function(d) { return y4(data7[d]); })
        .attr("width", x4.bandwidth())
        .attr("fill", "#69b3a2")
        .attr("height", function(d) { return height4 - y4(data7[d]); });

    bars4.append("text")
        .text(function(d) {
            return data7[d] + "%";
        })
        .attr("x", function(d){
            return x4(d) + x4.bandwidth()/2;
        })
        .attr("y", function(d){
            return y4(data7[d]) - 5;
        })
        .attr("text-anchor", "middle")
        .attr("font-size" , "12px");

</script>