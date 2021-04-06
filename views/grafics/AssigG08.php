<div id="AssigG08"></div>
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
        data15 = <?php echo taula_resultats(connection(), "AssigG08", "$edicio", "$pla", "$assignatura"); ?>;
    } else {
        data15 = <?php echo taula_results_tots(connection(), "AssigG08", "$edicio", "$assignatura"); ?>;
    }

    if(<?php echo $grup?> != 0) {
        data15 = <?php echo taula_result_grup(connection(), "AssigG08", "$edicio", "$assignatura", "$grup"); ?>;
    }

    let sourceCount8 = [ 0, 0, 0, 0, 0];
    let totalresults8 = data15.map(function(item) {
        return item['resposta'];
    });

    for (i = 0; i < totalresults8.length; i++) {
        for (j = 0; j < sourceCount8.length; j++) {
            if(data15[i]['resposta'] == prelabels[j]) {
                sourceCount8[j] =  parseInt(data15[i]['totalAlumnes'], 10);
            }
        }
    }

    let data16 = {};
    sourceNames4.forEach((key, i) => data16[key] = sourceCount8[i]);

    // get graf
    let margin8 = {top: 30, right: 30, bottom: 90, left: 60};
    let svgWidth8 = 720, svgHeight8 = 300;
    let height8 = svgHeight8- margin8.top- margin8.bottom, width8 = 370;
        let x8 = d3.scaleBand().rangeRound([0, width8]).padding(0.1),
        y8 = d3.scaleLinear().rangeRound([height8, 0]);


    x8.domain(sourceNames4);
    y8.domain([0, 100]);

    let svg8 = d3.select("#AssigG08").append("svg");
    svg8.attr('height', svgHeight8)
        .attr('width', svgWidth8);

    svg8 = svg8.append("g")
        .attr("transform", "translate(" + margin8.left + "," + margin8.top + ")");

    svg8.append("g")
        .attr("transform", "translate(0," + height8 + ")")
        .call(d3.axisBottom(x8))
        .selectAll("text")
        .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end");

    svg8.append("g")
        .attr("class", "axis axis--y")
        .call(d3.axisLeft(y8).ticks(5))
    ;

    // Create rectangles
    let bars8 = svg8.selectAll('.bar')
        .data(sourceNames4)
        .enter()
        .append("g");

    bars8.append('rect')
        .attr('class', 'bar')
        .attr("x", function(d) { return x8(d); })
        .attr("y", function(d) { return y8(data16[d]); })
        .attr("width", x8.bandwidth())
        .attr("fill", "#69b3a2")
        .attr("height", function(d) { return height8 - y8(data16[d]); });

    bars8.append("text")
        .text(function(d) {
            return data16[d] + "%";
        })
        .attr("x", function(d){
            return x8(d) + x8.bandwidth()/2;
        })
        .attr("y", function(d){
            return y8(data16[d]) - 5;
        })
        .attr("text-anchor", "middle")
        .attr("font-size" , "12px");

</script>