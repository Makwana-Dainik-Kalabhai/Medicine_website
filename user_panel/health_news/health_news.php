<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Health News</title>
    <!-- //! Favicon -->
    <link rel="shortcut icon" href="http://localhost/php/medicine_website/logo.ico" type="image/x-icon" />

    <!-- //! Jquery Link -->
    <script src="http://localhost/php/mysql/icecream_website/jquery-3.7.1.js"></script>

    <!-- //! Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<style>
    .container {
        font-size: 20px;
        padding: 5% 0;
    }

    .container .card {
        position: relative;
        height: 540px;
        padding: 2rem;
        margin: 1.5rem 0.25rem;
    }

    .container .card img {
        width: auto;
        height: 230px;
        border-radius: 0.3rem;
    }

    .container .card h5,
    .container .card p {
        line-height: 1.5;
    }

    .card-title {
        font-size: 0.9em;
    }

    .card-text {
        font-size: 0.8em;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
    }

    .container .text-body-secondary {
        position: absolute;
        right: 5%;
        bottom: 3%;
        font-size: 0.8em;
    }

    .container .read-more {
        color: white;
        position: absolute;
        left: 1%;
        bottom: 0;
        width: fit-content;
        font-size: 0.8em;
        background-color: #30819c;
        border: none;
    }


    /* //! Previous & Next btns */
    .container .row:last-child {
        margin-top: 5rem;
    }

    .container .prev-btn {
        color: white;
        padding: 0.7rem 0;
        font-size: 0.8em;
        border: none;
    }

    .container .next-btn {
        color: white;
        padding: 0.7rem 0;
        font-size: 0.8em;
        border: none;
    }

    .container .prev-btn:focus {
        color: white;
    }

    .container .next-btn:focus {
        color: white;
    }
</style>

<script>
    $(document).ready(function() {
        $(".loading-row").css("display", "block");
        let api, data, total;
        var page = 1,
            articles = 0;

        async function fetchApi(pageNo) {
            $(".loading-row").css("display", "block");

            api = await fetch(`https://newsapi.org/v2/top-headlines?category=health&apiKey=63d9e062e0e64107a6e71ff0f6456a75&page=${pageNo}&pageSize=9`);
            data = await api.json();

            data.articles.map(function(e) {
                if (e.urlToImage != null) {
                    $(".container .news").append(`
                    <div class="col-md-4">
                        <div class="card">
                            <img src="${e.urlToImage}" style="width: 100%;" alt="Image Not Found" />
                            <div class="card-body">
                                <h5 class="card-title">${(e.title!=null)?e.title:""}
                                </h5>
                                <p class="card-text mb-2">
                                    ${(e.description!=null)?e.description:""}
                                </p>
                                <p class="card-text mt-0"><small class="text-body-dark"><b>${(e.author!=null)?e.author:""}</b></small></p>
                                <small class="text-body-secondary">${(e.publishedAt!=null)?new Date(e.publishedAt).toDateString():""}</small>
                            </div>
                            <a href="${(e.url!=null)?e.url:""}" class="btn btn-dark read-more">
                                Read More
                                </a>
                        </div>
                    </div>
                    `);
                }
            });
            $(".loading-row").css("display", "none");

            if (articles > 0) {
                $(".prev-btn").removeAttr("disabled");
            }
            if (articles <= 0) {
                $(".prev-btn").attr("disabled", "true");
            }
            if (articles <= data.totalResults) {
                $(".next-btn").removeAttr("disabled");
            }
            if (articles >= data.totalResults - 9) {
                $(".next-btn").attr("disabled", "true");
            }
        }
        fetchApi(1);

        $(".prev-btn").click(function() {
            $(".container .news").html("");
            fetchApi(page - 1);
            page -= 1;
            articles -= 9;
            window.scrollTo(0, 0);
        });
        $(".next-btn").click(function() {
            articles += 9;
            $(".container .news").html("");
            fetchApi(page + 1);
            page += 1;
            window.scrollTo(0, 0);
        });
    });
</script>


<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <style>
        :root {
            --loading-grey: #ededed;
        }

        .loading-row {
            display: none;
        }

        .loading {
            height: 400px !important;
            padding: 2rem;
            margin: 1.5rem 1rem;
            background-color: #fff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, .12);
        }

        .image {
            height: 200px;
        }

        .image img {
            display: block;
            width: 100%;
            height: inherit;
            object-fit: cover;
        }

        .content {
            width: 100%;
            padding: 2rem 0;
        }

        h4 {
            margin: 0 0 1rem;
            font-size: 1.5rem;
            line-height: 1.5rem;
        }

        .description {
            font-size: 1rem;
            line-height: 1.4rem;
        }

        .loading .image,
        .loading h4,
        .loading .description,
        .loading .btn {
            background-color: var(--loading-grey);
            background: linear-gradient(100deg,
                    rgba(255, 255, 255, 0) 40%,
                    rgba(255, 255, 255, .5) 50%,
                    rgba(255, 255, 255, 0) 60%) var(--loading-grey);
            background-size: 200% 100%;
            background-position-x: 180%;
            animation: 1s loading ease-in-out infinite;
        }

        @keyframes loading {
            to {
                background-position-x: -20%;
            }
        }

        .loading h4 {
            min-height: 1.6rem;
            border-radius: 4px;
            animation-delay: .05s;
        }

        .loading .description {
            min-height: 4rem;
            border-radius: 4px;
            animation-delay: .06s;
        }

        .loading .btn {
            width: 10rem;
            min-height: 3rem;
            border-radius: 4px;
            animation-delay: .06s;
        }
    </style>

    <div class="container">
        <div class="loading-row">
            <div class="row my-3">
                <div class="col-md-4">
                    <div class="card loading">
                        <div class="image">

                        </div>
                        <div class="content">
                            <h4></h4>
                            <div class="description">

                            </div>
                        </div>
                        <button class="btn"></button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card loading">
                        <div class="image">

                        </div>
                        <div class="content">
                            <h4></h4>
                            <div class="description">

                            </div>
                        </div>
                        <button class="btn"></button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card loading">
                        <div class="image">

                        </div>
                        <div class="content">
                            <h4></h4>
                            <div class="description">

                            </div>
                        </div>
                        <button class="btn"></button>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-4">
                    <div class="card loading">
                        <div class="image">

                        </div>
                        <div class="content">
                            <h4></h4>
                            <div class="description">

                            </div>
                        </div>
                        <button class="btn"></button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card loading">
                        <div class="image">

                        </div>
                        <div class="content">
                            <h4></h4>
                            <div class="description">

                            </div>
                        </div>
                        <button class="btn"></button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card loading">
                        <div class="image">

                        </div>
                        <div class="content">
                            <h4></h4>
                            <div class="description">

                            </div>
                        </div>
                        <button class="btn"></button>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-4">
                    <div class="card loading">
                        <div class="image">

                        </div>
                        <div class="content">
                            <h4></h4>
                            <div class="description">

                            </div>
                        </div>
                        <button class="btn"></button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card loading">
                        <div class="image">

                        </div>
                        <div class="content">
                            <h4></h4>
                            <div class="description">

                            </div>
                        </div>
                        <button class="btn"></button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card loading">
                        <div class="image">

                        </div>
                        <div class="content">
                            <h4></h4>
                            <div class="description">

                            </div>
                        </div>
                        <button class="btn"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3 news">
        </div>

        <div class="row">
            <div class="col-md-1"><button class="btn btn-dark prev-btn" disabled><i class="fa-solid fa-arrow-left"></i>&ensp;Prev</button></div>
            <div class="col-md-10"></div>
            <div class="col-md-1"><button class="btn btn-dark next-btn">Next&ensp;<i class="fa-solid fa-arrow-right"></i></button></div>
        </div>
    </div>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>