<?php
// index.php - Aplikasi Biodata + Pencarian (untuk Laragon)
// Pastikan disimpan di C:\laragon\www\biodata\index.php
function e($s) { return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Biodata Mahasiswa - Laragon</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body{font-family:Segoe UI, Roboto, Arial; margin:24px; background:#fafafa; color:#222}
        .card{background:white; border:1px solid #e0e0e0; padding:16px; border-radius:8px; box-shadow: 0 2px 4px rgba(0,0,0,0.03); max-width:900px;}
        h1,h2{margin:0 0 12px 0}
        form { margin-bottom:18px; }
        label{display:inline-block; min-width:140px; vertical-align:top}
        input[type="text"], select, textarea { padding:6px 8px; width:320px; border:1px solid #ccc; border-radius:4px; }
        textarea{resize:vertical}
        .row{margin-bottom:10px}
        .actions{margin-top:10px}
        table{border-collapse:collapse; width:100%; margin-top:12px}
        th,td{border:1px solid #ccc; padding:8px; text-align:left}
        th{background:#f6f6f6}
        .muted{color:#555; font-size:0.95em}
    </style>
</head>
<body>
<div class="card">
    <h1>Biodata Mahasiswa</h1>
    <p class="muted">Form input menggunakan <strong>POST</strong>. Hasil ditampilkan di halaman yang sama.</p>

    <!-- FORM BIODATA (POST) -->
    <form method="post" action="<?php echo e($_SERVER['PHP_SELF']); ?>">
        <div class="row">
            <label for="nama">Nama Lengkap</label>
            <input id="nama" name="nama" type="text" value="<?php echo e($_POST['nama'] ?? '') ?>">
        </div>
        <div class="row">
            <label for="nim">NIM</label>
            <input id="nim" name="nim" type="text" value="<?php echo e($_POST['nim'] ?? '') ?>">
        </div>
        <div class="row">
            <label for="prodi">Program Studi</label>
            <select id="prodi" name="prodi">
                <?php $prodi_list = ['Informatika','Sistem Informasi','Teknik Elektro']; ?>
                <?php foreach($prodi_list as $p): ?>
                    <option value="<?php echo e($p); ?>" <?php if(isset($_POST['prodi']) && $_POST['prodi']==$p) echo 'selected'; ?>><?php echo e($p); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row">
            <label>Jenis Kelamin</label>
            <label><input type="radio" name="jk" value="Laki-Laki" <?php if(isset($_POST['jk']) && $_POST['jk']=='Laki-Laki') echo 'checked'; ?>> Laki-Laki</label>
            &nbsp;
            <label><input type="radio" name="jk" value="Perempuan" <?php if(isset($_POST['jk']) && $_POST['jk']=='Perempuan') echo 'checked'; ?>> Perempuan</label>
        </div>
        <div class="row">
            <label>Hobi (pilih minimal 0-3+)</label>
            <?php
            $hobi_options = ['Membaca','Olahraga','Musik','Gaming','Jalan-Jalan'];
            foreach($hobi_options as $i => $h): 
                $checked = (isset($_POST['hobi']) && is_array($_POST['hobi']) && in_array($h, $_POST['hobi'])) ? 'checked' : '';
            ?>
            <label style="margin-right:8px"><input type="checkbox" name="hobi[]" value="<?php echo e($h); ?>" <?php echo $checked; ?>> <?php echo e($h); ?></label>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="4"><?php echo e($_POST['alamat'] ?? '') ?></textarea>
        </div>

        <div class="actions">
            <input type="submit" name="submit_bio" value="Kirim">
            <input type="reset" value="Reset">
        </div>
    </form>

    <?php if(isset($_POST['submit_bio'])): 
        // Ambil & sanitize
        $nama   = e($_POST['nama'] ?? '');
        $nim    = e($_POST['nim'] ?? '');
        $prodi  = e($_POST['prodi'] ?? '');
        $jk     = e($_POST['jk'] ?? '');
        $hobi   = [];
        if (!empty($_POST['hobi']) && is_array($_POST['hobi'])) {
            foreach($_POST['hobi'] as $hh) $hobi[] = e($hh);
        }
        $hobi_text = count($hobi) ? implode(', ', $hobi) : '-';
        $alamat = nl2br(e($_POST['alamat'] ?? ''));
    ?>
        <h2>Hasil Biodata</h2>
        <table>
            <tr><th>Nama Lengkap</th><td><?php echo $nama; ?></td></tr>
            <tr><th>NIM</th><td><?php echo $nim; ?></td></tr>
            <tr><th>Program Studi</th><td><?php echo $prodi; ?></td></tr>
            <tr><th>Jenis Kelamin</th><td><?php echo $jk ?: '-'; ?></td></tr>
            <tr><th>Hobi</th><td><?php echo e($hobi_text); ?></td></tr>
            <tr><th>Alamat</th><td><?php echo $alamat; ?></td></tr>
        </table>
    <?php endif; ?>

    <hr style="margin:20px 0;">

    <h2>Form Pencarian</h2>
    <p class="muted">Form pencarian menggunakan <strong>GET</strong>. Jika diisi, akan menampilkan pesan pencarian.</p>

    <!-- FORM PENCARIAN (GET) -->
    <form method="get" action="<?php echo e($_SERVER['PHP_SELF']); ?>">
        <div class="row">
            <label for="keyword">Kata kunci</label>
            <input id="keyword" name="keyword" type="text" value="<?php echo e($_GET['keyword'] ?? '') ?>">
            <input type="submit" value="Cari">
        </div>
    </form>

    <?php if(isset($_GET['keyword']) && trim($_GET['keyword']) !== ''): ?>
        <p><strong>Anda mencari data dengan kata kunci:</strong> <?php echo e($_GET['keyword']); ?></p>
    <?php endif; ?>

</div>
</body>
</html>
