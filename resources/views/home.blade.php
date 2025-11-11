<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Biodata Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-2xl">
    <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Form Biodata Mahasiswa</h2>

    <!-- FORM -->
    <form action="/submit" method="POST" class="space-y-5">
      @csrf

      <!-- Nama -->
      <div>
        <label class="block font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Masukkan nama lengkap"
          class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
      </div>

      <!-- NIM -->
      <div>
        <label class="block font-medium text-gray-700">NIM</label>
        <input type="text" name="nim" placeholder="Masukkan NIM"
          class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
      </div>

      <!-- Program Studi -->
      <div>
        <label class="block font-medium text-gray-700">Program Studi</label>
        <select name="prodi"
          class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
          <option value="">-- Pilih Program Studi --</option>
          <option value="TI">Teknik Informatika</option>
          <option value="SI">Sistem Informasi</option>
          <option value="MI">Manajemen Informatika</option>
        </select>
      </div>

      <!-- Jenis Kelamin -->
      <div>
        <label class="block font-medium text-gray-700">Jenis Kelamin</label>
        <div class="flex items-center gap-4 mt-2">
          <label><input type="radio" name="gender" value="Laki-laki" class="mr-1"> Laki-laki</label>
          <label><input type="radio" name="gender" value="Perempuan" class="mr-1"> Perempuan</label>
        </div>
      </div>

      <!-- Hobi -->
      <div>
        <label class="block font-medium text-gray-700">Hobi</label>
        <div class="flex flex-wrap gap-4 mt-2">
          <label><input type="checkbox" name="hobi[]" value="Membaca" class="mr-1"> Membaca</label>
          <label><input type="checkbox" name="hobi[]" value="Olahraga" class="mr-1"> Olahraga</label>
          <label><input type="checkbox" name="hobi[]" value="Musik" class="mr-1"> Musik</label>
          <label><input type="checkbox" name="hobi[]" value="Gaming" class="mr-1"> Gaming</label>
          <label><input type="checkbox" name="hobi[]" value="Jalan-jalan" class="mr-1"> Jalan-jalan</label>
        </div>
      </div>

      <!-- Alamat -->
      <div>
        <label class="block font-medium text-gray-700">Alamat</label>
        <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
          class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none"></textarea>
      </div>

      <!-- Tombol -->
      <div class="flex justify-end gap-3 mt-6">
        <button type="reset"
          class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Reset</button>
        <button type="submit"
          class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Submit</button>
      </div>
    </form>

    <!-- TEMPAT MENAMPILKAN DATA -->
    <div id="output" class="mt-6 hidden bg-blue-50 border border-blue-200 p-4 rounded-lg">
      <h3 class="text-lg font-semibold text-blue-700 mb-2">Data Mahasiswa:</h3>
      <div id="result"></div>
    </div>
  </div>

  <script>
    // Preview Data tanpa refresh
    const form = document.querySelector("form");
    const output = document.getElementById("output");
    const result = document.getElementById("result");

    form.addEventListener("submit", (e) => {
      e.preventDefault();

      const data = new FormData(form);
      let hobi = data.getAll("hobi[]").join(", ");

      result.innerHTML = `
        <p><strong>Nama:</strong> ${data.get("nama")}</p>
        <p><strong>NIM:</strong> ${data.get("nim")}</p>
        <p><strong>Prodi:</strong> ${data.get("prodi")}</p>
        <p><strong>Jenis Kelamin:</strong> ${data.get("gender")}</p>
        <p><strong>Hobi:</strong> ${hobi}</p>
        <p><strong>Alamat:</strong> ${data.get("alamat")}</p>
      `;

      output.classList.remove("hidden");
    });
  </script>
</body>
</html>
