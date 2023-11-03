<?php  
include 'koneksi_novel.php';
# Get All novels function
function get_all_novels($koneksi){
   $sql  = "SELECT * FROM novels ORDER bY id DESC";
   $stmt = $koneksi->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() > 0) {
   	  $novels = $stmt->fetchAll();
   }else {
      $novels = 0;
   }

   return $novels;
}



# Get  novel by ID function
function get_novel($koneksi, $id){
   $sql  = "SELECT * FROM novels WHERE id=?";
   $stmt = $koneksi->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
   	  $novel = $stmt->fetch();
   }else {
      $novel = 0;
   }

   return $novel;
}


# Search novels function
function search_novels($koneksi, $key){
   # creating simple search algorithm :) 
   $key = "%{$key}%";

   $sql  = "SELECT * FROM novels 
            WHERE title LIKE ?";
   $stmt = $koneksi->prepare($sql);
   $stmt->execute([$key, $key]);

   if ($stmt->rowCount() > 0) {
        $novels = $stmt->fetchAll();
   }else {
      $novels = 0;
   }

   return $novels;
}

# get novels by category
function get_novels_by_category($koneksi, $id){
   $sql  = "SELECT * FROM novels WHERE category_id=?";
   $stmt = $koneksi->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
        $novels = $stmt->fetchAll();
   }else {
      $novels = 0;
   }

   return $novels;
}


# get novels by author
// function get_novels_by_author($koneksi, $id){
//    $sql  = "SELECT * FROM novels WHERE author_id=?";
//    $stmt = $koneksi->prepare($sql);
//    $stmt->execute([$id]);

//    if ($stmt->rowCount() > 0) {
//         $novels = $stmt->fetchAll();
//    }else {
//       $novels = 0;
//    }

//    return $novels;
// }