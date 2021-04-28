
<!--<TABLE BORDER>
    <TR><TH ROWSPAN=2>Head1</TH>
        <TD>Item 1</TD> <TD>Item 2</TD> <TD>Item 3</TD> <TD>Item 4</TD>
    </TR>
    <TR><TD>Item 5</TD> <TD>Item 6</TD> <TD>Item 7</TD> <TD>Item 8</TD>
    </TR>
    <TR><TH>Head2</TH>
        <TD>Item 9</TD> <TD>Item 10</TD> <TD>Item 3</TD> <TD>Item 11</TD>
    </TR>
</TABLE>-->
<table class="table table-bordered table-hover table-compact" id="dataTableCentros" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Acrònim</th>
        <th style="width:10%">Opcions</th>

    </tr>
    </thead>
    <tbody>
    <?php //foreach ($lista as $centro): ?>
        <tr>
            <td><?php //echo htmlspecialchars($centro['idCentro']);?></td>
            <td><?php //echo htmlspecialchars($centro['nombre']);?></td>
            <td><?php //echo htmlspecialchars($centro['acronimo']);?></td>
            <td>
                <div class="dropdown mb-0" style="text-align: center;">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-info-circle"></i>
                        <span class="text">Detalls</span>
                    </button>
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                        <a id="botonEditarCentro-<?php // echo $centro['idCentro'];?>" class="dropdown-item" href="#">Modificar</a>
                        <div class="dropdown-divider"></div>
                        <a id="botonBorrarCentro-<?php //echo $centro['idCentro'];?>" class="dropdown-item" href="#">Eliminar</a>
                        <script>eliminarCentro(<?php //echo $centro['idCentro'];?>)</script>
                        <script>mostrarModificarCentro(<?php //echo $centro['idCentro'];?>)</script>
                    </div>
                </div>
            </td>
        </tr>
    <?php //endforeach; ?>
    </tbody>
</table>