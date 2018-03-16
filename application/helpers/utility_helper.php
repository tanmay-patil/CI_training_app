<?php

function asset_url(){
   return "http://".$_SERVER['HTTP_HOST']."/".PROJECT_NAME."/assets/";
}

function controller_url(){
   return "http://".$_SERVER['HTTP_HOST']."/".PROJECT_NAME."/";
}

?>