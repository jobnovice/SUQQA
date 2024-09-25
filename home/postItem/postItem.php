<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    /> -->
    <link rel="stylesheet" href="postItem.css">
    <title>Post Item</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link>
</head>

<body>
    <div class="container">
        <main class="box">


            <!-- Register Form -->
            <section class="box-post" id="post">
                <form action="register.php" method="post">
                    <header class="top-header">
                        <img src="../../images/logo_image.png" alt="">
                        <br>
                        <h3>Post Item</h3>
                        <small>We are happy to have you with us.</small>
                    </header>
                    <div class="input-group">
                        <div class="input-field">
                            <input type="text" class="input-box" id="title" required name="title">
                            <label for="title">Title</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input-box" id="regPrice" required name="price">
                            <label for="price">Price</label>
                        </div>




                        <!-- <div class="Gender">
                            &nbsp; &nbsp; <label for="formCheck2">Gender</label>
                                &nbsp; &nbsp; &nbsp;&nbsp;
                             <input type="radio" id="formCheck2" class="check" name="Gender">
                            <label for="formCheck2">Male</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="formCheck2" class="check" name="Gender">
                            <label for="formCheck2">Female</label> 
                            
                        </div> -->
                        <div class="input-field">

                            <select name="location" id="location" class="input-box" required>
                                <option value="location">Location</option>
                                <option value="AddisAbeba">Addis Abeba</option>
                                <option value="Bahirdar">Bahirdar</option>
                                <option value="Adama">Adama</option>
                                <option value="mekele">mekele</option>
                                <option value="Jimma">Jimma</option>
                                <option value="Diredewa">Diredewa</option>
                                
                            </select>
                        </div>


                        <div class="input-field">
                            <input type="number" class="input-box" id="Quantity" min="1">
                            <label for="price">Quantity</label>
                        </div>
                        <div class="input-field">

                            <select name="category" id="category" class="input-box" aria-placeholder="category" required>
                                <option value="electronics">choose category</option>
                                <option value="books">Books</option>
                                <option value="beauty">Beauty</option>
                                <option value="clothing">Clothing</option>
                                <option value="electronics">Electronics</option>
                                <option value="furniture">Furniture</option>
                                <option value="sports">Sports</option>
                                <option value="vehicle">vehicle</option>
                                <option value="others">Others</option>

                            </select>
                        </div>


                        <div class="input-field">
                            <select name="condition" class="input-box" id="condition">
                                <option value="condition">condition</option>
            <option value="new">New</option>
            <option value="like_new">Like New</option>
            <option value="used_good">Used - Good</option>
            <option value="used_fair">Used - Fair</option>
            <!-- Add more options as needed -->
                </select>
                        </div>


                        <div class="input-field">
                            <textarea name="Discription" class="input-disc" id="discription" cols="30" rows="5"></textarea>
                            <label for="discription">discription</label>
                        </div>

                        <div class="auction">

                            <label for="auction status">Auction status</label>
                            <label>
                            <input type="radio" name="auctionStatus" value="yes">
                            Yes
                        </label>

                            <label>
                            <input type="radio" name="auctionStatus" value="no">
                            No
                        </label>

                        </div>


                        <div class="one">
                            <input type="file" id="file" />
                            <label for="file">Upload image</label>

                        </div>

                        <div id="selectedBanner"></div>


                        <div class="input-field">
                            <input type="submit" class="input-submit" value="Post" required name="regsubmit">
                        </div>
                </form>
            </section>

            </div>



            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script>
                var selDiv = "";
                var storedFiles = [];
                $(document).ready(function() {
                    $("#file").on("change", handleFileSelect);
                    selDiv = $("#selectedBanner");
                });

                function handleFileSelect(e) {
                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    filesArr.forEach(function(f) {
                        if (!f.type.match("image.*")) {
                            return;
                        }
                        storedFiles.push(f);

                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var html =
                                '<img src="' +
                                e.target.result +
                                "\" data-file='" +
                                f.name +
                                "' class='avatar rounded lg' alt='Category Image' height='200px' width='200px'>";
                            selDiv.html(html);
                        };
                        reader.readAsDataURL(f);
                    });
                }
            </script>

</body>

</html>