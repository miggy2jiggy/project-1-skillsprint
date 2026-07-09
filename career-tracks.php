<?php
/**************************
Technology Career Data Each 
career contains information 
used throughout the website.
 **************************/
?>

<?php include 'includes/data.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>

<main>
    <section class="page-intro">
        <h1>Career Tracks</h1>
        <p>
            Explore five technology career paths and compare the skills,
            difficulty level, and focus area for each one.
        </p>
    </section>

    <div class="card-grid">
        <?php foreach ($careerTracks as $track): ?>
            <article class="career-card">
                <h2><?php echo $track["title"]; ?></h2>

                <p><?php echo $track["description"]; ?></p>

                <p><strong>Difficulty:</strong> <?php echo $track["difficulty"]; ?></p>
                <p><strong>Salary Range:</strong> <?php echo $track["salary"]; ?></p>
                <p><strong>Best For:</strong> <?php echo $track["best_for"]; ?></p>

                <h3>Key Skills</h3>
                <ul>
                    <?php foreach ($track["skills"] as $skill): ?>
                        <li><?php echo $skill; ?></li>
                    <?php endforeach; ?>
                </ul>
            </article>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>