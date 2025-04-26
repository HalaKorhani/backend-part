<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">TITLE</th>
      <th scope="col">Delete</th>
    </tr>
    <?php 
    require_once("../connection.php");
    $sql = "SELECT * FROM quiz";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute();
    $quiz = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    if(!$quiz){
        ?>
        <tr>NOT quiz</tr>
        <?php
    }else{
        foreach($quiz as $q){
              ?>
        <tr>
            <th><?php echo $q["id"] ?></th>
            <th><?php echo $q["title"] ?></th>
            <th><button type="button" class="btn btn-danger">Danger</button>
</th>
        </tr>
        <?php
        }
      
    }
    ?>
  </thead>