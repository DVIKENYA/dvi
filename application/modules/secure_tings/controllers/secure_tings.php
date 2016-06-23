<?php
class Secure_tings extends MY_Controller 
{
function __construct() {
	
parent::__construct();
}

function hash_it($password){
	$safe_password=$this->kuchocha($password);
	$safe_password1 = hash("sha512", $safe_password);
	echo $safe_password1;
	
}
 
function kuchocha($password){
	$chocha = $password.="3456789abhijklmnopqrstuvRSTUVWYZ@#$%^&*";
	return $chocha;

}

function is_logged_in(){
if(!isset($this->session->userdata['logged_in'])){
         	$this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-danger text-center">RESTRICTED PAGE. <br />Login to gain access</div>');
           redirect('/'); 
        }
}

function ni_admin(){
$this->is_logged_in();	
if($this->session->userdata['logged_in']['user_group']!="1"){
exit('Permission denied! You must have Admin Priviledges.');
return;
}
}

function ni_member(){
$this->is_logged_in();	
if($this->session->userdata['logged_in']['user_group']!="2"){
exit('Permission denied! You dont have Priviledges to view this page.');
return;
}

}
function ni_epi(){
$this->is_logged_in();	
if($this->session->userdata['logged_in']['user_group']!="3"){
exit('Permission denied! You dont have Priviledges to view this page.');
return;
}
}
function ni_hrio(){
$this->is_logged_in();	
if($this->session->userdata['logged_in']['user_group']!="4"){
exit('Permission denied! You dont have Priviledges to view this page.');
return;
}
}
function ni_moh(){
$this->is_logged_in();	
if($this->session->userdata['logged_in']['user_group']!="5"){
exit('Permission denied! You dont have Priviledges to view this page.');
return;
}
}
function ni_phn(){
$this->is_logged_in();	
if($this->session->userdata['logged_in']['user_group']!="6"){
exit('Permission denied! You dont have Priviledges to view this page.');
return;
}
}
function ni_met(){
$this->is_logged_in();	
if($this->session->userdata['logged_in']['user_group']!="7"){
exit('Permission denied! You dont have Priviledges to view this page.');
return;
}
}


function ni_national(){
if($this->session->userdata['logged_in']['user_level']!="1"){
exit('Permission denied! You must be a National User to upload documents');
return;
}
}

function ni_region(){
if($this->session->userdata['logged_in']['user_level']!="2"){
exit('Permission denied!');
return;
}
}

function ni_county(){
if($this->session->userdata['logged_in']['user_level']!="3"){
exit('Permission denied!');
return;
}
}

function ni_subcounty(){
if($this->session->userdata['logged_in']['user_level']!="4"){
exit('Permission denied!');
return;
}
}

function ni_facility(){
if($this->session->userdata['logged_in']['user_level']!="5"){
exit('Permission denied!');
return;
}
}



}