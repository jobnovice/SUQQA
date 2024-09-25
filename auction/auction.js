    // alert("here")

    // Get all the "Add to Cart" buttons
    // alert("test");

    // function setUpEventListeners() {

    //     var buttonMakebid = document.querySelectorAll(".make-a-bid-button");

    //     buttonMakebid.forEach(function(button) {
    //         button.addEventListener('click', function(event) {
    //             event.preventDefault();
    //             document.querySelector(".popUp").classList.add("active");
    //             // document.body.style.filter = 'blur(1px)';
    //             // document.querySelector(".popUp").style.filter = 'none';
    //         });
    //     });

    //     document.querySelector(".popUp .close-btn").addEventListener("click", function() {
    //         document.querySelector(".popUp").classList.remove("active");
    //     });
    // }

    // window.addEventListener('DOMContentLoaded', function() {
    //     setUpEventListeners();
    // });




    const filterDropdown = document.getElementById('filter-dropdown');
    txt_search = document.getElementById('input_search');
    btn_search = document.getElementById('search-btn');
    const allItems = document.querySelectorAll('.item-card');
    container = document.querySelector('main');


    function search() {
        result = Array.from(allItems).filter(div => div.textContent.toLowerCase().includes(txt_search.value));
        console.log(txt_search.value.toLowerCase());
        if (result.length != 0) {
            container.replaceChildren(...result);
            console.log(result);

            //result.map(res=> container.append( res.parentElement.parentElement));
        } else {
            container.innerHTML = "";
            msg = document.createElement("h2");
            msg.innerText = "There are no results found!!";
            container.appendChild(msg);
        }

        // const buttons = document.querySelectorAll(".make-a-bid-button");

        // // Remove the event listener from all buttons
        // buttons.forEach(function(button) {
        //     button.removeEventListener('click', setUpEventListeners);
        // });

        // // Reattach the event listener to all buttons
        // buttons.forEach(function(button) {
        //     button.addEventListener('click', setUpEventListeners);
        // });
    }

    btn_search.addEventListener('click', search);


    function setUpEventListeners() {


        var buttonMakebid = document.querySelectorAll(".make-a-bid-button");

        buttonMakebid.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                document.querySelector(".popUp").classList.add("active");
                // document.body.style.filter = 'blur(1px)';
                // document.querySelector(".popUp").style.filter = 'none';
            });
        });

    }
    document.querySelector(".popUp .close-btn").addEventListener("click", function() {
        document.querySelector(".popUp").classList.remove("active");
        // location.reload(true);
    });


    window.addEventListener('DOMContentLoaded', function() {
        setUpEventListeners();
        filterDropdown.addEventListener('change', filterItems);
    });


    function filterItems() {
        // alert("event");
        const selectedCategory = document.getElementById('filter-dropdown').value;
        const notFound = document.getElementById("not-Found");
        let counter = 0;
        const allItems = document.querySelectorAll('.item-card');

        for (let i = 0; i < allItems.length; i++) {
            const item = allItems[i];

            if (selectedCategory === 'all' || item.classList.contains(selectedCategory)) {
                item.style.display = 'block';
                counter++;
            } else {
                item.style.display = 'none';
                notFound.style.display = "block";
            }
        }
        if (counter > 0) {
            notFound.style.display = "none";
        }

    }