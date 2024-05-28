<?php
class CRUD_ADOPTION
{
    private $connection;

    public function __construct(string $database = "pet_adoption", string $host = "localhost", string $user = "root", string $password = "")
    {
        $this->connection = mysqli_connect($host, $user, $password, $database);
    }

    public function select(string $table, string $columns = "*", string $condition)
    {
        $sql = "SELECT $columns FROM $table";

        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }

        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }

    public function selectAdoptions(string $condition)
    {
        return $this->select("adoption", "*", $condition);
    }

    public function selectAdoptionsAndAgencyPets(string $condition)
    {
        $table = "`adoption` a 
        RIGHT JOIN `pet` p ON a.fk_pet_id = p.id 
        LEFT JOIN `users` u ON a.fk_adoptee_id = u.id ";

        $columns = "p.id as petId, 
        a.fk_adoptee_id as fk_adoptee_id,
        p.name as pname, 
        p.species as species, 
        p.experienceNeeded as petExperience,
        p.minSpace as petSpace,
        u.id as userId, 
        u.firstName as firstname, 
        u.lastName as lastname, 
        u.birthdate as birthDate,
        u.experienced as userExperience,
        u.space as userSpace,
        a.id as adoptId, 
        a.adopStatus as adopStatus, 
        a.adoptionDate as adoptionDate , 
        a.submitionDate as submitionDate, 
        a.reason as reason, 
        a.donation as donation ,
        p.fk_users_id as agency ";

        return $this->select($table, $columns, $condition);
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

    public function createAdoption(array $values)
    {

        $result = $this->insert("adoption", "`fk_pet_id`, `fk_adoptee_id`, `submitionDate`, `donation`, `reason`,`adoptionDate`, `adopStatus`", $values);

        $this->alertUser($result, "A new adoption has been submitted");

        header("refresh: 2; url = ../adoptions/myadoptions.php");
    }

    public function updateAdoptionStatus($table, $column, $status, $condition = "",)
    {
        $sql = "UPDATE `$table` SET `$column` = '$status' $condition";

        $result = mysqli_query($this->connection, $sql);


        

        return $result;
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
