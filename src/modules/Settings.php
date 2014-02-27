<?php
// ************************************************************** //
// *                                                            * //
// * Effect Web MuOnline                                        * //
// * Version: 1.8.5 Finish Edition                              * //
// * Release Date: 31/08/2013                                   * //
// * Build: 1.8.5.37                                            * //
// *                                                            * //
// ************************************************************** //
// *                                                            * //
// * Powered by Erick-Master                                    * //
// * E-Mail: erick-master@ctmts.com.br                          * //
// * Skype: erick-master.am                                     * //
// * Phone: (31) 9702-2076                                      * //
// *                                                            * //
// ************************************************************** //
// *                                                            * //
// * CTM Team Softwares - Custom Tech Services                  * //
// * Copyright (c) 2010-2012. All Rights Reserved,              * //
// * www.ctmts.com.br                                           * //
// *                                                            * //
// ************************************************************** //

/*****************************************************************************
	@ MSSQL Settings
	@ Configurações do Servidor Microsoft SQL Server
	@ true = Sim
	@ false = Não
*****************************************************************************/
define("MSSQL_Host", "127.0.0.1"); // -- Host do MSSQL (Padrão -> 127.0.0.1)
define("MSSQL_User", "sa"); // -- Usuario do MSSQL (Padrão -> sa)
define("MSSQL_Pass", "123456"); // -- Senha do MSSQL
define("MSSQL_DB", "CTM_ewOld"); // -- DataBase do Web Site (Padrão -> CTM_TeaM)
define("MuAcc_DB", "MuOnline"); // -- DataBase das contas [Geralmente = Me_MuOnline] (Padrão -> MuOnline)
define("MuGen_DB", "MuOnline"); // -- DataBase geral do server (Padrão -> MuOnline)
define("MSSQL_Security_Log", true); // -- Salvar Logs de Erros na tarefas do MSSQL (Padrão -> true)

/*****************************************************************************
	@ MySQL Settings
	@ Configurações do Servidor MySQL Server
	@ true = Sim
	@ false = Não
*****************************************************************************/
define("MySQL_Security_Log", true); // -- Salvar Logs de Erros na tarefas do MySQL (Padrão -> true)

/*****************************************************************************
	@ Mailer Settings
	@ Configurações do sistema de E-Mails
	@ true = Sim
	@ false = Não
	@ Para SMTP localhost deixe o usuario e senha vazios
	@ OBS: localhost é somente para hospedagens normais
*****************************************************************************/
$_Mailer["SMTP"]["Server"] = "xxxxxx"; // -- Host do Servidor SMTP (Padrão -> localhost)
$_Mailer["SMTP"]["Port"] = 25; // -- Porta do Servidor SMTP (Padrão -> 25)
$_Mailer["SMTP"]["User"] = "xxxxxx"; // -- Usuario do Servidor SMTP (Padrão -> Vazio)
$_Mailer["SMTP"]["Pass"] = "xxxxxx"; // -- Senha do Servidor SMTP (Padrão -> Vazio)
$_Mailer["SMTP"]["Mail"] = "xxxxxx"; // -- Remetente dos E-Mails
$_Mailer["SMTP"]["Debug"] = true; // -- Ativar/Desativar Debug System [Gerar Logs] (Padrão -> true)

/*****************************************************************************
	@ General Settings
	@ Configurações Gerais do Web Site
	@ true = Sim
	@ false = Não
*****************************************************************************/
define("Session_Name", "Fa2e9Zd23B37"); // -- Nome das Sessões do site
define("USE_MD5", 0); // -- O Servidor contem MD5? [1=Sim] [0=Não]
define("Recovery_Pass", true); // -- Mudar senha do úsuario ao efetuasr recuperação de senha (Padrão -> true)
define("VI_CURR_INFO", false); // -- Registrar dados na Tabela VI_CURR_INFO (Padrão -> true)
define("License_Cache", true); // -- Permitir a criação de Cache, efetuar Requests ao servidor de licença a cada 3 horas
define("Server_Location", 1); // -- Localidade de sua Hospedagem [0=USA] [1=BR] (Padrão -> 0)
define("Staff_Code", 32); // -- Codigo dos Personagens da Staff
define("Column_Reset", "Resets"); // -- Coluna de Resets (Padrão -> Resets)
define("Column_MReset", "MResets"); // -- Coluna de Master Resets (Padrão -> MResets)
define("Column_ResetDay", "ResetsDaily"); // -- Coluna dos Resets Diarios (Padrão -> resetsDay)
define("Column_ResetWeek", "ResetsWeek"); // -- Coluna dos Resets Semanais (Padrão -> resetsWeek)
define("Column_ResetMonth", "ResetsMonth"); // -- Coluna dos Resets Mensais (Padrão -> resetsMonth)
define("Column_PK", "PkCount"); // -- Coluna de PK (Padrão -> PkCount)
define("Column_Cmd", "Leadership"); // -- Coluna de Comando (Padrão -> Leadership)
define("Upload_Img", "images/uploads/chars/"); // -- Diretorio das Imagens dos Chars
define("Upload_SS", "images/uploads/screenshots/"); // -- Diretorio das ScreenShots
define("Image_Size", 100000); // -- Tamanho da Imagem em Bytes (Padrão -> 100000)
define("Max_Points", 65000); // -- Maximo de Pontos
define("Server_Files", 1); // -- Server Files [0=ENCGames Season 6] [1=X-Team Season 4/5] [2=X-Team Season 6] [3=Outros]
define("GS_Version", 6); // -- Server Version [0=99B-] [1=99Z a Season 1] [2=Season 2] [3=Season 3 EP1] [4=Season 3 EP2 a Season 4.5] [5=Season 5] [6=Season 6 EP1] [7=Season 6 EP2/3]
define("EXTRA_VAULT_COLUMN", "CTM_Vault"); // -- Coluna do Baú Extra (Web) (Padrão -> CTM_Vault)
define("CHAR_IMAGE_COLUMN", "CTM_Image"); // -- Coluna da imagem pessoal (Padrão -> CTM_Image)
define("RANKING_PK_COLUMN", "PkCountWeb"); // -- Coluna do Ranking de PK (Padrão -> PkCountWeb)
define("RANKING_HERO_COLUMN", "HeroCountWeb"); // -- Coluna do Ranking de PK (Padrão -> HeroCountWeb)
define("ENABLE_INFO_CHAR", TRUE); // -- Habilitar a exibição de perfil dos personagens (Padrão -> TRUE)
define("ENABLE_INFO_GUILD", TRUE); // -- Habilitar a exibição de perfil das guilds (Padrão -> TRUE)
define("ENABLE_PANELUSER_LOGS", TRUE); // -- Habilitar o registro de logs do painel do usuário [modules/Logs/CTM_PanelUser] (Padrão -> TRUE)

/*****************************************************************************
	@ Warehouse Settings
	@ Configurações do sistema de Baú
	@ true = Sim
	@ false = Não
*****************************************************************************/
define("ExtWarehouse", true); // -- O Servidor contem sistema de Baú Extra? (/vault | /bau)
define("ExtWare_Table", "ExtendedWarehouse"); // -- Table do Baú Extra (Padrão -> ExtWarehouse)
define("ExtWare_Item", "Items"); // -- Coluna de Itens do Baú Extra (Padrão -> items)
define("ExtWare_Login", "AccountID"); // -- Coluna de Login do Baú Extra (Padrão -> AccountID)

/*****************************************************************************
	@ Reference Settings
	@ Configurações do sistema de Referência
	@ true = Sim
	@ false = Não
*****************************************************************************/
define("NEWFINAL_REF_ACCESSPOINTS", 1); // -- Pontos por cada acesso
define("NEWFINAL_REF_REGPOINTS", 2); // -- Pontos por cada registro
define("NEWFINAL_REF_LINK", "http://www.seusite.com.br/?ref="); // -- Link de referência

/*****************************************************************************
	@ Template Settings
	@ Configurações do Sistema de Template
	@ Para o template Padrão deixe "Default"
*****************************************************************************/
define("Template_Default", "Default"); // -- Nome da pasta do Template na pasta "templates" (Template Padrão)
define("Template_Selector", true); // -- Ativar/Desativar Seletor de Templates
##################################################################
	# Seletor de Templates
	# Somente se tiver Abilitado
	# OBS: Deixe Default somente para o template Padrão da Effect Web
	# Exemplo: 0 => array("Pasta do Template", "Nome do Template"),
##################################################################
$_Templates = array(0 => array("Default", "Effect Web"),
					1 => array("DarkStyle", "DarkStyle"),
				   );

/*****************************************************************************
	@ Update Settings
	@ A Chave de Update tem o objetivo que você não use o Site antes da leitura do ChangeLog
	@ Pegue a Chave de Update no ChangeLog.htm da ultima versão do site
*****************************************************************************/
define("Update_Key", 0x1A45F797); // -- Chave de Atualização. (Pegue no ChangeLog.htm)


/*****************************************************************************
	@ Info Settings
	@ Informações do Site
	@ true = Sim
	@ false = Não
*****************************************************************************/
define("Server_Name", "Mu Shock"); // -- Nome do Servidor
define("Web_Title", "Effect Web v1.8.0 Finish Edition"); // -- Titulo do Site
define("Server_Version", "1.04C Season 6 EP3"); // -- Versão do Servidor
define("Server_Xp", "4.000x"); // -- Experiência do Servidor
define("Server_Drop", "90%"); // -- Drop do Servidor
define("Server_BB", 1); // -- Bug Bless [0=Offline] [1=Online] [2=Outro]
define("BB_Text", "/zen"); // -- Outra Informação do Bug Bless (Somente para Bug Bless = 2)
define("Server_Time", "24/7"); // -- Horário do Servidor
define("Server_Type", 2); // -- Tipo de Servidor [1=Semi-Dedicado] [2=Dedicado]
define("Status_Enable", 2); // -- Exibir Status do Server [0=Não] [1=Sim] [2=Manutenção]
define("GS_Host", "127.0.0.1"); // -- IP/Host do GameServer (Padrão -> 127.0.0.1);
define("GS_Port", 8090); // -- Porta do GameServer (Padrão -> 55901)

/*****************************************************************************
	@ Server Settings
	@ Configurações da Lita de Servidores
	@ true = Sim
	@ false = Não
*****************************************************************************/
define("Server_List", true); // -- Ativar/Desativar Lista de Servidores
define("CS_Host", "127.0.0.1"); // -- IP do ConnectServer (Padrão -> 127.0.0.1)
define("CS_Port", 8090); // -- Porta do ConnectServer (Padrão -> 44405)
##################################################################
	# Configurações dos GameServers
	# Somente se tiver Abilitado
	# Exemplo: 0 => array("Nome do Servidor", "Nome do GameServer", Maximo de Conexões),
##################################################################
$_ServerList = array(0 => array("Server Geral", "GS", 1),
					 1 => array("Server VIP", "CTM-VIP", 1),
					 );


/*****************************************************************************
	@ Raffle System
	@ Configurações do sistema de Sorteio
	@ true = Sim
	@ false = Não
*****************************************************************************/
$_RaffleSystem["Enable"] = true; // -- Ativar/Desativar o sistema de Sorteio
$_RaffleSystem["Accounts"] = array("erick", "admlogan"); // -- Contas com permisão de gerenciar o sistema (Exemplo: "admin","adm2")
$_RaffleSystem["Raffle"] = array("erick", "admlogan"); // -- Contas com permisão para sortear jogadores (Exemplo: "admin","adm2")
$_RaffleSystem["Clear"] = array("erick", "admlogan"); // -- Contas com permisão para limpar a lista de sorteados (Exemplo: "admin","adm2")
$_RaffleSystem["Coin"] = 2; // -- Moeda a ser Sorteada [De 1 a 3] (Padrão -> 1)
$_RaffleSystem["List"]["Enable"] = true; // -- Ativar/Desativar Lista de Sorteados (Padrão -> true)
$_RaffleSystem["List"]["Id"] = true; // -- Exibir Id do Sorteado na lista de sorteados (Padrão -> false)
$_RaffleSystem["List"]["Coin"] = true; // -- Exibir a moeda premiada na lista de sorteados (Padrão -> true)
$_RaffleSystem["List"]["Gold"] = true; // -- Exibir o numero de Moeda recebidos na lista de sorteados (Padrão -> true)
$_RaffleSystem["List"]["Date"] = true; // -- Exibir a data do sorteio na lista de sorteados (Padrão -> true)
$_RaffleSystem["List"]["Time"] = true; // -- Eibir a hora do sorteio na lista de sorteados (Padrão -> false)
 
/*****************************************************************************
	@ Register Settings
	@ Configurações do Registro no Servidor
	@ true = Sim
	@ false = Não
*****************************************************************************/
define("Register[Enable]", true); // -- Ativar/Desativar Registro no Servidor
define("Register[Confirm_Mail]", false); // -- Obrigar confirmação no E-Mail
define("Register[VIP][Enable]", true); // -- Ganhar VIP ao se Cadastrar (Padrão -> true)
define("Register[VIP][Type]", 2); // -- Tipo de VIP [De 1 a 5] (Padrão -> 1)
define("Register[VIP][Time]", 5); // -- Tempo de VIP a Ganhar (Padrão -> 5)
define("Register[Cash][Enable]", true); // -- Ganhar Cash ao se Cadastrar (Padrão -> false)
define("Register[Cash][Coin]", 1); // -- Moeda a Ganhar [De 1 a 3] (Padrão -> 1)
define("Register[Cash][Number]", 3); // -- Quantidade de Cash a Ganhar
define("Register[ItemBonus]", TRUE); // -- Habilitar o Item Bônus (Necessário licença adicional)
define("Register[DefinePID]", TRUE); // -- Solicitar o Personal ID no cadastro
define("Register[ForceLower]", TRUE); // -- Forçar logins minúsculos na query de cadastro e validação

/*****************************************************************************
	@ Link Settings
	@ Configurações dos links do Site
	@ true = Sim
	@ false = Não
*****************************************************************************/
define("Forum_Enable", true); // -- O Servidor contem Fórum?
define("Forum_Link", "http://forum.ctmts.com.br"); // -- Link do Fórum
define("Num_Shops", 2); // -- Numero de Web Shops
define("Shop_Link", "http://www.ctmts.com.br"); // -- Link do Shop (Somente para 1 Shop)
##################################################################
	# Link dos Shops
	# Somente se tiver 2 ou mais
	# Exemplo: 0 => array("Link do Shop", "Nome do Shop"),
##################################################################
$_Shop = array(0 => array("http://www.ctmts.com.br", "Shop Gold"),
			   1 => array("http://www.ctmts.com.br", "Shop Cash"),
			   );
			   
define("Orkut_Link", "http://www.orkut.com.br/Main#Home"); // -- Link da Comunidade do Orkut
define("Twitter_Enable", true); // -- Ativar/Desativar Link do Twitter
define("Twitter_Link", "http://www.twitter.com/"); // -- Link do Twitter
define("Chat_Enable", true); // -- Ativar/Destivar Chat do Servidor
define("Chat_Scripts", '<embed src="http://www.xatech.com/web_gear/chat/chat.swf" quality="high" width="540" height="405" name="chat" FlashVars="id=120822513" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://xat.com/update_flash.shtml" />'); // -- Script do Chat

/*****************************************************************************
	@ Menu Settings
	@ Configurações do Menu Extra
	@ 1 = Pagina no Site
	@ 2 = Pagina em outra Janela
	@ OBS: Para pagina no site colocar o nome o arquivo .pag.php da pasta pages/
	@ Exemplo: 0 => array(Tipo e Pagina, "Nome no Menu", "Link da Pagina),
******************************************************************************/
$_Menu = array(0 => array(1, "Pagina Extra", "example"),
			   1 => array(2, "Nova Janela", "http://www.ctmts.com.br"),
			   );

/*****************************************************************************
	@ Suportt Settings
	@ Configurações do Suporte
	@ true = Sim
	@ false = Não
******************************************************************************/
define("Suportt_Forum", "http://forum.ctmts.com.br/index.php?"); // -- Link da Ártea de Suporte no Fórum (Caso Tenha Fórum)
define("Suportt_Phone", true); // -- Ativar/Desativar Suporte via telefone
##################################################################
	# E-Mails de Suporte
	# Exemplo: 0 => array("E-Mail", "Atendente"),
##################################################################
$_Suportt["Mail"] = array(0 => array("erick-master@ctmts.com.br", "Erick-Master"),
			   			  1 => array("vendas@ctmts.com.br", "Suporte a Vendas"),
						  );
##################################################################
	# Telefones de Suporte
	# Somente se tiver Ativado
	# Exemplo: 0 => array("Numero do Telefone", "Atendente", "Falar com:"),
##################################################################
$_Suportt["Phone"] = array(0 => array("(00) 0000-0000", "Erick-Master", "Erick"),
			   			  );
						  
/*****************************************************************************
	@ Panel Settings
	@ Configurações do Painel de Controle
	@ 1 = Sim
	@ 0 = Não
*****************************************************************************/
$_Panel["Account"]["Dates"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Alterar Dados
$_Panel["Account"]["Change_PID"] = array(1 /* Ativado */); // -- Alterar Personal ID (PID)
$_Panel["Account"]["Change_Mail"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Alterar E-Mail
$_Panel["Account"]["Alt_Vault"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Alterar Baú
$_Panel["Account"]["Connects"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Conexões Recentes
$_Panel["Account"]["ScreenShots"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Enviar / Remover ScreenShots
$_Panel["Account"]["ReferenceLink"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Link de Referência
$_Panel["Char"]["Reset"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Reset System
$_Panel["Char"]["MReset"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Master Reset
$_Panel["Char"]["Transfer_Resets"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Master Reset
$_Panel["Char"]["Trade_RCash"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Trocar Resets por Cash
$_Panel["Char"]["Clear_PK"] =  array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Limpar PK
$_Panel["Char"]["Change_Class"] = array(1 /* Ativado */,0 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Alterar Classe
$_Panel["Char"]["Change_Nick"] = array(1 /* Ativado */,1 /* Free */,0 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Alterar Nick
$_Panel["Char"]["Move_Char"] = array(1 /* Ativado */,0 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Mover Personagem
$_Panel["Char"]["Profile_Char"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Gerenciar Perfil
$_Panel["Char"]["Upload_Img"] = array(1 /* Ativado */,0 /* Free */,0 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Gerenciar Imagem
$_Panel["Char"]["Concert_Points"] = array(1 /* Ativado */,0 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Concertar Pontos
$_Panel["Char"]["Reset_Points"] = array(1 /* Ativado */,0 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Resetar Pontos
$_Panel["Char"]["Distribute_Points"] = array(1 /* Ativado */,0 /* Free */,0 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Distribuir Pontos
$_Panel["Char"]["Clear_Char"] = array(1 /* Ativado */,0 /* Free */,0 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Limpar Personagem
$_Panel["Suportt"]["Tickets"] = array(1 /* Ativado */,1 /* Free */,1 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Tickets de Suporte
$_Panel["Financial"]["Payments"] = array(1 /* Ativado */); // -- Pagamentos
$_Panel["Financial"]["Trade_Amount"] = array(1 /* Ativado */); // -- Troca de Moedas
$_Panel["Financial"]["Buy_VIP"] = array(1 /* Ativado */); // -- Comprar VIP
$_Panel["Financial"]["PagSeguro"] = array(1 /* Ativado */); // -- Módulo PagSeguro (Necessário licença adicional)

/************ Configurações do Reset System ************
	@ Modulo 1 : Reset Acumulativo
	@ Modulo 2 : Reset Pontuativo
	@ Modulo 3 : Reset Tabelado
*******************************************************/
$_Panel["Char"]["Reset"]["General"]["Mode"] = 3; // -- Modulo de Reset

/* Configurações para o Reset Acumulativo/Pontuativo (Modulo 1/2 do Reset System) */
$_Panel["Char"]["Reset"]["General"]["Level"] = array(350 /* Free */,290 /* VIP 1 */,220 /* VIP 2 */,220 /* VIP 3 */,220 /* VIP 4 */,220 /* VIP 5 */); // -- Level Minimo
$_Panel["Char"]["Reset"]["General"]["Money"] = array(120000 /* Free */,50000 /* VIP 1 */,1 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Zen Requerido
$_Panel["Char"]["Reset"]["General"]["Return"] = array(1 /* Free */,5 /* VIP 1 */,10 /* VIP 2 */,15 /* VIP 3 */,20 /* VIP 4 */,25 /* VIP 5 */); // -- Level a Retornar
$_Panel["Char"]["Reset"]["General"]["Invent"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Invetório
$_Panel["Char"]["Reset"]["General"]["Skill"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Skills
$_Panel["Char"]["Reset"]["General"]["Quest"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Resetar Quests
$_Panel["Char"]["Reset"]["General"]["Points"] = array(300 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Ganhar

/* Configurações para o Reset Tabelado (Modulo 3 do Reset System) */
$_Panel["Char"]["Reset"]["Tabulated"]['0-10']["Level"] = array(350 /* Free */,290 /* VIP 1 */,220 /* VIP 2 */,220 /* VIP 3 */,220 /* VIP 4 */,220 /* VIP 5 */); // -- Level Minimo
$_Panel["Char"]["Reset"]["Tabulated"]['0-10']["Money"] = array(120000 /* Free */,50000 /* VIP 1 */,1 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Zen Requerido
$_Panel["Char"]["Reset"]["Tabulated"]['0-10']["Return"] = array(1 /* Free */,5 /* VIP 1 */,10 /* VIP 2 */,15 /* VIP 3 */,20 /* VIP 4 */,25 /* VIP 5 */); // -- Level a Retornar
$_Panel["Char"]["Reset"]["Tabulated"]['0-10']["Invent"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Invetório
$_Panel["Char"]["Reset"]["Tabulated"]['0-10']["Skill"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Skills
$_Panel["Char"]["Reset"]["Tabulated"]['0-10']["Quest"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Resetar Quests
$_Panel["Char"]["Reset"]["Tabulated"]['0-10']["Points"] = array(300 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Ganhar

$_Panel["Char"]["Reset"]["Tabulated"]['11-50']["Level"] = array(350 /* Free */,290 /* VIP 1 */,220 /* VIP 2 */,220 /* VIP 3 */,220 /* VIP 4 */,220 /* VIP 5 */); // -- Level Minimo
$_Panel["Char"]["Reset"]["Tabulated"]['11-50']["Money"] = array(120000 /* Free */,50000 /* VIP 1 */,1 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Zen Requerido
$_Panel["Char"]["Reset"]["Tabulated"]['11-50']["Return"] = array(1 /* Free */,5 /* VIP 1 */,10 /* VIP 2 */,15 /* VIP 3 */,20 /* VIP 4 */,25 /* VIP 5 */); // -- Level a Retornar
$_Panel["Char"]["Reset"]["Tabulated"]['11-50']["Invent"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Invetório
$_Panel["Char"]["Reset"]["Tabulated"]['11-50']["Skill"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Skills
$_Panel["Char"]["Reset"]["Tabulated"]['11-50']["Quest"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Resetar Quests
$_Panel["Char"]["Reset"]["Tabulated"]['11-50']["Points"] = array(300 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Ganhar
$_Panel["Char"]["Reset"]["Tabulated"]['11-50']["SomePoints"] = array(2350 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Somar

$_Panel["Char"]["Reset"]["Tabulated"]['51-100']["Level"] = array(350 /* Free */,290 /* VIP 1 */,220 /* VIP 2 */,220 /* VIP 3 */,220 /* VIP 4 */,220 /* VIP 5 */); // -- Level Minimo
$_Panel["Char"]["Reset"]["Tabulated"]['51-100']["Money"] = array(120000 /* Free */,50000 /* VIP 1 */,1 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Zen Requerido
$_Panel["Char"]["Reset"]["Tabulated"]['51-100']["Return"] = array(1 /* Free */,5 /* VIP 1 */,10 /* VIP 2 */,15 /* VIP 3 */,20 /* VIP 4 */,25 /* VIP 5 */); // -- Level a Retornar
$_Panel["Char"]["Reset"]["Tabulated"]['51-100']["Invent"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Invetório
$_Panel["Char"]["Reset"]["Tabulated"]['51-100']["Skill"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Skills
$_Panel["Char"]["Reset"]["Tabulated"]['51-100']["Quest"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Resetar Quests
$_Panel["Char"]["Reset"]["Tabulated"]['51-100']["Points"] = array(300 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Ganhar
$_Panel["Char"]["Reset"]["Tabulated"]['51-100']["SomePoints"] = array(10350 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Somar

$_Panel["Char"]["Reset"]["Tabulated"]['101-150']["Level"] = array(350 /* Free */,290 /* VIP 1 */,220 /* VIP 2 */,220 /* VIP 3 */,220 /* VIP 4 */,220 /* VIP 5 */); // -- Level Minimo
$_Panel["Char"]["Reset"]["Tabulated"]['101-150']["Money"] = array(120000 /* Free */,50000 /* VIP 1 */,1 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Zen Requerido
$_Panel["Char"]["Reset"]["Tabulated"]['101-150']["Return"] = array(1 /* Free */,5 /* VIP 1 */,10 /* VIP 2 */,15 /* VIP 3 */,20 /* VIP 4 */,25 /* VIP 5 */); // -- Level a Retornar
$_Panel["Char"]["Reset"]["Tabulated"]['101-150']["Invent"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Invetório
$_Panel["Char"]["Reset"]["Tabulated"]['101-150']["Skill"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Skills
$_Panel["Char"]["Reset"]["Tabulated"]['101-150']["Quest"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Resetar Quests
$_Panel["Char"]["Reset"]["Tabulated"]['101-150']["Points"] = array(300 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Ganhar
$_Panel["Char"]["Reset"]["Tabulated"]['101-150']["SomePoints"] = array(19100 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Somar

$_Panel["Char"]["Reset"]["Tabulated"]['151-200']["Level"] = array(350 /* Free */,290 /* VIP 1 */,220 /* VIP 2 */,220 /* VIP 3 */,220 /* VIP 4 */,220 /* VIP 5 */); // -- Level Minimo
$_Panel["Char"]["Reset"]["Tabulated"]['151-200']["Money"] = array(120000 /* Free */,50000 /* VIP 1 */,1 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Zen Requerido
$_Panel["Char"]["Reset"]["Tabulated"]['151-200']["Return"] = array(1 /* Free */,5 /* VIP 1 */,10 /* VIP 2 */,15 /* VIP 3 */,20 /* VIP 4 */,25 /* VIP 5 */); // -- Level a Retornar
$_Panel["Char"]["Reset"]["Tabulated"]['151-200']["Invent"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Invetório
$_Panel["Char"]["Reset"]["Tabulated"]['151-200']["Skill"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Skills
$_Panel["Char"]["Reset"]["Tabulated"]['151-200']["Quest"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Resetar Quests
$_Panel["Char"]["Reset"]["Tabulated"]['151-200']["Points"] = array(300 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Ganhar
$_Panel["Char"]["Reset"]["Tabulated"]['151-200']["SomePoints"] = array(26600 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Somar

$_Panel["Char"]["Reset"]["Tabulated"]['201-300']["Level"] = array(350 /* Free */,290 /* VIP 1 */,220 /* VIP 2 */,220 /* VIP 3 */,220 /* VIP 4 */,220 /* VIP 5 */); // -- Level Minimo
$_Panel["Char"]["Reset"]["Tabulated"]['201-300']["Money"] = array(120000 /* Free */,50000 /* VIP 1 */,1 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Zen Requerido
$_Panel["Char"]["Reset"]["Tabulated"]['201-300']["Return"] = array(1 /* Free */,5 /* VIP 1 */,10 /* VIP 2 */,15 /* VIP 3 */,20 /* VIP 4 */,25 /* VIP 5 */); // -- Level a Retornar
$_Panel["Char"]["Reset"]["Tabulated"]['201-300']["Invent"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Invetório
$_Panel["Char"]["Reset"]["Tabulated"]['201-300']["Skill"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Skills
$_Panel["Char"]["Reset"]["Tabulated"]['201-300']["Quest"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Resetar Quests
$_Panel["Char"]["Reset"]["Tabulated"]['201-300']["Points"] = array(300 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Ganhar
$_Panel["Char"]["Reset"]["Tabulated"]['201-300']["SomePoints"] = array(32850 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Somar

$_Panel["Char"]["Reset"]["Tabulated"]['301-XXX']["Level"] = array(350 /* Free */,290 /* VIP 1 */,220 /* VIP 2 */,220 /* VIP 3 */,220 /* VIP 4 */,220 /* VIP 5 */); // -- Level Minimo
$_Panel["Char"]["Reset"]["Tabulated"]['301-XXX']["Money"] = array(120000 /* Free */,50000 /* VIP 1 */,1 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Zen Requerido
$_Panel["Char"]["Reset"]["Tabulated"]['301-XXX']["Return"] = array(1 /* Free */,5 /* VIP 1 */,10 /* VIP 2 */,15 /* VIP 3 */,20 /* VIP 4 */,25 /* VIP 5 */); // -- Level a Retornar
$_Panel["Char"]["Reset"]["Tabulated"]['301-XXX']["Invent"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Invetório
$_Panel["Char"]["Reset"]["Tabulated"]['301-XXX']["Skill"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Limpar Skills
$_Panel["Char"]["Reset"]["Tabulated"]['301-XXX']["Quest"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5*/); // -- Resetar Quests
$_Panel["Char"]["Reset"]["Tabulated"]['301-XXX']["Points"] = array(300 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Ganhar
$_Panel["Char"]["Reset"]["Tabulated"]['301-XXX']["SomePoints"] = array(42850 /* Free */,400 /* VIP 1 */,500 /* VIP 2 */,600 /* VIP 3 */,700 /* VIP 4 */,800 /* VIP 5*/); // -- Pontos a Somar

/************ Configurações do Master Reset ************
	@ O Sistema credita Golds para as contas Resetadas
	@ Todos os pontos serão resetados
	@ Os Resets serão diminuidos caso ativado
*******************************************************/
$_Panel["Char"]["MReset"]["Level"] = array(400 /* Free */,350 /* VIP 1 */,280 /* VIP 2 */,280 /* VIP 3 */,280 /* VIP 4 */,280 /* VIP 5*/); // -- Level Minimo
$_Panel["Char"]["MReset"]["Resets"] = array(10 /* Free */,5 /* VIP 1 */,1 /* VIP 2 */,1 /* VIP 3 */,1 /* VIP 4 */,1 /* VIP 5 */); // -- Resets Requeridos
$_Panel["Char"]["MReset"]["Money"] = array(400 /* Free */,350 /* VIP 1 */,280 /* VIP 2 */,280 /* VIP 3 */,280 /* VIP 4 */,280 /* VIP 5 */); // -- Zen Requerido
$_Panel["Char"]["MReset"]["Stats"] = array(65000 /* Força */,65000 /* Agilidade */,65000 /* Vitalidade */,65000 /* Energia */,65000 /* Comando (Somente DL/LE */); // -- Stats Requeridos para dar o Master Reset
$_Panel["Char"]["MReset"]["Points"] = array(100 /* Força */,18 /* Agilidade */,15 /* Vitalidade */,30 /* Energia */,0 /* Comando (Somente DL/LE */); // -- Stats após o Master Reset
$_Panel["Char"]["MReset"]["Clear_Reset"] = array(0 /* Free */,0 /* VIP 1 */,1 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,1 /* VIP 5 */); // -- Diminuir Resets
$_Panel["Char"]["MReset"]["Invent"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Limpar Invetório
$_Panel["Char"]["MReset"]["Skill"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Limpar Skills
$_Panel["Char"]["MReset"]["Quest"] = array(0 /* Free */,0 /* VIP 1 */,0 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Resetar Quests
$_Panel["Char"]["MReset"]["Cash"] = array(1 /* Free */,2 /* VIP 1 */,3 /* VIP 2 */,4 /* VIP 3 */,5 /* VIP 4 */,6 /* VIP 5 */); // -- Golds a Receber
$_Panel["Char"]["MReset"]["Coin"] = 1; // -- Moeda a receber (1 a 3)

/************ Configurações do Transferir Resets ************/
$_Panel["Char"]["Transfer_Resets"]["Min_Total"] = 49; // -- Numero minimo de Resets que o char deve conter
$_Panel["Char"]["Transfer_Resets"]["Min_Send"] = 50; // -- Numero minomo de Resets que o char pode enviar

/************ Configurações do Trocar Resets por Cash ************/
$_Panel["Char"]["Trade_RCash"]["Coin"] = 2; // -- Moeda a receber (1 a 3)
$_Panel["Char"]["Trade_RCash"]["Price"] = 10; // -- Preço de cada Moeda em Resets
$_Panel["Char"]["Trade_RCash"]["Min_Total"] = 40; // -- Numero minimo de Resets que o char deve conter
$_Panel["Char"]["Trade_RCash"]["Min_Send"] = 20; // -- Numero minimo de Moeda que o char pode requisitar
$_Panel["Char"]["Trade_RCash"]["Bonus_Register"] = 10; // -- Numero de resets que ganha ao cadastrar (Caso não ganha, deixe 0)

/************ Configurações do Limpar PK ************/
$_Panel["Char"]["Clear_PK"]["Money"] = array(300 /* Free */,400 /* VIP 1 */,1999999719 /* VIP 2 */,0 /* VIP 3 */,0 /* VIP 4 */,0 /* VIP 5 */); // -- Zen Requerido

/************ Configurações do Alterar Nick ************/
$_Panel["Char"]["Change_Nick"]["CheckGuild"] = 0; // -- Obrigar Saida da Guild para Alterar o Nick (Padrão -> 0)
$_Panel["Char"]["Change_Nick"]["Security"] = array("ADM", "SUB", "DV", "GM", "WebZen", "Web-Zen", ); // -- Palavras Bloqueadas (Exemplo: "ADM", "GM")

/************ Configurações do Resetar Pontos ************/
$_Panel["Char"]["Reset_Points"]["Min"] = 10; // -- Minimo de pontos requeridos em todos os Stats

/************ Configurações do Ticket de Suporte ************/
$_Panel["Suportt"]["Tickets"]["Departaments"] = array("Suporte Geral", "Suporte Financeiro",); // -- Departamentos de Suporte
$_Panel["Suportt"]["Tickets"]["Limit_Open"] = 5; // -- Numero maximo de Tickets em Aberto

/************ Configurações da Troca de Moedas ************/
$_Panel["Financial"]["Trade_Amount"]["Price"][0] = 5; // -- Preço da Moeda 1 para a Troca de Moeda 2 para Moeda 1
$_Panel["Financial"]["Trade_Amount"]["Price"][1] = 10; // -- Preço da Moeda 1 para a Troca de Moeda 3 para Moeda 1
$_Panel["Financial"]["Trade_Amount"]["Price"][2] = 5; // -- Preço da Moeda 2 para a Troca de Moeda 3 para Moeda 2

/*****************************************************************************
	@ Panel Admin Settings
	@ Configurações do Painel Administrativo
	@ 1 = Game Master
	@ 2 = Sub-Administrador
	@ 3 = Administrador
*****************************************************************************/
$_PanelAdmin["General"]["Master"] = array("erick", "admlogan");// -- Contas Admin Master (Exemplo: "admin","adm2")
$_PanelAdmin["ManageX"] = 1; // -- Permissão minima para Gerenciamento Geral
$_PanelAdmin["Mail"] = 3; // -- Enviar E-Mail ao Jogador
$_PanelAdmin["Warning"] = 3; // -- Permissão minima para Gerenciar o Aviso Importante
$_PanelAdmin["News"] = 2; // -- Permissão minima para Gerenciar Noticias
$_PanelAdmin["ScreenShots"] = 2; // -- Permissão minima para Gerenciar ScreenShots (Deletar)
$_PanelAdmin["Downloads"] = 3; // -- Permissão minima para Gerenciar Downloads
$_PanelAdmin["Staff"] = 3; // -- Permissão minima para Gerenciar a Equipe
$_PanelAdmin["Poll"] = 3; // -- Permissão minima para gerenciar Enquetes
$_PanelAdmin["Account"] = 2; // -- Permissão minima para Gerenciar Contas
$_PanelAdmin["Character"] = 1; // -- Permissão minima para Gerenciar Chars
$_PanelAdmin["Reference"] = 3; // -- Permissão minima para Gerenciar Referência
$_PanelAdmin["Tickets"] = 2; // -- Permissão minima para Gerenciar Tickets de Suporte
$_PanelAdmin["Payments"] = 3; // -- Permissão minima para Gerenciamento de Pagamentos
$_PanelAdmin["VIP"] = 2; // -- Permissão minima para Gerenciar VIP
$_PanelAdmin["Cash"] = 2; // -- Permissão minima para Gerenciar Golds
$_PanelAdmin["SQL"] = 3; // -- Permissão minima para Gerenciar o SQL
$_PanelAdmin["RaffleSystem"] = 3; // -- Permissão minima para Gerenciar o sistema de Sorteio

/************ Configurações do Gerenciamento Geral ************/
$_PanelAdmin["Manage"]["Sitronize"] = 1; // -- Permisão minima para Sitronizar VIPs/Contas BAN/Chars Ban
$_PanelAdmin["Manage"]["EffectWeb"] = array("erick", "admlogan", ); // -- Contas com permisão de gerenciar Licença da Effect Web (Exemplo: "admin","adm2")

/************ Configurações do Gerenciamento do CronJob ************/
$_PanelAdmin["CronbJob"]["Security"] = array("erick", "admlogan", ); // -- Contas com permisão de gerenciar o CronJob (Exemplo: "admin","adm2")

/************ Configurações do Gerenciar Contas ************/
$_PanelAdmin["Accounts"]["Manage"] = 3; // -- Permisão minima para Gerenciar Contas
$_PanelAdmin["Accounts"]["Ban"]["Send_Mail"] = true; // -- Enviar E-Mail a conta caso for banida (Padrão -> true)

/************ Configurações do Gerenciar Personagens ************/
$_PanelAdmin["Characters"]["Create"] = 3; // -- Permisão minima para Criar Personagens
$_PanelAdmin["Characters"]["Manage"] = 3; // -- Permisão minima para Editar Personagens
$_PanelAdmin["Characters"]["Ban"]["Send_Mail"] = true; // -- Enviar E-Mail a conta caso o char for banido (Padrão -> true)

/************ Configurações do Gerenciar Tickets ************/
$_PanelAdmin["Ticket"]["Delete"] = 3; // -- Permisão minima para deletar Tickets

/************ Configurações do Gerenciar Pagamentos ************/
$_PanelAdmin["Payment"]["Auto_Credit"] = true; // -- Creditar Golds altomaticamente ao Confirmar Pagamento (Padrão -> true)
$_PanelAdmin["Payment"]["Delete"] = 3; // -- Permisão minima para deletar Pagamentos

/************ Configurações do Gerenciar VIP ************/
$_PanelAdmin["VIPs"]["All"] = 3; // -- Permisão minima para adicionar VIP em todas as contas Free
						  
/*****************************************************************************
	@ Home Settings
	@ Configurações da Pagina Home
	@ true = Sim
	@ false = Não
*****************************************************************************/
define("Show_News", true); // -- Mostrar Notícias (Padrão -> true)
define("Top_News", 7); // -- Total de Notícias (Padrão -> 7)
define("Board_News", false); // -- Mostrar Notícias do Fórum (Padrão -> true)
define("Show_Warning", true); // -- Mostrar Aviso Importante (Padrão -> true)
define("Siege_Enable", true); // -- Mostrar Informações do Castle Siege
define("Siege_Hour", "00:00"); // -- Hora do Castle Siege
define("Top_Resets", true); // -- Mostrar Top Resets/Master Resets (Padrão -> true)
define("Top_RDayRWeekRMonth", true); // -- Mostrar Top Resets Diarios/Semanais/Mensais (Padrão -> true)
define("Top_PKHero", true); // -- Mostrar Top PK/Hero (Padrão -> true)
define("Top_Guilds", true); // -- Mostrar Top Guilds (Padrão -> true)
define("Show_ScreenShots", true); // -- Mostrar ScreenShots Recentes (Padrão -> true)
define("SIEGE_DATE_FIX", TRUE); // -- Habilite esta opção caso o site exibir somado +1 a data do Siege (Padrão -> TRUE)

/***** Configurações das Notícias via Fórum ************
	@ Modulo 1 : Invision Power Board (IPB)
	@ Modulo 2 : vBulletin
	@ Modulo 3 : phpBB
	@ Modulo 4 : Simple Machines Forum (SMF)
*******************************************************/
$_Home["Board"]["Mode"] = 1; // -- Modulo do Fórum
$_Home["Board"]["Link"] = "http://localhost:8090/board/smf"; // -- Link do Fórum
$_Home["Board"]["MySQL"]["Host"] = "localhost"; // -- Host/IP do MySQL (Padrão -> localhost)
$_Home["Board"]["MySQL"]["User"] = "root"; // -- Úsuario do MySQL
$_Home["Board"]["MySQL"]["Pass"] = "xxxxx"; // -- Senha do MySQL
$_Home["Board"]["MySQL"]["DataBase"] = "invision"; // -- DataBase do Fórum (Padrão -> forum)
$_Home["Board"]["Prefix"] = "ctm_"; // -- Prefixo das Tables (Padrão -> ibf_)
$_Home["Board"]["Forum_ID"] = array(1,2); // -- IDs dos Fóruns das Notícias
$_Home["Board"]["Debug"] = false; // -- Ativar Debug dos Titulos (Caso esteja Bugado)
$_Home["Board"]["Top_News"] = 7; // -- Tota de Notícias (Padrão -> 7)
$_Home["Board"]["Target"] = true; // -- Abrir em nova Janela (Padrão -> true)

/*****************************************************************************
	@ Ranking Settings
	@ Configurações dos Rankings
	@ true = Sim
	@ false = Não
******************************************************************************/
$_Ranking["Reset"] = array(true /* Ativar/Desativar */,50 /* Limite */); // -- Ranking de Reset
$_Ranking["ResetDay"] = array(true /* Ativar/Desativar */,50 /* Limite */); // -- Ranking de Reset Diario
$_Ranking["ResetWeek"] = array(true /* Ativar/Desativar */,50 /* Limite */); // -- Ranking de Reset Semanal
$_Ranking["ResetMonth"] = array(true /* Ativar/Desativar */,50 /* Limite */); // -- Ranking de Reset Mensal
$_Ranking["MReset"] = array(true /* Ativar/Desativat */,50 /* Limite */); // -- Ranking de Master Reset
$_Ranking["Guild"] = array(true /* Ativar/Desativar */,50 /* Limite */); // -- Ranking de Guilds
$_Ranking["PK"] = array(true /* Ativar/Desativar */,50 /* Limite */); // -- Ranking de PK
$_Ranking["Hero"] = array(true /* Ativar/Desativar */,50 /* Limite */); // -- Ranking de Hero
$_Ranking["Gens"] = array(true /* Ativar/Desativar */,50 /* Limite */); // -- Ranking de Gens
##################################################################
	# Gens Ranking
	# Configurações do Ranking de Gens
	# Modulo 1 : ENCGames and Softwares
##################################################################
$_Ranking["Gens"]["Enable"] = true; // -- Ativar/Desativar Ranking de Gens
$_Ranking["Gens"]["Module"] = 1; // -- Modulo de Gens
$_Ranking["Gens"]["DB"] = "MuOnline_ENC"; // -- DataBase de Gens (Padrão -> MuOnline)
$_Ranking["Gens"]["Table"] = "T_GensSystem"; // -- Tabela de Gens (Padrão -> T_GensSystem)
##################################################################
	# Tops Ranking
	# Lista de Top do Gerador de Rankings
	# Exemplo: 0 => Numero Maximo
##################################################################
$_Ranking["Gerator"]["TOP"] = array(0 => 10,
									1 => 50,
									2 => 100,
									3 => 200,
									);

/*****************************************************************************
	@ Dados Bancarios
	@ Configurações das contas Bancarias
	@ Exemplo: 0 => array("Banco", "Agencia", "Numero da Conta", "Operação", "Favorecido"),
******************************************************************************/
$_BankList = array(0 => array("Caixa Economica Federal #1", "AAAA", "XXXXXXXX-Y", "EEE", "CTM TeaM Softwares"),
				   1 => array("Caixa Economica Federal #2", "BBBB", "MMMMMMMM-N", "III", "CTM TeaM Softwares"),
				  );
				  
/*****************************************************************************
	@ PagSeguro Module (Powered by Litlle)
	@ Configurações do módulo PagSeguro
	@ Necessário licença adicional
******************************************************************************/
$_PAGSEGURO['API_KEY'] = "24EF263E-ED02CFAA-3F33F852-58AB216A"; // -- Chave de segurança recebida junto ao módulo
$_PAGSEGURO['MAIL_RECEIVER'] = "xxxxx@xxxx.com"; // -- E-Mail do recebedor
$_PAGSEGURO['PROMOTIONS'] = array(/* n */0, array(/* de */0,/* até */29, /* multiplicação */2),
								  /* n */1, array(/* de */ 30,/* até */149, /* multiplicação */2),
								  /* n */2, array(/* de */150,/* até */9999, /* multiplicação */2)); 

/*****************************************************************************
	@ Coin Settings
	@ Configurações de Moedas
******************************************************************************/
define("Coin_Number", 3); // -- Numero de Moedas [De 1 a 3]
define("Coin_1", "Cash"); // -- Nome da Moeda 1
define("Coin_2", "Gold"); // -- Nome da Moeda 2
define("Coin_3", "Point"); // -- Nome da Moeda 3
define("GL_DB", "MuOnline"); // -- DataBase de Golds (Padrão -> MuOnline)
define("GL_Table", "MEMB_INFO"); // -- Tabela de Golds (Padrão -> MEMB_INFO)
define("GL_Column_1", "Cash"); // -- Coluna de Golds 1 (Padrão -> Cash)
define("GL_Column_2", "Gold"); // -- Coluna de Golds 2 (Padrão -> Gold)
define("GL_Column_3", "Points"); // -- Coluna de Golds 3 (Padrão -> Point)
define("GL_Login", "memb___id"); // -- Coluna de Logins para Golds (Padrão -> memb___id)
##################################################################
	# Preços de Coin
	# Exemplo: 0 => array(Numero de Coin, Preço em Dinheiro),
##################################################################
$_Coin = array(0 => array("1", "R$ 1.00"),
			   1 => array("5", "R$ 5.00"),
			   2 => array("10", "R$ 10.00"),
			  );

/*****************************************************************************
	@ VIP Settings
	@ Configurações de Conta VIP
******************************************************************************/
define("VIP_Number", 5); // -- Numero de tipos de VIP [De 2 a 5] (Padrão -> 2)
define("VIP_1", "VIP-Normal"); // -- Nome do VIP 1
define("VIP_2", "VIP-Master"); // -- Nome do VIP 2
define("VIP_3", "VIP-Shock"); // -- Nome do VIP 3
define("VIP_4", "VIP-Super"); // -- Nome do VIP 4
define("VIP_5", "VIP-Mega"); // -- Nome do VIP 5
define("VIP_DB", "MuOnline"); // -- DataBase das contas VIP (Padrão -> MuOnline)
define("VIP_Table", "MEMB_INFO"); // -- Tabela das contas VIP (Padrão -> MEMB_INFO)
define("VIP_Column", "Vip"); // -- Coluna de VIP (Padrão -> VIP_Type)
define("VIP_Begin", "VIP_Begin"); // -- Columna de Inicio do VIP (Padrão -> VIP_Begin)
define("VIP_Time", "VIP_Time"); // -- Coluna de Tempo VIP (Padrão -> VIP_Time)
define("VIP_Credits", "VIP_Integer"); // -- Coluna de Tempo em numeros Inteiros (Padrão -> VIP_Integer)
define("VIP_Login", "memb___id"); // -- Coluna de Logins VIP (Padrão -> memb___id)
##################################################################
	# Preços de VIP
	# Os preços é em Coin
	# Exemplo: 0 => array(Dias de VIP, Preço em Coins),
##################################################################
/****************** VIP 1 *******************/
$_VIP[1] =	array(0 => array(30, 5),
			  	  1 => array(90, 15),
			  	  2 => array(365, 60),
			 	 );
/****************** VIP 2 *******************/
$_VIP[2] =	array(0 => array(30, 10),
			 	  1 => array(90, 30),
			 	  2 => array(365, 120),
			 	 );
				 
/****************** VIP 3 *******************/
$_VIP[3] =	array(0 => array(30, 10),
			 	  1 => array(90, 30),
			 	  2 => array(365, 120),
			 	 );

/****************** VIP 4 *******************/
$_VIP[4] =	array(0 => array(30, 10),
			 	  1 => array(90, 30),
			 	  2 => array(365, 120),
			 	 );

/****************** VIP 5 *******************/
$_VIP[5] =	array(0 => array(30, 10),
			 	  1 => array(90, 30),
			 	  2 => array(365, 120),
			 	 );
				 
				 
/*****************************************************************************
	@ CronJob Settings
	@ Configurações do sistema de CronJob
	@ true = Sim
	@ false = Não
******************************************************************************/
define("CronJob_Enable", true); // -- Ativar/Desativar CronJob
define("CronJob_Debug", true); // -- Ativar/Desativar Modo Debug
define("CronJob_Clear", true); // -- Ativar/Desativar Sistema para reativação dos CronTabs
define("CronJob_Time", "05"); // -- Hora para Reativar os CronTabs
define("CronJob_Minute", "42"); // -- Minuto para Reativar os CronTabs
				 
/*****************************************************************************
	@ Class Settings
	@ Configurações da Classes
******************************************************************************/
$_ClassType = array("DW" => array(0, "Dark Wizard"), // -- Dark Wizard
				    "SM" => array(1, "Soul Master"), // -- Soul Master
					"GM" => array(2, "Grand Master"), // -- Grand Master
					"DK" => array(16, "Dark Knight"), // -- Dark Knight
					"BK" => array(17, "Blade Knight"), // -- Blade Knight
					"BM" => array(18, "Blade Master"), // -- Blade Master
					"FE" => array(32, "Fary Elf"), // -- Fary Elf
					"ME" => array(33, "Muse Elf"), // -- Muse Elf
					"HE" => array(34, "High Elf"), // -- High Elf
					"MG" => array(48, "Magic Gladiator"), // -- Magic Gladiator
					"DM" => array(49, "Duel Master"), // -- Duel Master
					"DM2" => array(50, "Duel Master"), // -- Duel Master (Em algumas versões Season 4/Superior)
					"DL" => array(64, "Dark Lord"), // -- Dark Lord
					"LE" => array(65, "Lord Emperor"), // -- Lord Emperor
					"LE2" => array(66, "Lord Emperor"), // -- Lord Emperor (Em algumas versões Season 4/Superior)
					"SU" => array(80, "Summoner"), // -- Summoner
					"BS" => array(81, "Blood Summoner"), // -- Blood Summoner
					"DIM" => array(82, "Dimension Master"), // -- Dimension Master
					"RF" => array(96, "Rage Fighter"), // -- Rage Fighter (Season 6)
					"FM" => array(98, "Fist Master"), // -- Fist Master (Season 6)
				    );
					
/*****************************************************************************
	@ Map Settings
	@ Configurações dos Mapas
	@ Exemplo: 0 => array(Numero do Mapa, Coordenada X, Coordenada Y, "Nome do Mapa"),
******************************************************************************/
$_MapInfo = array(0 => array(0, 125, 125, "Lorencia"),
    			  1 => array(1, 231, 126, "Dungeon"),
                  2 => array(2, 120, 38, "Devias"),
    			  3 => array(3, 174, 108, "Noria"),
   				  4 => array(4, 207, 78, "Lost Tower"), 
      			  5 => array(6, 62, 114, "Stadium"),
   				  6 => array(7, 16, 14, "Atlans"),
          		  7 => array(8, 202, 68, "Tarkan"),
   				  8 => array(10, 125, 125, "Icarus"),
    			  9 => array(24, 125, 125, "Kalima 1"),
    			  10 => array(25, 125, 125, "Kalima 2"),
    			  11 => array(26, 125, 125, "Kalima 3"),
    			  12 => array(27, 125, 125, "Kalima 4"),
    			  13 => array(28, 125, 125, "Kalima 5"),
    			  14 => array(29, 125, 125, "Kalima 6"),
   				  15 => array(36, 125, 125, "Kalima 7"),
    			  16 => array(30, 93, 214, "Valey of Loren"),
    			  17 => array(31, 93, 214, "Land of Trial"),
    			  18 => array(33, 84, 13, "Aida"),
    			  19 => array(34, 228, 41, "Crywolf"),
    			  20 => array(37, 71, 218, "KantruLand"),
    			  21 => array(38, 71, 105, "KantruRuin"),
    			  22 => array(39, 69, 185, "Kantru Island"),
    			  23 => array(41, 28, 76, "Barracks"),
    			  24 => array(42, 97, 185, "Refuge"),
    			  25 => array(51, 51, 216, "Elbeland"),
    			  26 => array(56, 140, 106, "Swamp of Calmness"),
    			  27 => array(57, 221, 210, "Raklion"),
    			  28 => array(64, 51, 216, "Vulcanus"),
    			  29 => array(79, 51, 216, "Loren Market"),
   				  30 => array(80, 126, 124, "Kalrutan 1"),
    			  31 => array(81, 163, 16, "kalrutan 2"),
    			  );

?>