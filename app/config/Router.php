<?php

$this->get('/', function(){
    echo 'Tela inicial !!!!';
});

$this->get('/home', function(){
    echo 'estou na HOME !!!!';
});
//dd('TESTE');

$this->get('/about', function(){
    echo 'estou na ABOUT !!!!';
});