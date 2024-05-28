<?php
class CRUD_STORY
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

    public function selectStories(string $condition)
    {
        return $this->select("stories", "*", $condition);
    }

    public function selectMessages(string $condition)
    {
        return $this->select("message", "*", $condition);
    }

    public function changeMsgStatus($id, $status, $user)
    {
        $col = ($user === 'User') ? "readmsg_user" : "readmsg_agency";

        $sql = "UPDATE `message` SET `$col`=$status WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        return $result;
    }

    public function createStory(array $values)
    {
        $result = $this->insert("stories", "`fk_pet_id`, `image`, `title`, `date`,`desc`, `fk_user_id`", $values);

        $this->alertUser($result, "A new adoption story has been submitted");
    }
    public function updateStory($id, $title, $desc, $date, $image)
    {
        $sql = "UPDATE `stories` SET `title`='$title',`desc`='$desc',`date`='$date'";

        if (!empty($image)) {
            $sql .= ", `image`= '$image' WHERE id = $id";
        } else {
            $sql .= "WHERE id = $id";
        }

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The Story has been updated successfully");

        return $result;
    }
    public function deleteStory($id)
    {
        $sql = "DELETE FROM `stories` WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The Story has been deleted");
    }
    public function createMessage(array $values)
    {
        $result = $this->insert("message", "`subject`, `message`, `fk_sender_id`, `fk_receiver_id`, `readmsg_agency`, `readmsg_user`", $values);

        $this->alertUser($result, "A new message has been submitted");

        header("refresh: 2; url = ../messages/seeMessages.php");
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
