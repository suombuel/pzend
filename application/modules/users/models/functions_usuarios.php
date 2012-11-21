<?php 
	
    require_once '../application/models/functions_db2.php';

    function insertUsuarios($link, $CLEAR){
        $sql="INSERT INTO usuarios SET 
							name='".$CLEAR['name']."',
							email='".$CLEAR['email']."',
							password='".$CLEAR['password']."',
							dateofb='".$CLEAR['date']."',
							status='".$CLEAR['status']."'
					";
		echo $sql;
		return Execute($sql, $link);		
    }
    
    function selectOneUsuarios($link, $id){
        $sql="SELECT * FROM usuarios WHERE
        					idusuario='".$id."'
					";
		$result=OpenRecordset($sql, $link);		
		$out=FetchAssoc($result);	
		return $out;
    }
    
    function selectUsuarios($link){
        $out=array();
    	$sql="SELECT * FROM usuarios";
		$result=OpenRecordset($sql, $link);	
			
		while ($row = mysql_fetch_assoc($result)){
			$out[]=$row;	
		}
		return $out;
    }
    
    function updateUsuarios($link, $CLEAR, $id){
        $sql="UPDATE usuarios SET 
							name='".$CLEAR['name']."',
							email='".$CLEAR['email']."',
							password='".$CLEAR['password']."',
							dateofb='".$CLEAR['date']."',
							status='".$CLEAR['status']."'
					WHERE idusuario='".$id."'";
		echo $sql;
		return Execute($sql, $link);		
    }
    
    function deleteUsuarios($link, $CLEAR, $id){
        $sql="DELETE FROM usuarios WHERE idusuario='".$id."'";
		echo $sql;
		return Execute($sql, $link);		
    }
    
    
    
   
    
?>