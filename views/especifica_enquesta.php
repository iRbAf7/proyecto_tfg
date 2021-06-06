<?php include __DIR__ . "/../resources/encabezado.html";
?>
<body class="bg-light">
<?php include __DIR__ . "/../resources/title.html";

if (!isset($_SESSION['niu'])){
    echo "<div class='container'><div class='alert alert-danger' role='alert'>" .$message . "</div></div>";
}else{?>
<?php include __DIR__ . "/../resources/navigator.php";?>
<div class="container">
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
                    <?php if (gettype($result_llistar_edicions) == "array"){?>
                    <option value="<?php echo $result_llistar_edicions[0]['nom'];?>" >
                        <?php
                            echo htmlentities($result_llistar_edicions[0]['descripcio']);
                        ?>
                    </option>
                    <?php }
                    if (gettype($result_llistar_edicions) == "array" && sizeof($result_llistar_edicions) > 1){
                        for ($i = 1 ;$i<sizeof($result_llistar_edicions);$i++){ ?>
                            <option value="<?php echo $result_llistar_edicions[$i]['nom'];?>">
                                <?php echo htmlentities($result_llistar_edicions[$i]['descripcio']);?>
                            </option>
                        <?php }
                    }?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="pla_estudis">Pla d'estudis: </label>
            <div class="col-sm-10">
                <select name="pla_estudis" id="pla_estudis" class="form-control">

                    <?php /*if (isset($_SESSION['in']) ){//&& $_SESSION['ambit_selec'] == 'Professors'){?>
                    <?php
                        for ($i = 0 ;$i<sizeof($_SESSION['result_llistar_pla']);$i++){ ?>
                    <option value="<?php echo htmlentities($_SESSION['result_llistar_pla'][$i]['idEstudio']);?>">
                        <?php echo htmlentities($_SESSION['result_llistar_pla'][$i]['nombre']);?></option>
                    <?php }//endforeach; ?>

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
*/
                     ?>
                </select><br>
                <?php /*if(empty($_SESSION['result_llistar_pla'])){
                    echo "<div class='alert alert-danger' role='alert'> Amb aquest perfil, no hi ha cap pla d'estudi disponible per visualitzar.</div>" ;
                }*/?>
            </div>

        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Enviar</button>
            </div>
        </div>

    </form>
    <br>
    <br>
    <br><br><br><br><br>
</div>
</div>
<?php }
include __DIR__ . "/../resources/footer.html"; ?>
</body>
</html>