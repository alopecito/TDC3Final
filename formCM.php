<?php

require_once 'controllerCM.php';

$units = '';



$controllerCM = new controllerCM();
//get the Project code

$project = $_GET['project'];
//$project = 1;

if(isset($_POST['units']))
{
    
    $choosedUnitInfo = $controllerCM->SearchandGetInfo($_POST['units'], $project);
    $unit_number = $_POST['units'];
    
}else{
    //please check this outcome
    $choosedUnitInfo = '';
}

if(isset($_POST['units']))
{
    $unit_number = $_POST['units'];
    
}else
{
    $unit_number = '';
}

if(isset($_POST['unitInfo']))
{
    $unit_number = $_POST['units'];
    echo "test, aqui voy:";
    $controllerCM->updateUnitValues($units, $project) ;
    
    
 return $unit_number;   
}








$title = $controllerCM->createTitle($project);
//this call the function to get the dropdown list and get the search done
$search = $controllerCM->CreateDropdownList($project);


$unitTab = $controllerCM->getUnitForm($unit_number, $project) ;

$purchaser1Tab = $controllerCM->getPurchaser1Form($unit_number, $project);

$purchaser2Tab = $controllerCM->getPurchaser1Form($unit_number, $project);

include 'TemplateCM.php';

