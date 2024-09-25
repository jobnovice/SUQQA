<?php

declare(strict_types=1);

function check_profile_errors()
{
    if (isset($_SESSION['errors_profile'])) {
        $errors = $_SESSION['errors_profile'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION['errors_profile']);
    } else if (isset($_GET["update"]) && $_GET["update"] === "success") {
        echo  '<script>alertz();</script>';
    }
}
?>
<link rel="stylesheet" href="toast.css">

<div class="toast">
    <div class="toast-content">
        <i class="fas fa-solid fa-check check"></i>
        <div class="message">
            <span class="text text-1" style="display: none;">Success</span>
            <span class="text text-2" style="display: none;">Your changes have been saved</span>
        </div>
    </div>
    <i class="fa-solid fa-xmark close"></i>
    <div class="progress"></div>
</div>



<script>


document.addEventListener("DOMContentLoaded", function() {
    if (typeof displayToast !== 'undefined' && displayToast) {
        alertz();
    }
});

function alertz() {
    const toast = document.querySelector(".toast");
    const closeIcon = document.querySelector(".close");
    const progress = document.querySelector(".progress");

    const text1 = document.querySelector(".text-1");
    const text2 = document.querySelector(".text-2");

    let timer1, timer2;

    toast.classList.add("active");
    progress.classList.add("active");

    text1.style.display = "block"; // Show the first text span
    text2.style.display = "block"; // Show the second text span

    timer1 = setTimeout(() => {
        toast.classList.remove("active");
    }, 5000); // 1s = 1000 milliseconds

    timer2 = setTimeout(() => {
        progress.classList.remove("active");
    }, 5300);

    closeIcon.addEventListener("click", () => {
        toast.classList.remove("active");

        setTimeout(() => {
            progress.classList.remove("active");
        }, 300);

        clearTimeout(timer1);
        clearTimeout(timer2);
    });
}
</script>
