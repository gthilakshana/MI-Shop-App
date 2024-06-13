<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple responsive owl carousel</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style>
    @charset "utf-8";

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: -webkit-pictograph;
    }

    main {
        width: 100%;
        height: 840px;
        /*background: red;*/
        margin: 10px auto;
        position: relative;
        padding: 5px 0;
    }

    main .text {
        padding: 10px;
        text-align: center;
        /*font-size: 30px;*/
        color: #554;
    }

    .text h1 {
        font-size: 50px;
    }

    .text p {
        width: 60%;
        padding: 5px;
        margin: auto;
        line-height: 30px;
    }

    main header {
        width: 98%;
        height: 60px;
        margin: 0 auto;
        /*background: gray;*/
        display: flex;
        align-items: center;
        padding: 20px;
        justify-content: space-between;
        border-bottom: 2px solid #ddd;
    }

    header p span {
        font-size: 40px;
        margin: 0 5px;
        cursor: pointer;
        color: #555;
        width: 30px;
        height: 30px;
        display: inline-block;
        line-height: 19px;
        text-align: center;
        border-radius: 3px;
    }

    header p span:hover {
        background: #222;
        color: white;
    }

    section {
        width: 98%;
        height: 600px;
        /*background: red;*/
        margin: auto;
        display: flex;
        align-items: center;
        overflow-x: auto;
    }

    section::-webkit-scrollbar {
        display: none;
    }

    section .product {
        min-width: 24%;
        height: 90%;
        background: whitesmoke;
        margin: 0 20px 0 0;
        border-radius: 20px;
        position: relative;
        left: 0;
        transition: 0.5s;

    }

    picture {
        width: 100%;
        height: 70%;
        padding: 20px;
        /*background: green;*/
        display: flex;
        overflow: hidden;
        margin-bottom: 20px;
    }

    picture img {
        width: 100%;
    }

    .detail,
    .button {
        width: 90%;
        /*background: red;*/
        margin: auto;
        padding: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 50px;
        font-size: 20px;
        color: #444;
    }

    small {
        color: #555;
    }

    a {
        text-decoration: none;
        padding: 6px 14px;
        font-size: 15px;
        margin: 5px 0 0 20px;
        display: inline-block;
        background: #6773ff;
        color: white;
    }

    p.star {
        margin: 5px auto;
        width: 65%;
        font-size: 25px;
        color: #808080;
    }

    @media (max-width: 768px) {
        .text h1 {
            font-size: 35px;
        }

        .text p {
            width: 90%;
        }

        header h1 {
            font-size: 25px;
        }

        header p span {
            font-size: 30px;
        }

        section .product {
            min-width: 49%;
            margin: 0 10px 0 0;
        }

        .detail,
        .button {
            font-size: 16px;
        }

        a {
            padding: 6px 10px;
        }
    }
</style>

<body>
    <main>
        <div class="text">
            <h1>Simple Single carousel</h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam non atque adipisci est, recusandae aperiam, ullam minima quos nostrum animi voluptas sequi. At repellendus fuga reiciendis accusantium, dolor suscipit repellat?
            </p>
        </div>
        <header>
            <h1>Top Hottest Products</h1>
            <p>
                <span>&#139;</span>
                <span>&#155;</span>
            </p>
        </header>
        <section>
            <div class="product">
                <picture>
                    <img src="image/banner2.png" alt="">
                </picture>
                <div class="detail">
                    <p>
                        <b>Product One</b><br>
                        <small>New arrival</small>
                    </p>
                    <samp>$45.00</samp>
                </div>
                <div class="button">
                    <p class="star">
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                    </p>
                    <a href="#">Add-cart</a>
                </div>
            </div>
           
        </section>
    </main>
    <script>
        let span = document.getElementsByTagName('span');
        let product = document.getElementsByClassName('product')
        let product_page = Math.ceil(product.length / 4);
        let l = 0;
        let movePer = 25.34;
        let maxMove = 203;
        // mobile_view	
        let mob_view = window.matchMedia("(max-width: 768px)");
        if (mob_view.matches) {
            movePer = 50.36;
            maxMove = 504;
        }

        let right_mover = () => {
            l = l + movePer;
            if (product == 1) {
                l = 0;
            }
            for (const i of product) {
                if (l > maxMove) {
                    l = l - movePer;
                }
                i.style.left = '-' + l + '%';
            }

        }
        let left_mover = () => {
            l = l - movePer;
            if (l <= 0) {
                l = 0;
            }
            for (const i of product) {
                if (product_page > 1) {
                    i.style.left = '-' + l + '%';
                }
            }
        }
        span[1].onclick = () => {
            right_mover();
        }
        span[0].onclick = () => {
            left_mover();
        }
    </script>
</body>

</html>
<script type="text/javascript" src="js/main.js"></script>