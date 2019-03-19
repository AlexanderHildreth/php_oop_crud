<?php
class Blog{
    private $conn;
    private $table_name = "posts";

    public $id;
    public $title;
    public $post;
    public $category_id;
    public $image;
    public $timestamp;

    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, post=:post, category_id=:category_id, image=:image, created=:created";

        $stmt = $this->conn->prepare($query);
        
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->post = htmlspecialchars(strip_tags($this->post));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->timestamp = date('Y-m-d H:i:s');

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":post", $this->post);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":created", $this->timestamp);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    function readAll($from_record_num, $records_per_page){

        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created DESC LIMIT {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function countAll(){
        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0, 1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->post = $row['post'];
        $this->category_id = $row['category_id'];
        $this->image = $row['image'];
    }

    function update(){
        $query = "UPDATE " . $this->table_name . " SET title=:title, post=:post, category_id=:category_id, image=:image, modified=:modified WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->post = htmlspecialchars(strip_tags($this->post));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->timestamp = date('Y-m-d H:i:s');

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":post", $this->post);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":modified", $this->timestamp);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function search($search_term, $from_record_num, $records_per_page){
        $query = "SELECT c.name as category_name, p.* FROM " . $this->table_name . " p LEFT JOIN categories c ON (p.category_id=c.id) WHERE p.post LIKE ? OR p.title LIKE ? ORDER BY p.post ASC LIMIT ?, ?";

        $stmt = $this->conn->prepare($query);

        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;        
    }

    public function countAll_BySearch($search_term) {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . " p LEFT JOIN categories c ON p.category_id = c.id WHERE p.post LIKE ?";

        $stmt = $this->conn->prepare( $query );

        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    function uploadPhoto(){
        $result_message = "";
        if($this->image) {
            $target_directory = "uploads/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            $file_upload_error_messages = "";

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
            // submitted file is an image
            } else {
                $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
            }

            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages .= "<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }

            if(file_exists($target_file)){
                $file_upload_error_messages .= "<div>Image already exists. Try to change file post.</div>";
            } 

            if($_FILES['image']['size'] > (2048000)){
                $file_upload_error_messages.="<div>Image must be less than 2 MB in size.</div>";
            } 

            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }

            if(empty($file_upload_error_messages)) {
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                } else {
                    $result_message .= "<div class='alert alert-danger'>";
                    $result_message .= "<div>Unable to upload photo.</div>";
                    $result_message .= "<div>Update the record to upload photo.</div>";
                    $result_message .= "</div>";
                    
                    $_SESSION['success'] .= $result_message;
                }
            } else {
                $result_message .= "<div class='alert alert-danger'>";
                $result_message .= "{$file_upload_error_messages}";
                $result_message .= "<div>Update the record to upload photo.</div>";
                $result_message .= "</div>";

                $_SESSION['error'] .= $result_message;
            }
        }

        return true;
    }
}