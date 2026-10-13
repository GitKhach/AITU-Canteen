<?php
// index.php
session_start();

if (empty($_SESSION) ||
(isset($_GET['action']) && $_GET['action'] == 'signout')
) {
    session_unset();
    session_destroy();
    header("Location: welcome.php");
    exit();
} else {
    $title = "AITU Canteen";
    include("header.php");
?>

<style>
    .canteen-page {
        max-width: 1550px;
        margin: 0 auto;
        padding: 30px 24px 60px;
        color: #20231f;
    }

    .canteen-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 34px;
    }

    .canteen-eyebrow {
        color: #64815c;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .canteen-title {
        margin: 0 0 10px;
        font-size: clamp(30px, 4vw, 44px);
        font-weight: 800;
        letter-spacing: -1.5px;
    }

    .canteen-subtitle {
        margin: 0;
        color: #777d74;
        font-size: 15px;
    }

    .orders-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 21px;
        border-radius: 13px;
        background: #273e2b;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
        transition: background 0.2s, transform 0.2s;
    }

    .orders-button:hover {
        background: #3c5b40;
        color: #fff;
        transform: translateY(-2px);
    }

    .canteen-layout {
        display: grid;
        grid-template-columns: 255px minmax(0, 1fr) 190px;
        gap: 22px;
        align-items: start;
    }

    .menu-content {
        min-width: 0;
    }

    /* Shopping cart */

    .shopping-cart {
        position: sticky;
        top: 24px;
        min-width: 0;
        padding: 20px 16px;
        border: 1px solid #e8ebe5;
        border-radius: 17px;
        background: #fff;
        box-sizing: border-box;
    }

    .cart-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 8px;
    }

    .cart-title {
        margin: 0;
        font-size: 19px;
        font-weight: 800;
    }

    .cart-count {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 25px;
        height: 25px;
        padding: 0 6px;
        box-sizing: border-box;
        border-radius: 8px;
        background: #eaf0e5;
        color: #345435;
        font-size: 12px;
        font-weight: 700;
    }

    .cart-subtitle {
        margin: 0 0 18px;
        color: #858b80;
        font-size: 12px;
        line-height: 1.5;
    }

    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .cart-empty {
        padding: 24px 8px;
        color: #92988c;
        text-align: center;
        font-size: 13px;
        line-height: 1.6;
    }

    .cart-empty-icon {
        display: block;
        margin-bottom: 10px;
        font-size: 30px;
    }

    .cart-item {
        padding-bottom: 14px;
        border-bottom: 1px solid #eceee9;
    }

    .cart-item-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 9px;
    }

    .cart-item-name {
        margin: 0;
        color: #30362e;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.45;
        overflow-wrap: anywhere;
    }

    .cart-remove {
        flex-shrink: 0;
        padding: 0 3px;
        border: none;
        background: transparent;
        color: #a3a89e;
        font-size: 19px;
        line-height: 1;
        cursor: pointer;
    }

    .cart-remove:hover {
        color: #b6443d;
    }

    .cart-item-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .cart-item-price {
        color: #426440;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .cart-quantity {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 3px;
        border: 1px solid #e6e9e2;
        border-radius: 8px;
    }

    .cart-quantity button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 23px;
        height: 23px;
        border: none;
        border-radius: 5px;
        background: #f0f4ed;
        color: #345435;
        font-size: 16px;
        cursor: pointer;
    }

    .cart-quantity button:hover {
        background: #dfe8d9;
    }

    .cart-quantity span {
        min-width: 12px;
        color: #30362e;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
    }

    .cart-summary {
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid #e6e9e2;
    }

    .cart-total-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 15px;
    }

    .cart-total-label {
        color: #777d74;
        font-size: 13px;
    }

    .cart-total {
        color: #273e2b;
        font-size: 18px;
        font-weight: 800;
        white-space: nowrap;
    }

    .cart-clear,
    .cart-order {
        width: 100%;
        padding: 11px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }

    .cart-clear {
        border: 1px solid #e5e9e1;
        background: #fff;
        color: #73796f;
    }

    .cart-clear:hover {
        background: #fff1ef;
        color: #b6443d;
    }

    .cart-order {
        margin-top: 9px;
        border: none;
        background: #273e2b;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
    }

    .cart-order:hover:not(:disabled) {
        background: #3c5b40;
    }

    .cart-order:disabled {
        background: #dfe3dc;
        color: #92988c;
        cursor: not-allowed;
    }

    /* Menu */

    .menu-category {
        margin-bottom: 38px;
        scroll-margin-top: 25px;
    }

    .category-heading {
        display: flex;
        align-items: center;
        gap: 14px;
        margin: 0 0 18px;
        padding-bottom: 14px;
        border-bottom: 1px solid #e6e9e2;
        font-size: 23px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .category-heading::before {
        content: "";
        width: 5px;
        height: 27px;
        flex-shrink: 0;
        border-radius: 5px;
        background: #64815c;
    }

    .dish-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .dish-card {
        overflow: hidden;
        border: 1px solid #e8ebe5;
        border-radius: 17px;
        background: #fff;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    }

    .dish-card:hover {
        transform: translateY(-3px);
        border-color: #cbd8c4;
        box-shadow: 0 10px 25px rgba(30, 40, 25, 0.07);
    }

    .dish-card:focus-visible {
        outline: 2px solid #64815c;
        outline-offset: 3px;
    }

    .dish-image {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        aspect-ratio: 16 / 10;
        overflow: hidden;
        background: #f0f2ec;
    }

    .dish-image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        color: #9aa391;
        font-size: 12px;
    }

    .image-placeholder span {
        font-size: 30px;
    }

    .dish-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 17px;
    }

    .dish-name {
        margin: 0;
        font-size: 15px;
        line-height: 1.45;
        font-weight: 700;
    }

    .dish-price {
        flex-shrink: 0;
        color: #426440;
        font-size: 15px;
        font-weight: 800;
        white-space: nowrap;
    }

    .category-sidebar {
        position: sticky;
        top: 24px;
        padding: 20px 14px;
        border: 1px solid #e8ebe5;
        border-radius: 17px;
        background: #fff;
    }

    .sidebar-title {
        margin: 0 0 15px;
        padding: 0 9px;
        color: #8a9085;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .category-links {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .category-link {
        display: block;
        padding: 11px 10px;
        border-radius: 9px;
        color: #62695e;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.4;
        text-decoration: none;
        transition: color 0.2s, background 0.2s;
    }

    .category-link:hover {
        color: #345435;
        background: #f0f4ed;
    }

    @media (max-width: 1200px) {
        .canteen-layout {
            grid-template-columns: 225px minmax(0, 1fr);
            gap: 18px;
        }

        .category-sidebar {
            position: static;
            grid-column: 1 / -1;
        }

        .category-links {
            flex-direction: row;
            flex-wrap: wrap;
        }

        .category-link {
            padding: 9px 11px;
        }
    }

    @media (max-width: 900px) {
        .dish-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {
        .canteen-page {
            padding: 25px 15px 40px;
        }

        .canteen-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .orders-button {
            width: 100%;
            box-sizing: border-box;
        }

        .canteen-layout {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .shopping-cart,
        .category-sidebar,
        .menu-content {
            position: static;
            width: 100%;
            box-sizing: border-box;
        }

        .shopping-cart {
            padding: 18px;
            order: 1;
        }

        .category-sidebar {
            order: 0;
        }

        .menu-content {
            order: 2;
        }

        .category-links {
            flex-direction: row;
            flex-wrap: wrap;
        }

        .dish-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .dish-info {
            align-items: flex-start;
            flex-direction: column;
            gap: 8px;
            padding: 13px;
        }

        .dish-name {
            font-size: 13px;
        }

        .dish-price {
            font-size: 14px;
        }

        .category-heading {
            font-size: 21px;
        }
    }

    @media (max-width: 380px) {
        .dish-grid {
            grid-template-columns: 1fr;
        }

        .dish-info {
            flex-direction: row;
            align-items: center;
        }
    }
</style>

<div class="canteen-page">

    <section class="canteen-header">
        <div>
            <div class="canteen-eyebrow">AITU Canteen</div>

            <h1 class="canteen-title">
                Welcome, <?= htmlspecialchars($_SESSION['username']) ?>
            </h1>

            <p class="canteen-subtitle">
                Explore our selection of meals and drinks.
            </p>
        </div>

        <a href="OrderAwait.php" class="orders-button">
            <span>🛒</span>
            Orders
            <span>→</span>
        </a>
    </section>

    <div class="canteen-layout">

        <aside class="shopping-cart" aria-label="Shopping cart">
            <div class="cart-heading">
                <h2 class="cart-title">Your Cart</h2>
                <span class="cart-count" id="cartCount">0</span>
            </div>

            <p class="cart-subtitle">Your selected dishes</p>

            <div class="cart-items" id="cartItems" aria-live="polite">
                <div class="cart-empty">
                    <span class="cart-empty-icon">🛒</span>
                    Your cart is empty.<br>
                    Click a dish to add it.
                </div>
            </div>

            <div class="cart-summary">
                <div class="cart-total-row">
                    <span class="cart-total-label">Total</span>
                    <span class="cart-total" id="cartTotal">0 ₸</span>
                </div>

                <button type="button" class="cart-clear" id="clearCart">
                    Clear cart
                </button>

                <button type="button" class="cart-order" id="orderButton" disabled>
                    Order
                </button>
            </div>
        </aside>

        <div class="menu-content">

            <section class="menu-category" id="salads">
                <h2 class="category-heading">Salads</h2>
                <div class="dish-grid">

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🥗</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Салат «Тянь-Шань»</h3>
                            <div class="dish-price">600 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🥗</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Салат из спаржи</h3>
                            <div class="dish-price">500 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🥗</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Салат «Ассорти» овощное</h3>
                            <div class="dish-price">600 ₸</div>
                        </div>
                    </article>

                </div>
            </section>

            <section class="menu-category" id="soups">
                <h2 class="category-heading">Soups</h2>
                <div class="dish-grid">

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍲</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Суп «Крестьянский»</h3>
                            <div class="dish-price">400 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍲</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Суп гороховый</h3>
                            <div class="dish-price">400 ₸</div>
                        </div>
                    </article>

                </div>
            </section>

            <section class="menu-category" id="main-dishes">
                <h2 class="category-heading">Main Dishes</h2>
                <div class="dish-grid">

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍛</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Плов с мясом говядины</h3>
                            <div class="dish-price">1 350 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🥟</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Пельмени</h3>
                            <div class="dish-price">1 200 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍖</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Мясо по-гречески</h3>
                            <div class="dish-price">1 000 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍖</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Тефтели говяжьи</h3>
                            <div class="dish-price">600 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍗</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Капиталинка</h3>
                            <div class="dish-price">1 200 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍗</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Рулет куриный</h3>
                            <div class="dish-price">1 100 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍗</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Рулет куриный</h3>
                            <div class="dish-price">1 300 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍗</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Курица с овощами</h3>
                            <div class="dish-price">900 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍗</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Крылья KFC</h3>
                            <div class="dish-price">1 000 ₸</div>
                        </div>
                    </article>

                </div>
            </section>

            <section class="menu-category" id="side-dishes">
                <h2 class="category-heading">Side Dishes</h2>
                <div class="dish-grid">

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍚</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Гарнир рисовый</h3>
                            <div class="dish-price">400 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍚</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Гарнир гречневый</h3>
                            <div class="dish-price">400 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍝</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Макароны отварные</h3>
                            <div class="dish-price">400 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍟</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Картофель фри</h3>
                            <div class="dish-price">500 ₸</div>
                        </div>
                    </article>

                </div>
            </section>

            <section class="menu-category" id="drinks">
                <h2 class="category-heading">Drinks</h2>
                <div class="dish-grid">

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🥤</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Компот, морс, кисель</h3>
                            <div class="dish-price">250 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🧃</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Сок натуральный в ассортименте</h3>
                            <div class="dish-price">300 ₸</div>
                        </div>
                    </article>

                    <article class="dish-card">
                        <div class="dish-image">
                            <div class="image-placeholder"><span>🍵</span>Food image</div>
                        </div>
                        <div class="dish-info">
                            <h3 class="dish-name">Чай витаминный</h3>
                            <div class="dish-price">500 ₸</div>
                        </div>
                    </article>

                </div>
            </section>

        </div>

        <aside class="category-sidebar">
            <h2 class="sidebar-title">Categories</h2>
            <nav class="category-links">
                <a href="#salads" class="category-link">Salads</a>
                <a href="#soups" class="category-link">Soups</a>
                <a href="#main-dishes" class="category-link">Main Dishes</a>
                <a href="#side-dishes" class="category-link">Side Dishes</a>
                <a href="#drinks" class="category-link">Drinks</a>
            </nav>
        </aside>

    </div>
</div>

<script>
    const cart = new Map();

    const cartItemsElement = document.getElementById('cartItems');
    const cartCountElement = document.getElementById('cartCount');
    const cartTotalElement = document.getElementById('cartTotal');
    const clearCartButton = document.getElementById('clearCart');
    const orderButton = document.getElementById('orderButton');

    const moneyFormatter = new Intl.NumberFormat('ru-RU');

    function formatPrice(price) {
        return moneyFormatter.format(price) + ' ₸';
    }

    function addToCart(name, price) {
        if (cart.has(name)) {
            cart.get(name).quantity++;
        } else {
            cart.set(name, {
                name: name,
                price: price,
                quantity: 1
            });
        }

        renderCart();
    }

    function changeQuantity(name, amount) {
        if (!cart.has(name)) {
            return;
        }

        const item = cart.get(name);
        item.quantity += amount;

        if (item.quantity <= 0) {
            cart.delete(name);
        }

        renderCart();
    }

    function removeFromCart(name) {
        cart.delete(name);
        renderCart();
    }

    function renderCart() {
        cartItemsElement.replaceChildren();

        let totalQuantity = 0;
        let totalPrice = 0;

        cart.forEach(function (item) {
            totalQuantity += item.quantity;
            totalPrice += item.price * item.quantity;

            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';

            const top = document.createElement('div');
            top.className = 'cart-item-top';

            const name = document.createElement('h3');
            name.className = 'cart-item-name';
            name.textContent = item.name;

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'cart-remove';
            removeButton.textContent = '×';
            removeButton.setAttribute('aria-label', 'Remove ' + item.name);
            removeButton.addEventListener('click', function () {
                removeFromCart(item.name);
            });

            top.append(name, removeButton);

            const bottom = document.createElement('div');
            bottom.className = 'cart-item-bottom';

            const price = document.createElement('span');
            price.className = 'cart-item-price';
            price.textContent = formatPrice(item.price * item.quantity);

            const quantityControls = document.createElement('div');
            quantityControls.className = 'cart-quantity';

            const minusButton = document.createElement('button');
            minusButton.type = 'button';
            minusButton.textContent = '−';
            minusButton.setAttribute('aria-label', 'Decrease quantity');
            minusButton.addEventListener('click', function () {
                changeQuantity(item.name, -1);
            });

            const quantity = document.createElement('span');
            quantity.textContent = item.quantity;

            const plusButton = document.createElement('button');
            plusButton.type = 'button';
            plusButton.textContent = '+';
            plusButton.setAttribute('aria-label', 'Increase quantity');
            plusButton.addEventListener('click', function () {
                changeQuantity(item.name, 1);
            });

            quantityControls.append(minusButton, quantity, plusButton);
            bottom.append(price, quantityControls);
            cartItem.append(top, bottom);
            cartItemsElement.appendChild(cartItem);
        });

        if (cart.size === 0) {
            const empty = document.createElement('div');
            empty.className = 'cart-empty';

            const icon = document.createElement('span');
            icon.className = 'cart-empty-icon';
            icon.textContent = '🛒';

            empty.append(icon, document.createTextNode('Your cart is empty.'));

            const hint = document.createElement('div');
            hint.textContent = 'Click a dish to add it.';

            empty.appendChild(hint);
            cartItemsElement.appendChild(empty);
        }

        cartCountElement.textContent = totalQuantity;
        cartTotalElement.textContent = formatPrice(totalPrice);
        orderButton.disabled = cart.size === 0;
    }

    document.querySelectorAll('.dish-card').forEach(function (card) {
        const nameElement = card.querySelector('.dish-name');
        const priceElement = card.querySelector('.dish-price');

        if (!nameElement || !priceElement) {
            return;
        }

        const name = nameElement.textContent.trim();
        const price = Number(priceElement.textContent.replace(/\D/g, ''));

        card.setAttribute('role', 'button');
        card.setAttribute('tabindex', '0');
        card.setAttribute('aria-label', 'Add ' + name + ' to cart');

        card.addEventListener('click', function () {
            addToCart(name, price);
        });

        card.addEventListener('keydown', function (event) {
            if (event.target !== card) {
                return;
            }

            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                addToCart(name, price);
            }
        });
    });

    clearCartButton.addEventListener('click', function () {
        cart.clear();
        renderCart();
    });

    orderButton.addEventListener('click', function () {
        if (cart.size === 0) {
            return;
        }

        let message = 'Confirm your order?\n\n';
        let total = 0;

        cart.forEach(function (item) {
            const itemTotal = item.price * item.quantity;

            message += item.name + ' × ' + item.quantity +
                ' — ' + formatPrice(itemTotal) + '\n';

            total += itemTotal;
        });

        message += '\nTotal: ' + formatPrice(total);

        if (window.confirm(message)) {
            alert('Order confirmed!\n\nTotal: ' + formatPrice(total));
            cart.clear();
            renderCart();
        }
    });

    renderCart();
</script>

<?php
    include("footer.php");
}
?>
