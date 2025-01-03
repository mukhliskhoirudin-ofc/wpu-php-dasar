<?php

require 'db_connect.php';

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function create($data)
{
    global $conn;
    $nama = htmlspecialchars(trim($data["nama"]));
    $npm = htmlspecialchars(trim($data["npm"]));
    $email = htmlspecialchars(trim($data["email"]));
    $jurusan = htmlspecialchars(trim($data["jurusan"]));
    $gambar = htmlspecialchars(trim($data["gambar"]));

    $query = "INSERT INTO mahasiswa (nama, npm, email, jurusan, gambar) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "sssss", $nama, $npm, $email, $jurusan, $gambar);
    mysqli_stmt_execute($stmt);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}
