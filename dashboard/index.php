<?php
include "../koneksi.php";
$products = mysqli_query($koneksi, "SELECT tbl_produk.*, tbl_kategori.nama AS kategori FROM tbl_produk JOIN tbl_kategori ON tbl_produk.id_kategori=tbl_kategori.id");

if (isset($_POST['submit']) || isset($_POST['edit'])) {
   $nama = $_POST['nama'];
   $idKategori = $_POST['idKategori'];
   $harga = $_POST['harga'];
   $deskripsi = $_POST['deskripsi'];
   $img = $_FILES['productImage']['name'];

   if (!empty($img)) {
      $imgName = explode('.', $img); // memisahkan nama file dengan ekstensi yang diupload
      $extension = strtolower(end($imgName));
      $file_tmp = $_FILES['productImage']['tmp_name'];

      $newImgName = time() . '-' . $img; // menggabungkan timestamp dengan nama file sebenarnya
      move_uploaded_file($file_tmp, '../uploads/products/' . $newImgName); // memindah file gambar ke folder gambar

      $query = "";
      if (isset($_POST['submit'])) {
         $query = "INSERT INTO tbl_produk (nama, deskripsi, id_kategori, harga, img) VALUES ('$nama', '$deskripsi', '$idKategori', '$harga', '$newImgName')";
      } elseif (isset($_POST['edit'])) {
         $id = $_POST['id'];
         $query = "UPDATE tbl_produk SET nama='$nama', deskripsi='$deskripsi', id_kategori='$idKategori', harga='$harga', img='$newImgName' WHERE id='$id'";
      }

      $result = mysqli_query($koneksi, $query);
      if ($result)
         header("Location: ./");
   } elseif ($_POST['edit']) {
      $id = $_POST['id'];
      $query = "UPDATE tbl_produk SET nama='$nama', deskripsi='$deskripsi', id_kategori='$idKategori', harga='$harga' WHERE id='$id'";
      $result = mysqli_query($koneksi, $query);
      if ($result)
         header("Location: ./");
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="true" />
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet" />
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
   <script src="https://cdn.tailwindcss.com"></script>
   <script src="../script/stylingConfig.js"></script>
   <title>Dashboard</title>
</head>

<body>
   <header class="h-[70px] flex top-0 items-center border-b border-slate-300 sticky bg-white">
      <div class="px-[70px] w-full flex items-center justify-between">
         <h1 class="text-lg font-bold text-black-font text-primary">
            Creative Store
         </h1>
         <a href="../" class="bg-secondary text-primary py-3 px-6 flex items-center gap-2 hover:bg-primary/20">
            <i class="uil uil-eye text-xl"></i>
            <span>View Site</span>
         </a>
      </div>
   </header>
   <div class="flex">
      <aside class="sticky top-[70px] h-[calc(100vh-70px)] w-fit border-r border-slate-300">
         <div class="flex flex-col gap-4 py-4 px-[54px]">
            <a href="./" class="bg-secondary text-primary flex items-center gap-4 px-4 py-2 rounded-full">
               <i class="uil uil-archive text-xl"></i>
               <span>Product</span>
            </a>
            <a href="./category/"
               class="hover:bg-slate-200 flex text-slate-500 items-center gap-4 px-4 py-2 rounded-full">
               <i class="uil uil-apps text-xl"></i>
               <span>Category</span>
            </a>
         </div>
      </aside>
      <main class="min-h-[calc(100vh-70px] w-full">
         <div class="p-10 pr-[70px] text-black-font">
            <h1 class="text-4xl font-bold mb-10">Data Produk</h1>
            <button
               class="bg-primary text-white rounded-lg px-4 py-2 text-sm transition-all hover:shadow-lg hover:shadow-primary/20"
               id="showModal">
               Tambah Data
            </button>
            <table class="w-full mt-6">
               <thead>
                  <tr class="bg-secondary text-left">
                     <th class="p-2 font-medium">Nama Produk</th>
                     <th class="p-2 font-medium">Deskripsi Produk</th>
                     <th class="p-2 font-medium">Kategori Produk</th>
                     <th class="p-2 font-medium">Harga Produk</th>
                     <th class="p-2 font-medium">Gambar Produk</th>
                     <th class="p-2 font-medium">Aksi</th>
                  </tr>
               </thead>
               <tbody class="text-sm">
                  <?php while ($product = mysqli_fetch_array($products)): ?>
                     <tr class="border-b border-slate-300">
                        <td class="font-300 p-2 w-max">
                           <?= $product["nama"] ?>
                        </td>
                        <td class="font-300 p-2 max-w-[400px] truncate">
                           <?= $product["deskripsi"] ?>
                        </td>
                        <td class="font-300 p-2 w-max">
                           <?= $product["kategori"] ?>
                        </td>
                        <td class="font-300 p-2 w-max">
                           <?="Rp. " . number_format($product["harga"], 0, ',', '.'); ?>
                        </td>
                        <td class="p-2 w-max">
                           <img src="../uploads/products/<?= $product["img"] ?>" class="w-20 h-20 object-cover mx-auto" />
                        </td>
                        <td class="font-300 p-2 w-max text-xs flex gap-2 ">
                           <a href="./?action=edit&id=<?= $product["id"] ?>"
                              class="bg-blue-500 py-1 px-2 rounded text-white hover:bg-blue-600" id="editData">
                              Ubah
                           </a>
                           <a href="delete.php?id=<?= $product["id"] ?>"
                              onclick="return confirm('Yakin ingin menghapus data ini?')"
                              class="bg-red-500 py-1 px-2 rounded text-white hover:bg-red-600">
                              Hapus
                           </a>
                        </td>
                     </tr>
                  <?php endwhile; ?>
               </tbody>
            </table>
         </div>
      </main>
   </div>

   <div class="fixed hidden inset-0 z-50 bg-white/50" id="modal">
      <div
         class="flex flex-col absolute top-1/2 -translate-y-1/2 bg-white shadow-xl left-1/2 -translate-x-1/2 min-w-[500px] rounded-lg">
         <div class="p-4 border-b border-slate-300 flex justify-between items-center">
            <h1 class="text-lg font-semibold">Tambah Data Product</h1>
            <i class="uil uil-times text-xl cursor-pointer" id="closeModal"></i>
         </div>
         <form action="index.php" method="post" class="flex flex-col gap-6 p-4" enctype="multipart/form-data">
            <label class="flex flex-col gap-2">
               <span class="text-sm">Nama Produk</span>
               <input type="text" placeholder="Nama Produk" name="nama"
                  class="py-2 px-4 border rounded text-xs border-slate-300" />
            </label>
            <label class="flex flex-col gap-2">
               <span class="text-sm">Kategori Produk</span>
               <select name="idKategori" class="py-2 px-4 border rounded text-xs border-slate-300">
                  <?php
                  $categories = mysqli_query($koneksi, "SELECT * FROM tbl_kategori");
                  while ($category = mysqli_fetch_array($categories)): ?>
                     <option value="<?= $category["id"] ?>"><?= $category["nama"] ?></option>
                  <?php endwhile; ?>
               </select>
            </label>
            <label class="flex flex-col gap-2">
               <span class="text-sm">Harga Produk</span>
               <input type="number" placeholder="Harga Produk" name="harga"
                  class="py-2 px-4 border rounded text-xs border-slate-300" />
            </label>
            <label class="flex flex-col gap-2">
               <span class="text-sm">Deskripsi Produk</span>
               <textarea placeholder="Deskripsi Produk" height="100" name="deskripsi"
                  class="py-2 px-4 border rounded text-xs border-slate-300 h-28"></textarea>
            </label>
            <label class="flex flex-col gap-2">
               <span class="text-sm">Gambar Produk</span>
               <input type="file" class="text-xs p-2 border rounded border-slate-300" accept="images/*"
                  name="productImage" />
            </label>
            <input type="submit" value="Submit" name="submit" id="btnForm"
               class="bg-primary text-white py-2 px-4 text-sm rounded cursor-pointer" />
         </form>
      </div>
   </div>

   <?php
   if (isset($_GET["action"]) && $_GET["action"] == "edit"):
      $result = mysqli_query($koneksi, "SELECT tbl_produk.*, tbl_kategori.nama AS kategori FROM tbl_produk JOIN tbl_kategori ON tbl_produk.id_kategori=tbl_kategori.id WHERE tbl_produk.id = {$_GET["id"]}");
      $product = mysqli_fetch_array($result);
      ?>
      <div class="fixed inset-0 z-50 bg-white/50" id="modal">
         <div
            class="flex flex-col absolute top-1/2 -translate-y-1/2 bg-white shadow-xl left-1/2 -translate-x-1/2 min-w-[500px] rounded-lg">
            <div class="p-4 border-b border-slate-300 flex justify-between items-center">
               <h1 class="text-lg font-semibold">Ubah Data Product</h1>
               <i class="uil uil-times text-xl cursor-pointer" id="closeModal"></i>
            </div>
            <form action="index.php" method="post" class="flex flex-col gap-6 p-4" enctype="multipart/form-data">
               <input type="hidden" name="id" value="<?= $product["id"] ?>" />
               <label class="flex flex-col gap-2">
                  <span class="text-sm">Nama Produk</span>
                  <input type="text" placeholder="Nama Produk" name="nama" value="<?= $product["nama"] ?>"
                     class="py-2 px-4 border rounded text-xs border-slate-300" />
               </label>
               <label class="flex flex-col gap-2">
                  <span class="text-sm">Kategori Produk</span>
                  <select name="idKategori" class="py-2 px-4 border rounded text-xs border-slate-300">
                     <option value="<?= $product["id_kategori"] ?>"><?= $product["kategori"] ?></option>
                     <?php
                     $categories = mysqli_query($koneksi, "SELECT * FROM tbl_kategori WHERE id != {$product["id_kategori"]}");
                     while ($category = mysqli_fetch_array($categories)): ?>
                        <option value="<?= $category["id"] ?>"><?= $category["nama"] ?></option>
                     <?php endwhile; ?>
                  </select>
               </label>
               <label class="flex flex-col gap-2">
                  <span class="text-sm">Harga Produk</span>
                  <input type="number" placeholder="Harga Produk" name="harga" value="<?= $product["harga"] ?>"
                     class="py-2 px-4 border rounded text-xs border-slate-300" />
               </label>
               <label class="flex flex-col gap-2">
                  <span class="text-sm">Deskripsi Produk</span>
                  <textarea placeholder="Deskripsi Produk" height="100" name="deskripsi"
                     class="py-2 px-4 border rounded text-xs border-slate-300 h-28"><?= $product["deskripsi"] ?></textarea>
               </label>
               <label class="flex flex-col gap-2">
                  <span class="text-sm">Gambar Produk</span>
                  <input type="file" class="text-xs p-2 border rounded border-slate-300" accept="images/*"
                     name="productImage" value="<?= $product["img"] ?>" />
               </label>
               <input type="submit" value="Simpan" name="edit" id="btnForm"
                  class="bg-primary text-white py-2 px-4 text-sm rounded cursor-pointer" />
            </form>
         </div>
      </div>
   <?php endif; ?>

   <script src="../script/dashboard.js"></script>
</body>

</html>