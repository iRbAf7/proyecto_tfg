<?php

echo $_SESSION['niu'];?>
<div id="formEdicio">
    <h6 class="border-bottom border-gray pb-2 mb-0">Informació sobre l'enquesta</h6>
    <?php
    if($pla != 0) {
        $select_pla = $nom_pla[0][0];
    } else {
        $select_pla = "Tots";
    }
    ?>
    <div style="padding: 15px;">
        <small class="text-muted"><strong>Model: </strong></small><small><?php echo $nom_model[0][0] ?></small><br>
        <small class="text-muted"><strong>Versió: </strong></small><small><?php echo $nom_versio[0][0] ?></small><br>
        <small class="text-muted"><strong>Edició: </strong></small><small><?php echo $nom_edicio[0][0] ?></small><br>
        <small class="text-muted"><strong>Pla d'estudis: </strong></small><small><?php echo $select_pla ?></small><br>
    </div>
    <br>
    <h6 class="border-bottom border-gray pb-2 mb-0">Escollir assignatura</h6>
    <br>
    <form class="form-horizontal" action="index.php?action=escollir_assignatura" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="assignatures">Assignatura: </label>
            <div class="col-sm-10">
                <select name="assignatures" id="assignatures" class="form-control">
                    <?php foreach ($result_llistar_assignatures as $assignatures): ?>
                        <option value="<?php echo $assignatures['Assignatura'];?>"><?php echo htmlentities($assignatures['nombre']);?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Enviar</button>
            </div>
        </div>

    </form>
</div>
