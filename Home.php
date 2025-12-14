<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: access-denied.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Enhanced Internal CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #f9f9f9, #e8f5e9);
            color: #333;
            line-height: 1.6;
        }

        header {
            background: linear-gradient(135deg, #4CAF50, #2e7d32);
            color: white;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.25);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header h1 {
            margin: 0;
            font-size: 2.2em;
            letter-spacing: 1px;
            animation: fadeInDown 1s ease;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        hr {
            border: none;
            border-top: 2px solid #ccc;
            margin: 0;
        }

        img {
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            margin-top: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        img:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(0,0,0,0.4);
        }

        main {
            padding: 30px;
            max-width: 900px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            animation: fadeIn 1.2s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        section {
            margin-bottom: 40px;
        }

        h2 {
            color: #4CAF50;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 8px;
            margin-bottom: 20px;
            font-size: 1.6em;
        }

        p {
            font-size: 1.1em;
            text-align: justify;
        }

        nav {
            text-align: center;
            margin: 20px 0;
        }

        nav a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
            margin: 0 12px;
            padding: 8px 12px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        nav a:hover {
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        footer {
            background-color: #222;
            color: #ccc;
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 0.9em;
            box-shadow: 0 -2px 6px rgba(0,0,0,0.2);
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>St. Teresa's School Berhampore</h1> 
    </header>
    <hr>
    <p style="text-align: center;">
        <img src="STS.jpg" alt="St. Teresa's School Berhampore" width="140" height="140">
    </p>

    <nav>
        <a href="About Us.php">About</a>
        <a href="Departments.php">Departments</a>
        <a href="WIP.php">Contact Us</a>
        <a href="LICENSE.php">License</a>
    </nav>

    <main>
        <section>
            <h2>Introduction</h2>
            <p>
                <b>
                 St. Teresa's School, Berhampore, a Catholic English Medium Educational Institution for boys and girls, 
                 owned by Teresian Carmelite Sisters, was established in 2015.
                 It is a minority institution but provision is also made for the admission of children irrespective of caste and creed.
                 The Teresian Carmelites are working in India and abroad through educational centres, 
                 orphanages and other charitable and promotional works.
                </b>
            </p>
        </section>
    </main>

    <footer>
        <p>&copy; 2015 St. Teresa's School. All rights reserved.</p>
    </footer>
</body>
</html>



