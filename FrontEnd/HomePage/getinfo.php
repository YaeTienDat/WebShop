<?php
 require_once ('../../Database/db.php');
$firstname = '';
$lastname = '';
$email = '';
$phone = '';
$address = '';
 if(isset($_COOKIE['id']))
 {
    $id = $_COOKIE['id'];
 }
 else
 {
     header('Location :login.php');
 }
if(!empty($_POST))
{
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $sql='select*from guest where id_acc='.$_GET['id'];
    $guest=executeSingleResult($sql);
    if($guest !=null)
    {
        $sql='update guest set firstname= "'.$firstname.'" , lastname="'.$lastname.'" , email="'.$email.'" , phone="'.$phone.'" , address="'.$address.'" where id_acc='.$id;
        execute($sql);
        header('Location: index.php');

    }
    else
    {
        $insertGuestQuery = "INSERT INTO `guest`(`id_acc`, `firstname`, `lastname`, `email`, `phone`, `address`) VALUES ($id,'$firstname','$lastname','$email','$phone','$address')";
        execute($insertGuestQuery);
        header('Location: index.php');

    }
}
if(isset($_GET['id']))
{
    $sql='select*from guest where id_acc='.$_GET['id'];
    $guest=executeSingleResult($sql);
    if($guest !=null)
    {
        $firstname = $guest['firstname'];
        $lastname = $guest['lastname'];
        $email = $guest['email'];
        $phone = $guest['phone'];
        $address = $guest['address'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get your infor</title>
    <style>
        body{
    margin: 0;
    padding: 0;
    background: linear-gradient(120deg, #2980b9, #8e44ad);
    height: 100vh;
    overflow: hidden;
}
.center{
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
     width: 400px;
     background: white;
     border-radius: 10px;
}
.center h1{
    text-align: center;
    padding: 0 0 20px 0;
    border-bottom: 1px solid silver;
}
.center form{
    padding: 0 40px;
    box-sizing: border-box;
}
form .txt_field{
    position: relative;
    border-bottom: 2px solid #adadad;
    margin: 30px 0;
}
.txt_field input{
    width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 16px;
    border: none;
    background: none;
    outline: none;
}
.txt_field label{
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    font-size: 16px;
    pointer-events: none;
}
.txt_field span::before{
    content: '';
    position: absolute;
    top: 40px;
    left: 0;
    width: 100%;
    height: 2px;
    background: #2691d9;
    transform: .5s;
}
.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
    top: -5px;
    color: #2691d9;
}
.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before{
    width: 100%;
}
.pass{
    margin: -5px 0 20px 5px;
    color: #a6a6a6;
    cursor: pointer;
}
.pass:hover{
    text-decoration: underline;
}
input[type='submit']{
    width: 100%;
    height: 50px;
    border: 1px solid;
    background: #2691d9;
    border-radius: 25px;
    font-size: 18px;
    color: #e9f4fb;
    font-weight: 700;
    cursor: pointer;
    outline: none;
}
input[type='submit']:hover{
    border-color: #2691d9;
    transition: .5s;
}
.signup_link{
    margin: 30px 0;
    text-align: center;
    font-size: 16px;
    color: #666666;
}
.signup_link a{
    color: #2691d9;
    text-decoration: none;
}
.signup_link a:hover{
    text-decoration: underline;
}
.is_admin{
    text-align: center;
    margin-bottom: 30px;
    size: 16px;
    color: #2691d9;
    font-weight: 400;
}
.is_admin input{
    margin: 5px;
}
        input[type='submit']{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="center">
        <h1>Nhập thông tin</h1>
        <form method="post">
            <div class="txt_field">
                <input type="text" name="firstname" value=<?=$firstname?> required>
                <span></span>
                <label>Tên</label>
            </div>
            <div class="txt_field">
                <input type="text" name="lastname" value=<?=$lastname?> required>
                <span></span>
                <label>Họ</label>
            </div>
            <div class="txt_field">
                <input type="email" name="email"value=<?=$email?> required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="tel" name="phone" value=<?=$phone?> required>
                <span></span>
                <label>Số điện thoại</label>
            </div>
            <div class="txt_field">
                <input type="text" name="address" value=<?=$address?> required>
                <span></span>
                <label>Địa chỉ</label>
            </div>
            <input type="submit" value="Hoàn thành thông tin">
        </form>
    </div>
</body>
</html>