<?php
class Buku {

    // Atribut / variabel
    private $koneksi;
    private $table = "buku";

    // Atribut / variabel
    public $id_buku;
    public $judul;
    public $penulis;
    public $penerbit;
    public $deskripsi;
    public $bahasa;
    public $genre;
    public $jumlah_halaman;
    public $tahun_terbit;

    // Konstruktor koneksi db
    public function __construct($db) {
        $this->koneksi = $db;
    }

    // Method atau fungsi untuk menampilkan semua data buku
    public function listAll() {

        // Query sql
        $query = "SELECT * FROM ". $this->table ." ORDER BY id_buku ASC";

        // Prepare statement
        $stmt = $this->koneksi->prepare($query);

        // Eksekusi query
        $stmt->execute();

        // Kembalikan hasil eksekusi query
        return $stmt;
    }

    // Method atau fungsi untuk tambah data buku
    public function tambah() {

        // Query sql
        $query = "INSERT INTO ". $this->table . " SET judul=:judul, penulis=:penulis, penerbit=:penerbit, 
                deskripsi=:deskripsi, bahasa=:bahasa, genre=:genre, jumlah_halaman=:jumlah_halaman, tahun_terbit=:tahun_terbit";

        // Prepare statement
        $stmt = $this->koneksi->prepare($query);

        // Sanitize input browser
        $this->judul = htmlspecialchars(strip_tags($this->judul));
        $this->penulis = htmlspecialchars(strip_tags($this->penulis));
        $this->penerbit = htmlspecialchars(strip_tags($this->penerbit));
        $this->deskripsi = htmlspecialchars(strip_tags($this->deskripsi));
        $this->bahasa = htmlspecialchars(strip_tags($this->bahasa));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->jumlah_halaman = htmlspecialchars(strip_tags($this->jumlah_halaman));
        $this->tahun_terbit = htmlspecialchars(strip_tags($this->tahun_terbit));

        // Binding isi
        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":penerbit", $this->penerbit);
        $stmt->bindParam(":deskripsi", $this->deskripsi);
        $stmt->bindParam(":bahasa", $this->bahasa);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":jumlah_halaman", $this->jumlah_halaman);
        $stmt->bindParam(":tahun_terbit", $this->tahun_terbit);

        // Eksekusi query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method atau fungsi untuk menampilkan data berdasarkan id ( parameter )
    public function listId() {

        // Query sql
        $query = "SELECT * FROM " . $this->table . " WHERE id_buku = ? LIMIT 0,1";

        // Prepare statement
        $stmt = $this->koneksi->prepare($query);

        // Binding isi / parameter
        $stmt->bindParam(1, $this->id_buku);

        // Eksekusi query
        $stmt->execute();

        // Fetch data hasil query
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Masukkan isi hasil fetch data ke dalam objek
        $this->judul = $row['judul'];
        $this->penulis = $row['penulis'];
        $this->penerbit = $row['penerbit'];
        $this->deskripsi = $row['deskripsi'];
        $this->bahasa = $row['bahasa'];
        $this->genre = $row['genre'];
        $this->jumlah_halaman = $row['jumlah_halaman'];
        $this->tahun_terbit = $row['tahun_terbit'];
    }

    // Method atau fungsi untuk update data buku
    public function update() {

        // Query sql
        $query = "UPDATE " . $this->table . "
                SET judul=:judul, penulis=:penulis, 
                penerbit=:penerbit, deskripsi=:deskripsi,
                bahasa=:bahasa, genre=:genre, jumlah_halaman=:jumlah_halaman,
                tahun_terbit=:tahun_terbit
                WHERE id_buku=:id_buku";

        // Prepare statement
        $stmt = $this->koneksi->prepare($query);

        // Sanitize input
        $this->judul = htmlspecialchars(strip_tags($this->judul));
        $this->penulis = htmlspecialchars(strip_tags($this->penulis));
        $this->penerbit = htmlspecialchars(strip_tags($this->penerbit));
        $this->deskripsi = htmlspecialchars(strip_tags($this->deskripsi));
        $this->bahasa = htmlspecialchars(strip_tags($this->bahasa));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->jumlah_halaman = htmlspecialchars(strip_tags($this->jumlah_halaman));
        $this->tahun_terbit = htmlspecialchars(strip_tags($this->tahun_terbit));
        $this->id_buku = htmlspecialchars(strip_tags($this->id_buku));

        // Binding isi
        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":penerbit", $this->penerbit);
        $stmt->bindParam(":deskripsi", $this->deskripsi);
        $stmt->bindParam(":bahasa", $this->bahasa);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":jumlah_halaman", $this->jumlah_halaman);
        $stmt->bindParam(":tahun_terbit", $this->tahun_terbit);
        $stmt->bindParam(":id_buku", $this->id_buku);

        // Eksekusi statement atau query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method atau fungsi untuk delete data buku
    public function delete() {

        // Query sql
        $query = "DELETE FROM " .$this->table." WHERE id_buku = ?";

        // Prepare statement
        $stmt = $this->koneksi->prepare($query);

        // Sanitize isi
        $this->id = htmlspecialchars(strip_tags($this->id_buku));

        // Binding isi
        $stmt->bindParam(1, $this->id);

        // Eksekusi query
        if($stmt->execute()) {
            return true;
        } 

        return false;
    }

    // Method atau fungsi cari data berdasarkan parameter
    function search($keywords){
  
        // Query sql
        $query = "SELECT * FROM ".$this->table . " WHERE judul LIKE ?";
      
        // Prepare statement
        $stmt = $this->koneksi->prepare($query);
      
        // Sanitize isi
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
      
        // Bind isi
        $stmt->bindParam(1, $keywords);
              
        // Eksekusi query
        $stmt->execute();
      
        // Kembalikan nilai statement atau hasil eksekusi
        return $stmt;
    }
}
?>