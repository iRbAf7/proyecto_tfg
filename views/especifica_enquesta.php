<?php

echo $_SESSION['niu'];
var_dump($_SESSION['ambit_selec']);
var_dump($permiso_defecto);
//var_dump($result_llistar_models[0]);?>
<div id="formEdicio">
    <h6 class="border-bottom border-gray pb-2 mb-0">Definir models, versió, edició i pla d'estudis</h6>
    <form class="form-horizontal" action="index.php?action=especifica_enquesta" method="post">
        <div class="form-group">
            <br>
            <label class="control-label col-sm-2" for="nom_model">Model: </label>
            <div class="col-sm-10">
                <select name="nom_model" id="nom_model" class="form-control">
                    <?php foreach ($result_llistar_models as $model): ?>
                        <option value="<?php echo $model['nom'];?>"><?php echo htmlentities($model['descripcio']);?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="nom_versio">Versió: </label>
            <div class="col-sm-10">
                <select name="nom_versio" id="nom_versio" class="form-control">
                    <?php foreach ($result_llistar_versions as $versions): ?>
                        <option value="<?php echo $versions['nom'];?>"><?php echo htmlentities($versions['descripcio']);?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="nom_edicio">Edició: </label>
            <div class="col-sm-10">
                <select name="nom_edicio" id="nom_edicio" class="form-control">
                    <?php foreach ($result_llistar_edicions as $edicions): ?>
                        <option value="<?php echo $edicions['nom'];?>"><?php echo htmlentities($edicions['descripcio']);?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pla_estudis">Pla d'estudis: </label>
            <div class="col-sm-10">
                <select name="pla_estudis" id="pla_estudis" class="form-control">
                    <option value="0">Tots</option>
                    <?php foreach ($result_llistar_pla as $pla): ?>
                        <option value="<?php echo $pla['idEstudio'];?>"><?php echo htmlentities($pla['nombre']);?></option>
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
