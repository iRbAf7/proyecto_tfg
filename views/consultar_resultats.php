<style>
    .table-wrapper {
        max-height: 200px;
        overflow: auto;
        display:inline-block;
    }
    th, td {
        width: 100%;
    }
</style>

<?php

echo $_SESSION['niu'];?>
<div>
    <h3><?php echo $nom_assigantura[0][0] ?></h3>
    <br>
    <h6 class="border-bottom border-gray pb-2 mb-0">Informació sobre l'enquesta</h6>
    <?php
    if($pla != 0) {
        $select_pla = $nom_pla[0][0];
    } else {
        $select_pla = "Tots";
    }
    ?>
    <div style="padding: 15px;">
        <small class="text-muted"><strong>Edició: </strong></small><small><?php echo $nom_edicio[0][0] ?></small><br>
        <small class="text-muted"><strong>Pla d'estudis: </strong></small><small><?php echo $select_pla ?></small><br>
        <small class="text-muted"><strong>Grup: </strong></small><small><?php echo $grup ?></small><br>
    </div>
    <br>
    <h6 class="border-bottom border-gray pb-2 mb-0">Especifica un grup</h6>
    <div style="padding: 15px;">
        <form action="index.php?action=res&ve=<?php echo $versio ?>&ed=<?php echo $edicio ?>&pla=<?php echo $pla ?>&as=<?php echo $assignatura ?>" method="post">
            <select name="grup" id="grup" class="custom-select custom-select-md" style="width: 150px;">
                <option value="Tots">Tots</option>
                <?php foreach ($llista_grups as $grup): ?>
                    <option value="<?php echo $grup[0];?>"><?php echo htmlentities($grup[0]);?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" id="submit" class="btn btn-default">Actualitzar</button>
        </form>
    </div>
    <br>
    <h6 class="border-bottom border-gray pb-2 mb-0">Participació</h6>
    <div style="padding: 15px;">
        <small class="text-muted"><strong>Nombre d'alumnes matriculats: </strong></small><small><?php echo $matriculats[0][0] ?></small><br>
        <small class="text-muted"><strong>Nombre de participants: </strong></small><small><?php echo $participacio[0][0] ?></small><br>
        <small class="text-muted"><strong>Percentatge de participació: </strong></small><small><?php echo $percentParticipacio ?></small><br>
    </div>
    <br>

    <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[0]['numero'] ?>. <?php echo $preguntes[0]['enunciat'] ?></h6>
    <div>
        <br>
        <?php include __DIR__ . "/grafics/AssigG01.php"; ?>
    </div>


    <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[1]['numero'] ?>. <?php echo $preguntes[1]['enunciat'] ?></h6>
    <div>
        <?php include __DIR__ . "/grafics/AssigG02.php"; ?>
    </div>
    <br>


    <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[2]['numero'] ?>. <?php echo $preguntes[2]['enunciat'] ?></h6>
    <div>
        <?php include __DIR__ . "/grafics/AssigG03.php"; ?>
    </div>
    <br>


    <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[3]['numero'] ?>. <?php echo $preguntes[3]['enunciat'] ?></h6>
    <?php
    require_once("models/calcul_mitjana.php");
    require_once("models/mitjana_total.php");
    require_once("models/mitjana_grup.php");

    if($pla != 0) {
        $mitjana4 = calcul_mitjana(connection(), 'AssigG04',"$edicio","$pla", "$assignatura");
    }else {
        $mitjana4 = mitjana_total(connection(), 'AssigG04',"$edicio","$assignatura");
    }
    if ($_SESSION['grup'] != NULL) {
        $mitjana4 = mitjana_grup(connection(), 'AssigG04',"$edicio","$assignatura", "$grup");
    }
    ?>
    <br>

    <small class="text-muted"><strong>Valoració: </strong>0 Molt desacord / 1 Desacord / 2 Indiferent / 3 D'acord / 4 Molt d'acord</small>
    <br>
    <small class="text-muted"><strong>Mitjana: </strong></small><small><?php echo $mitjana4[0][0] ?></small>
    <div>
        <?php include __DIR__ . "/grafics/AssigG04.php"; ?>
    </div>


    <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[4]['numero'] ?>. <?php echo $preguntes[4]['enunciat'] ?></h6>
    <?php
    require_once("models/calcul_mitjana.php");
    require_once("models/mitjana_total.php");
    if($pla != 0) {
        $mitjana5 = calcul_mitjana(connection(), 'AssigG05',"$edicio","$pla", "$assignatura");
    }else {
        $mitjana5 = mitjana_total(connection(), 'AssigG05',"$edicio","$assignatura");
    }
    if ($_SESSION['grup'] != NULL) {
        $mitjana5 = mitjana_grup(connection(), 'AssigG05',"$edicio","$assignatura", "$grup");
    }
    ?>
    <br>
    <small class="text-muted"><strong>Valoració: </strong>0 Molt desacord / 1 Desacord / 2 Indiferent / 3 D'acord / 4 Molt d'acord</small>
    <br>
    <small class="text-muted"><strong>Mitjana: </strong></small><small><?php echo $mitjana5[0][0] ?></small>
    <div>
        <?php include __DIR__ . "/grafics/AssigG05.php"; ?>
    </div>


    <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[5]['numero'] ?>. <?php echo $preguntes[5]['enunciat'] ?></h6>
    <?php
    require_once("models/calcul_mitjana.php");
    require_once("models/mitjana_total.php");
    if($pla != 0) {
        $mitjana6 = calcul_mitjana(connection(), 'AssigG06',"$edicio","$pla", "$assignatura");
    }else {
        $mitjana6 = mitjana_total(connection(), 'AssigG06',"$edicio","$assignatura");
    }
    if ($_SESSION['grup'] != NULL) {
        $mitjana6 = mitjana_grup(connection(), 'AssigG06',"$edicio","$assignatura", "$grup");
    }
    ?>
    <br>
    <small class="text-muted"><strong>Valoració: </strong>0 Molt desacord / 1 Desacord / 2 Indiferent / 3 D'acord / 4 Molt d'acord</small>
    <br>
    <small class="text-muted"><strong>Mitjana: </strong></small><small><?php echo $mitjana6[0][0] ?></small>
    <div>
        <?php include __DIR__ . "/grafics/AssigG06.php"; ?>
    </div>


    <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[6]['numero'] ?>. <?php echo $preguntes[6]['enunciat'] ?></h6>
    <?php
    require_once("models/calcul_mitjana.php");
    require_once("models/mitjana_total.php");
    if($pla != 0) {
        $mitjana7 = calcul_mitjana(connection(), 'AssigG07',"$edicio","$pla", "$assignatura");
    }else {
        $mitjana7 = mitjana_total(connection(), 'AssigG07',"$edicio","$assignatura");
    }
    if ($_SESSION['grup'] != NULL) {
        $mitjana7 = mitjana_grup(connection(), 'AssigG07',"$edicio","$assignatura", "$grup");
    }
    ?>
    <br>
    <small class="text-muted"><strong>Valoració: </strong>0 Molt desacord / 1 Desacord / 2 Indiferent / 3 D'acord / 4 Molt d'acord</small>
    <br>
    <small class="text-muted"><strong>Mitjana: </strong></small><small><?php echo $mitjana7[0][0] ?></small>
    <div>
        <?php include __DIR__ . "/grafics/AssigG07.php"; ?>
    </div>


    <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[7]['numero'] ?>. <?php echo $preguntes[7]['enunciat'] ?></h6>
    <?php
    require_once("models/calcul_mitjana.php");
    require_once("models/mitjana_total.php");
    if($pla != 0) {
        $mitjana8 = calcul_mitjana(connection(), 'AssigG08',"$edicio","$pla", "$assignatura");
    }else {
        $mitjana8 = mitjana_total(connection(), 'AssigG08',"$edicio","$assignatura");
    }
    if ($_SESSION['grup'] != NULL) {
        $mitjana8 = mitjana_grup(connection(), 'AssigG08',"$edicio","$assignatura", "$grup");
    }
    ?>
    <br>
    <small class="text-muted"><strong>Valoració: </strong>0 Molt desacord / 1 Desacord / 2 Indiferent / 3 D'acord / 4 Molt d'acord</small>
    <br>
    <small class="text-muted"><strong>Mitjana: </strong></small><small><?php echo $mitjana8[0][0] ?></small>
    <div>
        <?php include __DIR__ . "/grafics/AssigG08.php"; ?>
    </div>


    <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[8]['numero'] ?>. <?php echo $preguntes[8]['enunciat'] ?></h6>
    <?php
    require_once("models/calcul_mitjana.php");
    require_once("models/mitjana_total.php");
    if($pla != 0) {
        $mitjana9 = calcul_mitjana(connection(), 'AssigG09',"$edicio","$pla", "$assignatura");
    }else {
        $mitjana9 = mitjana_total(connection(), 'AssigG09',"$edicio","$assignatura");
    }
    if ($_SESSION['grup'] != NULL) {
        $mitjana9 = mitjana_grup(connection(), 'AssigG09',"$edicio","$assignatura", "$grup");
    }
    ?>
    <br>
    <small class="text-muted"><strong>Valoració: </strong>0 Molt desacord / 1 Desacord / 2 Indiferent / 3 D'acord / 4 Molt d'acord</small>
    <br>
    <small class="text-muted"><strong>Mitjana: </strong></small><small><?php echo $mitjana9[0][0] ?></small>
    <div>
        <?php include __DIR__ . "/grafics/AssigG09.php"; ?>
    </div>

    <?php
    require_once("models/nivell_privilegi.php");
    $privilegi_10 = nivell_privilegi(connection(),$preguntes[9]['numero']);
    $privilegi_11 = nivell_privilegi(connection(),$preguntes[10]['numero']);
    if(!empty($permis)) {
        if($privilegi_10[0][0] == "Alt" and $privilegi_11[0][0] == "Alt") { ?>
            <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[9]['numero'] ?>
                . <?php echo $preguntes[9]['enunciat'] ?></h6>
            <?php $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", "$assignatura"); ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-8" style="margin-left: auto; margin-right: auto;">
                        <div class=table-wrapper style="transform: scale(0.8);">
                            <table class="table">
                                <tbody>
                                <?php foreach ($llistat_respostes10 as $respostes): ?>
                                    <tr>
                                        <td><?php echo htmlentities($respostes[0]); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $preguntes[10]['numero'] ?>
                . <?php echo $preguntes[10]['enunciat'] ?></h6>
            <?php $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", "$assignatura"); ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-8" style="margin-left: auto; margin-right: auto;">
                        <div class=table-wrapper style="transform: scale(0.8);">
                            <table class="table">
                                <tbody>
                                <?php foreach ($llistat_respostes11 as $respostes): ?>
                                    <tr>
                                        <td><?php echo htmlentities($respostes[0]); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } ?>
    
</div>
