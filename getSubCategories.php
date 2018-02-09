<?PHP

require_once("./include/membersite_config.php");

$key = $_POST['id'];

$subcategories = $fgmembersite->GetSubCategories($key);

for ($i = 0; $i < sizeOf($subcategories); $i++) 
{
	?> <option class="subCategory" value="<?php echo $subcategories[$i]['subcategory_id'] ?>"> <?php echo $subcategories[$i]['subcategory_name'] ?>  </option> 

<?php
}



?>