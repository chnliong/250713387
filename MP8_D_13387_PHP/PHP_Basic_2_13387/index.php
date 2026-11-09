<?php

if($_POST) {
    $bayaran = $_POST['bayaran'] ?? '';
    $kode = $_POST['kode'] ?? '';
    $harga = 50000;
    $massage = array();
    $massage2 = "";
    $bayaranKembali = 0;

    if(empty($bayaran) || empty($kode)) {
        $massage[] = "Harap lengkapi semua data.";
    }

    if(!preg_match("/^[0-9]*$/", $bayaran)){
        $massage[] = "Kode bayaran hanya boleh mengandung angka.";
    }

    if(!preg_match("/^[ a-zA-Z ]*$/", $kode)){
        $massage[] = "Kode pembayaran hanya boleh mengandung huruf.";
    }

    if(!empty($massage)) {
        foreach($massage as $msg){
            echo "<p style='color:red;'>!!" . htmlspecialchars($msg) . "!!</p>";
        }
    } else {
        function kodeDiskon($kode){
            switch(strtolower($kode)){
                case 'p':
                    $diskon = 0.05;
                    break;
                case 'w':
                    $diskon = 0.02;
                    break;
                case 'd':
                    $diskon = 0.10;
                    break;
                default:
                    $diskon = 0;
            }
            return $diskon;
        }
        $diskon = kodeDiskon($kode);

        function totalBayar($harga, $diskon){
            return $harga - ($harga * $diskon);
        }
        $totalBayar = totalBayar($harga, $diskon);
        
        function pembayaran($bayaran, $totalBayar){
            if($bayaran < $totalBayar){
                return null;
            } else {
                $bayaranKembali = $bayaran - $totalBayar;
                return $bayaranKembali;
            }
        }
        $bayaranKembali = pembayaran($bayaran, $totalBayar);

        if($bayaranKembali == null){
            $massage2 = "Jumlah yang dibayar kurang dari total pembayaran. Silakan bayar sesuai jumlah yang ditentukan.";
            $bayaranKembali = 0;
        }
        if(!empty($massage2)){
            echo "<p style='color:red;'>!! " . htmlspecialchars($massage2) . " !!</p>";
        } else{
            echo "<h2>Informasi Pembayaran</h2>";
            echo "<p><strong>Jumlah yang dibayar: </strong> Rp" . htmlspecialchars($bayaran) . "</p>";
            echo "<p><strong>Kode diskon: </strong> " . htmlspecialchars($kode) . "</p>";

            if($diskon == 0){
                echo "<p>Maaf kode diskon tidak valid. Tidak ada diskon yang diberikan. </p>";
            } else {
                echo "<p>Selamat! Anda mendapatkan diskon " . (htmlspecialchars($diskon * 100)) . "% berkat nomor kode diskon anda.</p>";
            }
            echo '<p style="font-weight: bold; font-size: 18px;">Total Pembayaran: Rp' . htmlspecialchars($totalBayar) . '</p>';
            echo '<p style="font-weight: bold; font-size: 18px;">Kembalian: Rp' . htmlspecialchars($bayaranKembali) . '</p>';
        }
    }
} else {
    echo "Silakan isi formulir untuk melakukan pembayaran.";
}
?>