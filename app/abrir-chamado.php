<?php
include_once 'topo.php';
echo'
<meta name="theme-color" content="#1d2861">
<div class="row" style="font-size: 14px; margin: 8px">
    <div class="col-lg-12">
        <div class="page-header"  style="text-align:center;">
            <h3 style="    font-family: bebas;font-size: 2.5em;background: #d9d9d9;border-radius: 0.2em;">ABRIR CHAMADO</h3>
        </div>
    <div style="text-align:center;">
        <form action="insert-chamado.php" method="post" autocomplete="off">
            <div>
                <label for="inputDefault">Tipo</label>
                    <select type="text" class="form-control" name="tipo" id="inputDefault" required>
                        <option value="">selecione</option>
                        <option value="INCIDENTE">INICIDENTE</option>
                        <option value="SOLICITAÇÃO">SOLICITAÇÃO</option>
                        <option value="OUTROS">OUTROS</option>
                    </select>
            </div>
            <div>
                <label for="inputDefault">Descrição</label>
                <textarea rows="4" class="form-control" name="obs" placeholder="DESCREVA SUA SOLICITAÇÃO" id="inputDefault" required></textarea>
            </div>
            <div>
                <br />
                <button type="submit" class="btn btn-primary">SALVAR</button>
            </div>
            <hr style="border-top: 2px solid #00000036;margin-top: 1em;" class="hr">
            <h3 class="title">LEGENDAS</h3>           
              <h6>INCIDENTE:<span style="color:red"> Cabo rompido, sem conexão, roteador com luz vermelha.</span></6>
              <h6>SOLICITAÇÃO:<span style="color:red"> Troca de senha, posicionamento do roteador, mudar local instalação.</span></6>
        </form>
        <hr>
                </div>
            </div>
        </div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-lg-12">
        <center>
        <footer id="myFooter">
                <div class="footer-social">
                    <a href="chamado.php" class="social-icons"><i class="fa fa-circle-left social-icons"></i></a>
                </div>
        </footer>
        </center>
    </div>
</div>
';
