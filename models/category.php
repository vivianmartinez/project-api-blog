<?php


class Category{

    private $id;
    private $nombre;
    private $table;
    private $mysqli;

    public function __construct()
    {
        $this->table = 'categorias';
        $this->mysqli = Connection::connect();
    }


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function findAll(){
        $sql = 'SELECT * FROM '.$this->table;
        $stmt= $this->mysqli->query($sql);
        
        if($stmt){
            $result = [];
            while($row = $stmt->fetch_assoc()){
                array_push($result,$row);
            }
            $this->mysqli->close();
            return $result;
        }
        $this->mysqli->close();
        return false;
    }

    public function findOne(){
        $id   = $this->getId();
        $sql  = 'SELECT * FROM '.$this->table.' WHERE id = ?';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?? false;
    }

    public function save(){
        $name  = $this->getNombre();
        $sql  = 'INSERT INTO '.$this->table.'(nombre) VALUES(?)';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s",$name);
        $stmt->execute();
        if($stmt){
          return  $this->setId($this->mysqli->insert_id);
        }
        return false;
    }
}