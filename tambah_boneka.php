<!DOCTYPE html>
<html>
<head>
    <title>Tambah Boneka</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Boneka</h1>

        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data"
            <label>Nama:</label>
            <input type="text" name="Nama" required>

            <label>Jumlah:</label>
            <input type="int" name="Jumlah" required>

            <label>Harga</label>
            <input type="int" name="Harga" required>


            <label>Foto:</label>
            <input type="file" name="Foto" accept="image/*" required>

            <div class="buttons">
                <button type="submit">Tambah Boneka</button>
                <button id="cancel-button" onclick="location.href='index.html'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>