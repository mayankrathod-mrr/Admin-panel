<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Registration Portal</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background-image: url("wall 5.jpg");  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}

.wrapper {
  max-width: 800px;
  border-radius: 20px;
  padding: 40px;
  background: rgba(255, 255, 255, 0.1);
  border: 2px solid rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(55px);
  display: flex;
  flex-direction: column;
  align-items: center;
}

nav ul {
  display: flex;
  justify-content: flex-start;
  list-style: none;
  width: 100%;
}

nav ul li {
  margin-right: 20px;
}

nav ul li a {
  color: #ffffff;
  text-decoration: none;
  font-weight: 600;
}

nav ul li a:hover {
  text-decoration: underline;
}

h2 {
  font-size: 2rem;
  margin-bottom: 25px;
  text-align: center;
  color: #fff;
  letter-spacing: 1px;
}

.container .text {
  text-align: center;
  font-size: 1.5rem;
  font-weight: 600;
  color: #fff;
  margin-bottom: 20px;
}

.content p,
.content ul {
  font-size: 1rem;
  line-height: 1.6;
  color: #fff;
  text-align: justify;
}

.content ul {
  margin: 15px 0;
  padding-left: 20px;
}

.content ul li {
  margin-bottom: 10px;
}

.content ul li strong {
  color: #ffd700;
}

.next-btn {
  display: flex;
  justify-content: flex-end;
  margin-top: 20px;
}

.next-btn .btn {
  background-color: rgb(255, 255, 255, 1);
  color: #271930;
  font-weight: 600;
  padding: 15px 30px;
  border: none;
  border-radius: 40px;
  cursor: pointer;
  transition: all 0.4s ease;
}

.next-btn .btn:hover {
  background-color: rgb(255, 255, 255, 0.5);
  color: #000;
  border: 2px solid rgba(255, 255, 255, 0.5);
}

@media (max-width: 700px) {
  .wrapper {
    width: 100%;
    padding: 20px;
  }

  .container .text {
    font-size: 1.25rem;
  }

  .content p,
  .content ul {
    font-size: 0.9rem;
  }
}
    </style>
</head>
<body>
    <div class="wrapper">
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>

        <h2>Internship Registration Portal</h2>

        <div class="container">
            <div class="text">About the Internship Portal</div>
            <div class="content">
                <p>
                    Welcome to the Internship Management Portal. This platform helps administrators easily create, manage, and organize internship programs. With features like task management, PDF generation, and detailed program customization, managing internship programs is streamlined for a better experience.
                </p>
                <p>Key features of the portal include:</p>
                <ul>
                    <li><strong>Admin Authentication:</strong> Secure login for managing internship programs.</li>
                    <li><strong>Internship Program Creation:</strong> Add new programs with details like title, duration, and collaboration sessions.</li>
                    <li><strong>Task Management:</strong> Manage monthly and weekly tasks using AJAX.</li>
                </ul>
            </div>

            <div class="next-btn">
                <a href="reg.html" class="btn">Next</a>
            </div>
        </div>
    </div>
</body>
</html>
