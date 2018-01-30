<?php
include('../include/dbConfig.php');
session_start();

$data="";
$office_d="";
$office_s="";
$country_d="";
$country_s="";	
$business_d="";
$business_s="";
$product_d="";
$product_s="";
$service_d="";
$service_s="";



if(isset($_GET["data"]))
{
    $data = $_GET["data"];

    $result=$conn->query("UPDATE proposal_master SET IsActive = 0 WHERE Proposal_Id='".$data."'");
    
    if($result)
    {
        $conn->close();
        header('Location: ../proposal-list');
        exit();
    }
    else
    {
        $_SESSION["Error_Code"]="965";
        header('Location: ../error');
        exit();
    }
}

if(isset($_GET["office_d"]))
{
    $office_d = $_GET["office_d"];

    $result=$conn->query("UPDATE office_master SET IsActive = 0 WHERE Office_Id='".$office_d."'");
    
    if($result)
    {
        $conn->close();
        header('Location: ../admin-create-office');
        exit();
    }
    else
    {
        $_SESSION["Error_Code"]="966";
        header('Location: ../error');
        exit();
    }
}

if(isset($_GET["office_s"]))
{
    $office_s = $_GET["office_s"];

    $result=$conn->query("UPDATE office_master SET IsActive = 1 WHERE Office_Id='".$office_s."'");
    
    if($result)
    {
        $conn->close();
        header('Location: ../admin-create-office');
        exit();
    }
    else
    {
        $_SESSION["Error_Code"]="967";
        header('Location: ../error');
        exit();
    }
}

if(isset($_GET["country_d"]))
{
    $country_d = $_GET["country_d"];

    $result=$conn->query("UPDATE country_master SET IsActive = 0 WHERE Country_Id='".$country_d."'");
    
    if($result)
    {
        $result1=$conn->query("UPDATE office_master SET IsActive = 0 WHERE Country_Id=".$country_d);
        if($result1)
        {
            $conn->close();
            header('Location: ../admin-create-country');
            exit();
        }
        else
        {
            $_SESSION["Error_Code"]="968";
            header('Location: ../error');
            exit();
        }    
    }
    else
    {
        $_SESSION["Error_Code"]="969";
        header('Location: ../error');
        exit();
    }
}

if(isset($_GET["country_s"]))
{
    $country_s = $_GET["country_s"];

    $result=$conn->query("UPDATE country_master SET IsActive = 1 WHERE Country_Id='".$country_s."'");
    
    if($result)
    {
        $conn->close();
        header('Location: ../admin-create-country');
        exit();
    }
    else
    {
        $_SESSION["Error_Code"]="970";
        header('Location: ../error');
        exit();
    }
}

if(isset($_GET["business_d"]))
{
    $business_d = $_GET["business_d"];

    $result=$conn->query("UPDATE business_master SET IsActive = 0 WHERE Business_Id='".$business_d."'");
    
    if($result)
    {
        $result1=$conn->query("UPDATE product_master SET IsActive = 0 WHERE Business_Id=".$business_d);
        if($result1)
        {                    
            $conn->close();
            header('Location: ../admin-create-businessunit');
            exit();
        }
        else
        {
            $_SESSION["Error_Code"]="972";
            header('Location: ../error');
            exit();
        }
    }
    else
    {
        $_SESSION["Error_Code"]="973";
        header('Location: ../error');
        exit();
    }
}

if(isset($_GET["business_s"]))
{
    $business_s = $_GET["business_s"];

    $result=$conn->query("UPDATE business_master SET IsActive = 1 WHERE Business_Id='".$business_s."'");
    
    if($result)
    {
        $conn->close();
        header('Location: ../admin-create-businessunit');
        exit();
    }
    else
    {
        $_SESSION["Error_Code"]="974";
        header('Location: ../error');
        exit();
    }
}

if(isset($_GET["product_d"]))
{
    $product_d = $_GET["product_d"];

    $result=$conn->query("UPDATE product_master SET IsActive = 0 WHERE Product_Id='".$product_d."'");
    
    if($result)
    {
        $result1=$conn->query("UPDATE service_master SET IsActive = 0 WHERE Product_Id=".$product_d);
        if($result1)
        {
            $conn->close();
            header('Location: ../admin-create-product');
            exit();
        }
        else
        {
            $_SESSION["Error_Code"]="975";
            header('Location: ../error');
            exit();
        }
    }
    else
    {
        $_SESSION["Error_Code"]="976";
        header('Location: ../error');
        exit();
    }
}

if(isset($_GET["product_s"]))
{
    $product_s = $_GET["product_s"];

    $result=$conn->query("UPDATE product_master SET IsActive = 1 WHERE Product_Id='".$product_s."'");
    
    if($result)
    {
        $conn->close();
        header('Location: ../admin-create-product');
        exit();
    }
    else
    {
        $_SESSION["Error_Code"]="977";
        header('Location: ../error');
        exit();
    }
}

if(isset($_GET["service_d"]))
{
    $service_d = $_GET["service_d"];

    $result=$conn->query("UPDATE service_master SET IsActive = 0 WHERE Service_Id='".$service_d."'");
    
    if($result)
    {
        $conn->close();
        header('Location: ../admin-create-service');
        exit();
    }
    else
    {
        $_SESSION["Error_Code"]="978";
        header('Location: ../error');
        exit();
    }
}

if(isset($_GET["service_s"]))
{
    $service_s = $_GET["service_s"];

    $result=$conn->query("UPDATE service_master SET IsActive = 1 WHERE Service_Id='".$service_s."'");
    
    if($result)
    {
        $conn->close();
        header('Location: ../admin-create-service');
        exit();
    }
    else
    {
        $_SESSION["Error_Code"]="979";
        header('Location: ../error');
        exit();
    }
}

?>