<?php
class CRUD_PET
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

    public function selectPets(string $condition)
    {
        return $this->select("pet", "*", $condition);
    }


    public function selectStories(string $condition)
    {
        return $this->select("story", "*", $condition);
    }
    public function selectMessages(string $condition)
    {
        return $this->select("message", "*", $condition);
    }
    public function createPet(array $values)
    {
        $result = $this->insert("pet", "`name`, `image`, `location`, `species`, `breed`, `age`, `size`, `available`, `description`, `vaccinated`, `experienceNeeded`, `minSpace`, `behavior`, `fk_users_id`", $values);

        $this->alert($result, "A new pet has been created");

        header("refresh: 2; url = ../pet/listings.php");
    }

    public function updatePet($id, $name, $location, $species, $breed, $age, $size, $desc, $status, $vaccinated, $exp, $space, $behavior, $image)
    {
        $sql = "UPDATE `pet` SET `name`='$name',`location`='$location',`species`='$species',`breed`='$breed', `age`='$age', `size`='$size', `description`='$desc',
        `available`='$status',`vaccinated`='$vaccinated',`experienceNeeded`='$exp',`minSpace`='$space',`behavior`='$behavior'";

        if (!empty($image)) {
            $sql .= ", `image`= '$image' WHERE id = $id";
        } else {
            $sql .= "WHERE id = $id";
        }

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The pet has been updated successfully");

        return $result;
    }

    public function makePetOfDay($id)
    {
        $getPOD = $this->selectPets("`pet_day` = 1");

        if ($getPOD != NULL) {
            $POD = $getPOD[0]["id"];
            $this->removePetOfDay($POD);
        }


        $sql = "UPDATE `pet` SET `pet_day`= 1 WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The pet has been made pet of the day");

        return $result;
    }

    public function removePetOfDay($id)
    {

        $sql = "UPDATE `pet` SET `pet_day`= 0 WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        return $result;
    }

    public function deletePet($id)
    {
        $sql = "DELETE FROM `pet` WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The pet has been deleted");
    }

    public function createStory(array $values)
    {
        $result = $this->insert("stories", "`fk_pet_id`, `image`, `desc`,`date`, `fk_user_id`", $values);

        $this->alertUser($result, "A new adoption story has been submitted");
    }
    public function createMessage(array $values)
    {
        $result = $this->insert("message", "`subject`, `message`, `fk_user_id`, `fk_agency_id`", $values);

        $this->alertUser($result, "A new message has been submitted");
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
