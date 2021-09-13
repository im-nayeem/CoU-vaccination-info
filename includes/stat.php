
    <?php 
          
          $conn=getDB();

    /**function get number of element in an entity or get number of element based on entty */
          function getNum($sql)
          {
              global $conn;
              $result=mysqli_query($conn,$sql);
              return mysqli_fetch_array($result)[0];
          }

     //----total students and how many are vaccinated---//
          $total=getNum("SELECT count(*) FROM student;");

          $vaccinated=getNum("SELECT count('vaccinated') FROM student where vaccinated='Yes';");

          $v_percent=0;
          if($total!=0)
            $v_percent=round(($vaccinated*1.0/$total)*100,1);
          
  //----how many students taken first and second dose----//
          $first_dose=getNum("SELECT count('first_dose') FROM vaccination_info where first_dose='Yes';");

          $second_dose=getNum("SELECT count('second_dose') FROM vaccination_info where second_dose='Yes';");

          if($total!=0)
          {
              $first_dose = round(($first_dose*1.0/$total)*100,1);
              $second_dose = round(($second_dose*1.0/$total)*100,1);
          }

      //-----------side effects-------------//

        $total_effect=getNum("SELECT count(*) FROM side_effect where headache='Yes' 
        OR fever='Yes' OR vomitting='Yes' OR
         NOT ( other_effect='' OR other_effect='No' OR other_effect='Nothing');");

          $headache=getNum("SELECT count('headache') FROM side_effect where headache='Yes';");

          $fever=getNum("SELECT count('fever') FROM side_effect where fever='Yes';");

          $vomitting=getNum("SELECT count('vomitting') FROM side_effect where vomitting='Yes';");

          $other_effect=getNum("SELECT count('other_effect') FROM side_effect where NOT ( other_effect='' OR other_effect='No' OR other_effect='Nothing');");

          if($vaccinated!=0)
          {
            $total_effect = round(($total_effect*1.0/$vaccinated)*100,1);
              $fever = round(($fever*1.0/$vaccinated)*100,1);
              $headache = round(($headache*1.0/$vaccinated)*100,1);
              $vomitting = round(($vomitting*1.0/$vaccinated)*100,1);
              $other_effect = round(($other_effect*1.0/$vaccinated)*100,1);

          }
          
        
        ?>
<div class="stat">
    <strong>Vaccinated: </strong>
      <p>Total <?=$total;?> students have registered. Among them <?=$vaccinated;?> students are vaccinated.</p>
    <br>
    <?php if($total!=0):?>
        <div class="total shape">
                <div class="shape done"  style="height:24px;
                width:<?=$v_percent;?>%">
                     <?=$v_percent;?>%
                </div>
          </div>
          <h5><?=$v_percent;?>% students are vaccinated.</h5>
     <?php endif;?>
          
</div>

<div class="stat">
<strong>Dose: </strong>
    <p>
        <?=$first_dose;?>% students have taken first dose and <?=$second_dose;?>% students have taken second dose from all the students.
    </p>

    <div class="dose">
        <div class="circle left">
            <div class="filled" style="width:<?=$first_dose;?>%">
                <div class="text">
                    <?=$first_dose;?>%
                </div>
            </div>
            <div class="unfilled" style="width:<?=(100-$first_dose);?>%"></div>
        </div>

        <div class="circle right_circle">
            <div class="filled" style="width:<?=$second_dose;?>%">
                <div class="text">
                    <?=$second_dose;?>%
                </div>
            </div>
            <div class="unfilled" style="width:<?=(100-$second_dose);?>%"></div>
        </div>
    </div>

</div>
<!-- <div class="space">  
    </div> -->
    <div class="dose">
        <div class="left">
            Taken First Dose
        </div>
        <div class="right">
            Taken Second Dose
        </div>
    </div>
<div class="space" style="height:25px;"></div>

<div class="stat">
<strong>Side Effect After Vaccination: </strong>
<p>
        Among <?=$vaccinated;?> vaccinated students <?=$total_effect?>% students have encountered side effects after taking vaccine. Among them <?=$fever;?>% students had fever, <?=$headache;?>% students had headache,<?=$vomitting;?>% students faced vomiting and <?=$other_effect;?>% students faced other effects after vaccination.
    </p>
 
<div class="effects">

        <div class="circle left">
            <div class="filled" style="width:<?=$fever;?>%">
                <div class="text">
                    <?=$fever;?>%
                </div>
            </div>
            <div class="unfilled" style="width:<?=100-$fever;?>%"></div>
        </div>

        <div class="circle left">
            <div class="filled" style="width:<?=$headache;?>%">
                <div class="text">
                    <?=$headache;?>%
                </div>
            </div>
            <div class="unfilled" style="width:<?=100-$headache;?>%"></div>
        </div>

        <div class="circle left">
            <div class="filled" style="width:<?=$vomitting;?>%">
                <div class="text">
                    <?=$vomitting;?>%
                </div>
            </div>
            <div class="unfilled" style="width:<?=100-$vomitting;?>%"></div>
        </div>

        <div class="circle left">
            <div class="filled" style="width:<?=$other_effect;?>%">
                <div class="text">
                    <?=$other_effect;?>%
                </div>
            </div>
            <div class="unfilled" style="width:<?=100-$other_effect;?>%"></div>
        </div>

</div>

    <div class="effects">
        <div class="txt">
            Fever
        </div>
        <div class="txt">
            Headache
        </div>
        <div class="txt">
            Vomitting
        </div>
        <div class="txt">
            Other Effects
        </div>
    </div>
<div class="space" style="height:25px;"></div>
</div>