
<?php
function check_form($flag, $data)
{
	if (isset($data) && $data != NULL)
	{
		return(1);
	}
	else
	{
		$_SESSION["check-".$flag] = "champ vide";
		return (0);
	}
}



 ?>
