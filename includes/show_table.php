<?php if(!empty($arr)):?>
  <p>[Total:<?=sizeof($arr);?>](Click on any data to get details)</p>
  <table>
     <tr>
        <?php foreach($arr[0] as $key=>$value):?>
			<?php if($key=='email')continue;?> 
          <th><?=$entity[$key]?></th>
        <?php endforeach;?>
      </tr>

    <?php foreach($arr as $data):?>
      <tr>
      <?php foreach($data as $key=>$value):?>
		<?php if($key=='email')continue;?> 
          <td><a href="view.php?entty=<?=$key?>&value=<?=$value?>"><?=$value?></a></td>
        <?php endforeach; ?>
	  </tr>

      <?php endforeach;?>
  </table>
  <?php endif;?>