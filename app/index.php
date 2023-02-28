<?php
include_once 'topo.php';
?>

<body>
  <div class="viewport">
    <main class="main" role="main">
      <div class="gallery" aria-label="gallery">


        <a style="text-decoration:none" href="dadoscliente.php" class="gallery__item ">
          <h4 class="text_option">DADOS DO CLIENTE</h4>
          <i class="fa-solid fa-user-large btn_icon"></i>
        </a>

        <a style="text-decoration:none" href="faturas.php" class="gallery__item ">
          <h4 class="text_option">FATURAS</h4>
          <i class="fa-solid fa-money-check-dollar btn_icon"></i>
        </a>

        <a style="text-decoration:none" href="alertas.php" class="gallery__item ">
          <h4 class="text_option">AVISOS</h4>
          <i class="fa-solid fa-bell btn_icon"></i>
        </a>

        <a style="text-decoration:none" href="chamado.php" class="gallery__item ">
          <h4 class="text_option">CHAMADOS</h4>
          <i class="fa-solid fa-headset btn_icon"></i>
        </a>

        <a style="text-decoration:none" href="contratos.php" class="gallery__item ">
          <h4 class="text_option">CONTRATOS</h4>
          <i class="fa-solid fa-file-signature btn_icon"></i>
        </a>

      </div>
    </main>
  </div>
  <footer id="myFooter">
    <div class="footer-social">
      <a href="sair.php" class="social-icons"><i class="fa fa-circle-left social-icons"></i></a>
    </div>
  </footer>
</body>
<?php if (isset($_SESSION['idcliente']) != true) {
  echo '<script>location.href="sair.php";</script>';
} ?>

</html>