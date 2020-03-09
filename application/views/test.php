<?php
echo $this->session->id;

if(!isset($_SESSION['co'])){
    echo'ERROR';
}