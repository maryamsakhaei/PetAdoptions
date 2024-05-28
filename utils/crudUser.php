<?php
class CRUD_USER
{
    private $connection;

    public function __construct(string $database = "pet_adoption", string $host = "localhost", string $user = "root", string $password = "")
    {
        $this->connection = mysqli_connect($host, $user, $password, $database);
    }

    public function select(string $table, string $columns = "*", string $condition = "")
    {
        $sql = "SELECT $columns FROM $table";

        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }
        $result = mysqli_query($this->connection, $sql);

        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }

    public function insert(string $table, string $columns, array $values)
    {
        $valuesOut = [];
        foreach ($values as $val) {
            if (is_numeric($val)) {
                $valuesOut[] = "$val";
            } else {
                $valuesOut[] = "'$val'";
            }
        }
        $valuesOut = implode(",", $valuesOut);

        $sql = "INSERT INTO `$table`($columns) VALUES ($valuesOut)";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    public function selectUsers(string $condition)
    {
        return $this->select("users", "*", $condition);
    }

    public function createUser(array $values)
    {
        $result = $this->insert("users", "`role`, `firstName`, `lastName`, `email`, `phone`, `address`, `image`, `birthdate`, `space`, `experienced`, `password`", $values);

        $this->alert($result, "A new user account has been created");

        header("refresh: 2; url = ../user/login.php");
    }

    public function updateUser($id, $firstname, $lastname, $address, $birthdate, $phone, $email, $space, $exp, $image)
    {
        $sql = "UPDATE `users` SET `firstName`='$firstname',`lastName`='$lastname',`address`='$address',`birthdate`='$birthdate',
                                    `phone`='$phone',`email`='$email',`space`='$space',`experienced`='$exp'";

        if (!empty($image)) {
            $sql .= ", `image`= '$image' WHERE id = $id";
        } else {
            $sql .= "WHERE id = $id";
        }

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The user information has been updated");

        return $result;
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM `users` WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The user has been deleted");
    }
    public function createAgency(array $values)
    {
        $result = $this->insert("users", "`role`, `address`, `image`, `email`, `phone`, `password`", $values);

        $this->alert($result, "A new agency account has been created");

        header("refresh: 2; url = ../agency/dashboard.php");
    }

    public function updateAgency($id, $agency, $address, $phone, $email, $image)
    {

        $sql = "UPDATE `users` SET `agency`='$agency',`address`='$address', `email`='$email',`phone`='$phone'";

        if (!empty($image)) {
            $sql .= ", `image`= '$image' WHERE id = $id";
        } else {
            $sql .= " WHERE id = $id"; 
        }    

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The agency information has been updated");

        return $result;
    }

    public function deleteAgency($id)
    {
        $sql = "DELETE FROM `users` WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The agency has been deleted");
    }

    public function alertUser($result, string $message)
    {
        if ($result) {
            echo "
            <div class='alert alert-success'>
               <p>{$message}</p>
            </div>";
        } else {
            echo "
            <div class='alert alert-danger'>
               <p>Something went wrong, please try again later ...</p>
            </div>";
        }
    }
    public function alert($result, string $message)
    {
        if ($result) {
            echo "
            <div class='alert alert-success'>
               <p>{$message}</p>
            </div>";
        } else {
            echo "
            <div class='alert alert-danger'>
               <p>Something went wrong, please try again later ...</p>
            </div>";
        }
    }

    public function __destruct()
    {
        mysqli_close($this->connection);
    }
}
