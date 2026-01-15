<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/projectcard.css">
    <title>Landing Screen</title>
</head>

<body class="body">

    

    <div class="bg-container">
        <?php include 'views/components/header.php'; ?>
        <img src="/public/images/bg.png" alt="Background Image" class="bg-image">
    </div>

    <!-- <h1 class = "h1_center">Landing Screen </h1>
    <button onclick="location.href='/views/common/login.html'">Login</button>
    <button onclick="location.href='/views/common/about.html'">About us</button>
    <h2 class = "h2_center">Past Works Here</h2>
    <h2 class = "h2_center">Footer</h2> -->
    <div class="projects">
        <div class="projecttitle">
            <h1>Ongoing Projects</h1>
            <h3>Protect and enhance poverty.</h3>
        </div>
            
        <div class="card-row" style="display:flex; gap:30px;">

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="/public/images/img1.png" alt="Card 1">
                    </div>
                    <div class="flip-card-back">
                        <h2>Volunteer</h2>
                        <p>Join our volunteer programs.</p>
                    </div>
                </div>
            </div>

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="/public/images/img2.png" alt="Card 2">
                    </div>
                    <div class="flip-card-back">
                        <h2>Donate</h2>
                        <p>Support our community efforts.</p>
                    </div>
                </div>
            </div>

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="/public/images/img3.png" alt="Card 3">
                    </div>
                    <div class="flip-card-back">
                        <h2>Projects</h2>
                        <p>See what we’ve accomplished.</p>
                    </div>
                </div>
            </div>

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="/public/images/img4.png" alt="Card 4">
                    </div>
                    <div class="flip-card-back">
                        <h2>Projects</h2>
                        <p>See what we’ve accomplished.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-row" style="display:flex; gap:30px;">

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="/public/images/img5.png" alt="Card 1">
                    </div>
                    <div class="flip-card-back">
                        <h2>Volunteer</h2>
                        <p>Join our volunteer programs.</p>
                    </div>
                </div>
            </div>

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="/public/images/img6.png" alt="Card 2">
                    </div>
                    <div class="flip-card-back">
                        <h2>Donate</h2>
                        <p>Support our community efforts.</p>
                    </div>
                </div>
            </div>

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="/public/images/img7.png" alt="Card 3">
                    </div>
                    <div class="flip-card-back">
                        <h2>Projects</h2>
                        <p>See what we’ve accomplished.</p>
                    </div>
                </div>
            </div>

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="/public/images/img8.png" alt="Card 4">
                    </div>
                    <div class="flip-card-back">
                        <h2>Projects</h2>
                        <p>See what we’ve accomplished.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="footer">
        <?php include 'views/components/footer.php'; ?>
    </div>

</body>
</html>