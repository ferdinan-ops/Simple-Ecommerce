<?php
include "koneksi.php";
$products = mysqli_query($koneksi, "SELECT * FROM tbl_produk");
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
   <script src="https://cdn.tailwindcss.com"></script>
   <script src="./script/stylingConfig.js"></script>
   <title>Home</title>
</head>

<body>
   <header class="h-[70px] flex items-center shadow-md">
      <div class="container mx-auto flex items-center justify-between">
         <h1 class="text-lg font-bold text-black-font text-primary">
            Creative Store
         </h1>
         <nav class="flex items-center gap-10 text-[15px] font-medium text-black-font">
            <a href="#" class="hover:text-primary">Home</a>
            <a href="#" class="hover:text-primary">Category</a>
            <a href="#" class="hover:text-primary">Product</a>
         </nav>
         <a href="/ecommerce/dashboard.php" class="bg-secondary text-primary py-2 px-6">
            Go to Dashboard
         </a>
      </div>
   </header>
   <section class="container mx-auto h-60 relative flex items-center">
      <div class="absolute z-0 inset-0">
         <img src="./images/banner.svg" alt="" class="w-full h-full object-cover" />
      </div>
      <div class="relative flex flex-col text-5xl text-white gap-4 ml-24">
         <div class="bg-secondary text-primary py-1 px-2 text-2xl w-fit">
            Special Offers
         </div>
         <span class="font-semibold">Sport Day</span>
         <span class="font-semibold">Super Amazing Discount</span>
      </div>
   </section>
   <section class="py-10 container mx-auto">
      <div class="flex flex-col gap-5">
         <button class="py-3 px-6 bg-primary w-fit font-medium text-white">
            Product Category
         </button>
         <div class="flex gap-6 justify-between">
            <div class="shadow-lg rounded-md flex flex-col font-medium">
               <img src="./images/laptop.png" alt="" />
               <span class="bg-secondary text-primary py-2 text-center">
                  Laptop & PC
               </span>
            </div>
            <div class="shadow-lg rounded-md flex flex-col font-medium">
               <img src="./images/laptop.png" alt="" />
               <span class="bg-secondary text-primary py-2 text-center">
                  Laptop & PC
               </span>
            </div>
            <div class="shadow-lg rounded-md flex flex-col font-medium">
               <img src="./images/laptop.png" alt="" />
               <span class="bg-secondary text-primary py-2 text-center">
                  Laptop & PC
               </span>
            </div>
            <div class="shadow-lg rounded-md flex flex-col font-medium">
               <img src="./images/laptop.png" alt="" />
               <span class="bg-secondary text-primary py-2 text-center">
                  Laptop & PC
               </span>
            </div>
            <div class="shadow-lg rounded-md flex flex-col font-medium">
               <img src="./images/laptop.png" alt="" />
               <span class="bg-secondary text-primary py-2 text-center">
                  Laptop & PC
               </span>
            </div>
            <div class="shadow-lg rounded-md flex flex-col font-medium">
               <img src="./images/laptop.png" alt="" />
               <span class="bg-secondary text-primary py-2 text-center">
                  Laptop & PC
               </span>
            </div>
         </div>
      </div>
   </section>
   <section class="container mx-auto py-10">
      <div class="flex flex-col">
         <h1 class="font-medium text-[32px] text-black-font text-center mb-5">
            All Products
         </h1>
         <div class="flex mx-auto w-6/12 shadow-lg text-sm">
            <input type="text" placeholder="search something..." class="w-full py-[14px] px-4" />
            <button class="bg-primary text-white px-6">Search</button>
         </div>
         <div class="flex flex-wrap mt-[40px] gap-6">
            <?php while ($product = mysqli_fetch_array($products)): ?>
               <div class="p-3 flex flex-col max-w-[261px] gap-3 shadow-lg">
                  <div class="h-[200px] w-full">
                     <img src="./images/<?= $product['img'] ?>" alt="" class="w-full h-full" />
                  </div>
                  <div class="flex flex-col">
                     <div class="flex flex-col">
                        <span class="font-[300] text-xs text-[#9C9C9C]">
                           <?= $product['kategori'] ?>
                        </span>
                        <span>
                           <?= $product['nama'] ?>
                        </span>
                     </div>
                     <p class="font-[300] text-xs mt-1">
                        <?= $product['deskripsi'] ?>
                     </p>
                     <div class="flex justify-between mt-[10px] items-center">
                        <span>Rp.
                           <?= $product['harga'] ?>
                        </span>
                        <button class="text-primary bg-secondary py-1 px-2">Beli</button>
                     </div>
                  </div>
               </div>
            <?php endwhile; ?>
         </div>
      </div>
   </section>
</body>

</html>