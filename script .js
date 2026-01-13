document.addEventListener('DOMContentLoaded', function () {
    const availableKeywords = [
        'Batticaloa',
        'Ampara',
        'Mannar',
        'Hatton',
        'Badulla',
        'Matara',
        'Anuradhapura',
        'Polannaruwa',
        'Hambantota',
        'Kilinochi',
        'Vavuniya',
        'Mullaiththivu',
        'Gampaha',
        'Kalutara',
        'Galle',
        'Matale',
        'Nuwara Eliya',
        'Moneragala',
        'Kegalle',
        'Ratnapura',
        'Kuruenegala',
        'Puttalam',
        'Colombo',
        'Trincomalee',
    ];

    const resultsBox = document.querySelector(".result-box");
    const inputBox = document.getElementById("input-box");
    const inputBox1 = document.getElementById("input-box1");

    inputBox.onkeyup = function () {
        let result = [];
        let input = inputBox.value;
        if (input.length) {
            result = availableKeywords.filter((keyword) => {
                return keyword.toLowerCase().includes(input.toLowerCase());
            });
        }
        display(result);
    };

    inputBox1.onkeyup = function () {
        let result = [];
        let input = inputBox1.value;
        if (input.length) {
            result = availableKeywords.filter((keyword) => {
                return keyword.toLowerCase().includes(input.toLowerCase());
            });
        }
        display1(result);
    };

    function display(result) {
        const content = result.map((list) => {
            return "<li onclick='selectInput(this)'>" + list + "</li>";
        });

        resultsBox.innerHTML = "<ul>" + content.join('') + "</ul>";
    }

    function display1(result) {
        const content = result.map((list) => {
            return "<li onclick='selectInput1(this)'>" + list + "</li>";
        });

        resultsBox1.innerHTML = "<ul>" + content.join('') + "</ul>";
    }

    function selectInput(list) {
        inputBox.value = list.innerHTML;
        resultsBox.innerHTML = '';
    }

    function selectInput1(list) {
        inputBox1.value = list.innerHTML;
        resultsBox1.innerHTML = '';
    }

    // Select a random district
    const randomDistrict = availableKeywords[Math.floor(Math.random() * availableKeywords.length)];
    // Display the random district
    document.querySelector('.random-district').textContent = randomDistrict;
});
