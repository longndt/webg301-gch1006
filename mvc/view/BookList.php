<table border="1">
   <tr>
      <th>Book Title</th>
      <th>Book Price</th>
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
      <td><?= $book->price ?> $</td>
      <td>
         <img src="<?= $book->cover ?>" width="100" height="100">
      </td>
   </tr>
   <?php
   }
   ?>
</table>