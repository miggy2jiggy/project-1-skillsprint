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
        <h1>Skills Library</h1>
        <p>
            Browse important technical and professional skills connected to each
            technology career path.
        </p>
    </section>

    <div class="skills-library">
        <?php foreach ($careerTracks as $track): ?>
            <article class="skill-group">
                <h2><?php echo $track["title"]; ?></h2>

                <p><?php echo $track["description"]; ?></p>

                <ul class="skill-list">
                    <?php foreach ($track["skills"] as $skill): ?>
                        <li><?php echo $skill; ?></li>
                    <?php endforeach; ?>
                </ul>
            </article>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>