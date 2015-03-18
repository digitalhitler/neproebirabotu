<?php
require_once("init.php");


if($_POST["Month"] != "" && $_POST["Year"] != "" && $_POST["HalfDay"] != "" && $_POST["FullDay"] != "") {
    //$NPRMain->DestroyCalendar();
    $NPRMain->CreateCalendar();
} else $NPRMain->ShowForm();