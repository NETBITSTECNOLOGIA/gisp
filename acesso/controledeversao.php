<?php
include_once('topo.php');

echo'
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content">   
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">          
            <!-- /.box-header -->
            <div class="box-body">

                <div class="box-header ui-sortable-handle">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Lista de tarefa</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCad"><i class="fa fa-plus"></i> Add tarefa</button>
                    </div>
                </div>    

                <div class="box-body">  ';          
                $arquivo = fopen ('versionamento.md', 'r');
                while(!feof($arquivo)){ 
                        $linha = fgets($arquivo, 1024); 
                        echo $linha.'<br />'; 
                    }
                fclose($arquivo);            
echo'
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!--./col-xs-12-->      
      </div>
      <!--/.row-->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->';



include_once('rodape.php');
