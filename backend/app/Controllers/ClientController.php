<?php

namespace App\Controllers;

use mysqli;

class ClientController
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
        $clients = [];
        $conn = $this->connect();

        $sql = "SELECT id, nome, datanascimento, cpf, rg, telefone FROM clients ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $clients[] = $row;
            http_response_code(200);
        }
        } else {
            $clients = ['client' => 'Nenhum registro encontrado.'];
            http_response_code(400);
        }

        $conn->close();

        return json_encode($clients);
    }

    public function create()
    {
        $client = [];

        $_POST = json_decode(file_get_contents('php://input'), true);

        $nome = $_POST['nome'];
        $datanascimento = $_POST['datanascimento'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $telefone = $_POST['telefone'];

        $conn = $this->connect();

        $sql = "INSERT INTO clients (nome, datanascimento, cpf, rg, telefone)
        VALUES ('$nome', '$datanascimento', '$cpf', '$rg', '$telefone')";

        if ($conn->query($sql) === TRUE) {
            $client = [
                "Sucesso" => "Operação realizada com sucesso.",
                "data" => $sql
            ];
            http_response_code(200);
        } else {
            $client = [
                "erro" => "Erro ao realizar a operação",
                "error" => $conn->error
            ];
            http_response_code(400);
        }

        $conn->close();

        return json_encode($client);
    }

    public function edit()
    {
        $client = [];
        $id = $_GET['id'];

        $conn = $this->connect();

        $sql = "SELECT id, nome, datanascimento, cpf, rg, telefone FROM clients where id = $id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row

            $client = $result->fetch_assoc();
            http_response_code(200);
        
        } else {
            $client = ['client' => 'Nenhum registro encontrado.'];
            http_response_code(400);
        }

        $conn->close();

        return json_encode($client);
    }

    public function update()
    {
        $client = [];
        $id = $_GET['id'];

        $_POST = json_decode(file_get_contents('php://input'), true);

        $nome = $_POST['nome'];
        $datanascimento = $_POST['datanascimento'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $telefone = $_POST['telefone'];

        $conn = $this->connect();

        $sql = "UPDATE clients SET nome='$nome', datanascimento='$datanascimento', cpf='$cpf', rg='$rg', telefone='$telefone' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
           $client =  [
               "Sucesso" => "Operação realizada com sucesso",
               "data" => $sql
            ];
            http_response_code(200);
          } else {
            $client = [
                "erro" => "Erro ao realizar a operação",
                "error" => $conn->error
            ];
            http_response_code(400);
          }

        $conn->close();

        return json_encode($client);
    }

    public function delete()
    {
        $client = [];
        $id = $_GET['id'];

        $conn = $this->connect();

        $sql = "DELETE FROM clients WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $client = [ "Registro deletado com sucesso" ];
            http_response_code(200);
        } else {
            $client = [
                "erro" => "Erro ao realizar a operação",
                "error" => $conn->error
            ];
            http_response_code(400);
        }
        $conn->close();
        return json_encode($client);
    }

}
