var sPath = window.location.pathname;
var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);


$(document).ready(function () {
    if (sPage == "index.html" || sPage == "" || sPage == "/") {
        getLatest('All');
        loadBestSellers();
    }
});

// get best selling books
function loadBestSellers() {
    $("#mostSelling").html(
        '<h3 class="loading" id="loading"> ..يتم التحميل الان  </h3>'
    );
    $("#book").html(
        '<h3 class="loading" id="loading"> ..يتم التحميل الان  </h3>'
    );
    $("#book2").html(
        '<h3 class="loading" id="loading"> ..يتم التحميل الان  </h3>'
    );
    $("#book3").html(
        '<h3 class="loading" id="loading"> ..يتم التحميل الان  </h3>'
    );
    $.ajax({
        type: 'GET',
        url: './pages/best_seller.php',
        data: { category: 'All', option: 3},
        dataType: "json",
        success: function (result) {
            $("#mostSelling").empty();
            $("#loading").remove();
            if (!$.trim(result)=='') {
                $.each(result, function (index, book) {
                    $("#mostSelling").append(
                        '<div class="card h-100" id="' + book._id.$oid + '" onclick="viewBook(\'' + book._id.$oid + '\')">'
                        + '<div class="card-body">'
                        + '<img style="height: 200px; width: 100%;" src=\"' + setCover(book.figureCoverPage) + '\">'
                        + '<div class="title-text">'
                        + '<h5 class="card-title">' + book.title + '</h5>'
                        + '<p class="card-text">' + book.author.name + '</p>'
                        + '<p class="card-text">' + book.licence.licenceDate + '</p>'
                        + '</div>'
                        + '<div class="price">' + getPrice(book.price, book.discount, book.discountFrom, book.discountTo) + ' دولار </div>'
                        + '<div class="addCart">'
                        + '<button id="addCart" type="button" class="btn btn-info btn-circle btn-lg" onclick="addToCart(\'' + book._id.$oid + '\')">'
                        + '<i class="fas fa-cart-plus"></i></button>'
                        + '</div>'
                        + '</div>'
                        + '</div>'
                    );
                });
                $("#book").append(result[0].title);
                $("#author1").append(result[0].author.name);
                $("#image").attr("src", result[0].figureCoverPage);
                $("#viewBook").attr("onclick", 'viewBook("' + result[0]._id.$oid + '")');

                $("#book2").append(result[1].title);
                $("#author2").append(result[1].author.name);
                $("#image2").attr("src", result[1].figureCoverPage);
                $("#viewBook2").attr("onclick", 'viewBook("' + result[1]._id.$oid + '")');

                $("#book3").append(result[2].title);
                $("#author3").append(result[2].author.name);
                $("#image3").attr("src", result[2].figureCoverPage);
                $("#viewBook3").attr("onclick", 'viewBook("' + result[2]._id.$oid + '")');
            }
        },
        error: function (xhr, status, error) {
            var err = xhr.responseText;
            alert(error + ':لقد حصل خطأ');
            alert(err.Message + ':لقد حصل خطأ');
        }
    });
}

//load nav and footer in index page
$(".index-nav").load('pages/components/nav2.php');
$(".index-footer").load('pages/components/footer.html');

//load nav and footer in other pages
$(".nav").load('../components/nav2.php');
$(".footer").load('../components/footer.html');

//on scroll nav bar 
$(window).scroll(function () {
    if ($(document).scrollTop() > 50) {
        $('.navbar').css("transition", "0.2s ease-in");
        $('.navbar').css("background-color", "white");
        $('.container-fluid').removeClass("pr-5 pl-5 pt-3 pb-3");
        $('.container-fluid').addClass("pr-5 pl-5 pt-2 pb-2");
    } else {
        $('.container-fluid').removeClass("pr-5 pl-5 pt-2 pb-2");
        $('.container-fluid').addClass("pr-5 pl-5 pt-3 pb-3");
        $('.navbar').css("background-color", "transparent");
    }
    var $el = $('#category');
    var isPositionFixed = ($el.css('position') == 'fixed');
    if ($(this).scrollTop() > 900 && !isPositionFixed) {
        $el.css({ 'position': 'fixed', 'top': '150px', 'z-index': '999' });
        $el.css({ 'width': '70%' });
    }
    if ($(this).scrollTop() < 900 && isPositionFixed) {
        $el.css({ 'position': 'static' });
        $el.css({ 'width': '100%' });
    }
});

//get books
function getBestSelling(cat, display) {
    $("#mostSelling").html(
        '<h3 class="loading" id="loading"> ..يتم التحميل الان  </h3>'
    );
    if(display){
        $("#allBooks").css('display', 'none');
        $("#latest-books").css('display', 'none');
    }    
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: './pages/best_seller.php',
            data: {category: cat, option: 9999},
            dataType: "json",
            success: function (result) {
                $("#mostSelling").empty();
                $("#loading").remove();
                if (!$.trim(result)=='') {
                    $.each(result, function (index, book) {
                        $("#mostSelling").append(
                            '<div class="card" id="' + book._id.$oid + '" onclick="viewBook(\'' + book._id.$oid + '\')">'
                            + '<div class="card-body">'
                            + '<img style="height: 200px; width: 100%;" src=\"' + setCover(book.figureCoverPage) + '\">'
                            + '<div class="title-text">'
                            + '<h5 class="card-title">' + book.title + '</h5>'
                            + '<p class="card-text">' + book.author.name + '</p>'
                            + '<p class="card-text">' + book.licence.licenceDate + '</p>'
                            + '</div>'
                            + '<div class="price">' + getPrice(book.price, book.discount, book.discountFrom, book.discountTo) + ' دولار</div>'
                            + '<div class="addCart">'
                            + '<button id="addCart" type="button" class="btn btn-info btn-circle btn-lg" onclick="addToCart(\'' + book._id.$oid + '\')">'
                            + '<i class="fas fa-cart-plus"></i></button>'
                            + '</div>'
                            + '</div>'
                            + '</div>'
                        );
                    });
                } else {
                    $("#mostSelling").html(
                        '<h3> لا يوجداي منتج </h3>'
                    );
                }
            },
            error: function (xhr, status, error) {
                var err = xhr.responseText;
                alert('لقد حصل خطأ');
            }
        });
    });
}
//get books
function getLatest(cat) {
    $("#allBooks").html(
        '<h3 class="loading" id="loading"> ..يتم التحميل الان  </h3>'
    );
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: './pages/retrieve_books.php',
            dataType: "json",
            data: {category: cat, limit: 30},
            success: function (result) {
                $("#allBooks").empty();
                $("#loading").remove();
                if (!$.trim(result)=='') {
                    $.each(result, function (index, book) {
                        $("#allBooks").append(
                            '<div class="card" id="' + book._id.$oid + '" onclick="viewBook(\'' + book._id.$oid + '\')">'
                            + '<div class="card-body">'
                            + '<img style="height: 200px; width: 100%;" src=\"' + setCover(book.figureCoverPage) + '\">'
                            + '<div class="title-text">'
                            + '<h5 class="card-title">' + book.title + '</h5>'
                            + '<p class="card-text">' + book.author.name + '</p>'
                            + '<p class="card-text">' + book.licence.licenceDate + '</p>'
                            + '</div>'
                            + '<div class="price">' + getPrice(book.price, book.discount, book.discountFrom, book.discountTo) + ' دولار </div>'
                            + '<div class="addCart">'
                            + '<button id="addCart" type="button" class="btn btn-info btn-circle btn-lg" onclick="addToCart(\'' + book._id.$oid + '\')">'
                            + '<i class="fas fa-cart-plus"></i></button>'
                            + '</div>'
                            + '</div>'
                            + '</div>'
                        );
                    });
                } else {
                    $("#allBooks").html(
                        '<h3> لا يوجداي منتج </h3>'
                    );
                }
            },
            error: function (xhr, status, error) {
                var err = xhr.responseText;
                alert('لقد حصل خطأ');
            }
        });
    });
}
//get books
function getBooks(cat, display) {
    $("#allBooks").html(
        '<h3 class="loading" id="loading"> ..يتم التحميل الان  </h3>'
    );
    if(display){
        $("#mostSelling").css('display', 'none');
        $("#most-selling").css('display', 'none');
    }    
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: './pages/retrieve_books.php',
            dataType: "json",
            data: {category: cat, limit: 999},
            success: function (result) {
                $("#allBooks").empty();
                $("#loading").remove();
                if (!$.trim(result)=='') {
                    $.each(result, function (index, book) {
                        $("#allBooks").append(
                            '<div class="card" id="' + book._id.$oid + '" onclick="viewBook(\'' + book._id.$oid + '\')">'
                            + '<div class="card-body">'
                            + '<img style="height: 200px; width: 100%;" src=\"' + setCover(book.figureCoverPage) + '\">'
                            + '<div class="title-text">'
                            + '<h5 class="card-title">' + book.title + '</h5>'
                            + '<p class="card-text">' + book.author.name + '</p>'
                            + '<p class="card-text">' + book.licence.licenceDate + '</p>'
                            + '</div>'
                            + '<div class="price">' + getPrice(book.price, book.discount, book.discountFrom, book.discountTo) + 'دولار </div>'
                            + '<div class="addCart">'
                            + '<button id="addCart" type="button" class="btn btn-info btn-circle btn-lg" onclick="addToCart(\'' + book._id.$oid + '\')">'
                            + '<i class="fas fa-cart-plus"></i></button>'
                            + '</div>'
                            + '</div>'
                            + '</div>'
                        );
                    });
                } else {
                    $("#allBooks").html('<h3> لا يوجداي منتج </h3>');
                }
            },
            error: function (xhr, status, error) {
                var err = xhr.responseText;
                alert('لقد حصل خطأ');
            }
        });
    });
}
//  change input
function changeInput(that) {
    if (that.value == "2") {
        document.getElementById("year").style.display = "block"; 
        document.getElementById("keyword").style.display = "none"; 
    }else { 
        document.getElementById("year").style.display = "none";
        document.getElementById("keyword").style.display = "block";
    }
}

//on Card Click 
function viewBook(id) {
    if (sPage == "product.php") {
        window.location = "product.php?id=" + id;
    } else {
        window.location = "pages/product/product.php?id=" + id;
    }
}

//Go to cart page 
function goToCart() {
    var n =$('#numberbooks span').text();
    if(n >0){
        if (sPage == "help.php"||sPage == "contactUs.html" ||sPage == "refound.html" ||sPage == "product.php" || sPage == "about.html" || sPage == "privacy.html") {
            window.location = "../cart/cart.php";
        } else if (sPage == "cart.php") {
            window.location = "cart.php";
        } else {
            window.location = "pages/cart/cart.php";
        }
    }
}

//Go to about page
function goToAbout() {
    if (sPage == "help.php"||sPage == "contactUs.html" ||sPage == "refound.html" ||sPage == "product.php" || sPage == "cart.php" || sPage == "privacy.html") {
        window.location = "../about/about.html";
    } else if (sPage == "about.html") {
        window.location = "about.html";
    } else {
        window.location = "pages/about/about.html";
    }
}
function goToHelp() {
    if (sPage == "contactUs.html" ||sPage == "refound.html" ||sPage == "product.php" || sPage == "cart.php" || sPage == "about.html" || sPage == "privacy.html") {
        window.location = "../about/help.php";
    } else if (sPage == "help.php") {
         window.location = "help.php";
    }else {
        window.location = "pages/about/help.php";
    }
}

//Go to home page
function goToHome() {
    if (sPage == "help.php"||sPage == "contactUs.html" ||sPage == "refound.html" ||sPage == "product.php" || sPage == "cart.php" || sPage == "about.html" || sPage == "privacy.html") {
        window.location = "../../index.html";
    } else {
        window.location = "index.html";
    }
}
//Go to privacy  page
function goToPrivacy() {
    if (sPage == "help.php"||sPage == "contactUs.html" ||sPage == "refound.html" ||sPage == "product.php" || sPage == "cart.php" || sPage == "about.html" || sPage == "privacy.html") {
        window.location = "../../index.html";
    } else {
        window.location = "index.html";
    }
}

//Go to login page
function goToLogin() {
    if (sPage == "help.php"||sPage == "contactUs.html" ||sPage == "refound.html" ||sPage == "product.php" || sPage == "cart.php" || sPage == "about.html" || sPage == "privacy.html") {
        window.location = "../auth/login.html";
    } else {
        window.location = "pages/auth/login.html";
    }
}
function goToProfile() {
    if (sPage == "help.php"||sPage == "contactUs.html" || sPage == "refound.html" || sPage == "product.php" || sPage == "cart.php" || sPage == "about.html" || sPage == "privacy.html") {
        window.location = "../author/author.php";
    } else {
        window.location = "pages/author/author.php";
    }
}

//Go to register page 
function goToRegister() {
    if (sPage == "help.php"||sPage == "contactUs.html" || sPage == "refound.html"  ||sPage == "product.php" || sPage == "cart.php" || sPage == "about.html" || sPage == "privacy.html") {
        window.location = "../auth/register.html";
    } else {
        window.location = "pages/auth/register.html";
    }
}

//on Card Click 
function addToCart(id) {
    $('#' + id + ' #addCart').html('<i class="fas fa-sync fa-spin"></i>');
    if (event.stopPropagation) {
        event.stopPropagation();
    }
    event.cancelBubble = true;

    var url = '';
    if (sPage == "product.php") {
        if ($('#addCart').html() == 'تم الاضافة <i class="far fa-check-circle"></i>') {
            return;
        }
        url = "../cart/add_to_cart.php";
    } else {
        if ($('#' + id + ' #addCart').css('background-color') == 'green') {
            return;
        }
        url = "pages/cart/add_to_cart.php";
    }

    $.ajax({
        type: 'POST',
        url: url,
        data: { book: id },
        success: function (result) {
            if (sPage == "product.php") {
                $('#addCart').html('تم الاضافة <i class="far fa-check-circle"></i>');
                $('#addCart').css('background-color', 'green');
            } else {
                $('#' + id + ' #addCart').html(' <i class="far fa-check-circle"></i>');
                $('#' + id + ' #addCart').css('background-color', 'green');
            }
            location.reload();
        },
        error: function (xhr, status, error) {
            if (sPage == "product.php") {
                $('#' + id + ' #addCart').html('الاضافة الى السلة <i class="fas fa-shopping-cart ml-1"></i>');
            } else {
                $('#' + id + ' #addCart').html('<i class="fas fa-cart-plus"></i>');
            }
            var err = xhr.responseText;
            alert('لقد حصل خطأ');
        }
    });
}
//Delete from cart
function deleteBookCart(id) {
    $('.delete').html('<i class="fas fa-sync fa-spin"></i>');
    $.ajax({
        type: 'POST',
        url: 'remove_from_cart.php',
        data: {book: id },
        success: function (result) {
          $('.delete').html('<i class="far fa-trash-alt"></i>');                 
          location.reload();
        },
        error: function (xhr, status, error) {
            var err = xhr.responseText;
            alert('لقد حصل خطأ');
        }
    });
}

//change Category
function changeCategory(id) {
    var category = '';
    $("#category .nav-link").css("color", "black");
    switch (id) {        
        case 2:
            category = 'development';
            $(".2").css("color", "#4bfebe");
            break;
        case 3:
            category = 'success';
            $(".3").css("color", "#4bfebe");
            break;
        case 4:
            category = 'psychology';
            $(".4").css("color", "#4bfebe");
            break;
        case 5:
            category = 'life';
            $(".5").css("color", "#4bfebe");
            break;
        case 6:
            category = 'studying';
            $(".6").css("color", "#4bfebe");
            break;
        case 7:
            category = 'art';
            $(".7").css("color", "#4bfebe");
            break;
        case 9:
            category = 'stories';
            $(".9").css("color", "#4bfebe");
            break;
        default:
            category = 'All';
            $(".0").css("color", "#4bfebe");
    }
    if ($("#allBooks").css('display') == 'none') {
        getBestSelling(category, true);
    } else if ($("#mostSelling").css('display') == 'none') {   
        getBooks(category, true);
       } else {
        getBestSelling(category, false);
        getBooks(category, false);
     }
}

function category(id) {
    if (id == 'stories') {
        return 'الرواية و الشعر';
    } else if (id == 'development') {
        return ' التنمية البشرية';
    } else if (id == 'psychology') {
        return 'الصحة النفسية';
    } else if (id == 'success') {
        return 'النجاح والثراء ';
    } else if (id == 'life') {
        return ' السعادة و أنماط الحياة';
    } else if (id == 'art') {
        return 'الفن والأدب';
    }else if(id == 'studying'){
        return ' المذاكرة وقوة الحفظ';
    }
}

// set Cover Image book
function setCover(cover){
    if(cover.lastIndexOf('image') != -1 || isImgLink(cover)) {
    	return cover;
    } else {
    	return "./images/default.jpeg";
    }
}

function isImgLink(url) {
    if (typeof url !== 'string') return false;
    return(url.match(/^http[^\?]*.(jpg|jpeg|gif|png|tiff|bmp)(\?(.*))?$/gmi) != null);
}

// Get price with discount
function getPrice(price, discount, dateFrom, dateTo) {
    var currentDate = new Date().setHours(0,0,0,0);
    var from = new Date(dateFrom).setHours(0,0,0,0);
    var to = new Date(dateTo).setHours(0,0,0,0);
    var numVal1 = Number(price);
    var numVal2 = Number(discount) / 100;
    var totalValue;
    if(discount == 0)
      return price;
    if (currentDate >= from) {
        if (currentDate <= to ) {
            if (Number(discount) > 0) {
                totalValue = numVal1 - (numVal1 * numVal2);
                return price.strike().fontcolor('grey') + '  ' + totalValue.toFixed(2);
            } else {
                return price;
            }
        } else {
            return price;
        }
    } else {
        return price;
    }
}