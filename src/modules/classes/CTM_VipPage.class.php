<?php
//**********************************************//
// -> Effect Web                                //
// -> Powered By: Erick-Master                  //
// -> CTM TeaM Softwares                        //
// -> www.ctmts.com.br                          //
//**********************************************//

$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>CTM-Error: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}

if(IN_EFFECTWEB != "47e5098c88cc5f67543414ff1af32efc")
	exit("<!-- CTM.Error(x); -->");

if(!class_exists("CTM_VipPage")) :

class CTM_VipPage
{
	public function __construct()
	{
		global $CTM_Template, $_Panel;

		echo("<script type=\"text/javascript\" src=\"modules/header/javascripts/SpryTabbedPanels.js\"></script>
			  <style type=\"text/css\"> @import url('modules/header/css/SpryTabbedPanels.css'); </style>\n\r");
			  
		$Advantages["Dates"] = array(
		$_Panel["Account"]["Dates"][1] == 1 ? "success" : "error", 
		$_Panel["Account"]["Dates"][2] == 1 ? "success" : "error", 
		$_Panel["Account"]["Dates"][3] == 1 ? "success" : "error", 
		$_Panel["Account"]["Dates"][4] == 1 ? "success" : "error", 
		$_Panel["Account"]["Dates"][5] == 1 ? "success" : "error", 
		$_Panel["Account"]["Dates"][6] == 1 ? "success" : "error"
		);
		$Advantages["PM_System"] = array(
		$_Panel["Account"]["PM_System"][1] == 1 ? "success" : "error", 
		$_Panel["Account"]["PM_System"][2] == 1 ? "success" : "error", 
		$_Panel["Account"]["PM_System"][3] == 1 ? "success" : "error", 
		$_Panel["Account"]["PM_System"][4] == 1 ? "success" : "error", 
		$_Panel["Account"]["PM_System"][5] == 1 ? "success" : "error", 
		$_Panel["Account"]["PM_System"][6] == 1 ? "success" : "error"
		);
		$Advantages["Alt_Vault"] = array(
		$_Panel["Account"]["Alt_Vault"][1] == 1 ? "success" : "error", 
		$_Panel["Account"]["Alt_Vault"][2] == 1 ? "success" : "error", 
		$_Panel["Account"]["Alt_Vault"][3] == 1 ? "success" : "error", 
		$_Panel["Account"]["Alt_Vault"][4] == 1 ? "success" : "error", 
		$_Panel["Account"]["Alt_Vault"][5] == 1 ? "success" : "error", 
		$_Panel["Account"]["Alt_Vault"][6] == 1 ? "success" : "error"
		);
		$Advantages["Connects"] = array(
		$_Panel["Account"]["Connects"][1] == 1 ? "success" : "error",
		$_Panel["Account"]["Connects"][2] == 1 ? "success" : "error", 
		$_Panel["Account"]["Connects"][3] == 1 ? "success" : "error", 
		$_Panel["Account"]["Connects"][4] == 1 ? "success" : "error", 
		$_Panel["Account"]["Connects"][5] == 1 ? "success" : "error", 
		$_Panel["Account"]["Connects"][6] == 1 ? "success" : "error"
		);
		$Advantages["Reset"] = array(
		$_Panel["Char"]["Reset"]["General"]["Level"][0], 
		$_Panel["Char"]["Reset"]["General"]["Level"][1], 
		$_Panel["Char"]["Reset"]["General"]["Level"][2], 
		$_Panel["Char"]["Reset"]["General"]["Level"][3], 
		$_Panel["Char"]["Reset"]["General"]["Level"][4], 
		$_Panel["Char"]["Reset"]["General"]["Level"][5]
		);
		$Advantages["MReset"] = array(
		$_Panel["Char"]["MReset"]["Cash"][0], 
		$_Panel["Char"]["MReset"]["Cash"][1], 
		$_Panel["Char"]["MReset"]["Cash"][2], 
		$_Panel["Char"]["MReset"]["Cash"][3], 
		$_Panel["Char"]["MReset"]["Cash"][4], 
		$_Panel["Char"]["MReset"]["Cash"][5]
		);
		$Advantages["Clear_PK"] = array(
		$_Panel["Char"]["Clear_PK"][1] == 1 ? "success" : "error", 
		$_Panel["Char"]["Clear_PK"][2] == 1 ? "success" : "error", 
		$_Panel["Char"]["Clear_PK"][3] == 1 ? "success" : "error", 
		$_Panel["Char"]["Clear_PK"][4] == 1 ? "success" : "error", 
		$_Panel["Char"]["Clear_PK"][5] == 1 ? "success" : "error", 
		$_Panel["Char"]["Clear_PK"][6] == 1 ? "success" : "error"
		);
		$Advantages["Change_Class"] = array(
		$_Panel["Char"]["Change_Class"][1] == 1 ? "success" : "error", 
		$_Panel["Char"]["Change_Class"][2] == 1 ? "success" : "error", 
		$_Panel["Char"]["Change_Class"][3] == 1 ? "success" : "error", 
		$_Panel["Char"]["Change_Class"][4] == 1 ? "success" : "error", 
		$_Panel["Char"]["Change_Class"][5] == 1 ? "success" : "error", 
		$_Panel["Char"]["Change_Class"][6] == 1 ? "success" : "error"
		);
		$Advantages["Change_Nick"] = array(
		$_Panel["Char"]["Change_Nick"][1] == 1 ? "success" : "error", 
		$_Panel["Char"]["Change_Nick"][2] == 1 ? "success" : "error", 
		$_Panel["Char"]["Change_Nick"][3] == 1 ? "success" : "error", 
		$_Panel["Char"]["Change_Nick"][4] == 1 ? "success" : "error", 
		$_Panel["Char"]["Change_Nick"][5] == 1 ? "success" : "error", 
		$_Panel["Char"]["Change_Nick"][6] == 1 ? "success" : "error"
		);
		$Advantages["Move_Char"] = array(
		$_Panel["Char"]["Move_Char"][1] == 1 ? "success" : "error", 
		$_Panel["Char"]["Move_Char"][2] == 1 ? "success" : "error", 
		$_Panel["Char"]["Move_Char"][3] == 1 ? "success" : "error", 
		$_Panel["Char"]["Move_Char"][4] == 1 ? "success" : "error", 
		$_Panel["Char"]["Move_Char"][5] == 1 ? "success" : "error", 
		$_Panel["Char"]["Move_Char"][6] == 1 ? "success" : "error"
		);
		$Advantages["Profile_Char"] = array(
		$_Panel["Char"]["Profile_Char"][1] == 1 ? "success" : "error", 
		$_Panel["Char"]["Profile_Char"][2] == 1 ? "success" : "error", 
		$_Panel["Char"]["Profile_Char"][3] == 1 ? "success" : "error", 
		$_Panel["Char"]["Profile_Char"][4] == 1 ? "success" : "error", 
		$_Panel["Char"]["Profile_Char"][5] == 1 ? "success" : "error", 
		$_Panel["Char"]["Profile_Char"][6] == 1 ? "success" : "error"
		);
		$Advantages["Upload_Img"] = array(
		$_Panel["Char"]["Upload_Img"][1] == 1 ? "success" : "error", 
		$_Panel["Char"]["Upload_Img"][2] == 1 ? "success" : "error", 
		$_Panel["Char"]["Upload_Img"][3] == 1 ? "success" : "error", 
		$_Panel["Char"]["Upload_Img"][4] == 1 ? "success" : "error", 
		$_Panel["Char"]["Upload_Img"][5] == 1 ? "success" : "error", 
		$_Panel["Char"]["Upload_Img"][6] == 1 ? "success" : "error"
		);
		$Advantages["Reset_Points"] = array(
		$_Panel["Char"]["Reset_Points"][1] == 1 ? "success" : "error", 
		$_Panel["Char"]["Reset_Points"][2] == 1 ? "success" : "error", 
		$_Panel["Char"]["Reset_Points"][3] == 1 ? "success" : "error", 
		$_Panel["Char"]["Reset_Points"][4] == 1 ? "success" : "error", 
		$_Panel["Char"]["Reset_Points"][5] == 1 ? "success" : "error", 
		$_Panel["Char"]["Reset_Points"][6] == 1 ? "success" : "error"
		);
		$Advantages["Distribute_Points"] = array(
		$_Panel["Char"]["Distribute_Points"][1] == 1 ? "success" : "error", 
		$_Panel["Char"]["Distribute_Points"][2] == 1 ? "success" : "error", 
		$_Panel["Char"]["Distribute_Points"][3] == 1 ? "success" : "error", 
		$_Panel["Char"]["Distribute_Points"][4] == 1 ? "success" : "error", 
		$_Panel["Char"]["Distribute_Points"][5] == 1 ? "success" : "error", 
		$_Panel["Char"]["Distribute_Points"][6] == 1 ? "success" : "error"
		);
		$Advantages["Clear_Char"] = array(
		$_Panel["Char"]["Clear_Char"][1] == 1 ? "success" : "error", 
		$_Panel["Char"]["Clear_Char"][2] == 1 ? "success" : "error", 
		$_Panel["Char"]["Clear_Char"][3] == 1 ? "success" : "error", 
		$_Panel["Char"]["Clear_Char"][4] == 1 ? "success" : "error", 
		$_Panel["Char"]["Clear_Char"][5] == 1 ? "success" : "error", 
		$_Panel["Char"]["Clear_Char"][6] == 1 ? "success" : "error"
		);
		
		$CTM_Template->Set("Coin_Table", $this->Gold_Table());
		$CTM_Template->Set("Bank_List", $this->Bank_List());
		
		$CTM_Template->Set("Advantages#Date_Free", $Advantages["Dates"][0]);
		$CTM_Template->Set("Advantages#PM_System_Free", $Advantages["PM_System"][0]);
		$CTM_Template->Set("Advantages#Alt_Vault_Free", $Advantages["Alt_Vault"][0]);
		$CTM_Template->Set("Advantages#Connects_Free", $Advantages["Connects"][0]);
		$CTM_Template->Set("Advantages#Reset_Free", $Advantages["Reset"][0]);
		$CTM_Template->Set("Advantages#MReset_Free", $Advantages["MReset"][0]);
		$CTM_Template->Set("Advantages#Clear_PK_Free", $Advantages["Clear_PK"][0]);
		$CTM_Template->Set("Advantages#Change_Class_Free", $Advantages["Change_Class"][0]);
		$CTM_Template->Set("Advantages#Change_Nick_Free", $Advantages["Change_Nick"][0]);
		$CTM_Template->Set("Advantages#Move_Char_Free", $Advantages["Move_Char"][0]);
		$CTM_Template->Set("Advantages#Profile_Char_Free", $Advantages["Profile_Char"][0]);
		$CTM_Template->Set("Advantages#Upload_Img_Free", $Advantages["Upload_Img"][0]);
		$CTM_Template->Set("Advantages#Reset_Points_Free" ,$Advantages["Reset_Points"][0]);
		$CTM_Template->Set("Advantages#Distribute_Points_Free", $Advantages["Distribute_Points"][0]);
		$CTM_Template->Set("Advantages#Clear_Char_Free", $Advantages["Clear_Char"][0]);
		
		$CTM_Template->Set("Advantages#Date_VIP1", $Advantages["Dates"][1]);
		$CTM_Template->Set("Advantages#PM_System_VIP1", $Advantages["PM_System"][1]);
		$CTM_Template->Set("Advantages#Alt_Vault_VIP1", $Advantages["Alt_Vault"][1]);
		$CTM_Template->Set("Advantages#Connects_VIP1", $Advantages["Connects"][1]);
		$CTM_Template->Set("Advantages#Reset_VIP1", $Advantages["Reset"][1]);
		$CTM_Template->Set("Advantages#MReset_VIP1", $Advantages["MReset"][1]);
		$CTM_Template->Set("Advantages#Clear_PK_VIP1", $Advantages["Clear_PK"][1]);
		$CTM_Template->Set("Advantages#Change_Class_VIP1", $Advantages["Change_Class"][1]);
		$CTM_Template->Set("Advantages#Change_Nick_VIP1", $Advantages["Change_Nick"][1]);
		$CTM_Template->Set("Advantages#Move_Char_VIP1", $Advantages["Move_Char"][1]);
		$CTM_Template->Set("Advantages#Profile_Char_VIP1", $Advantages["Profile_Char"][1]);
		$CTM_Template->Set("Advantages#Upload_Img_VIP1", $Advantages["Upload_Img"][1]);
		$CTM_Template->Set("Advantages#Reset_Points_VIP1" ,$Advantages["Reset_Points"][1]);
		$CTM_Template->Set("Advantages#Distribute_Points_VIP1", $Advantages["Distribute_Points"][1]);
		$CTM_Template->Set("Advantages#Clear_Char_VIP1", $Advantages["Clear_Char"][1]);
		
		$CTM_Template->Set("Advantages#Date_VIP2", $Advantages["Dates"][2]);
		$CTM_Template->Set("Advantages#PM_System_VIP2", $Advantages["PM_System"][2]);
		$CTM_Template->Set("Advantages#Alt_Vault_VIP2", $Advantages["Alt_Vault"][2]);
		$CTM_Template->Set("Advantages#Connects_VIP2", $Advantages["Connects"][2]);
		$CTM_Template->Set("Advantages#Reset_VIP2", $Advantages["Reset"][2]);
		$CTM_Template->Set("Advantages#MReset_VIP2", $Advantages["MReset"][2]);
		$CTM_Template->Set("Advantages#Clear_PK_VIP2", $Advantages["Clear_PK"][2]);
		$CTM_Template->Set("Advantages#Change_Class_VIP2", $Advantages["Change_Class"][2]);
		$CTM_Template->Set("Advantages#Change_Nick_VIP2", $Advantages["Change_Nick"][2]);
		$CTM_Template->Set("Advantages#Move_Char_VIP2", $Advantages["Move_Char"][2]);
		$CTM_Template->Set("Advantages#Profile_Char_VIP2", $Advantages["Profile_Char"][2]);
		$CTM_Template->Set("Advantages#Upload_Img_VIP2", $Advantages["Upload_Img"][2]);
		$CTM_Template->Set("Advantages#Reset_Points_VIP2" ,$Advantages["Reset_Points"][2]);
		$CTM_Template->Set("Advantages#Distribute_Points_VIP2", $Advantages["Distribute_Points"][2]);
		$CTM_Template->Set("Advantages#Clear_Char_VIP2", $Advantages["Clear_Char"][2]);
		
		$CTM_Template->Set("Advantages#Date_VIP3", $Advantages["Dates"][3]);
		$CTM_Template->Set("Advantages#PM_System_VIP3", $Advantages["PM_System"][3]);
		$CTM_Template->Set("Advantages#Alt_Vault_VIP3", $Advantages["Alt_Vault"][3]);
		$CTM_Template->Set("Advantages#Connects_VIP3", $Advantages["Connects"][3]);
		$CTM_Template->Set("Advantages#Reset_VIP3", $Advantages["Reset"][3]);
		$CTM_Template->Set("Advantages#MReset_VIP3", $Advantages["MReset"][3]);
		$CTM_Template->Set("Advantages#Clear_PK_VIP3", $Advantages["Clear_PK"][3]);
		$CTM_Template->Set("Advantages#Change_Class_VIP3", $Advantages["Change_Class"][3]);
		$CTM_Template->Set("Advantages#Change_Nick_VIP3", $Advantages["Change_Nick"][3]);
		$CTM_Template->Set("Advantages#Move_Char_VIP3", $Advantages["Move_Char"][3]);
		$CTM_Template->Set("Advantages#Profile_Char_VIP3", $Advantages["Profile_Char"][3]);
		$CTM_Template->Set("Advantages#Upload_Img_VIP3", $Advantages["Upload_Img"][3]);
		$CTM_Template->Set("Advantages#Reset_Points_VIP3" ,$Advantages["Reset_Points"][3]);
		$CTM_Template->Set("Advantages#Distribute_Points_VIP3", $Advantages["Distribute_Points"][3]);
		$CTM_Template->Set("Advantages#Clear_Char_VIP3", $Advantages["Clear_Char"][3]);
		
		$CTM_Template->Set("Advantages#Date_VIP4", $Advantages["Dates"][4]);
		$CTM_Template->Set("Advantages#PM_System_VIP4", $Advantages["PM_System"][4]);
		$CTM_Template->Set("Advantages#Alt_Vault_VIP4", $Advantages["Alt_Vault"][4]);
		$CTM_Template->Set("Advantages#Connects_VIP4", $Advantages["Connects"][4]);
		$CTM_Template->Set("Advantages#Reset_VIP4", $Advantages["Reset"][4]);
		$CTM_Template->Set("Advantages#MReset_VIP4", $Advantages["MReset"][4]);
		$CTM_Template->Set("Advantages#Clear_PK_VIP4", $Advantages["Clear_PK"][4]);
		$CTM_Template->Set("Advantages#Change_Class_VIP4", $Advantages["Change_Class"][4]);
		$CTM_Template->Set("Advantages#Change_Nick_VIP4", $Advantages["Change_Nick"][4]);
		$CTM_Template->Set("Advantages#Move_Char_VIP4", $Advantages["Move_Char"][4]);
		$CTM_Template->Set("Advantages#Profile_Char_VIP4", $Advantages["Profile_Char"][4]);
		$CTM_Template->Set("Advantages#Upload_Img_VIP4", $Advantages["Upload_Img"][4]);
		$CTM_Template->Set("Advantages#Reset_Points_VIP4" ,$Advantages["Reset_Points"][4]);
		$CTM_Template->Set("Advantages#Distribute_Points_VIP4", $Advantages["Distribute_Points"][4]);
		$CTM_Template->Set("Advantages#Clear_Char_VIP4", $Advantages["Clear_Char"][4]);
		
		$CTM_Template->Set("Advantages#Date_VIP5", $Advantages["Dates"][5]);
		$CTM_Template->Set("Advantages#PM_System_VIP5", $Advantages["PM_System"][5]);
		$CTM_Template->Set("Advantages#Alt_Vault_VIP5", $Advantages["Alt_Vault"][5]);
		$CTM_Template->Set("Advantages#Connects_VIP5", $Advantages["Connects"][5]);
		$CTM_Template->Set("Advantages#Reset_VIP5", $Advantages["Reset"][5]);
		$CTM_Template->Set("Advantages#MReset_VIP5", $Advantages["MReset"][5]);
		$CTM_Template->Set("Advantages#Clear_PK_VIP5", $Advantages["Clear_PK"][5]);
		$CTM_Template->Set("Advantages#Change_Class_VIP5", $Advantages["Change_Class"][5]);
		$CTM_Template->Set("Advantages#Change_Nick_VIP5", $Advantages["Change_Nick"][5]);
		$CTM_Template->Set("Advantages#Move_Char_VIP5", $Advantages["Move_Char"][5]);
		$CTM_Template->Set("Advantages#Profile_Char_VIP5", $Advantages["Profile_Char"][5]);
		$CTM_Template->Set("Advantages#Upload_Img_VIP5", $Advantages["Upload_Img"][5]);
		$CTM_Template->Set("Advantages#Reset_Points_VIP5" ,$Advantages["Reset_Points"][5]);
		$CTM_Template->Set("Advantages#Distribute_Points_VIP5", $Advantages["Distribute_Points"][5]);
		$CTM_Template->Set("Advantages#Clear_Char_VIP5", $Advantages["Clear_Char"][5]);
		
		$CTM_Template->Set("VIP_Number", constant("VIP_Number"));
		$CTM_Template->Set("MReset_Coin", constant("Coin_".$_Panel["Char"]["MReset"]["Coin"]));
	
		$this->ResetTable();
	}
	private function Gold_Table()
	{
		global $_Coin;
		
		for($WzAG = 0; $WzAG < count($_Coin); $WzAG++)
		{
			$Return .= "<li><b>&raquo; <span class=\"colr\">".$_Coin[$WzAG][0]." ".Coin_1."</span> - <span class=\"red\">".$_Coin[$WzAG][1]."</span></b></li>\n";
		}
		return $Return;
	}
	private function Bank_List()
	{
		global $_BankList;
		
		for($MuGS = 0; $MuGS < count($_BankList); $MuGS++)
		{
			$Return .= "<tr>
   		 <td class=\"colr\">".$_BankList[$MuGS][0]."</td>
    	 <td>".$_BankList[$MuGS][1]."</td>
    	 <td>".$_BankList[$MuGS][2]."</td>
    	 <td>".$_BankList[$MuGS][3]."</td>
    	 <td class=\"red\">".$_BankList[$MuGS][4]."</td>
  		</tr>\n";
		}
		return $Return;
	}
	private function ResetTable()
	{
		global $CTM_Template, $_Panel;
		
		if($_Panel['Char']['Reset']['General']['Mode'] == 3)
		{
			$CTM_Template->Set("ResetTable#0-10[Level_Free]", $_Panel['Char']['Reset']['Tabulated']['0-10']['Level'][0]);
			$CTM_Template->Set("ResetTable#0-10[Level_VIP1]", $_Panel['Char']['Reset']['Tabulated']['0-10']['Level'][1]);
			$CTM_Template->Set("ResetTable#0-10[Level_VIP2]", $_Panel['Char']['Reset']['Tabulated']['0-10']['Level'][2]);
			$CTM_Template->Set("ResetTable#0-10[Level_VIP3]", $_Panel['Char']['Reset']['Tabulated']['0-10']['Level'][3]);
			$CTM_Template->Set("ResetTable#0-10[Level_VIP4]", $_Panel['Char']['Reset']['Tabulated']['0-10']['Level'][4]);
			$CTM_Template->Set("ResetTable#0-10[Level_VIP5]", $_Panel['Char']['Reset']['Tabulated']['0-10']['Level'][5]);
			
			$CTM_Template->Set("ResetTable#11-50[Level_Free]", $_Panel['Char']['Reset']['Tabulated']['11-50']['Level'][0]);
			$CTM_Template->Set("ResetTable#11-50[Level_VIP1]", $_Panel['Char']['Reset']['Tabulated']['11-50']['Level'][1]);
			$CTM_Template->Set("ResetTable#11-50[Level_VIP2]", $_Panel['Char']['Reset']['Tabulated']['11-50']['Level'][2]);
			$CTM_Template->Set("ResetTable#11-50[Level_VIP3]", $_Panel['Char']['Reset']['Tabulated']['11-50']['Level'][3]);
			$CTM_Template->Set("ResetTable#11-50[Level_VIP4]", $_Panel['Char']['Reset']['Tabulated']['11-50']['Level'][4]);
			$CTM_Template->Set("ResetTable#11-50[Level_VIP5]", $_Panel['Char']['Reset']['Tabulated']['11-50']['Level'][5]);
			
			$CTM_Template->Set("ResetTable#51-100[Level_Free]", $_Panel['Char']['Reset']['Tabulated']['51-100']['Level'][0]);
			$CTM_Template->Set("ResetTable#51-100[Level_VIP1]", $_Panel['Char']['Reset']['Tabulated']['51-100']['Level'][1]);
			$CTM_Template->Set("ResetTable#51-100[Level_VIP2]", $_Panel['Char']['Reset']['Tabulated']['51-100']['Level'][2]);
			$CTM_Template->Set("ResetTable#51-100[Level_VIP3]", $_Panel['Char']['Reset']['Tabulated']['51-100']['Level'][3]);
			$CTM_Template->Set("ResetTable#51-100[Level_VIP4]", $_Panel['Char']['Reset']['Tabulated']['51-100']['Level'][4]);
			$CTM_Template->Set("ResetTable#51-100[Level_VIP5]", $_Panel['Char']['Reset']['Tabulated']['51-100']['Level'][5]);
			
			$CTM_Template->Set("ResetTable#101-150[Level_Free]", $_Panel['Char']['Reset']['Tabulated']['101-150']['Level'][0]);
			$CTM_Template->Set("ResetTable#101-150[Level_VIP1]", $_Panel['Char']['Reset']['Tabulated']['101-150']['Level'][1]);
			$CTM_Template->Set("ResetTable#101-150[Level_VIP2]", $_Panel['Char']['Reset']['Tabulated']['101-150']['Level'][2]);
			$CTM_Template->Set("ResetTable#101-150[Level_VIP3]", $_Panel['Char']['Reset']['Tabulated']['101-150']['Level'][3]);
			$CTM_Template->Set("ResetTable#101-150[Level_VIP4]", $_Panel['Char']['Reset']['Tabulated']['101-150']['Level'][4]);
			$CTM_Template->Set("ResetTable#101-150[Level_VIP5]", $_Panel['Char']['Reset']['Tabulated']['101-150']['Level'][5]);
			
			$CTM_Template->Set("ResetTable#151-200[Level_Free]", $_Panel['Char']['Reset']['Tabulated']['151-200']['Level'][0]);
			$CTM_Template->Set("ResetTable#151-200[Level_VIP1]", $_Panel['Char']['Reset']['Tabulated']['151-200']['Level'][1]);
			$CTM_Template->Set("ResetTable#151-200[Level_VIP2]", $_Panel['Char']['Reset']['Tabulated']['151-200']['Level'][2]);
			$CTM_Template->Set("ResetTable#151-200[Level_VIP3]", $_Panel['Char']['Reset']['Tabulated']['151-200']['Level'][3]);
			$CTM_Template->Set("ResetTable#151-200[Level_VIP4]", $_Panel['Char']['Reset']['Tabulated']['151-200']['Level'][4]);
			$CTM_Template->Set("ResetTable#151-200[Level_VIP5]", $_Panel['Char']['Reset']['Tabulated']['151-200']['Level'][5]);
			
			$CTM_Template->Set("ResetTable#201-300[Level_Free]", $_Panel['Char']['Reset']['Tabulated']['201-300']['Level'][0]);
			$CTM_Template->Set("ResetTable#201-300[Level_VIP1]", $_Panel['Char']['Reset']['Tabulated']['201-300']['Level'][1]);
			$CTM_Template->Set("ResetTable#201-300[Level_VIP2]", $_Panel['Char']['Reset']['Tabulated']['201-300']['Level'][2]);
			$CTM_Template->Set("ResetTable#201-300[Level_VIP3]", $_Panel['Char']['Reset']['Tabulated']['201-300']['Level'][3]);
			$CTM_Template->Set("ResetTable#201-300[Level_VIP4]", $_Panel['Char']['Reset']['Tabulated']['201-300']['Level'][4]);
			$CTM_Template->Set("ResetTable#201-300[Level_VIP5]", $_Panel['Char']['Reset']['Tabulated']['201-300']['Level'][5]);
			
			$CTM_Template->Set("ResetTable#301-XXX[Level_Free]", $_Panel['Char']['Reset']['Tabulated']['301-XXX']['Level'][0]);
			$CTM_Template->Set("ResetTable#301-XXX[Level_VIP1]", $_Panel['Char']['Reset']['Tabulated']['301-XXX']['Level'][1]);
			$CTM_Template->Set("ResetTable#301-XXX[Level_VIP2]", $_Panel['Char']['Reset']['Tabulated']['301-XXX']['Level'][2]);
			$CTM_Template->Set("ResetTable#301-XXX[Level_VIP3]", $_Panel['Char']['Reset']['Tabulated']['301-XXX']['Level'][3]);
			$CTM_Template->Set("ResetTable#301-XXX[Level_VIP4]", $_Panel['Char']['Reset']['Tabulated']['301-XXX']['Level'][4]);
			$CTM_Template->Set("ResetTable#301-XXX[Level_VIP5]", $_Panel['Char']['Reset']['Tabulated']['301-XXX']['Level'][5]);
		}
	}
}
endif;