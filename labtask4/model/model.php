<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function addCustomerToJson($data)
{
    $current_data = file_get_contents('Customer_Data.json');
    $array_data = json_decode($current_data, true);
    $extra = array(
        'name'               =>     test_input($data["name"]),
        'email'              =>     test_input($data["email"]),
        'phoneNo'            =>     test_input($data["phoneNo"]),
        'password'           =>     test_input($data["password"]),
        'gender'             =>     test_input($data["gender"]),
        'dateOfBirth'        =>     test_input($data["dateOfBirth"]),
        'profilePic'         =>     'Dummy.png'
    );
    $array_data[] = $extra;
    $final_data = json_encode($array_data);
    if (file_put_contents('Customer_Data.json', $final_data)) {
        return '<span class="green">Registered successfully</span>';
    } else {
        return '<span class="red">Registration failed</span>';
    }
}