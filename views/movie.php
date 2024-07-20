<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Movie Search Results</h1>
        <a href="index.php">Back to Search</a>

        <?php if ($movie && isset($movie['Title'])): ?>
            <div class="card">
                <h2><?php echo $movie['Title']; ?></h2>
                <h4><?php echo $movie['Year']; ?></h4>
                <ul>
                    <li><strong>Rated:</strong> <?php echo $movie['Rated']; ?></li>
                    <li><strong>Released:</strong> <?php echo $movie['Released']; ?></li>
                    <li><strong>Runtime:</strong> <?php echo $movie['Runtime']; ?></li>
                    <li><strong>Genre:</strong> <?php echo $movie['Genre']; ?></li>
                    <li><strong>Director:</strong> <?php echo $movie['Director']; ?></li>
                    <li><strong>Writer:</strong> <?php echo $movie['Writer']; ?></li>
                    <li><strong>Actors:</strong> <?php echo $movie['Actors']; ?></li>
                    <li><strong>Plot:</strong> <?php echo $movie['Plot']; ?></li>
                    <li><strong>Language:</strong> <?php echo $movie['Language']; ?></li>
                    <li><strong>Country:</strong> <?php echo $movie['Country']; ?></li>
                    <li><strong>Awards:</strong> <?php echo $movie['Awards']; ?></li>
                    <li><strong>Poster:</strong> <img src="<?php echo $movie['Poster']; ?>" alt="Poster"></li>
                </ul>
            </div>
            <div class="card">
                <h3>Add a Review</h3>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST" action="index.php?action=addReview">
                        <input type="hidden" name="movie_id" value="<?php echo $movie['imdbID']; ?>">
                        <input type="hidden" name="movie_title" value="<?php echo $movie['Title']; ?>">
                        <textarea name="review_text" placeholder="Enter your review" required></textarea>
                        <label for="stars">Stars:</label>
                        <select name="stars" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button type="submit">Submit Review</button>
                    </form>
                    <form method="POST" action="index.php?action=generateAIReview">
                          <input type="hidden" name="movie_id" value="<?php echo $movie['imdbID']; ?>">
                        <input type="hidden" name="movie_title" value="<?php echo $movie['Title']; ?>">
                        <button type="submit">Let AI Generate Review</button>
                    </form>
                <?php else: ?>
                    <p>Please <a href="index.php?action=login&redirect=<?php echo urlencode("index.php?search=" . urlencode($movie['Title'])); ?>">login</a> to add a review.</p>
                <?php endif; ?>
            </div>
            <div class="card">
                <h3>Reviews</h3>
                <?php if ($reviews): ?>
                    <ul>
                        <?php foreach ($reviews as $review): ?>
                            <li><?php echo htmlspecialchars($review['review']); ?> (<?php echo $review['stars']; ?> stars) <br><small>by <?php echo $review['name']; ?> on <?php echo $review['created_at']; ?></small></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No reviews yet.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="alert">No movie found.</div>
        <?php endif; ?>
    </div>
</body>
</html>
