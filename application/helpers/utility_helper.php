<?php

function asset_url(){
   return base_url().'assets/';
}

function controller_url(){
   return "http://".$_SERVER['HTTP_HOST']."/"."CI_training/";
}

?>