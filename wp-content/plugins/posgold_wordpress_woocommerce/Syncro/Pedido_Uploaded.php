<?php


function posgold_syncro_order_completed_page_display(){
    global $wpdb, $table_prefix;



    ?>
        <h1 class="text-center">PEDIDOS CARGADOS</h1>

        <div class="row">
            <div class="col-md-4">
                <label>Fecha Desde</label>
                <input type="date" class="form-control" name="desde" required />
            </div>

            <div class="col-md-4">
                <label>Fecha Final</label>
                <input type="date" class="form-control" name="hasta" required/>
            </div>



        </div>

    <?php
}