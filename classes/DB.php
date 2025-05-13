<?php
class DB {
    private $pdo;
    private $host = 'localhost';
    private $dbname = 'artesanato_db';
    private $user = 'root';
    private $password = '';

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    public function listarProdutos() {
        $sql = "SELECT id, nome, preco FROM produtos_artesanais";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrarProduto($nome, $preco, $descricao, $categoria) {
        $sql = "INSERT INTO produtos_artesanais (nome, preco, descricao, categoria) VALUES (:nome, :preco, :descricao, :categoria)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':categoria', $categoria);
        return $stmt->execute();
    }

    public function removerProduto($id) {
        $sql = "DELETE FROM produtos_artesanais WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>