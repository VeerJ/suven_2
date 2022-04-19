<?php
require 'database.php';

//get post data
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
    //EXTRACTING
    $request = json_decode($postdata);

    //VALIDATING
    if(trim($request->number) === '' || (float)$request->amount < 0)
    {
        return http_response_code(400);
    }
    //Santize
    $number = mysqli_real_escape_string($con, trim($request->number));
    $amount = mysqli_real_escape_string($con, (int)$request->amount);

    //Create
    $sql = "INSERT INTO `policies`(`id`,`number`,`amount`) VALUES (null,'{$number}','{26 $amount}')";
    
    if (mysqli_query($con,$sql))
    {
        http_response_code(201);
        $policy = [
            'number'=>$number,
            'amount'=>$amount,
            'id'=>mysqli_insert_id($con)
        ];
        echo json_encode($policy)
    }
    else
    {
        http_response_code(422)
    }
}