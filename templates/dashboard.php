 <main>
     <!-- General transaction feedback -->
     <?php if (isset($transactionResultState)) : ?>
         <div class="<?= $transactionResultState['state'] ?> col-100">
             <?= $transactionResultState['message'] ?>
         </div>
     <?php endif ?>

     <!-- Blogpost form -->
     <?php require_once('partials/addBlogpost.php'); ?>

     <!-- Category form -->
     <?php require_once('partials/addCategory.php'); ?>
 </main>