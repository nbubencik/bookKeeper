<?php   										// Opening PHP tag
	
	// Include the database connection script
	require 'includes/database-connection.php';

	$book_id = $_GET['bookID'];
  $book_title = $_GET['title'];


	function get_reviews(PDO $pdo, string $id){
		$sql = " SELECT r.rating, r.review_text, u.first_name
				FROM reviews as r JOIN users as u ON r.userID = u.userID
				WHERE bookID= :id;";

		$review = pdo($pdo, $sql, ['id' => $id])->fetchAll();	

		return $review;
	}

	$all_reviews = get_reviews($pdo, $book_id);

// Closing PHP tag  ?> 

<!DOCTYPE>
<html>

	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<title>book Inventory</title>
  		<link rel="stylesheet" href="css/style.css">
  		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
	</head>

	<body>

		<header>
			<div class="header-left">
				<div class="logo">
					<img src="imgs/book-logo.jpg" alt="Book Inventory Logo">
      			</div>

	      		<nav>
	      			<ul>
	      				<li><a href="index.php">Book Catalog</a></li>
	      				<li><a href="about.php">About</a></li>
			        </ul>
			    </nav>
		   	</div>

		    <div class="header-right">
		    	<ul>
		    		<li><a href="list.php">Lists</a></li>
		    	</ul>
		    </div>
		</header>

		<main>
		
			<div class="book-details-container">
				
				<div class="book-details">

					<!-- Display title of book -->
			        <h1><?= $book_title ?></h1>

			        <hr />

			        <h3>Reviews</h3>

			        <!-- Display all reviews -->
			        <ul>
			        	<?php foreach ($all_reviews as $review): ?>
			            	<li>
			            		<strong>Rating:</strong> <?= $review['rating'] ?><br>
			            		<strong>Review:</strong> <?= $review['review_text'] ?><br>
			            		<strong>User:</strong> <?= $review['first_name'] ?>
			            	</li>
			            <?php endforeach; ?>
			        </ul>
			        
			    </div>
			</div>
		</main>

	</body>
</html>
