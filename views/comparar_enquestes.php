<h6 class="border-bottom border-gray pb-2 mb-0">Informació sobre l'enquesta a comparar</h6>
<div style="padding: 15px;">
        <small class="text-muted"><strong>Model: </strong></small><small><?php echo $model_compare[0]['descripcio'] ?></small><br>
<small class="text-muted"><strong>Versió: </strong></small><small><?php echo $versio_compare[0]['descripcio'] ?></small><br>

</div>
<br>
<div id="divToHide">
    <h6 class="border-bottom border-gray pb-2 mb-0">Escollir assignatura</h6>
    <br>
    <form class="form-horizontal" id="asig_to_compare" method="POST"> <!-- action="index.php?action=escollir_assignatura" -->
        <div class="form-group">
            <label class="control-label col-sm-2" for="assignatures">Assignatura: </label>
            <div class="col-sm-10">
                <select name="assignatures" id="assignatures" class="form-control" >
                    <?php foreach ($llista_asignatures as $assignatures): ?>
                        <option value="<?php echo $assignatures['Assignatura'];?>"><?php echo htmlentities($assignatures['nombre']);?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="button" id="comparar" onclick="functionHide()" class="btn btn-default" value="Comparar">
            </div>
        </div>

    </form>
</div>
<div id="show_table">

</div>