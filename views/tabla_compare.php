
<!--<link href="../css/style.css" rel="stylesheet">-->

<h5 class="border-bottom border-gray pb-2 mb-0"><?php echo $nom_asignatura[0]['nombre'];?></h5><br>
<div class="header">
    <ul class="navi">
        <?php for ($i =0; $i < sizeof($preguntes)-2 ; $i++){?>
            <li><a><?php echo "Pregunta: ".$preguntes[$i]['numero'];?></a>
                <ul class="submenu">
                    <li>
                        <a><?php echo $preguntes[$i]['enunciat'];?></a>
                    </li>
                </ul>
            </li>
        <?php }?>
    </ul>
</div> <br><br><br>

<table ><!-- cellspacing="1000"-->
    <thead>
    <tr>
        <th>Edició: </th> <!--style="width: auto"-->
       <th>Nombre d'alumnes matriculats:</th>
        <th>Nombre de participants:</th>
        <?php
        for ($i = 0;$i<sizeof($preguntes)-2;$i++){ ?>
        <th>
            <?php echo "P. ".$preguntes[$i]['numero'];
                if($i != 0 && $i != 1 && $i != 2){//$preguntes[$i]['numero'] !== '1' || $preguntes[$i]['numero'] != '2' || $preguntes[$i]['numero'] != '3') {
                    echo " Mitjana Global:";
            }?>
            <!--<div id="header">
                <ul class="nav">
                    <li><?php //echo "P. ".$preguntes[$i]['numero']; echo "Mitjana Global:";?>
                        <ul>
                            <li>
                                <?php //echo $preguntes[$i]['enunciat'];?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>-->
        </th>

        <?php }; ?>
        <!--<th>Nom</th>
        <th>Acrònim</th>
        <th style="width:10%">Opcions</th>-->

    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($ediciones as $edicion): ?>
        <tr>
            <td><?php echo htmlspecialchars($edicion['curs_academic']);?></td>
            <td></td>
            <td></td>
            <td><?php echo (htmlspecialchars($edicion[0][0]['resposta']).": ".htmlspecialchars($edicion[0][0]['totalAlumnes'])."%  ");?><br>
                <?php if (sizeof($edicion[0]) > 1){
                    echo (htmlspecialchars($edicion[0][1]['resposta']).": ".htmlspecialchars($edicion[0][1]['totalAlumnes'])."%");
                }?></td><!--pregunta1-->
            <td><?php echo "a.".htmlspecialchars($edicion[1][1]['totalAlumnes']."% ");?><br> <?php echo "b.".htmlspecialchars($edicion[1][0]['totalAlumnes']."%"); ?>
                <?php echo "c.".htmlspecialchars($edicion[1][3]['totalAlumnes']."%"); echo " d.".htmlspecialchars($edicion[1][2]['totalAlumnes']."%");
                      ?>
            </td><!--pregunta2-->
            <td>
                <?php echo "a.".htmlspecialchars($edicion[2][3]['totalAlumnes']."%"); echo " b.".htmlspecialchars($edicion[2][0]['totalAlumnes']."%"); ?><br>
                <?php echo "c.".htmlspecialchars($edicion[2][1]['totalAlumnes']."%"); echo " d.".htmlspecialchars($edicion[2][2]['totalAlumnes']."%");?><br>
                <?php echo "d.".htmlspecialchars($edicion[2][4]['totalAlumnes']."%");?>
            </td><!--pregunta3-->
            <td>
                <?php echo htmlspecialchars($edicion[3][0]); ?></td><!--pregunta4-->
            <td>
                <?php echo htmlspecialchars($edicion[4][0]); ?></td><!--pregunta5-->
            <td>
                <?php echo htmlspecialchars($edicion[5][0]); ?></td><!--pregunta6-->
            <td>
                <?php echo htmlspecialchars($edicion[6][0]); ?></td><!--pregunta7-->
            <td>
                <?php echo htmlspecialchars($edicion[7][0]); ?></td><!--pregunta8-->
            <td>
                <?php echo htmlspecialchars($edicion[8][0]); ?></td><!--pregunta9-->
           <!-- <td>
               <div class="dropdown mb-0" style="text-align: center;">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-info-circle"></i>
                        <span class="text">Detalls</span>
                    </button>
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                        <a id="botonEditarCentro-<?php // echo $centro['idCentro'];?>" class="dropdown-item" href="#">Modificar</a>
                        <div class="dropdown-divider"></div>
                        <a id="botonBorrarCentro-<?php //echo $centro['idCentro'];?>" class="dropdown-item" href="#">Eliminar</a>

                    </div>
                </div>
            </td>-->
        </tr>
    <?php endforeach; ?>
    </tbody>
</table><br><br>




