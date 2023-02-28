<?php
include_once 'topo.php';
echo' 
<style>
body{
  background: #ecf0f5 !important;
}
</style> 
<div class="row" style="font-size: 14px; margin: 8px";>
  <div style="text-align:center;" class="col-lg-12">
    <div  class="page-header" style="text-align:center;">
      <h3 style="margin-top:1em;font-family: bebas;font-size: 2.5em;background: #d9d9d9;border-radius: 0.2em;">ALERTAS</h3>
    </div>
  </div>';
  $query = mysqli_query($conexao,"SELECT * FROM alertas WHERE idempresa='$idempresa' AND idcliente IN (0,'$idcliente') ORDER BY id DESC");
  if(mysqli_num_rows($query) >=1 ){
    while($dd = mysqli_fetch_array($query)){
        echo'
        <div class="col-lg-12" >
          ';
            if($dd['tipo'] == 'Para todos'){
            echo'      
              <div class="card text-white bg-warning mb-3 style="width: 100%">';
            }else{
            echo'
              <div class="card text-white bg-primary mb-3 style="width: 100%">';
            }
            echo'
              <div class="card-header"><h6 class="card-title">Avisos - Data: '.date('d-m-Y H:m',strtotime($dd['datacad'])).'</h6></div>
                <div class="card-body"><center>
                  <p class="card-text" style="font-size:20px">'.AspasForm($dd['descricao']).'</p></center>
                </div>
              </div>
            </div>     
          
        </div>';
      
    }
  }else{ 'Sem avisos';}
    echo'
</div>';
include_once 'rodape.php';
