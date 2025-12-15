
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Work in Progress</title>
<style>
    body {
        font-family: "Segoe UI", Arial, sans-serif;
        background: #0d1117;
        color: #e6edf3;
        text-align: center;
        padding: 60px 20px;
    }

    h1 {
        font-size: 2.2em;
        margin-bottom: 40px;
        color: #90ee90;
        text-shadow: 0 0 10px rgba(144, 238, 144, 0.7);
    }

    /* Spinner container */
    .spinner {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 10px solid rgba(144, 238, 144, 0.2); /* light green transparent */
        border-top: 10px solid #90ee90; /* brighter green */
        animation: spin 1.2s linear infinite, glow 2s ease-in-out infinite;
        margin: 0 auto 25px;
    }

    /* Rotation animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Subtle glowing effect */
    @keyframes glow {
        0%, 100% { box-shadow: 0 0 10px rgba(144, 238, 144, 0.6); }
        50% { box-shadow: 0 0 25px rgba(144, 238, 144, 0.9); }
    }

    .status {
        font-size: 1.3em;
        color: #90ee90;
        letter-spacing: 1px;
        animation: pulseText 2s ease-in-out infinite;
    }

    /* Text pulsing effect */
    @keyframes pulseText {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }
</style>
</head>
<body>

    <h1>🚧 Work in Progress 🚧</h1>
    <div class="spinner"></div>
    <div class="status">Loading... Please wait</div>

</body>
</html>
