<?php
class Buku {

    private $koneksi;
    private $table = "buku";

    // Objek
    public $id_buku;
    public $judul_buku;
    public $penerbit;
    public $penulis;
    public $deskripsi;
    public $date_created;

    public function __construct($db) {
        $this->koneksi = $db;
    }

    public function tampil() {
       $query = "SELECT * FROM ". $this->table ." ORDER BY id_buku ASC";

       $stmt = $this->koneksi->prepare($query);

       $stmt->execute();

       return $stmt;
    }

    public function tambah() {
        $query = "INSERT INTO ". $this->table . " SET judul_buku=:judul_buku, penerbit=:penerbit, penulis=:penulis, deskripsi=:deskripsi, date_created=:date_created";

        $stmt = $this->koneksi->prepare($query);

        $this->judul_buku = htmlspecialchars(strip_tags($this->judul_buku));
        $this->penerbit = htmlspecialchars(strip_tags($this->penerbit));
        $this->penulis = htmlspecialchars(strip_tags($this->penulis));
        $this->deskripsi = htmlspecialchars(strip_tags($this->deskripsi));
        $this->date_created = htmlspecialchars(strip_tags($this->date_created));

        $stmt->bindParam(":judul_buku", $this->judul_buku);
        $stmt->bindParam(":penerbit", $this->penerbit);
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":deskripsi", $this->deskripsi);
        $stmt->bindParam(":date_created", $this->date_created);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function listId() {
        $query = "SELECT * FROM " . $this->table . " WHERE id_buku = ? LIMIT 0,1";

        $stmt = $this->koneksi->prepare($query);

        $stmt->bindParam(1, $this->id_buku);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->judul_buku = $row['judul_buku'];
        $this->penerbit = $row['penerbit'];
        $this->penulis = $row['penulis'];
        $this->deskripsi = $row['deskripsi'];
        $this->date_created = $row['date_created'];
    }
}
?>