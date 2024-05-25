<?php
include 'config.php';

session_start();

$sqli = "SELECT * FROM users";
$result = $conn->query($sqli);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Stock Minyak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="mx-auto" style="width: 800px;">
        <div class="card">
            <h5 class="card-header text-center bg-light border border-secondary">STOCK OIL CPO Raw Material</h5>
            <div class="card-body">
                <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                </div>
                <?php } ?>

                <?php if (isset($_SESSION['sukses'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                        echo $_SESSION['sukses'];
                        unset($_SESSION['sukses']);
                        ?>
                </div>
                <?php } ?>

                <form method="POST" action="create.php">
                    <div class="mb-3 row">
                        <label for="jenis" class="col-sm-2 col-form-label">Jenis Minyak</label>
                        <div class="col-sm-10">
                            <input type="text" name="jenis" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah Minyak</label>
                        <div class="col-sm-10">
                            <input type="text" name="jumlah" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="satuan" id="satuan" required>
                                <option value="">- Pilih Satuan -</option>
                                <option value="L">L</option>
                                <option value="ML">ML</option>
                            </select>
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Simpan">
                </form><br>
                <h5 class="card-header text-center text-white bg-secondary border border-dark">List Minyak</h5>
                <table class="table table-striped table-hover">
                    <tr>

                        <th>Jenis Minyak</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Created At</th>
                        <th>Edited At</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    
                                    <td>".$row['jenis']."</td>
                                    <td>".$row['jumlah']."</td>
                                    <td>".$row['satuan']."</td>
                                    <td>".$row['created_at']."</td>
                                    <td>".$row['edited_at']."</td>
                                    <td>
                                        <a href='update.php?id=".$row['id']."' class='btn btn-warning'>Edit</a>
                                        <a href='delete.php?id=".$row['id']."' class='btn btn-danger'>Delete</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Belum Ada Data Minyak</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>