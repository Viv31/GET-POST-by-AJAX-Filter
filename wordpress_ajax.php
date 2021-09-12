<?php
/*
*Template Name:Wordpress Ajax 
*/
get_header();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>All Posts</h2>
  <div class="col-md-10 mx-auto">
  	<div class="form-group mb-2">
  		<input type="text" name="search" id="search" class="form-control">
  		<select class="form-control" name="categoryName" id="categoryName">
  			<option value="first">First</option>
  			<option value="second">Second</option>
  			
  		</select>
  		<button type="submit" class="btn btn-primary" id="search_data">Search</button>
  </div>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Sno</th>
        <th>Post Title</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody class="post_resp">
    	<?php
    global $post;
 
    $myposts = get_posts( array(
        'posts_per_page' => 5,
        'order'=>'ASC'

        
    ) );
    
 
    if ( $myposts ) {
    	$sno=1;
        foreach ( $myposts as $post ) : 
            setup_postdata( $post ); ?>
            <tr>
            	<td><?php echo $sno;  ?></td>
            	<td>
            		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            	</td>
            	<td>
            		<?php the_content(); ?>
            	</td>

	            </tr>
        <?php
        $sno++;
        endforeach;
        wp_reset_postdata();
    }
    ?>
    		
    		
      
    </tbody>
  </table>
</div>

</body>
</html>


<?php get_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var ajax_url = "<?= admin_url('admin-ajax.php'); ?>";
		jQuery('#search_data').click(function(){
			var selected_letter = jQuery('#search').val();
			var categoryName = jQuery('#categoryName').val();
			var data = {
        'action':'GetPost_forAjax',//function name which is created by us in function.php
        "selected_letter":selected_letter,
        "categoryName":categoryName 
    };
    jQuery.ajax({
        url:ajax_url,
         method:'POST',
                data:data,
                success:function(res){
                  console.log(res);
                  //alert("Success Res"+res);
                  jQuery('.post_resp').html(res);//getting response


                }

      });

		});
		
	});
</script>
<script type="text/javascript">
  /*jQuery(document).ready(function(){
    
    jQuery('#selected_letter').keyup(function(){
     
      var selected_letter = jQuery('#selected_letter').val();
      console.log("selected_letter",selected_letter);
      var data = {
        'action':'get_school_directory_by_first_letter',
        "selected_letter":selected_letter };
      
      

    });
    
  });*/
</script>