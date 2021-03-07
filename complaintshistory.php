<?php
include('header.php');
if($_SESSION["sessid"]=="")
{
  echo '<script>window.location.href="index.php";</script>';
}
?>
<style>
  label{
    display:none !important;
  }
</style>
<link rel="stylesheet" href="css/w3.css">

<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="width:217px; background: #0071ff;    color: white !important;     padding-top: 35px;" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
  <?php
  include('sidebar.php');
  ?>
</div>
<?php
include('datatables.php');
?>
<div class="w3-main" style="margin-left:200px; "><!--  height: 500px !important; -->
<div class="w3-teal" style="background-color: #f79f24!important;">
  <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
  <div class="w3-container">
    <h1 style="margin-left: 33px;color: white;">Complaint History</h1>
  </div>
</div>

<div class="w3-container">
  

      
      <section class="ftco-section bg-light" style="">

      <div class="container">
         <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="table-responsive" style="overflow-x: none !important;padding: 16px;">
                              
                               

                            <?php
                            if($countcomphis>0)
                            {
                              ?>
                              <table class="table table-striped  table-hover" id="dataTables-example">
                                 <thead style="color:black">
                                    <th>Sl.</th>
                                    <th>Complaint No.</th>
                                    <th>Device Name</th>
                                    <th>Complaint</th>
                                    <th>Status</th>
                                    
                                    
                                    
                                  
                                 </thead>
                                 <tbody style="color:white">

                                  <?php
                                  $counterbadd=0;
                                  while($rowcomphis=mysqli_fetch_assoc($rescomphis))
                                  {
                                    $devid=$rowcomphis['deviceid'];
                                    $sqldevid="SELECT * FROM `003_omgss_devices` WHERE `id`='$devid'";
                                    $resdevid=mysqli_query($conn,$sqldevid);
                                    $rowdevid=mysqli_fetch_assoc($resdevid);

                                    $prdiddev=$rowdevid['productid'];

                                    $sqlprdiddev="SELECT * FROM `005_omgss_products` WHERE `id`='$prdiddev'";
                                    $resprdiddev=mysqli_query($conn,$sqlprdiddev);
                                    $rowprdiddev=mysqli_fetch_assoc($resprdiddev);
                                    $counterbadd++;
                                    
									
                                    ?>
                                    <tr <?php if($rowcomphis['status']=="Solved"){ echo 'style="background:green"'; }else{ echo 'style="background:orange"'; } ?>>
                                      <td><?php echo $counterbadd; ?></td>
                                      <td>OMGCOMP<?php echo $rowcomphis['id']; ?></td>
                                      <td><?php echo $rowprdiddev['name']; ?></td>
                                      <td><?php echo $rowcomphis['complaint']; ?></td>
                                      <td><?php echo $rowcomphis['status']; ?></td>
                                     
                                    </tr>
                                    <?php
                                  }
                                  ?>
                                  
                                 </tbody>
                                </table>
                              <?php
                            }
                            else
                            {
                              echo '<p>No Orders Found</p>';
                            }
                            ?>

                                




                  </div>
            <div class="wrapper">

              <div class="row no-gutters">

                <div class="col-md-7 d-flex">
                  <div class="container-fluid">
 
  <div class="row">
    <div class="col-sm-4" ></div>
    <div class="col-sm-4" ></div>
    <div class="col-sm-4"></div>
  </div>
</div>

               
                </div>
                
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </section>

</div>
   
</div>



<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>

<?php 
include('footer.php');
?>