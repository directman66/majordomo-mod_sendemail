<?php
/**
* 
* @package project
* @author Wizard <sergejey@gmail.com>
* @copyright http://majordomo.smartliving.ru/ (c)
* @version 0.1 (wizard, 09:04:00 [Apr 04, 2016])
*/
//
//
class mod_sendemail extends module {
/**
*
* Module class constructor
*
* @access private
*/
function mod_sendemail() {
  $this->name="mod_sendemail";
  $this->title="mod_sendemail";
  $this->module_category="<#LANG_SECTION_SETTINGS#>";
  $this->checkInstalled();
}
/**
* saveParams
*
* Saving module parameters
*
* @access public
*/
function saveParams($data=0) {
 $p=array();
 if (IsSet($this->id)) {
  $p["id"]=$this->id;
 }
 if (IsSet($this->view_mode)) {
  $p["view_mode"]=$this->view_mode;
 }
 if (IsSet($this->edit_mode)) {
  $p["edit_mode"]=$this->edit_mode;
 }
 if (IsSet($this->tab)) {
  $p["tab"]=$this->tab;
 }
 return parent::saveParams($p);
}



/**
* getParams
*
* Getting module parameters from query string
*
* @access public
*/
function getParams() {
  global $id;
  global $mode;
  global $view_mode;
  global $edit_mode;
  global $tab;
  if (isset($id)) {
   $this->id=$id;
  }
  if (isset($mode)) {
   $this->mode=$mode;
  }
  if (isset($view_mode)) {
   $this->view_mode=$view_mode;
  }
  if (isset($edit_mode)) {
   $this->edit_mode=$edit_mode;
  }
  if (isset($tab)) {
   $this->tab=$tab;
  }
}
/**
* Run
*
* Description
*
* @access public
*/
function run() {
 global $session;
  $out=array();
  if ($this->action=='admin') {
   $this->admin($out);
  } else {
   $this->usual($out);
  }
  if (IsSet($this->owner->action)) {
   $out['PARENT_ACTION']=$this->owner->action;
  }
  if (IsSet($this->owner->name)) {
   $out['PARENT_NAME']=$this->owner->name;
  }
  $out['VIEW_MODE']=$this->view_mode;
  $out['EDIT_MODE']=$this->edit_mode;
  $out['MODE']=$this->mode;
  $out['ACTION']=$this->action;
  $out['TAB']=$this->tab;



//$out['hosts']=implode ('<br>',$files);
//$out['hosts']=$files;
$out['hostsenable']=$str;









  $this->data=$out;
  $p=new parser(DIR_TEMPLATES.$this->name."/".$this->name.".html", $this->data, $this);
  $this->result=$p->result;
}
/**
* BackEnd
*
* Module backend
*
* @access public
*/
function admin(&$out) {
 $this->getConfig();




 $out['FROM']=$this->config['FROM'];			
 $out['FROMFIO']=$this->config['FROMFIO'];			
 $out['PORT']=$this->config['PORT'];			
 $out['SSL']=$this->config['SSL'];			
 $out['TO']=$this->config['TO'];			
 $out['SMTPSERVER']=$this->config['SMTPSERVER'];			
 $out['MESG']=$this->config['MESG'];			
 $out['SMTPLOGIN']=$this->config['SMTPLOGIN'];			
 $out['SMTPLOGIN']=$this->config['SMTPLOGIN'];			
 $out['SMTPPWD']=$this->config['SMTPPWD'];			
 $out['SUBJECT']=$this->config['SUBJECT'];			
 $out['RESULT']=$this->config['RESULT'];			



 



 if ($this->view_mode=='get_content') {



}
 

 if ($this->view_mode=='sendmsg') {
	global $smtrserver;
	global $to;
	$this->config['TO']=$to;	 

	global $mesg;
	$this->config['MESG']=$mesg;

	global $subject;
	$this->config['SUBJECT']=$subject;
	$this->config['RESULT']='';

   
   $this->saveConfig();


if    ($mesg) {$this->sendsmtp($to, $mesg, $subject);}


   $this->redirect("?");
 }

 
 if ($this->view_mode=='update_settings') {
	global $smtrserver;
	$this->config['SMTPSERVER']=$smtrserver;	 

	global $from;
	$this->config['FROM']=$from;	 

	global $fromfio;
	$this->config['FROMFIO']=$fromfio;	 


	global $port;
	$this->config['PORT']=$port;	 

	global $ssl;
	$this->config['SSL']=$ssl;	 

	global $to;
	$this->config['TO']=$to;	 

	global $mesg;
	$this->config['MESG']=$mesg;

	global $smtplogin;
	$this->config['SMTPLOGIN']=$smtplogin;

	global $smtppwd;
	$this->config['SMTPPWD']=$smtppwd;

	global $subject;
	$this->config['SUBJECT']=$subject;

   
   $this->saveConfig();


   $this->redirect("?");
 }
 if (isset($this->data_source) && !$_GET['data_source'] && !$_POST['data_source']) {
  $out['SET_DATASOURCE']=1;
 }
 
 //if ($this->tab=='' || $this->tab=='outdata') {
if ($this->tab=='outdata') {
//**   $this->outdata_search($out);
 }  
 //if ($this->tab=='indata') {
if ($this->tab=='' || $this->tab=='indata') {	
//   $this->indata_search($out); 
 }

	
}


function sendsmtp($to, $msg, $subject) {

 $this->getConfig();
 $from=$this->config['FROM'];			
 $port=$this->config['PORT'];			
 $ssl=$this->config['SSL'];			
 $fromfio=$this->config['FROMFIO'];			
 $smtpserver=$this->config['SMTPSERVER'];			
 $smtplogin=$this->config['SMTPLOGIN'];			
 $smtppwd=$this->config['SMTPPWD'];			




//require_once "SendMailSmtpClass.php"; // подключаем класс
//https://github.com/Ipatov/SendMailSmtpClass
require_once(DIR_MODULES . $this->name . '/SendMailSmtpClass.php');

	// $mailSMTP = new SendMailSmtpClass('zhenikipatov@yandex.ru', '***', 'ssl://smtp.yandex.ru', 465, "UTF-8");
	// $mailSMTP = new SendMailSmtpClass('zhenikipatov@yandex.ru', '***', 'ssl://smtp.yandex.ru', 465, "windows-1251");
	// $mailSMTP = new SendMailSmtpClass('monitor.test@mail.ru', '***', 'ssl://smtp.mail.ru', 465, "UTF-8");
	// $mailSMTP = new SendMailSmtpClass('red@mega-dev.ru', '***', 'ssl://smtp.beget.com', 465, "UTF-8");
	// $mailSMTP = new SendMailSmtpClass('red@mega-dev.ru', '***', 'smtp.beget.com', 2525, "windows-1251");
	// $mailSMTP = new SendMailSmtpClass('red@mega-dev.ru', '***', 'ssl://smtp.beget.com', 465, "utf-8");
        // $mailSMTP = new SendMailSmtpClass('red@mega-dev.ru', '***', 'smtp.beget.com', 2525, "utf-8");
	// $mailSMTP = new SendMailSmtpClass('логин', 'пароль', 'хост', 'порт', 'кодировка письма');

if ($ssl=='1')	{
debmes('используем ssl', 'mod_sendemail');
$mailSMTP = new SendMailSmtpClass($smtplogin, $smtppwd, 'ssl://'.$smtpserver, $port, "utf-8");} 
else  {
debmes('не используем ssl', 'mod_sendemail');
$mailSMTP = new SendMailSmtpClass($smtplogin, $smtppwd, $smtpserver, $port, "utf-8");} 


	// от кого
	$from = array(
		$fromfio, // Имя отправителя
		$from // почта отправителя
	);
	// кому отправка. Можно указывать несколько получателей через запятую

	
	// добавляем файлы
//	$mailSMTP->addFile("test.jpg");
//	$mailSMTP->addFile("test2.jpg");
//	$mailSMTP->addFile("test3.txt");
	
debmes('отправляем письмо '.$to, 'mod_sendemail');

	// отправляем письмо
	$result =  $mailSMTP->send($to, $subject, $msg, $from); 
	// $result =  $mailSMTP->send('Кому письмо', 'Тема письма', 'Текст письма', 'Отправитель письма');
	
	if($result === true){
$res= "Done";
	}else{
$res= "Error: " . $result;
	}
debmes($out['RUSULT'], 'mod_sendemail');
$this->config['RESULT']=$res;
$this->saveConfig();
echo $res;



}
/**
* FrontEnd
*
* Module frontend
*
* @access public
*/
function usual(&$out) {



 $this->admin($out);
}
/**
* OutData search
*
* @access public
*/

/**
* InData search
*
* @access public
*/ 

/**
* OutData edit/add
*
* @access public
*/

/**
* OutData delete record
*
* @access public
*/

/**
* InData edit/add
*
* @access public
*/

/**
* InData delete record
*
* @access public
*/

 

 
 

						

		
	
 
   
 
/**
* Install
*
* Module installation routine
*
* @access private
*/
 function install($data='') {
  parent::install();
 }
/**
* Uninstall
*
* Module uninstall routine
*
* @access public
*/
 function uninstall() {
  parent::uninstall();
 }
/**
* dbInstall
*
* Database installation routine
*
* @access private
*/
 function dbInstall($data) {

  

  parent::dbInstall($data);

	 
 }



// --------------------------------------------------------------------

//////

}
/*
*
* TW9kdWxlIGNyZWF0ZWQgQXByIDA0LCAyMDE2IHVzaW5nIFNlcmdlIEouIHdpemFyZCAoQWN0aXZlVW5pdCBJbmMgd3d3LmFjdGl2ZXVuaXQuY29tKQ==
*
*/
