<html>

<head>
   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <link rel="stylesheet" href="css/mystyle.css">
</head>

<body>
   <div class="container col-md-8 mt-3">
      <table class="table table-primary text-center">
         <tr>
            <th colspan=5 class="text text-danger h1 inhoa">Book List</th>
         </tr>
         <tr>
            <th class="gachchan">Book Title</th>
            <th>Book Price</th>
            <th>Book Quantity</th>
            <th>Total Price</th>
            <th>Book Cover</th>
         </tr>
         <?php
         foreach ($books as $book) {
         ?>
         <tr>
            <td>
               <a href="index.php?title=<?= $book->title ?>">
                  <?php echo $book->title; ?>
               </a>
            </td>
            <td class="innghieng"><?= $book->price ?> USD</td>
            <td><?= $book->quantity ?></td>
            <td>
               <?php
                  $price = $book->price;
                  $quantity = $book->quantity;
                  $total = $price * $quantity;
                  echo $total . " USD";
                  ?>
            </td>
            <td>
               <a href="index.php?title=<?= $book->title ?>">
                  <img src="<?= $book->cover ?>" width="100" height="100">
               </a>
            </td>
         </tr>
         <?php
         }
         ?>
      </table>
   </div>
</body>

</html>