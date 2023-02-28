<?php
include_once('topo.php');
echo '
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <i class="fa fa-text-width"></i>
            <h3 class="box-title">Ajuda</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <dl>
              <dt class="text-red">Primeira</dt>
              <dd>Cadastrar seu servidor e conectar nele</dd>
              <dt class="text-red">Segunda</dt>
              <dd>Se precisar se conectar em outro, apenas cadastre e conecte nele.<dd>
              <dt class="text-red">Terceira</dt>
              <dd>Existe funções ainda não ativas, motivos: em desenvolvimento ou versão demo.<dd>
              <dt class="text-red">Quarta</dt>
              <dd>No juno acesse: Plugins & API -> NOTIFICAÇÃO DE PAGAMENTOS e cole em: Configure aqui a URL que receberá as notificações em seu sistema<br />
              "https://gisp.digital/acesso/confirma-recebimento-juno.php", para ser dado baixa automático quando seu cliente pagar o boleto.
              </dd>
              <dt class="text-red">Quinta</dt>
              <dd>Cobranças em lote: No menu tem duas opções automático: juno e porta, são para gerar todas as cobranças de boleto, boleto_pix para todos os clientes
              com essa opção o mesmo para cobrança porta a porta. <i class="text-red">*Gerados sempre para o mês vigente</i>
              </dd>
              <dt class="text-red">Erro, ajuda, idéias, perguntas</dt>
              <dt class="text-red">#Suporte:</dt>
              <dd><a href="https://api.whatsapp.com/send?phone=5581989489788&text=Ol%C3%A1%2C">Clique aqui: <i class="fa fa-whatsapp fa-2x text-green"></i> Marcone Araújo</a><dd>
              <dd><a href="https://api.whatsapp.com/send?phone=5581985302501&text=Ol%C3%A1%2C">Clique aqui: <i class="fa fa-whatsapp fa-2x text-green"></i> Netbits Tecnologia </a><dd>
            </dl>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>      
      </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->';
include_once('rodape.php'); ?>
<script>
  $('#ajuda').addClass('active');
</script>