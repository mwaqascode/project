<?php
// require_once 'partials/connect.php';
// $dbobj = new Database();
// var_dump($dbobj);


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ad code</title>
  <!-- bootsrap css  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- style css  -->
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>


  <h1 class="bg-dark text-light text-center py-2">PHP ADVANCE CRUD</h1>

  
  
  <div class="container ">
    <div class="displaymessage bg-dark text-light text-center mb-3 "></div>

    <!-- modal form  -->
    <?php include 'form.php'; ?>

    <!-- input search and buttton  -->
    <div class="row mb-3">
      <div class="col-10">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark">
              <i class="fas fa-search"></i>

            </span>


          </div>
          <input type="text" class="form-control" placeholder="Search user..."  id="searchuser">

        </div>

      </div>

      <div class="col-2">
        <button class="btn btn-dark " type="button" data-toggle="modal" data-target="#usermodal" id="adduserbtn">Add new user</button>
      </div>

    </div>

    <!-- table  -->
    <?php include 'tableData.php';   ?>
    <?php include 'profile.php';   ?>
    <!-- pagination  -->
    <nav aria-label="Page navigation example" id="pagination">
      <!-- <ul class="pagination justify-content-center">
        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul> -->
    </nav>
    <input type="hidden" value="1" name="currentpage" id="currentpage">



  </div>




  <!-- jquary cdm  -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- boost js -->
   <!-- Yeh Wali na use karo ok ab sai hogia kya<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  <!-- js file -->
  <script src="js/script.js"></script>

</body>

</html>