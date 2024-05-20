let rank_price = 0;
let coins_price = 0;
const username = document.getElementById("username");
function inputChanged() {
    const submit_btn = document.getElementById("submit-btn");
    let sum = rank_price + coins_price;
    if (username.value.length >= 3 && sum > 0) {
        submit_btn.disabled = false;
        return;
    }
    submit_btn.disabled = true;
}
document.addEventListener("DOMContentLoaded", (event) => {
    const rank = document.getElementById("rank-select");
    const coins = document.getElementById("coins-select");
    const total_text = document.getElementById("total-price");
    const submit_btn = document.getElementById("submit-btn");
    const list_cart_rank = document.getElementById("list-cart-rank");
    const list_cart_coins = document.getElementById("list-cart-coins");
    const list_rank_price = document.getElementById("list-rank-price");
    const list_coins_price = document.getElementById("list-coins-price");
    submit_btn.disabled = true;
    function checkSelectionRank() {
        if (rank.value != "-") {
            list_cart_rank.textContent = rank.value;
            switch (rank.value) {
                case "Hero":
                    rank_price = 5;
                    break;
                case "Legend":
                    rank_price = 10;
                    break;
                case "Infinity":
                    rank_price = 15;
                    break;
                default:
                    break;
            }
            let formattedNumber = `$${rank_price.toFixed(2)}`;
            list_rank_price.textContent = formattedNumber;
            list_rank_price.classList.remove("d-none");
        } else {
            rank_price = 0;
            list_cart_rank.textContent = "-";
            list_rank_price.classList.add("d-none");
        }
        totalPrice();
    }
    function checkSelectionCoins() {
        if (coins.value != "-") {
            let coins_formatted = new Intl.NumberFormat("en-US").format(
                coins.value
            );
            list_cart_coins.textContent = coins_formatted;
            switch (coins.value) {
                case "64":
                    coins_price = 1;
                    break;
                case "350":
                    coins_price = 5;
                    break;
                case "700":
                    coins_price = 10;
                    break;
                case "1400":
                    coins_price = 20;
                    break;
                default:
                    break;
            }
            let formattedNumber = `$${coins_price.toFixed(2)}`;
            list_coins_price.textContent = formattedNumber;
            list_coins_price.classList.remove("d-none");
        } else {
            coins_price = 0;
            list_cart_coins.textContent = "-";
            list_coins_price.classList.add("d-none");
        }
        totalPrice();
    }
    let total;
    function totalPrice() {
        total = rank_price + coins_price;
        if (total > 0) {
            let formattedNumber = `$${total.toFixed(2)}`;
            total_text.textContent = formattedNumber;
            inputChanged();
            return;
        }
        total_text.textContent = "-";
        submit_btn.disabled = true;
        return;
    }
    rank.addEventListener("change", checkSelectionRank);
    coins.addEventListener("change", checkSelectionCoins);
});

document.addEventListener("DOMContentLoaded", function () {
    if (window.location.hash) {
        history.replaceState(null, document.title, window.location.pathname);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener("scroll", function () {
        var navbar = document.getElementById("navbar-sticky");
        if (window.scrollY > 20) {
            navbar.classList.remove("navbar-container-pd");
            navbar.classList.add("navbar-container-bg");
        } else {
            navbar.classList.add("navbar-container-pd");
            navbar.classList.remove("navbar-container-bg");
        }
    });
});

function openStore() {
    window.open("store.html", "_blank");
    return;
}