<?php
class Candidates{   
    
    private $candidatesTable = "candidates";      
    public $id;
    public $candidate_name;
    public $family_member;
    public $gender;
    public $relation_name;   
    public $created; 
	public $modified; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->candidatesTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->candidatesTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->candidatesTable."(`candidate_name`, `family_member`, `gender`, `relation_name`, `created`)
			VALUES(?,?,?,?,?)");
		
		$this->candidate_name = htmlspecialchars(strip_tags($this->candidate_name));
		$this->family_member = htmlspecialchars(strip_tags($this->family_member));
		$this->gender = htmlspecialchars(strip_tags($this->gender));
		$this->relation_name = htmlspecialchars(strip_tags($this->relation_name));
		$this->created = htmlspecialchars(strip_tags($this->created));
		
		
		$stmt->bind_param("ssiis", $this->candidate_name, $this->family_member, $this->gender, $this->relation_name, $this->created);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->candidatesTable." 
			SET candidate_name= ?, family_member = ?, gender = ?, relation_name = ?, created = ?
			WHERE id = ?");
	 
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->candidate_name = htmlspecialchars(strip_tags($this->candidate_name));
		$this->family_member = htmlspecialchars(strip_tags($this->family_member));
		$this->gender = htmlspecialchars(strip_tags($this->gender));
		$this->relation_name = htmlspecialchars(strip_tags($this->relation_name));
		$this->created = htmlspecialchars(strip_tags($this->created));
	 
		$stmt->bind_param("ssiisi", $this->candidate_name, $this->family_member, $this->gender, $this->relation_name, $this->created, $this->id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->candidatesTable." 
			WHERE id = ?");
			
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>