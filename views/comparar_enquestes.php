<!--<script src="https://code.jquery.com/jquery-3.2.1.js"></script>-->
<script>

</script>
<?php include __DIR__ . "/../resources/encabezado.html";
?>
<body class="bg-light">
<?php include __DIR__ . "/../resources/title.html";

if (!isset($_SESSION['niu'])){
    echo "<div class='container'><div class='alert alert-danger' role='alert'>" .$message . "</div></div>";
}else{?>
<?php include __DIR__ . "/../resources/navigator.php";?>
<div class="container">
    <?php
    if (isset($sin_permisos)){
        echo "<div class='alert alert-danger' role='alert'>".$sin_permisos." </div>" ;
    }else{
    ?>
    <h6 class="border-bottom border-gray pb-2 mb-0">Informació sobre l'enquesta a comparar</h6>
    <div style="padding: 15px;">
            <small class="text-muted"><strong>Model: </strong></small><small><?php echo $model_compare[0]['descripcio'] ?></small><br>
    <small class="text-muted"><strong>Versió: </strong></small><small><?php echo $versio_compare[0]['descripcio'] ?></small><br>

    </div>
    <br>
    <div id="divToHide">
        <h6 class="border-bottom border-gray pb-2 mb-0">Escollir assignatura</h6>
        <br>
        <form class="form-horizontal" id="asig_to_compare" name="" method="post"> <!--  action="index.php?action=escollir_assignatura" -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="estudis">Pla d'estudis: </label>
                <div class="col-sm-10">
                    <select name="estudis" id="estudis" class="form-control" required>
                       <option value="<?php echo $lista_estudios[0]['idEstudio'];?>" selected>
                           <?php
                           echo htmlentities($lista_estudios[0]['nombre']);
                            /*if (!isset($sin_permisos)){
                                echo "Selecciona un pla d'estudi" ;
                            }*/
                            ?>
                        </option>
                        <?php if (sizeof($lista_estudios) > 1){
                        for ($i = 1 ;$i<sizeof($lista_estudios);$i++){ ?>
                            <option value="<?php echo $lista_estudios[$i]['idEstudio'];?>">
                                <?php echo htmlentities($lista_estudios[$i]['nombre']);?>
                            </option>
                        <?php }
                        }?>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="assignatura">Assignatura: </label>
                <div class="col-sm-10">
                    <select name="assignatura" id="assignatura" class="form-control" required>
                        <!--<option> Primer selecciona un pla d'estudi</option>-->
                        <?php //foreach ($llista_asignatures as $assignatures): ?>
                            <!--<option value="<?php //echo $assignatures['Assignatura'];?>"><?php //echo htmlentities($assignatures['nombre']);?></option>-->
                        <?php //endforeach; ?>
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
    <?php } ?>
</div>
<?php }
include __DIR__ . "/../resources/footer.html"; ?>
</body>
</html>