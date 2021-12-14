<?php
const HOST = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DATABASE = 'databasefilm';

function createDataBase(){
    $conn = new mysqli(HOST, USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');
    $sql = 'create database if not exists '.DATABASE;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}



function executeResult($sql){
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn,'utf8');

    $data = [];
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($result,1)) {

        $data[] = $row;
    }
    
    mysqli_close($conn);

    return $data;
}

function execute($sql){
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn, 'utf8');
    mysqli_query($conn, $sql);
    mysqli_close($conn);

}