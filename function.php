<?php

// koneksi ke database
$conn = mysqli_connect("localhost" , "root", "", "kasir");


// function query($query){
//     global $conn;
//     $result = mysqli_query($conn, $query);
//     $rows = [];
//     while ($row = mysqli_fetch_assoc($result)) {
//         $rows[] = $row;
//     }
//     return $rows;
// }

function registrasi($data){
    global $conn;

    $username = stripslashes($data["username"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sama dengan username baru

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username telah tersedia')
        </script>
        ";
        return false;
    }

    // cek password
    if ($password !== $password2) {
        echo "<script>
        alert('konfirmasi password tidak sesuai')
        </script>
        ";
        return false;
    }
    // enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    // tambahkan userbaru ke database 
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}

?>