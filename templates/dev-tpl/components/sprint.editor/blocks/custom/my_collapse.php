<div class="content-block content-collapse">
  <?php
    foreach($block['rows'] as $row){
      tpl('components/accordeon', [
        'title' => $row['title'],
        'text' => '<div class="content-text accordeon-content" slot="content">'.$row['text'].'</div>'
      ]);
    }
  ?>
</div>