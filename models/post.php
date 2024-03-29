<?php


class Post{
    private $id;
    private $title;
    private $description;
    private $createAt;
    private $userId;
    private $categoryId;
    private $mysqli;
    private $table;

    public function __construct()
    {
        $this->mysqli = Connection::connect();
        $this->table = 'entradas';
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
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of createAt
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set the value of createAt
     */
    public function setCreateAt($createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     */
    public function setUserId($userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of categoryId
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set the value of categoryId
     */
    public function setCategoryId($categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }
    /**
     * Get all posts
     */
    public function findAll(){
        $sql = 'SELECT * FROM '.$this->table;
        $stmt = $this->mysqli->query($sql);
        if($stmt){
            $result = [];
            while($row = $stmt->fetch_assoc()){
                array_push($result,$row);
            }
            return $result;
        }
        return false;
    }

    /**
     * Get find one
     */

    public function findOne(){
        $id = $this->getId();
        $sql = 'SELECT * FROM '.$this->table.' WHERE id = ?';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?? false;
    }
    /**
     * Save post
     */

    public function save(){
        $title = $this->getTitle();
        $description = $this->getDescription();
        $categoryId = $this->getcategoryId();
        $userId = $this->getuserId();
        $sql  = 'INSERT INTO '.$this->table.' (titulo,descripcion,categoria_id,usuario_id,fecha) VALUES(?,?,?,?,CURRENT_DATE())';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssii",$title,$description,$categoryId,$userId);
        if($stmt->execute()){
            $this->setId($this->mysqli->insert_id);
            return true;
        }
        return false;
    }
    /**
     * Delete post
     */

    public function delete(){
        $id   = $this->getId();
        $sql  = 'DELETE FROM '.$this->table.' WHERE id = ?';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i",$id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    /**
     * Update Post
     */
    public function update(){
        $id   = $this->getId();
        $update = "";
        $title = $this->getTitle() ?? null;
        $description = $this->getDescription() ?? null;

        if($title !== null){
            $update += "title = $title ";
        }
        $sql = "UPDATE $this->table SET ".$update." WHERE id = ?";
    }

    /*
    https://nhmadrid-my.sharepoint.com/:f:/g/personal/soporte_dignitae_com/EnsFdX8OwtdPkMem8bwuRi0ByEBNsez0ikNCoCPSJtMbkg?e=zmfarD
    */
}