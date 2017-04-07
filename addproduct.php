<?php 

require 'templates/header.php';
require_once('resources/db/db_connect.php');

$create_db_query = 'CREATE TABLE IF NOT EXISTS Product(
id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(50),
manufacturer VARCHAR(50),
description VARCHAR(255),
imageurls VARCHAR(255),
price DOUBLE,
stock INT,
sizes VARCHAR(255),
PRIMARY KEY(id)
)ENGINE=InnoDB;';

$create_db_query_sale = 'CREATE TABLE IF NOT EXISTS Sale(
id INT NOT NULL AUTO_INCREMENT,
email VARCHAR(255),
date DATE,
data LONGTEXT,
PRIMARY KEY(id)
)ENGINE=InnoDB;';

if (isset($_POST['contentsubmit'])){
    $written_upload_files = '';
    $write_count = 0;
    
    /*ini_set('file_uploads','on');
    ini_set('upload_max_filesize','5M');
    ini_set('max_file_uploads','5');
    ini_set('open_basedir','G:/PleskVhosts//sonofiroko.com\\;C:\Windows\\Temp\\;G:/PleskVhosts//sonofiroko.com\\resources\\products\\images\\');
    */
    //$index = 0;
    foreach ($_FILES as $key => $uploadFile){
        if (isset($uploadFile)){
            try{
                $image_filename = basename($uploadFile['name']);
                $image_tmp_name = $uploadFile['tmp_name'];
                $new_image_filename = 'resources/products/images/' . $image_filename;
                move_uploaded_file($image_tmp_name, $new_image_filename);
                if ($write_count > 0)
                    $written_upload_files .= ",";
                $written_upload_files .= $image_filename;
                $write_count++;

            }catch (Exception $e){
                echo $e->getMessage();
            }
        }
    }
    
    try{
        $name = $_POST['name'];
        $manufacturer = $_POST['manufacturer'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $sizes = $_POST['sizes'];
        $image_urls = $written_upload_files;
        
        $insert_query = 'INSERT INTO Product (name, manufacturer, description, price, sizes, stock, imageurls)'.
            ' VALUES (?,?,?,?,?,?,?)';
        
        //create table if not exists
        $conn->query($create_db_query);
        
        //create 'Sale' table if not exists
        $conn->query($create_db_query_sale);
        
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('sssdiis',$name, $manufacturer, $description, $price, $sizes, $stock, $image_urls);
        $stmt->execute();
    }catch (Exception $e){
        //echo $e->getMessage();
    }finally{
        $stmt->close();
        $conn->close();
    }
    
    header("Location", "addproduct.php");
}
?>

<div id="maincontent">

<div
	class="back-image-1">

			<div id="userform-div-cover">
			
	<form class="userform" id="addcontentform" action="Javascript:void(0);" method="POST" enctype="multipart/form-data">
		<div>
			<label>Product Name</label><br />
			<input type="text" class="rform" name="name" />

			<br> <label>Manufacturer</label><br />
			<input type="text" class="rform" name="manufacturer" />

			<br /> <label>Description</label><br />
			<textarea class="rform" name="description" style="height: 100px;"></textarea>

			<br /> <label>Price</label><br />
			<input type="number" class="rform" name="price" />
            
            <br /> <label>Sizes (Comma separated)</label><br />
			<input type="text" class="rform" name="sizes" />
            
            <br /> <label>Stock</label><br />
			<input type="number" class="rform" name="stock" />

            <br /> <label>Upload Image</label><br />
            <button id="add-image-button">Add Image</button>
            <div id="image-upload-div">
            </div>
			
			<br /> <br> <input id="addContentsubmit" type="submit"
				name="contentsubmit" value="Submit" />
		</div>
	</form>
	</div>
	</div>

	<br />
	<div style="color: white;">
		<span></span>
	</div>
	<div id="dialog" title="Incorrect input"></div>
	
</div>
<script>
    
    var uploadfilecount = 0;
    $("#add-image-button").click(function(){
        if (uploadfilecount < 5){
            addImageUploadField()
            uploadfilecount++;
        }
    });
    
    function addImageUploadField(){
        var d = document.getElementById("image-upload-div");
        var newInput = document.createElement("input");
        newInput.setAttribute("type", "file");
        newInput.setAttribute("name", "image_file" + uploadfilecount);
        newInput.setAttribute("class", "rform");
        d.appendChild(newInput);
        d.appendChild(document.createElement("br"));
    }
    
    $("#addContentsubmit").click(function(){
        $("#addcontentform").attr("action", "");
        $("#addcontentform").submit();
    });
</script>
<!--END OF MAIN CONTENT-->
<?php require 'templates/footer.php'; ?>