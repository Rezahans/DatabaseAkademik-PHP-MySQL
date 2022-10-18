<?php 
$conn = mysqli_connect("localhost", "root", "","akademik" );

if (!$conn) {
    die('Gagal Connected MySQL ,Try Again !!'.  mysqli_connect_error());
} else {
    echo 'Connected MySQL';
}

$table_name = 'mahasiswa';

$sql = 'CREATE TABLE IF NOT EXISTS `' . $table_name . '` (
            `nama` varchar(20) NOT NULL,
            `nim` int(5) NOT NULL,
            `tugas` int(5) NOT NULL,
            `uts` int(5) NOT NULL,
            `uas` int(5) NOT NULL,
            PRIMARY KEY (`nim`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8';

$query = mysqli_query($conn, $sql);

if (!$query) {
    die ('ERROR: Tabel ' . $table_name . ' gagal dibuat: ' . mysqli_error($conn));
}
echo 'Tabel ' . $table_name . ' berhasil dibuat <br/>';
$sql = "INSERT INTO `$table_name` (`nim`, `nama`, `tugas`, `uts`, `uas`)
        VALUES (12008, 'Reza Hans Latif', 90, 90, 90),
                (12009, 'Farhan Dwi Oktavian',90, 80, 70),
                (12010, 'Iman Oetama',70, 80, 90),
                (12011, 'Iqbal', 86, 80, 70),
                (12012, 'Ikhsan', 70, 80, 75)";
$query = mysqli_query($conn, $sql);

if (!$query) { 
    die ('ERROR: Data gagal dimasukkan pada tabel ' . $table_name . ': ' . mysqli_error($conn));
}
echo 'Data berhasil dimasukkan pada tabel ' . $table_name . '';

$sql = 'SELECT nim, nama, tugas, uts, uas, (tugas+uts+uas)/3 AS nilai_akhir
        FROM mahasiswa';

$query = mysqli_query($conn, $sql);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}
echo '<html>
        <head>
            <title>Menampilkan Data Tabel MySQL dengan mysqli_fetch_array</title>
            <style>
                body {font-family:tahoma, arial}
                table {border-collapse: collapse}
                th, td {font-size: 13px; border: 1px solid #DEDEDE; padding; 8px 8px; color: #303030}
                th {background: #CCCCCC; font-size: 12px; border-color:#B0B0B0}
                .subtotal td (background: #F8F8F8}
                .right(text-align: right}

                
            </style>
        </head>
        <body>
        <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>NAMA</th>
                <th>TUGAS</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>NILAI AKHIR</th>
            </tr>
        </thead>
        <tbody>';
         
while ($row = mysqli_fetch_array($query))
{
    echo '<tr>
            <td>'.$row['nim'].'</td>
            <td>'.$row['nama'].'</td>
            <td>'.$row['tugas'].'</td>
            <td>'.$row['uts'].'</td>
            <td>'.$row['uas'].'</td>
            <td class="right">'.$row['nilai_akhir'].'</td>
            </tr>';
}
echo '
    </tbody>
</table>
</body>
</html>';

mysqli_free_result($query);
mysqli_close($conn);
?>