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
        $("#top_load").css("display", "block");

        $("#top_load").css("width", "20%");
        let api, data, total;
        var page = 1,
            articles = 0;

        async function fetchApi(pageNo) {
            $("#top_load").css("width", "40%");
            api = await fetch(`https://newsapi.org/v2/top-headlines?category=health&apiKey=63d9e062e0e64107a6e71ff0f6456a75&page=${pageNo}&pageSize=9`);
            data = await api.json();
            $("#top_load").css("width", "60%");

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
            $("#top_load").css("width", "100%");
            setTimeout(() => {
                $("#top_load").css("width", "0");
            }, 1000);

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

    <div class="container">
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