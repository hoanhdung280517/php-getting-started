<?php
 
  Include '../lib/database.php';
  Include '../helpers/format.php';
?>

<?php
/** 
 * 
*/
class category
{
    private $db;
    private $fm;

    public function __construct()
    {
       $this->db = new Database();
       $this->fm = new Format();
    }
    public function insert_category($catName){
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
    
        if(empty($catName)){
            $alert = " Category must be not empty";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
            $result = $this->db->insert($query); 

            if($result){
                $alert = "<span class = 'success'> Insert Product Successfully </span>";
                return $alert;
            }else{
                $alert = "<span class ='error'> Insert Product Not Successfully </span>";
                return $alert;
            }
        }
    }
    public function show_product(){
        $query = "SELECT * FROM tbl_catproduct order by catId desc";
        $result = $this->db->select($query); 
        return $result;
    }
    public function getcatbyId($id){
        $query = "SELECT * FROM tbl_catproduct where catId = '$id'";
        $result = $this->db->select($query); 
        return $result;
    }
    public function update_product($catName,$id){
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if(empty($catName)){
            $alert = " Product must be not empty";
            return $alert;
        }else{
            $query = "UPDATE tbl_catproduct SET catName = '$catName' WHERE catId = '$id'";
            $result = $this->db->update($query); 

            if($result){
                $alert = "<span class = 'success'> Updtate Product Successfully </span>";
                return $alert;
            }else{
                $alert = "<span class ='error'> Update Product Not Successfully </span>";
                return $alert;
            }
        }
    }
    public function del_product($id){
        $query = "DELETE FROM tbl_catproduct where catId = '$id'";
        $result = $this->db->delete($query); 
        if($result){
            $alert = "<span class = 'success'> Deleted Product Successfully </span>";
            return $alert;
        }else{
            $alert = "<span class ='error'> Deleted Product Not Successfully </span>";
            return $alert;
        }
    }
}
?>