<?php
// Inisialisasi array untuk menyimpan data pemesanan
session_start(); // Mulai session untuk menyimpan data
if (!isset($_SESSION['bookings'])) {
    $_SESSION['bookings'] = []; // Inisialisasi array jika belum ada
}

// Tangani form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = htmlspecialchars($_POST['name']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $location = htmlspecialchars($_POST['location']);
    $startDate = htmlspecialchars($_POST['startDate']);
    $endDate = htmlspecialchars($_POST['endDate']);
    $participants = htmlspecialchars($_POST['participants']);
    $paymentMethod = htmlspecialchars($_POST['paymentMethod']);

    // Simpan data ke dalam array
    $newBooking = [
        'name' => $name,
        'telepon' => $telepon,
        'location' => $location,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'participants' => $participants,
        'paymentMethod' => $paymentMethod,
    ];

    // Tambahkan data baru ke session
    array_push($_SESSION['bookings'], $newBooking);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Wisata</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo_title.png">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: url(img/Pemesanan/rajaampat.jpg);
            background-size: cover;
            background-position: center;
            background-size: cover;
        }

        .container {
            position: relative;
            max-width: 600px;
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(55px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            padding: 2rem 3rem;
            overflow: hidden;
        }

        form {
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #fff;
        }

        h1, h2 {
            font-size: 2rem;
            color: #fff;
            text-align: center;
        }

        input[type="text"],
        input[type="tel"],
        input[type="date"],
        input[type="number"]{
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background-color: rgb(24, 207, 94);
            color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            transition: all 0.4s ease;
        }

        button:hover {
            color: rgb(51, 255, 0);
            background-color: rgba(255, 255, 255, 0.5);
        }

        table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
            border-radius: 20px;
            backdrop-filter: blur(55px);
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            table-layout: fixed;
            text-align: left;
            font-size: 0.7rem;
        }

        th:first-child {
            border: 1px transparent;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
        }

        th:last-child {
            border: 1px transparent;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
        }

        th:not(:first-child):not(:last-child) {
            border: 1px transparent;
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
        }

        td:first-child {
            border: 1px transparent;
            padding: 15px;
            text-align: left;
            word-wrap: break-word;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        td:last-child {
            border: 1px transparent;
            padding: 15px;
            text-align: left;
            word-wrap: break-word;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        td:not(:first-child):not(:last-child) {
            border: 1px transparent;
            padding: 15px;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
    <script>
        function confirmSubmit() {
            return confirm("Apakah Anda yakin ingin mengirim data pemesanan?");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Form Pemesanan <br>Tempat Wisata</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirmSubmit()">
            <label for="name">Nama : </label>
            <input type="text" id="name" name="name" required>
            
            <label for="telepon">No. Telepon : </label>
            <input type="tel" id="telepon" name="telepon" required>
            
            <label for="location">Lokasi Wisata : </label>
            <input type="text" id="location" name="location" required>
            
            <label for="startDate">Tanggal Awal : </label>
            <input type="date" id="startDate" name="startDate" required>

            <label for="endDate">Tanggal Akhir : </label>
            <input type="date" id="endDate" name="endDate" required>
            
            <label for="participants">Jumlah Peserta : </label>
            <input type="number" id="participants" name="participants" required min="1">
            
            <label>Metode Pembayaran:</label>
            <div style="display: flex; justify-content: space-evenly;">
                <label><input type="radio" name="paymentMethod" value="cash" onclick="toggleEMoneyOptions()" required> Cash</label>
                <label><input type="radio" name="paymentMethod" value="e-money" onclick="toggleEMoneyOptions()" required> E-Money</label>
            </div>
            
            <button type="submit">Pesan</button>
        </form>

        <h2>Daftar Pemesanan <br>Tempat Wisata</h2>
        <table id="bookingTable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nomor Telpon</th>
                    <th>Lokasi Wisata</th>
                    <th>Tgl Awal</th>
                    <th>Tgl Akhir</th>
                    <th>Jmlh Peserta</th>
                    <th>Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($_SESSION['bookings'])): ?>
                    <?php foreach ($_SESSION['bookings'] as $booking): ?>
                        <tr>
                            <td><?= $booking['name'] ?></td>
                            <td><?= $booking['telepon'] ?></td>
                            <td><?= $booking['location'] ?></td>
                            <td><?= $booking['startDate'] ?></td>
                            <td><?= $booking['endDate'] ?></td>
                            <td><?= $booking['participants'] ?></td>
                            <td><?= $booking['paymentMethod'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Belum ada data pemesanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>