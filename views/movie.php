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
        <?php else: ?>
            <div class="alert">No movie found.</div>
        <?php endif; ?>
    </div>
</body>
</html>
