<?php
if (isset($_SESSION['niu'])){
 ?>
<div class="nav-scroller bg-white box-shadow">
    <nav class="nav nav-underline">
        <a id="especifica_enquesta" class="nav-link active" href="index.php?action=especifica_enquesta">Especificar Enquesta</a>
        <a id="escollir_assignatura" class="nav-link active" href="index.php?action=escollir_assignatura">Escollir Assignatura</a>
        <a id="consultar_resultats" class="nav-link active" href="index.php?action=res">Consultar Resultats</a>
        <a id="comparar_enquestes" class="nav-link active" href="index.php?action=comparar_enquestes">Comparar Enquestes</a>
        <a id="logout" class="nav-link active navbar-right" style="color: #99CCFF; font-style: italic;" href="index.php?action=logout">Logout</a>
    </nav>
</div>
<?php
}
?>
