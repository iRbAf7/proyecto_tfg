<div id="AssigG02"></div>
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

    ?>//ffalta añadir una opcion para cuando entra con def=ninguno y ambito=basico/total
    // si el pla es tots el valor de pla es 0
    if(<?php echo $pla?> != 0) {
        data3 = <?php echo taula_resultats(connection(), "AssigG02", "$edicio", "$pla", "$assignatura"); ?>;
    } else {
        data3 = <?php echo taula_results_tots(connection(), "AssigG02", "$edicio", "$assignatura"); ?>;
    }

    if(<?php echo $grup?> != 0) {
        data3 = <?php echo taula_result_grup(connection(), "AssigG02", "$edicio", "$assignatura", "$grup"); ?>;
    }

    let sourceNames2 = [
        'Pràcticament nul·la (<25%)',
        'Baixa (25-50%)',
        'Relativament alta (51-75%)',
        'Pràcticament total (>75%)'
    ];

    let sourceCount2 = [ 0, 0, 0, 0 ];
    let totalresults = data3.map(function(item) {
        return item['resposta'];
    });

    console.log(data3);
    console.log(totalresults);
    cat = [
        'Pràcticament nul·la (<25%)',
        'Baixa (25-50%)',
        'Relativament alta (51-75%)',
        'Pràcticament total (>75%)'
    ];
    es = [
        'Prácticamente nula (<25%)',
        'Baja (25-50%)',
        'Relativamente alta (51-75%)',
        'Prácticamente total (>75%)',
    ];
    ang = [
        'Practically non-existing (<25%)',
        'Low (25-50%)',
        'Relatively high (51-75%)',
        'Almost complete (>75%)',
    ];

    for (i = 0; i < totalresults.length; i++) {
        for (j = 0; j < sourceCount2.length; j++) {
            if(data3[i]['resposta'] == cat[j]) {
                sourceCount2[j] +=  parseInt(data3[i]['totalAlumnes'], 10);
            }
        }
    }

    console.log(sourceCount2);

    for (i = 0; i < totalresults.length; i++) {
        for (j = 0; j < sourceCount2.length; j++) {
            if(data3[i]['resposta'] == es[j]) {
                sourceCount2[j] +=  parseInt(data3[i]['totalAlumnes'], 10);
            }
        }
    }

    for (i = 0; i < totalresults.length; i++) {
        for (j = 0; j < sourceCount2.length; j++) {
            if(data3[i]['resposta'] == ang[j]) {
                sourceCount2[j] +=  parseInt(data3[i]['totalAlumnes'], 10);
            }
        }
    }

    let data4 = {};
    sourceNames2.forEach((key, i) => data4[key] = sourceCount2[i]);

    // get graf
    let margin2 = {top: 30, right: 30, bottom: 100, left: 60};
    let svgWidth2 = 720, svgHeight2 = 300;
    let height2 = svgHeight2- margin2.top- margin2.bottom, width2 = 370;
    let x2 = d3.scaleBand().rangeRound([0, width2]).padding(0.1),
        y2 = d3.scaleLinear().rangeRound([height2, 0]);


    x2.domain(sourceNames2);
    y2.domain([0, 100]);

    let svg2 = d3.select("#AssigG02").append("svg");
    svg2.attr('height', svgHeight2)
        .attr('width', svgWidth2);

    svg2 = svg2.append("g")
        .attr("transform", "translate(" + margin2.left + "," + margin2.top + ")");

    svg2.append("g")
        .attr("transform", "translate(0," + height2 + ")")
        .call(d3.axisBottom(x2))
        .selectAll("text")
        .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end");

    svg2.append("g")
        .attr("class", "axis axis--y")
        .call(d3.axisLeft(y2).ticks(5))
    ;

    // Create rectangles
    let bars2 = svg2.selectAll('.bar')
        .data(sourceNames2)
        .enter()
        .append("g");

    bars2.append('rect')
        .attr('class', 'bar')
        .attr("x", function(d) { return x2(d); })
        .attr("y", function(d) { return y2(data4[d]); })
        .attr("width", x2.bandwidth())
        .attr("fill", "#69b3a2")
        .attr("height", function(d) { return height2 - y2(data4[d]); });

    bars2.append("text")
        .text(function(d) {
            return data4[d] + "%";
        })
        .attr("x", function(d){
            return x2(d) + x2.bandwidth()/2;
        })
        .attr("y", function(d){
            return y2(data4[d]) - 5;
        })
        .attr("text-anchor", "middle")
        .attr("font-size" , "12px");

</script>