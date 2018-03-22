<?php
class klasaobicna  {

    protected $db;

    public function __construct($db)
    {
		$this->conn = $db;
		$conn = $this->conn->__construct;
		if( $conn === false ) { die( print_r( sqlsrv_errors(), true)); }
    }



	public function g3slider($upit) {
		return  $ete = $this->conn->rawQuery($upit);
		}
			
  
}
?>
