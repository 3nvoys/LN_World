<?php  

# Get all Categories function
function get_all_categories($koneksi){
   $sql  = "SELECT * FROM categories";
   $stmt = $koneksi->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() > 0) {
   	  $categories = $stmt->fetchAll();
   }else {
      $categories = 0;
   }

   return $categories;
}


# Get category by ID
function get_category($koneksi, $id){
   $sql  = "SELECT * FROM categories WHERE id=?";
   $stmt = $koneksi->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
   	  $category = $stmt->fetch();
   }else {
      $category = 0;
   }

   return $category;
}