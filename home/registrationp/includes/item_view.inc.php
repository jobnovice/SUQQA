<?php

function  check_item_success()
{
    
    if (isset($_GET['post']) && $_GET['post'] === "success") {
        echo '<script>alertz();</script>'; 
       
    }
}

check_item_success();
?>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f2f2f2;
    overflow: hidden;
}

.toast{
    position: absolute;
    top: 25px;
    right: 10px;
    border-radius: 12px;
    background: #fff;
    padding: 20px 10px 20px 25px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    border-left: 6px solid #0A9055;
    overflow: hidden;
    transform: translateX(calc(100% + 30px));
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
    width: 300px;
    z-index:1000;
}

.toast.active{
    transform: translateX(0%);
}

.toast .toast-content{
    display: flex;
    align-items: center;
}

.toast-content .check{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 35px;
    width: 35px;
    background-color: #0A9055;
    color: #fff;
    font-size: 20px;
    border-radius: 50%;
}

.toast-content .message{
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text{
    font-size: 20px;
    font-weight: 400;;
    color: #666666;
}

.message .text.text-1{
    font-weight: 600;
    color: #333;
}

.toast .close{
    position: absolute;
    top: 10px;
    right: 15px;
    padding: 5px;
    cursor: pointer;
    opacity: 0.7;
}

.toast .close:hover{
    opacity: 1;
}

.toast .progress{
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
    background: #ddd;
}

.toast .progress:before{
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    height: 100%;
    width: 100%;
    background-color: #0A9055;
}

.progress.active:before{
    animation: progress 5s linear forwards;
}

@keyframes progress {
    100%{
        right: 100%;
    }
}

.button{
    padding: 12px 20px;
    font-size: 20px;
    outline: none;
    border: none;
    background-color: #0A9055;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

.button:hover{
    background-color: #0A9055;
}

.toast.active ~ button{
    pointer-events: none;
}
</style>

<div class="toast">
    <div class="toast-content">
        <i class="fas fa-solid fa-check check"></i>
        <div class="message">
            <span class="text text-1" style="display: none;">&nbsp;&nbsp;&nbsp;Success</span>
            <span class="text text-2" style="display: none;">&nbsp;&nbsp;&nbsp;You have succes fully added listing</span>
        </div>
    </div>
    <i class="fa-solid fa-xmark close"></i>
    <div class="progress"></div>
</div>



<script>
// Your JavaScript code
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

