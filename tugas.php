<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Elearning PENS</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" />
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/styles/styles.css" />
</head>

<body>
    <?php
        require_once 'includes/connection.php';
        session_start();
        $id = $_SESSION['iduser'];
	?>

    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navigation">
                <div class="padding-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="fa fa-book"></i> E-Learning PENS
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clearfix">
                Welcome, <?php echo $_SESSION['nama'] ?>
                &nbsp;
                <a href="logout.php" class="btn btn-danger navbar-btn right">
                    <i class="fa fa-sign-out-alt"> Log Out</i>
                </a>
            </div>
        </div>
    </nav>

<div id="content">
<div class="container">
<?php 
if (isset($_GET['id'])) {
$idtugas = $_GET['id'];
$query = " DELETE from tugas where id_tugas = '" . $idtugas . "'";
$result = mysqli_query($con, $query);
if ($result) {
echo "<div class='alert alert-info col-md-12 mt-3'>Tugas Berhasil Dihapus</div>";
echo "<meta http-equiv='refresh' content='1;url=tugas.php'>";
} else {
echo ' Please Check Your Query ';
}
}
?>
<div class="card mt-3">
<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
<div class="container">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navigation">
<div class="padding-nav">
<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="halaman_dosen.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="matakuliah.php">Mata Kuliah</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="">Tugas</a>
    </li>
</ul>
</div>
</div>
</div>
<div class="clearfix">
<a href="tambahtugas.php" class="btn btn-primary navbar-btn right">
<i class="fa fa-plus"></i>
<span>Tambahkan Tugas</span>
</a>
</div>
</nav>
</div>

<div class="row mt-2">
<div class="col-md-12" id="cart">
<div class="card">
<div class="card-body">
<h3>Daftar Tugas</h3>
<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th>Judul Tugas</th>
            <th>Batas Waktu</th>
            <th class="text-center">Status Pengumpulan</th>
            <th>Mata Kuliah</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $data = $con->query("SELECT *,(SELECT COUNT(id_detail_tugas) FROM detailtugas WHERE detailtugas.id_tugas = tugas.id_tugas ) AS hitung 
            FROM tugas,matakuliah
            WHERE tugas.id_matkul = matakuliah.id_matkul
            AND matakuliah.nip_dosen = '$id'");
            while ($row = $data->fetch_assoc()) {
            ?>
        <tr>
            <td><?php echo $row["judul_tugas"]; ?></td>
            <td><?php echo $row["tanggal"]; ?></td>
            <td class="text-center"><?php echo $row["hitung"]; ?> Mahasiswa</td>
            <td><?php echo $row["nama_matkul"]; ?></td>
            <td>
                <a href="lihat_tugas_dosen.php?id=<?php echo $row['id_tugas']?>"
                    class="btn btn-info btn-xs"><i class="fas fa-eye"></i>
                </a>
                <a href="edittugas.php?id=<?php echo $row['id_tugas']?>"
                    class="btn btn-warning btn-xs"><i class="fas fa-pencil-alt"></i>
                </a>
                <a href="tugas.php?id=<?php echo $row['id_tugas']?>"
                    class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
        <?php
                }
            ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>