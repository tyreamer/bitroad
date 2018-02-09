<?PHP

require_once("./include/membersite_config.php");

//Make sure we have a category and location
if (!(isset($_POST['postID']))) 
{
	return false;
}
		
		$postInfo = $fgmembersite->GetPost($_POST['postID']);		
		echo json_encode($postInfo);
?>