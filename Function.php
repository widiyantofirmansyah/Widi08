<?php
session_start();

$conn = mySqli_connect("localhost","root","","stockbarang");

if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['Namabarang'];
    $deskripsi = $_POST['Deskripsi'];
    $stock = $_POST["Stock"];

    $addtotable = mySqli_query($conn,"insert into Stock (Namabarang, Deskripsi, Stock) values('$namabarang','$deskripsi','$stock')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};


if (isset($_POST['masuk'])) {
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['Penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where IDbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['Stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk (IDbarang, Keterangan, qty) values('$barangnya','$penerima','$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where IDbarang='$barangnya'");
    if ($addtomasuk&&$updatestockmasuk) {
        header('location:masuk.php');
    }else{
        echo 'gagal';
        header('location:masuk.php');
    }
};

if(isset($_POST['keluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstockbarang);

    $stocksekarang = $ambildatanya['Stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtokeluar = mysqli_query($conn,"insert into keluar (idbarang, penerima, qty) values('$barangnya','$penerima','$qty')");
    $updatestockkeluar = mysqli_query($conn, "update stock set stock= '$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");
    if($addtokeluar&&$updatestockkeluar){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}


?>
