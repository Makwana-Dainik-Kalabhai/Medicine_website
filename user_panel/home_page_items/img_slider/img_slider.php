<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    #carouselExampleAutoplaying img {
        height: 550px;
    }

    /* //! Media Queries */
    @media (max-width: 1100px) {
        #carouselExampleAutoplaying img {
            height: 520px;
        }
    }
    @media (max-width: 950px) {
        #carouselExampleAutoplaying img {
            height: 500px;
        }
    }
    @media (max-width: 850px) {
        #carouselExampleAutoplaying img {
            height: 450px;
        }
    }
    @media (max-width: 750px) {
        #carouselExampleAutoplaying img {
            height: 400px;
        }
    }
    @media (max-width: 650px) {
        #carouselExampleAutoplaying img {
            height: 350px;
        }
    }
    @media (max-width: 550px) {
        #carouselExampleAutoplaying img {
            height: 300px;
        }
    }
    @media (max-width: 450px) {
        #carouselExampleAutoplaying img {
            height: 250;
        }
    }
    @media (max-width: 370px) {
        #carouselExampleAutoplaying img {
            height: 200px;
        }
    }
    @media (max-width: 265px) {
        #carouselExampleAutoplaying img {
            height: 150px;
        }
    }
</style>

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="http://localhost/php/medicine_website/user_panel/home_page_items/img_slider/img5.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="http://localhost/php/medicine_website/user_panel/home_page_items/img_slider/img4.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="http://localhost/php/medicine_website/user_panel/home_page_items/img_slider/img7.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="http://localhost/php/medicine_website/user_panel/home_page_items/img_slider/img9.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>