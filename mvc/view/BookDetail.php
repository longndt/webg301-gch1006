<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
   <div class="container text-center mt-3 col-md-8">
      <div class="row">
         <div class="col">
            <img class="img-thumbnail" src="<?= $book->cover ?>" width="250" height="250">
         </div>
         <div class="col">
            <table class="table table-success">
               <tr>
                  <th>Title</th>
                  <td><?php echo $book->title; ?></td>
               </tr>
               <tr>
                  <th>Price</th>
                  <td><?= $book->price ?> $</td>
               </tr>
               <tr>
                  <th>Quantity</th>
                  <td><?= $book->quantity ?></td>
               </tr>
               <tr>
                  <th>Year</th>
                  <td><?= $book->year ?></td>
               </tr>
               <tr>
                  <th>Author</th>
                  <td><?= $book->author ?></td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</body>

</html>