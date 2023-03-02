## data da atualização e correção: v1.1.1 - 10/12/2022 
✅1-melhoria no form busca cliente (correção busca cnpj e hidden de campos, remoção de login)
	✅1.0-api bb (gerador de boleto pdf, https://boletophp.com.br/)
	✅1.2-codigolinhadigitavel (craido na tabela cobrança)
	✅1.3-img qrcode salvar pasta temporaria
	✅1.4-qrcode2 gerencianet e bb para cópiar  (craido na tabela cobrança)
	✅1.5-ncobranca -> numeroTituloCliente
	✅1.6-installmentLink -> recebe o qrcode
	✅1.7-layout carne sem valor bancario
	✅1.8-ativar cliente/bloquear/derrubar cliente (view clientes e clientesall)	
	✅7-inclusão de campo parceiro
	✅1.9-inclusão de campo voip
	✅1.10-inclusão de filtros no busca de cliente (parceiro,login,voip)
	✅1.11-inclusão campos(forma de cobrança: pós-pago,pré-pago)
	✅1.12-inclusão campos periodo de cobrança: Mensal, trimestral, semestral e anual)
	✅1-carne bb e parcelas
	✅2-pwa atualizar (boeltos BB)
✅2-correção recibo (token, contratos)
✅3-abri chamado na view do cliente
✅4-inclusão do view dev para controle de funções solicitadas para o sistema pelo cliente
✅5-inclusão do Banco do brasil

## data da atualização e correção: v1.8.4
✅1- correção :ADICIONAR FILTRO: CEP. -> v1.5.3
✅2- função: Modelo de boleto agrupado do Banco do Brasil - -> v1.5.2
🕟3- função: DECLARAÇÃO DE QUITAÇÃO DE DEBITOS atendendo a lei: https://www.planalto.gov.br/ccivil_03/_ato2007-2010/2009/lei/l12007.htm -> v1.4.2
✅4- SOLICITAR NOMERO DE NOTA AO INSERIR NOTA FISCAL NO FINANCEIRO DD ASSINANTE E EXIBIR TAMBEM NO APP -> v1.3.2
✅5- correção da função cliente online v1.1.2
✅6- menu relatorios 1.6.3
✅7- inclusão na api do BB (aceitar 90 dias apos vencimento) 1.7.3
✅8- correção dias de fevereiro gerando data errada 1.7.4
✅9- ativação do cliente bloqueado apos recebimento 1.8.4
🕟10- controle de vpn 1.9.4

## data da atualização e correção:
🕟🕟🕟🕟🕟🕟🕟🕟<<<<<<<---- ALTERANDO TODO PROJETO PARA OOP PHP
---> TROCADO FORMA DE LOGIN admin e staff PARA EMAIL E SENHA SENDO OBRIGATORIO, 
🕟1-SOLICITAR NUMERO DE NOTA AO INSERIR NOTA FISCAL (INDICANDO O TIPO DE NOTA DISPONIVEL AO ASSINANTE) NO FINANCEIRO DD ASSINANTE E EXIBIR TAMBEM NO APP
🕟2-NOTIFICACAO Apos o cadastro ja pode cair numa tabela na area de notificação igual chamado na area de trabalha exibindo os dez ultimos pre cadastros realizados data de cadastro e situação dele. Assim vai mapeando em quem faze o casdastro.
🕟3-DESBLOQUEIO DE CONFIANÇA: Adicionar o botao desbloqueio de confiança no financeiro e no app do assinante com o periodo de 3 dis uteis por mês. Ter um modal com o Aceite de termo em confianca deixando registrado e informações dentro do cadastro do assinante com data, hora e localização do desbloqueio, enviando um sms para o celular do cadastro apos confirmar o numero do cadastro e adicionando o codigo enviado via sistema sendo adicionado no termo e liberado. O sistema enviara o codigo do boleto e QRCODE do pix no email e sms cadastrado do cliente.
🕟4-INTEGRAÇÃO SERPRO: CONSULTA POR CPF E CNPJ E ATUALIZAÇÃO DOS DADOS CADASTRAIS DOS ASSINANTES FACILITANDO O CADASTRAMENTO DOS ASSINANTES.
🕟5-Preciso gerar uma planilha com alguns campos do cliente: tipo cliente, nome, telefones, plano, valor , situacao do cliente. Para uma auditoria.
🕟6-Carregar os dados referente ao MAC e IP dentro da caixa e uma opção para salvar dentro da caixa.
🕟7-CICLO DE PAGAMENTO: Mensal esta OK, gostaria que o trimestral, semestrestral e anual FUNCIONE AGRUPANDO OS MESES E SEUS VALORES E CICLOS. E tenha a opção de desconto: EXEMPLO: VALOR ATUAL DO PLANO, DESCONTO E VALOR COM DESCONTE É O QUE APARECENA NO TERMO DE ADESAO, FATURAS, APP, ETC....

v1.1.1 - ✅->concluido, 🕟->em desenvolvimento
– 1 (Major) – controle de compatibilidade. Informa que existem funcionalidades/códigos incompatíveis com as versões anteriores.
– 0 (Minor) – controle de funcionalidade. Informa que novas funcionalidades foram adicionadas ao código.
– 0 (Patch) – controle de correção de bugs. Informa que um ou mais erros foram identificados e corrigidos.
– Pré-release – versão candidata. É uma versão com algumas instabilidades pois pode ter incompatibilidades no pacote.