<?php
require_once "dbi_connect.php";

// TABEL MASTER KANTONG CHECKER
// prepare tabel sudah memiliki kolom yang diperlukan untuk produk kantong
$alterQueries = array(
    "ALTER TABLE `master_kantong` CHANGE `ket` `ket` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;",
    "ALTER TABLE `master_kantong` ADD `pr_utama` VARCHAR(255) NULL DEFAULT NULL AFTER `berat_ku`;",
    "ALTER TABLE `master_kantong` ADD `pr_s1` VARCHAR(255) NULL DEFAULT NULL AFTER `berat_s1`;",
    "ALTER TABLE `master_kantong` ADD `pr_s2` VARCHAR(255) NULL DEFAULT NULL AFTER `berat_s2`;",
    "ALTER TABLE `master_kantong` ADD `pr_s3` VARCHAR(255) NULL DEFAULT NULL AFTER `berat_s3`;",
    "ALTER TABLE `master_kantong` ADD `pr_s4` VARCHAR(255) NULL DEFAULT NULL AFTER `berat_s4`;",
    "ALTER TABLE `master_kantong` ADD `pr_s5` VARCHAR(255) NULL DEFAULT NULL AFTER `berat_s5`;",
    "ALTER TABLE `master_kantong` ADD `pr_s6` VARCHAR(255) NULL DEFAULT NULL AFTER `berat_s6`;",
    "ALTER TABLE `master_kantong` ADD `pr_s7` VARCHAR(255) NULL DEFAULT NULL AFTER `berat_s7`;",
    "ALTER TABLE  `produk` ADD  `stats` INT( 1 ) NULL DEFAULT NULL COMMENT  '0:Aktif, 1:NonAktif';"
);

foreach ($alterQueries as $query) {
    mysqli_query($dbi, $query);
}

// Daftar kolom yang perlu dicek dan diubah
$columnsToCheck = array(
    'dpengolahan' => array(
        'NoTrans' => "VARCHAR(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL",
        'selesai' => "TIME NULL DEFAULT NULL"
    ),
    'dpengolahan_temp' => array(
        'musnah' => "INT(1) NULL DEFAULT NULL COMMENT '1=Iya, 0=Tidak'"
    )
);

// Loop untuk setiap tabel dan kolom
foreach ($columnsToCheck as $tableName => $columns) {
    foreach ($columns as $columnName => $expectedDefinition) {
        $columnExists = false;
        $result = $dbi->query("SHOW COLUMNS FROM `$tableName` LIKE '$columnName'");
        if ($result && $result->num_rows > 0) {
            $column = $result->fetch_assoc();
            if (strpos($column['Type'], strtok($expectedDefinition, ' ')) !== false) {
                $columnExists = true;
            }
        }

        // Jalankan ALTER TABLE jika kolom belum sesuai
        if (!$columnExists) {
            $query = "ALTER TABLE `$tableName` CHANGE `$columnName` `$columnName` $expectedDefinition;";
            mysqli_query($dbi, $query);
        }
    }
}

// TABEL KANTONG MERK CHECKER
$tableName = "kantong_merk";

// Cek apakah tabel ada
$tableExists = false;
$result = $dbi->query("SHOW TABLES LIKE '$tableName'");
if ($result && $result->num_rows > 0) {
    $tableExists = true;
}

if (!$tableExists) {
    // Jika tabel belum ada, buat tabel dengan struktur yang diminta
    $createQuery = "
        CREATE TABLE `$tableName` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `merk` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
            `pemasok` VARCHAR(125) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
            `aktif` INT(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`)
        )
    ";
    if ($dbi->query($createQuery) === TRUE) {
        // echo "Tabel '$tableName' berhasil dibuat.<br>";
    } else {
        echo "Gagal membuat tabel: " . $dbi->error . "<br>";
    }
} else {
    // Jika tabel sudah ada, cek struktur kolomnya
    $columns = array();
    $res = $dbi->query("SHOW COLUMNS FROM `$tableName`");
    while ($row = $res->fetch_assoc()) {
        $columns[$row['Field']] = $row;
    }

    $alterQueries = array();

    // Cek dan buat query ALTER jika perlu
    if (!isset($columns['id']) || strpos($columns['id']['Type'], 'int') === false || $columns['id']['Extra'] != 'auto_increment') {
        $alterQueries[] = "MODIFY COLUMN `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
    }

    if (!isset($columns['merk'])) {
        $alterQueries[] = "ADD COLUMN `merk` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL AFTER `id`";
    } elseif (strpos($columns['merk']['Type'], 'varchar(20)') === false) {
        $alterQueries[] = "MODIFY COLUMN `merk` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL AFTER `id`";
    }

    if (!isset($columns['pemasok'])) {
        $alterQueries[] = "ADD COLUMN `pemasok` VARCHAR(125) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL AFTER `merk`";
    } elseif (strpos($columns['pemasok']['Type'], 'varchar(125)') === false) {
        $alterQueries[] = "MODIFY COLUMN `pemasok` VARCHAR(125) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL AFTER `merk`";
    }

    if (!isset($columns['aktif'])) {
        $alterQueries[] = "ADD COLUMN `aktif` INT(1) NOT NULL DEFAULT 0 COMMENT '0=Aktif, 1=Nonaktif' AFTER `pemasok`";
    } elseif (strpos($columns['aktif']['Type'], 'int(1)') === false) {
        $alterQueries[] = "MODIFY COLUMN `aktif` INT(1) NOT NULL DEFAULT 0 COMMENT '0=Aktif, 1=Nonaktif' AFTER `pemasok`";
    }


    // Jalankan ALTER jika ada perubahan
    if (!empty($alterQueries)) {
        $alterSQL = "ALTER TABLE `$tableName` " . implode(", ", $alterQueries);
        if ($dbi->query($alterSQL) === TRUE) {
            // echo "Struktur tabel '$tableName' telah diperbarui.<br>";
        } else {
            echo "Gagal memperbarui struktur tabel: " . $dbi->error . "<br>";
        }
    } else {
        // echo "Struktur tabel '$tableName' sudah sesuai.<br>";
    }
}

// $dbi->close();
?>
