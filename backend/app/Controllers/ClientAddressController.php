<?php

namespace App\Controllers;

use mysqli;

class ClientAddressController
{
    protected $servername;
    protected $username;
    protected $password;
    protected $dbname;

    public function __construct()
    //poderia criar uma classe para não usar aqui e colocar no .gitignore, porém para teste penso que não tem necessidade
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
        $id = $_GET['id'];
        $clients = [];
        $conn = $this->connect();

        $sql = "SELECT * FROM client_address WHERE client_id = $id ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $clients[] = $row;
            http_response_code(200);
        }
        } else {
            $clients = ['client' => 'Nenhum registro encontrado.'];
            http_response_code(200);
        }

        $conn->close();

        return json_encode($clients);
    }

    public function create()
    {
        $client = [];
        $id = $_GET['id'];

        $_POST = json_decode(file_get_contents('php://input'), true);

        $client_id = $id;
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $tipo = $_POST['tipo'];

        $conn = $this->connect();

        $sql = "INSERT INTO client_address (client_id, endereco, bairro, cidade, estado, tipo)
        VALUES ('$client_id', '$endereco', '$bairro', '$cidade', '$estado', '$tipo')";

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

    public function delete()
    {
        $client = [];
        $id = $_GET['id'];

        $conn = $this->connect();

        $sql = "DELETE FROM client_address WHERE id=$id";

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
