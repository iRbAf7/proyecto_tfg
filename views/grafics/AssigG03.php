<div id="AssigG03"></div>
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
        data5 = <?php echo taula_resultats(connection(), "AssigG03", "$edicio", "$pla", "$assignatura"); ?>;
    } else {
        data5 = <?php echo taula_results_tots(connection(), "AssigG03", "$edicio", "$assignatura"); ?>;
    }

    if(<?php echo $grup?> != 0) {
        data5 = <?php echo taula_result_grup(connection(), "AssigG03", "$edicio", "$assignatura", "$grup"); ?>;
    }

    let sourceNames3 = [
        '< 2 h',
        '2-4 h',
        '5-7 h',
        '8-10 h',
        '> 10 h'
    ];

    let sourceCount3 = [ 0, 0, 0, 0, 0 ];
    let totalresults2 = data5.map(function(item) {
        return item['resposta'];
    });

    for (i = 0; i < totalresults2.length; i++) {
        for (j = 0; j < sourceCount3.length; j++) {
            if(data5[i]['resposta'] == sourceNames3[j]) {
                sourceCount3[j] =  parseInt(data5[i]['totalAlumnes'], 10);
            }
        }
    }

    let data6 = {};
    sourceNames3.forEach((key, i) => data6[key] = sourceCount3[i]);

    // get graf
    let margin3 = {top: 30, right: 30, bottom: 60, left: 60};
    let svgWidth3 = 720, svgHeight3 = 300;
    let height3 = svgHeight3- margin3.top- margin3.bottom, width3 = 370;
    let x3 = d3.scaleBand().rangeRound([0, width3]).padding(0.1),
        y3 = d3.scaleLinear().rangeRound([height3, 0]);


    x3.domain(sourceNames3);
    y3.domain([0, 100]);

    let svg3 = d3.select("#AssigG03").append("svg");
    svg3.attr('height', svgHeight3)
        .attr('width', svgWidth3);

    svg3 = svg3.append("g")
        .attr("transform", "translate(" + margin3.left + "," + margin3.top + ")");

    svg3.append("g")
        .attr("transform", "translate(0," + height3 + ")")
        .call(d3.axisBottom(x3))
        .selectAll("text")
        .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end");

    svg3.append("g")
        .attr("class", "axis axis--y")
        .call(d3.axisLeft(y3).ticks(5))
    ;

    // Create rectangles
    let bars3 = svg3.selectAll('.bar')
        .data(sourceNames3)
        .enter()
        .append("g");

    bars3.append('rect')
        .attr('class', 'bar')
        .attr("x", function(d) { return x3(d); })
        .attr("y", function(d) { return y3(data6[d]); })
        .attr("width", x3.bandwidth())
        .attr("fill", "#69b3a2")
        .attr("height", function(d) { return height3 - y3(data6[d]); });

    bars3.append("text")
        .text(function(d) {
            return data6[d] + "%";
        })
        .attr("x", function(d){
            return x3(d) + x3.bandwidth()/2;
        })
        .attr("y", function(d){
            return y3(data6[d]) - 5;
        })
        .attr("text-anchor", "middle")
        .attr("font-size" , "12px");

</script>