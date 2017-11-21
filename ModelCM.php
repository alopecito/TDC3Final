<?php

include 'Connector/Credentials.php';

/**
 * Description of ModelCM
 *
 * @author Tirso
 */
class ModelContract {

    function getUnitNumbers($project) {

        $db = connect_db();

        define('PROJECT', $project);

        $stmt = $db->prepare("Select u.unit_number 
                            from units u, projects_units p
                            where u.unit_ID = p.unit_ID 
                            and project_ID=:project_id;");
        $stmt->bindValue(':project_id', PROJECT, PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll();
        return $rows;
    }

    function getTitle($project) {

        $db = connect_db();
                //get Project name
        define('PROJECT1', $project);


        $prName = $db->prepare("SELECT name FROM projects
                                WHERE project_id=:project_id;");
        $prName->bindValue(':project_id', PROJECT1, PDO::PARAM_INT);
        $prName->execute();
        //this variable will pop up all the units as per query
        $rowsPN = $prName->fetchAll(PDO::FETCH_ASSOC);
        return $rowsPN;
    }

    function getUnitInfobyUnit($units, $project) {
        
        
        $db = connect_db();

        //get Project name
        define('PROJECT2', $project);
        define('UNIT', $units);
        
        $stmt2     = $db->prepare("Select * from units u, projects_units p
                                where u.unit_ID = p.unit_ID 
                                and unit_number=:unit and project_ID =:project;");
        $stmt2->bindValue(':unit', UNIT, PDO::PARAM_INT);
        $stmt2->bindValue(':project', PROJECT2, PDO::PARAM_INT);
        $stmt2->execute();
//this variable will pop up all the units as per query
        $rows_unit = $stmt2->fetchAll();
        return $rows_unit;
    }

    function getRepsNamesDropDownList($project) {

         $db = connect_db();
        //get Project name

        define('PROJECT3', $project);
        
        $stmt2     = $db->prepare("SELECT * from salesreps s, projects p
                            where s.SaleRep_ID = p.SaleRep_ID
                            and project_ID =:project;");
        $stmt2->bindValue(':project', PROJECT3, PDO::PARAM_INT);
        $stmt2->execute();
//this variable will pop up all the units as per query
        $rows_unit = $stmt2->fetchAll();
        return $rows_unit;
    }

    function UpdateNewSale($units, $project) {
        
        $db = connect_db();
        echo $units . "<br>" . $project;
        define('PROJECT3', $project);
        define('UNIT', $units);

        
        $todayDate   = $_POST['contract_date'];
        $salesRep    = $_POST['sales_rep'];
        $unitPrice   = $_POST['sale_price'];
        $parking     = $_POST['parking'];
        $parkingCost = $_POST['parking_value'];
        $locker      = $_POST['locker'];
        $lockerCost  = $_POST['locker_value'];
        $user        = $_POST['final_user'];

        $stmt = $db->exec("UPDATE units u, projects_units p
                            SET u.contract_date = ':todayDate', 
                                    u.sales_rep = ':salesRep', 
                                    u.sale_price = ':unitPrice', 
                                    u.parking = ':parking', 
                                    u.parking_value = ':parkingCost', 
                                    u.locker = ':locker', 
                                    u.locker_value = ':lockerCost',
                                    u.status = 'F(R)'
                                    u.final_user = ':final_user'
                            where u.unit_number = ':unit' and p.project_ID = ':project';
                            ");


        $stmt->bindValue(':unit', UNIT, PDO::PARAM_INT);
        $stmt->bindValue(':project', PROJECT3, PDO::PARAM_INT);
        $stmt->bindParam(':salesRep', $salesRep);
        $stmt->bindParam(':todayDate', $todayDate);
        $stmt->bindParam(':salesRep', $salesRep);
        $stmt->bindParam(':unitPrice', $unitPrice);
        $stmt->bindParam(':parking', $parking);
        $stmt->bindParam(':parkingCost', $parkingCost);
        $stmt->bindParam(':locker', $locker);
        $stmt->bindParam(':lockerCost', $lockerCost);
        $stmt->bindParam(':final_user', $user);

        $stmt->execute();
        print_r($stmt);
    }

}
