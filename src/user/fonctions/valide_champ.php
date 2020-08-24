<?php
function check_form($flag, $data)
{
    //check if exist
	if (isset($data) && $data != NULL)
	{
	}
	else
	{
		$_SESSION["check-".$flag] = "champ vide";
		return (0);
	}
    //check if lenght between 4-36
    if (strlen($data) > 36 || strlen($data) < 4)
    {
        $_SESSION["check-".$flag] = "le champ doit contenir plus de 4 characteres et moins de 36";
        return (0);
    }
    
    //check for forbiden character
    for ($i = 0; $i < (strlen($data));)
    {
        if ($data[$i] == " " || $data[$i] =="(" || $data[$i] ==")" || $data[$i] =="<" || $data[$i] ==">" || $data[$i] =="," || $data[$i] ==";" || $data[$i] ==":" || $data[$i] =="ç" || $data[$i] =="%" || $data[$i] =="&")
        {
            $_SESSION["check-".$flag] = "charactères interdits : ()<>,;:\"|ç%&";
            return (0);
        }
        $i++;
    }

    return (1);
}
    
    
 ?>
