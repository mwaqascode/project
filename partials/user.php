<?php
require_once 'database.php';
class user extends Database
{
    protected $tableName = "usertable";

    // function add user 
    public function add($data)
    {

        if (!empty($data)) {
            $fileds = $placeholder = [];
            foreach ($data as $field => $value) {
                $fileds[] = $field;
                $placeholder[] = ":{$field}";
            }
        }
        $sql = "INSERT INTO {$this->tableName} (" . implode(',', $fileds) . ") 
        VALUES (" . implode(',', $placeholder) . ")";
        $stmt = $this->conn->prepare($sql);
        try {
            $this->conn->beginTransaction();
            $stmt->execute($data);
            $lastInsertId = $this->conn->lastInsertId();
            $this->conn->commit();
            return $lastInsertId;
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
            $this->conn->rollBack();
        }
    }
    // function to get rows
    public function getRows($start = 0, $limit = 4)
    {
        $sql = "SELECT * FROM {$this->tableName} ORDER BY id DESC LIMIT {$start},{$limit} ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }
        return $results;
    }

    //function to get single row 
    public function getrow($field, $value)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE {$field}=:{$field} ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":{$field}" => $value]);
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }


    //function to count number of row

    public function getcount()
    {
        $sql = "SELECT count(*) as pcount FROM 
        {$this->tableName}  ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pcount'];
    }

    //function to upload photo
    public function uploadphoto($file)
    {
        if (!empty($file)) {
            $fileTempPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileSize = $file['size'];
            $fileType = $file['type'];
            $fileNameCmps = explode('.', $fileName);
            $fileExtention = strtolower(end($fileNameCmps));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtention;
            $allowedExtn = ["png", "jpg", "jpeg"];
            if (in_array($fileExtention, $allowedExtn)) {
                $uploadFileDir = getcwd() . "/uploads/";
                $destFilePath = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTempPath, $destFilePath)) {
                    return $newFileName;
                }
            }
        }
    }


    // function to update 

    public function update($data, $id)
    {
        if (!empty($data)) {
            $fields = "";
            $x = 1;
            $fiedlsCound = count($data);
            foreach ($data as $field => $value) {
                $fields .= "{$field}=:{$field}";
                if ($x < $fiedlsCound) {
                    $fields .= ",";
                }
                $x++;
            }
        }

        $sql = "UPDATE {$this->tableName} SET {$fields} WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        try {
            $this->conn->beginTransaction();
            $data['id'] = $id;
            $stmt->execute($data);
            $this->conn->commit();
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
            $this->conn->rollBack();
        }
    }



    //function delete
    public function deleteRow($id)
    {
        $sql = "DELETE FROM {$this->tableName} WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        try {
            // $stmt->execute([":{$field}" => $value]);

            // $stmt=execute([':$id' => $id]);

            $stmt->execute([':id' => $id]);

            if ($stmt->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
            return false;
        }
    }



    //fuction to serch user 

    public function searchuser($searchText, $start = 0, $limit = 4)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE name LIKE :search ORDER BY id DESC LIMIT {$start},{$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':search' => "{$searchText}%"]);
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }
        return $results;
    }
    







    //  end    
}
