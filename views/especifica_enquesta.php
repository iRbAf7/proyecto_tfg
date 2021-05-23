<div id="formEdicio">
    <h6 class="border-bottom border-gray pb-2 mb-0">Definir models, versió, edició i pla d'estudis</h6>
    <h4><?php
        if (isset($sin_permisos)){
            echo "<div class='alert alert-danger' role='alert'>".$sin_permisos." </div>" ;
        }
        ?></h4>
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
                    <?php if (isset($_SESSION['in']) ){//&& $_SESSION['ambit_selec'] == 'Professors'){?>
                    <?php
                        for ($i = 0 ;$i<sizeof($_SESSION['result_llistar_pla']);$i++){//foreach ( $_SESSION['result_llistar_pla'] as $pla): ?>
                    <option value="<?php echo $_SESSION['result_llistar_pla'][$i]['idEstudio'];?>">
                        <?php echo htmlentities($_SESSION['result_llistar_pla'][$i]['nombre']);?></option>
                    <?php }

                    //endforeach; ?>

                    <?php }else{
                        ?>
                    <option value="0"><?php
                        if (!isset($sin_permisos)){
                            echo "Tots" ;
                        }
                        ?></option>
                    <?php ?>
                   <?php for ($i = 0 ;$i<sizeof($_SESSION['result_llistar_pla']);$i++){//foreach ( $_SESSION['result_llistar_pla'] as $pla): ?>
                        <option value="<?php echo $_SESSION['result_llistar_pla'][$i]['idEstudio'];?>">
                            <?php echo htmlentities($_SESSION['result_llistar_pla'][$i]['nombre']);?></option>
                    <?php }
                    }//endforeach;

                     ?>
                </select><br>
                <?php if(empty($_SESSION['result_llistar_pla'])){
                    echo "<div class='alert alert-danger' role='alert'> Amb aquest perfil, no hi ha cap pla disponible per visualitzar.</div>" ;
                }?>
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Enviar</button>
            </div>
        </div>

    </form>

    <!--<div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
        </div>
    </div>-->
    <br>
    <br>
    <br><br><br><br><br>
</div>
