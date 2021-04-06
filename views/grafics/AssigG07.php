<div id="AssigG07"></div>
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
        data13 = <?php echo taula_resultats(connection(), "AssigG07", "$edicio", "$pla", "$assignatura"); ?>;
    } else {
        data13 = <?php echo taula_results_tots(connection(), "AssigG07", "$edicio", "$assignatura"); ?>;
    }

    if(<?php echo $grup?> != 0) {
        data13 = <?php echo taula_result_grup(connection(), "AssigG07", "$edicio", "$assignatura", "$grup"); ?>;
    }

    let sourceCount7 = [ 0, 0, 0, 0, 0];
    let totalresults7 = data13.map(function(item) {
        return item['resposta'];
    });

    for (i = 0; i < totalresults7.length; i++) {
        for (j = 0; j < sourceCount7.length; j++) {
            if(data13[i]['resposta'] == prelabels[j]) {
                sourceCount7[j] =  parseInt(data13[i]['totalAlumnes'], 10);
            }
        }
    }

    let data14 = {};
    sourceNames4.forEach((key, i) => data14[key] = sourceCount7[i]);

    // get graf
    let margin7 = {top: 30, right: 30, bottom: 90, left: 60};
    let svgWidth7 = 720, svgHeight7 = 300;
    let height7 = svgHeight7- margin7.top- margin7.bottom, width7 = 370;
    let x7 = d3.scaleBand().rangeRound([0, width7]).padding(0.1),
        y7 = d3.scaleLinear().rangeRound([height7, 0]);


    x7.domain(sourceNames4);
    y7.domain([0, 100]);

    let svg7 = d3.select("#AssigG07").append("svg");
    svg7.attr('height', svgHeight7)
        .attr('width', svgWidth7);

    svg7 = svg7.append("g")
        .attr("transform", "translate(" + margin7.left + "," + margin7.top + ")");

    svg7.append("g")
        .attr("transform", "translate(0," + height7 + ")")
        .call(d3.axisBottom(x7))
        .selectAll("text")
        .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end");

    svg7.append("g")
        .attr("class", "axis axis--y")
        .call(d3.axisLeft(y7).ticks(5))
    ;

    // Create rectangles
    let bars7 = svg7.selectAll('.bar')
        .data(sourceNames4)
        .enter()
        .append("g");

    bars7.append('rect')
        .attr('class', 'bar')
        .attr("x", function(d) { return x7(d); })
        .attr("y", function(d) { return y7(data14[d]); })
        .attr("width", x7.bandwidth())
        .attr("fill", "#69b3a2")
        .attr("height", function(d) { return height7 - y7(data14[d]); });

    bars7.append("text")
        .text(function(d) {
            return data14[d] + "%";
        })
        .attr("x", function(d){
            return x7(d) + x7.bandwidth()/2;
        })
        .attr("y", function(d){
            return y7(data14[d]) - 5;
        })
        .attr("text-anchor", "middle")
        .attr("font-size" , "12px");

</script>