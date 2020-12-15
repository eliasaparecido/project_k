<?php

namespace App\Controllers;

use mysqli;

class UserController
{
    protected $servername;
    protected $username;
    protected $password;
    protected $dbname;

    public function __construct()
    //poderia criar uma classe para não usar no código e colocar no .gitignore, porém para teste penso que não tem necessidade
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "123456";
        $this->dbname = "kabum";
    }

    public function connect()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else{
            return $conn;
        }
    }

    public function index()
    {
        $users = [];
        $conn = $this->connect();

        $sql = "SELECT id, name, email FROM users ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            $users[] = $row;
            http_response_code(200);
        }
        } else {
            $users = ['user' => 'Nenhum registro encontrado.'];
            http_response_code(200);
        }

        mysqli_close($conn);

        return json_encode($users);
    }

    public function create()
    {
        $user = [];
       
        $_POST = json_decode(file_get_contents('php://input'), true);
       
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT) ;

        $conn = $this->connect();

        $sql = "INSERT INTO users (name, email, password)
        VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            $user = [
                "Sucesso" => "Operação realizada com sucesso.",
                "data" => $sql
            ];
            http_response_code(200);
        } else {
            $user = [
                "erro" => "Erro ao realizar a operação",
                "error" => $conn->error
            ];
            http_response_code(400);
        }

        $conn->close();

        return json_encode($user);
    }

    public function edit()
    {
        $user = [];
        $id = $_GET['id'];

        $conn = $this->connect();

        $sql = "SELECT id, name, email FROM users where id = $id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            http_response_code(200);
        } else {
            $user = ['user' => 'Nenhum registro encontrado.'];
            http_response_code(400);
        }

        $conn->close();

        return json_encode($user);
    }

    public function update()
    {
        $user = [];
        $id = $_GET['id'];

        $_POST = json_decode(file_get_contents('php://input'), true);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $conn = $this->connect();

        $sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
           $user =  [
               "Sucesso" => "Operação realizada com sucesso",
               "data" => $sql
            ];
            http_response_code(200);
          } else {
            $user = [
                "erro" => "Erro ao realizar a operação",
                "error" => $conn->error
            ];
            http_response_code(400);
          }

        $conn->close();

        return json_encode($user);
    }

    public function delete()
    {
        $user = [];
        $id = $_GET['id'];

        $conn = $this->connect();

        $sql = "DELETE FROM users WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $user = [ "Registro deletado com sucesso" ];
            http_response_code(200);
        } else {
            $user = [
                "erro" => "Erro ao realizar a operação",
                "error" => $conn->error
            ];
            http_response_code(400);
        }
        $conn->close();
        return json_encode($user);
    }
}