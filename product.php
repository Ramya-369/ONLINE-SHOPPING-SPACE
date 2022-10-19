<?php
include("include/config.php");
if (isset($_POST['submit']) && isset($_FILES['myfile'])){
    echo "<pre>";
   // print_r($_FILES['myfile']);
    echo "</pre>";
    $img_name=$_FILES['myfile']['name'];
    $img_size=$_FILES['myfile']['size'];
    $tmp_name=$_FILES['myfile']['tmp_name'];
    $error=$_FILES['myfile']['error'];
    $bname=$_POST['bname'];
    $pname=$_POST['pname'];
    $price=$_POST['price'];
    $cat=$_POST['cat'];
    $des=$_POST['des'];
    if($error===0){
        if($img_size>125000){
            $em="Sorry, your file is too large.";
            
        }else{
            $img_ex=pathinfo($img_name,PATHINFO_EXTENSION);
            $img_ex_lc=strtolower($img_ex);
            $allowed_exs=array("jpg","jpeg","png");
            if(in_array($img_ex_lc,$allowed_exs)){

                $new_img_name=uniqid("IMG-",true).'.'.$img_ex_lc;
                $img_upload_path='uploads/'.$new_img_name;
                move_uploaded_file($tmp_name,$img_upload_path);
            }else{
                $em="You can't upload files of this type";
            }

        }
    }else{
        $em="unknown error occured!";
    }
    $query="INSERT INTO products VALUES('$bname','$pname','$price','$des','$new_img_name','$cat')";
    $result=mysqli_query($con,$query);

    echo "Product Enter sucessfully";
}
else{
    header("Location:home.html");
}

?>