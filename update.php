<?php
require_once 'config.php';
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sqli = "SELECT * FROM users WHERE id=?";
    $stmt = $conn->prepare($sqli);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];

    $sqli = "UPDATE users SET jenis=?, jumlah=?, satuan=?, edited_at=NOW() WHERE id=?";
    $stmt = $conn->prepare($sqli);
    $stmt->bind_param("sssi", $jenis, $jumlah, $satuan, $id);

    if ($stmt->execute() === TRUE) {
        $_SESSION['sukses'] = "Data berhasil diperbarui";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['error'] = "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="mx-auto" style="width: 800px;">
        <div class="card">
            <h5 class="card-header text-center bg-light border border-secondary">Update OIL CPO Raw Material</h5>
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
                <form method="POST" action="update.php?id=<?php echo $id; ?>">
                    <div class="mb-3 row">
                        <label for="jenis" class="col-sm-2 col-form-label">Jenis Minyak</label>
                        <div class="col-sm-10">
                            <input type="text" name="jenis" class="form-control" value="<?php echo $row['jenis']; ?>"
                                required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah Minyak</label>
                        <div class="col-sm-10">
                            <input type="text" name="jumlah" class="form-control" value="<?php echo $row['jumlah']; ?>"
                                required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="satuan" id="satuan" required>
                                <option value="">- Pilih Satuan -</option>
                                <option value="L" <?php if ($row['satuan'] == 'L') echo 'selected'; ?>>L</option>
                                <option value="ML" <?php if ($row['satuan'] == 'ML') echo 'selected'; ?>>ML</option>
                            </select>
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Update">
                </form>
            </div>
        </div>
    </div>
</body>

</html>