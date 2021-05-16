<?php
$date_in = isset($_POST['date_in']) ? $_POST['date_in'] : date('Y-m-d');
$date_out = isset($_POST['date_out']) ? $_POST['date_out'] : date('Y-m-d',strtotime(date('Y-m-d').' + 3 days'));
?>

<header>
    <!--  logo    -->
    <div class="logo">
        
      <a href="Homepage.php"><img src="images/logo.png"></a>
    <h1>HOTEL ANNAPURNA</h1>
    </div>

    <!--  Navigation    -->

    <nav class="active">
      <ul>
        <li><a href="index.php?page=list">Accomodation</a></li>
        <li><a href="DINNING.html">Restaurant</a></li>
        <li><a href="..">Happenings</a></li>
        <li><a href="..">Activities</a></li>  
      </ul>
    </nav>
  </header>

<section class="page-section bg-dark">
		
		<div class="container">	
				<div class="col-lg-12">	
						<div class="card">
							<div class="card-body">	
									<form action="index.php?page=list" id="filter" method="POST">
			        					<div class="row">
			        						<div class="col-md-3">
			        							<label for="">Check-in Date</label>
			        							<input type="text" class="form-control datepicker" name="date_in" autocomplete="off" value="<?php echo isset($date_in) ? date("Y-m-d",strtotime($date_in)) : "" ?>">
			        						</div>
			        						<div class="col-md-3">
			        							<label for="">Check-out Date</label>
			        							<input type="text" class="form-control datepicker" name="date_out" autocomplete="off" value="<?php echo isset($date_out) ? date("Y-m-d",strtotime($date_out)) : "" ?>">
			        						</div>
			        						<div class="col-md-3">
			        							<br>
			        							<button class="btn-btn-block btn-primary mt-3">Check Availability</button>
			        						</div>

			        					</div>
			        				</form>
							</div>
						</div>	

						<hr>	
						
						<?php 
						
						 $cat = $conn->query("SELECT * FROM room_categories");
						$cat_arr = array();
						while($row = $cat->fetch_assoc()){
							$cat_arr[$row['id']] = $row;
						}
						$qry = $conn->query("SELECT distinct(category_id),category_id from rooms where id not in (SELECT room_id from checked where '$date_in' BETWEEN date(date_in) and date(date_out) and '$date_out' BETWEEN date(date_in) and date(date_out)  )");
							while($row= $qry->fetch_assoc()):

						?>
						<div class="card item-rooms mb-3">
							<div class="card-body">
								<div class="row">
								<div class="col-md-5">
									<img src="assets/img/<?php echo $cat_arr[$row['category_id']]['cover_img'] ?>" alt="">
								</div>
								<div class="col-md-5" height="100%">
									<h3><b><?php echo '$ '.number_format($cat_arr[$row['category_id']]['price'],2) ?></b><span> / per day</span></h3>

									<h4><b>
										<?php echo $cat_arr[$row['category_id']]['name'] ?>
									</b></h4>
									<div class="align-self-end mt-5">
										<button class="btn btn-primary  float-right book_now" type="button" data-id="<?php echo $row['category_id'] ?>">Book now</button>
									</div>
								</div>
							</div>

							</div>
						</div>
						<?php endwhile; ?>
				</div>	
		</div>	
</section>
<style type="text/css">
	.item-rooms img {
    width: 23vw;
}
</style>
<script>
	$('.book_now').click(function(){
		uni_modal('Book','admin/book.php?in=<?php echo $date_in ?>&out=<?php echo $date_out ?>&cid='+$(this).attr('data-id'))
	})
</script>