<?php

function loged(){
  $ci = get_instance();
  if(!$ci->session->userdata('username') || !$ci->session->userdata('email') || !$ci->session->userdata('level_user') || !$ci->session->userdata('status')){
  // if(!$ci->session->userdata('username')){
    redirect(base_url());
  }
}