
<!--<link href="../css/style.css" rel="stylesheet">-->

<h5><?php  echo $nom_pla;?></h5><br>
<h5 class="border-bottom border-gray pb-2 mb-0"><?php echo $nom_asig;?></h5><br>
<!--<div class="header">
    <ul class="navi">
        <?php //for ($i =0; $i < sizeof($preguntes)-2 ; $i++){?>
            <li><a><?php //echo "Pregunta: ".$preguntes[$i]['numero'];?></a>
                <ul class="submenu">
                    <li>
                        <a><?php //echo $preguntes[$i]['enunciat'];?></a>
                    </li>
                </ul>
            </li>
        <?php //}?>
    </ul>
</div>-->

<div class="header">
    <ul class="navi">
        <?php for ($i =0; $i < sizeof($preguntes)-2 ; $i++){?>
          <li onclick="mostraEnunciados(<?php echo $i;?>)"><a ><?php echo "Pregunta: ".$preguntes[$i]['numero'];?></a></li>
        <?php }?>
    </ul>
</div><br><br>
<?php for ($i =0; $i < sizeof($preguntes)-2 ; $i++){?>
    <div id="enunciado-<?php echo $i;?>" style="display:none;">
        <ul>
           <li> <?php echo $preguntes[$i]['enunciat']; echo "\n";?>
            <?php
            if ($i == 1){
            ?> <ul>
                   <li>  <?php  echo "a. ".$sourceName[0]; echo "\n";?></li>
                   <li><?php  echo "b. ".$sourceName[1]; echo "\n";?></li>
                   <li> <?php  echo "c. ".$sourceName[2]; echo "\n";?></li>
                   <li><?php  echo "d. ".$sourceName[3];?></li>

               </ul>
            <?php }
            if ($i==2){
            ?><ul>
                   <li>  <?php  echo "a. ".$sourceName2[0]; echo "\n";?></li>
                   <li><?php  echo "b. ".$sourceName2[1]; echo "\n";?></li>
                   <li> <?php  echo "c. ".$sourceName2[2]; echo "\n";?></li>
                   <li><?php  echo "d. ".$sourceName2[3];?></li>
                   <li><?php  echo "d. ".$sourceName2[4];?></li>
               </ul>
               <?php }?>
           </li>
        </ul>

    </div>
<?php }?>



<br><br>
<div id="tablero">
<table ><!-- cellspacing="1000"-->
    <thead>
    <tr>
        <th>Edició: </th> <!--style="width: auto"-->
       <th>Nombre d'alumnes matriculats:</th>
        <th>% de participació</th>
        <?php
        for ($i = 0;$i<sizeof($preguntes)-2;$i++){ ?>
        <th>
            <?php echo "P. ".$preguntes[$i]['numero'];
                if($i != 0 && $i != 1 && $i != 2){//$preguntes[$i]['numero'] !== '1' || $preguntes[$i]['numero'] != '2' || $preguntes[$i]['numero'] != '3') {
                    echo " Mitjana Global: Sobre 4";
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
            <td><?php echo htmlspecialchars($edicion[0]);?></td><!--  Nombre d'alumnes matriculats -->
            <td><?php echo htmlspecialchars($edicion[1]);?></td><!--  % de participacio  -->
            <td><?php echo (htmlspecialchars($edicion[2][0]['resposta']).": ".htmlspecialchars($edicion[2][0]['totalAlumnes'])."%  ");?><br>
                <?php if (sizeof($edicion[2]) > 1){
                    echo (htmlspecialchars($edicion[2][1]['resposta']).": ".htmlspecialchars($edicion[2][1]['totalAlumnes'])."%");
                }?></td><!--pregunta1-->
            <td><?php
               /* if ($edicion['nom'] == 'assiggrau_1920_1rsem' ){
                    echo "a. 1%\n\n"; echo " b. 7%\n"; echo " c. 20%\n"; echo " d. 72%";
                }else{*/ ?>
                    <?php echo "a.".htmlspecialchars($edicion[3][0][1]."% ");
                echo "b.".htmlspecialchars($edicion[3][1][1]."%"); ?><br>
                    <?php echo "c.".htmlspecialchars($edicion[3][2][1]."%");
                      echo " d.".htmlspecialchars($edicion[3][3][1]."%");//}
                      ?>
            </td><!--pregunta2-->
            <td>
                <?php echo "a.".htmlspecialchars($edicion[4][0][1]."%");
                      echo " b.".htmlspecialchars($edicion[4][1][1]."%"); ?><br>
                <?php echo "c.".htmlspecialchars($edicion[4][2][1]."%");
                      echo " d.".htmlspecialchars($edicion[4][3][1]."%");?><br>
                <?php echo "d.".htmlspecialchars($edicion[4][4][1]."%");?>
            </td><!--pregunta3-->
            <td>
                <?php echo htmlspecialchars($edicion[5][0]); ?></td><!--pregunta4-->
            <td>
                <?php echo htmlspecialchars($edicion[6][0]); ?></td><!--pregunta5-->
            <td>
                <?php echo htmlspecialchars($edicion[7][0]); ?></td><!--pregunta6-->
            <td>
                <?php echo htmlspecialchars($edicion[8][0]); ?></td><!--pregunta7-->
            <td>
                <?php echo htmlspecialchars($edicion[9][0]); ?></td><!--pregunta8-->
            <td>
                <?php echo htmlspecialchars($edicion[10][0]); ?></td><!--pregunta9-->
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
</table>
</div>
<br><br>




