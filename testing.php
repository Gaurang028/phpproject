<form id="loginForm" action="login.php" method="POST">
    <input type="email" name="email" placeholder="Enter Email" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit">Login</button>
</form>

<p id="message"></p>

<script>
document.getElementById("loginForm").addEventListener("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({
            email: "johndoe@example.com",
            password: "mypassword",
        }),
    })
    .then(response => response.json()) // Ensure JSON parsing
    .then(data => console.log(data))
    .catch(error => console.error("Error:", error));
});
</script>
