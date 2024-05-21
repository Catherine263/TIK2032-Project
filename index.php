<?php
// Koneksi Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// bagian mengambil ID blog dari parameter URL
$blogId = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name ="author" content="Catherine Assa">
        <meta name = "description" content="Catherine Contact">
        <title>
            Contact | Catherine Personal Homepage
        </title>
        <link rel = "icon" href="Contact.png" type = "image/x-icon">
        <link rel="stylesheet" href="style.css">
        <!-- link untuk icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <!---bagian menu-->
    <nav>
        <div class="wrapper">
            <div class="logo">
                <a href="index.html" target="Home">CatherineHomepage</a>
            </div>
            <i class="fa-solid fa-bars" id="sidebutton"></i>
            <ul class="menu">
                <li><a href="index.html" target="Home">Home</a></li>
                <li><a href="gallery.html" target="Gallery">Gallery</a></li>
                <li><a href="blog.html" target="Blog">Blog</a></li>
                <li><a href="contact.html" target="Contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <?php if ($blogId > 0): ?>
        <!-- bagian tombol kembali -->
        <a href="index.php" class="back-button" title="Back"><i class="fa-solid fa-arrow-left" id="backbutton"></i></a>
    <?php endif; ?>

    <!---bagian blog--->
    <section class="blog" id="blog">
        <div class="blog-text">
            <?php
            if ($blogId > 0) {
                $sql = "SELECT * FROM posts_blog WHERE id = $blogId";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<h2>" . htmlspecialchars($row["judul"]) . "</h2>";
                        echo "<p>Tanggal Upload: " . htmlspecialchars($row["tgl_up"]) . "</p>";
                        echo "<img src='" . htmlspecialchars($row["gambar"]) . "' alt=''>";
                        echo "<p>" . nl2br(htmlspecialchars($row["isi_blog"])) . "</p>";
                    }
                } else {
                    echo "Blog tidak ditemukan.";
                }
            } else {
                // bagian ringkasan blog
                echo "<h2>My Blog's</h2>";

                $sql = "SELECT id, gambar, judul, SUBSTRING(isi_blog, 1, 200) as ringkasan, tgl_up FROM posts_blog";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='blog-item'>";
                        echo "<h3>" . htmlspecialchars($row["judul"]) . "</h3>";
                        echo "<p>Tanggal Upload: " . htmlspecialchars($row["tgl_up"]) . "</p>";
                        echo "<img src='" . htmlspecialchars($row["gambar"]) . "' alt='" . htmlspecialchars($row["judul"]) . "'>";
                        echo "<p>" . htmlspecialchars($row["ringkasan"]) . "...</p>";
                        echo "<a href='index.php?id=" . $row["id"] . "'>Show All</a>";
                        echo "</div>";
                    }
                } else {
                    echo "Tidak ada blog tersedia.";
                }
            }
            ?>
        </div>
    </section>
</body>
</html>

<?php
$conn->close();
?>
