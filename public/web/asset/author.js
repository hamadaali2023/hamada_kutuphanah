/******************************************
 * My Login
 *
 * Bootstrap 4 Login Page
 *
 * @author          Muhamad Nauval Azhar
 * @uri 			https://nauval.in
 * @copyright       Copyright (c) 2018 Muhamad Nauval Azhar
 * @license         My Login is licensed under the MIT license.
 * @github          https://github.com/nauvalazhar/my-login
 * @version         1.2.0
 *
 * Help me to keep this project alive
 * https://www.buymeacoffee.com/mhdnauvalazhar
 *
 ******************************************/

var sPath = window.location.pathname;
var sPage = sPath.substring(sPath.lastIndexOf("/") + 1);
/*=================================
	Author Page
 ================================= */
// Add slideDown animation to Bootstrap dropdown when expanding.
$(".dropdown").on("show.bs.dropdown", function () {
  $(this).find(".dropdown-menu").first().stop(true, true).slideDown();
});

// Add slideUp animation to Bootstrap dropdown when collapsing.
$(".dropdown").on("hide.bs.dropdown", function () {
  $(this).find(".dropdown-menu").first().stop(true, true).slideUp();
});

//open / close menu
$("#menu-toggle").click(function (e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

//Load profile page
function loadProfile() {
  $("#author").html('<iframe src="../author/profile.php"></iframe>');
}

$("#image").click(function () {
  $("input[id='profileImage']").click();
});

//automatically load stats page
if (sPage == "author.php") {
  $("#author").html('<iframe src="../author/statistics.php"></iframe>');
} else if (sPage == "admin.php") {
  $("#author").html('<iframe src="../admin/statistics.php"></iframe>');
}
// for Transfer
function changePageAdmin(email) {
  $("#myModalTarsf").modal({ show: true });
  $("#myModalTarsf").find("#emailt").val(email);
}
// for selles
function changePageAdmin2(email) {
  $("#myModalTarsS").modal({ show: true });
  $("#myModalTarsS").find("#emailS").val(email);
}

function changePage(id) {
  switch (id) {
    case 1:
      if (sPage == "author.php") {
        $("#author").html('<iframe src="../author/statistics.php"></iframe>');
      } else if (sPage == "admin.php") {
        $("#author").html('<iframe src="../admin/statistics.php"></iframe>');
      }
      break;
    case 2:
      if (sPage == "author.php") {
        $("#author").html('<iframe src="../author/books.php"></iframe>');
      } else if (sPage == "admin.php") {
        $("#author").html('<iframe src="../admin/manage_authors.php"></iframe>');
      }
      break;
    case 3:
      if (sPage == "author.php") {
        $("#author").html('<iframe src="../author/add_book.php"></iframe>');
      } else if (sPage == "admin.php") {
        $("#author").html('<iframe src="../admin/manageTransfers.php"></iframe>');
      }
      break;
    case 4:
      if (sPage == "author.php") {
        $("#author").html('<iframe src="../author/Bill.php"></iframe>');
      } else if (sPage == "admin.php") {
        $("#author").html('<iframe src="../admin/NotesReport.php"></iframe>');
      }
      break;
    case 5:
      if (sPage == "author.php") {
        $("#author").html('<iframe src="../author/transfers.php"></iframe>');
      } else if (sPage == "admin.php") {
        $("#author").html('<iframe src="../admin/settingpage.php"></iframe>');
      }
      break;
    case 6:
      if (sPage == "author.php") {
        $("#author").html('<iframe src="../author/add_bankAccount.php"></iframe>');
      } else if (sPage == "admin.php") {
        $("#author").html('<iframe src="../admin/manageAuthorsAccount.php"></iframe>');
      }
      break;
    case 7:
      if (sPage == "author.php") {
         $("#author").html('<iframe src="../author/terms_conditionsau.php"></iframe>');
      }else if (sPage == "admin.php") {
        $("#author").html('<iframe src="../admin/edit_terms_page.php"></iframe>');
      }
      break;
    case 8:
       if (sPage == "admin.php") {
        $("#author").html('<iframe src="../admin/edit_help_page.php"></iframe>');
      }
      break;
  }
}

// Check if Fields are empty
$(function () {
  $("input[type='password'][data-eye]").each(function (i) {
    var $this = $(this),
      id = "eye-password-" + i,
      el = $("#" + id);

    $this.wrap(
      $("<div/>", {
        style: "position:relative",
        id: id,
      })
    );

    $this.css({
      paddingRight: 60,
    });
    $this.after(
      $("<div/>", {
        html: "Show",
        class: "btn btn-primary btn-sm",
        id: "passeye-toggle-" + i,
      }).css({
        position: "absolute",
        right: 10,
        top: $this.outerHeight() / 2 - 12,
        padding: "2px 7px",
        fontSize: 12,
        cursor: "pointer",
      })
    );

    $this.after(
      $("<input/>", {
        type: "hidden",
        id: "passeye-" + i,
      })
    );

    var invalid_feedback = $this.parent().parent().find(".invalid-feedback");

    if (invalid_feedback.length) {
      $this.after(invalid_feedback.clone());
    }

    $this.on("keyup paste", function () {
      $("#passeye-" + i).val($(this).val());
    });
    $("#passeye-toggle-" + i).on("click", function () {
      if ($this.hasClass("show")) {
        $this.attr("type", "password");
        $this.removeClass("show");
        $(this).removeClass("btn-outline-primary");
      } else {
        $this.attr("type", "text");
        $this.val($("#passeye-" + i).val());
        $this.addClass("show");
        $(this).addClass("btn-outline-primary");
      }
    });
  });

  $(".my-login-validation").submit(function () {
    var form = $(this);
    if (form[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    }
    form.addClass("was-validated");
  });
});
// logout Admin
function logOutAdmin() {
  $.ajax({
    type: "POST",
    url: "logoutAdmin.php",
    success: function (result) {
      window.location.href = "connect.html";
      history.pushState(null, null, location.href);
      window.onpopstate = function () {
        history.go(1);
      };
    },
    error: function (xhr, status, error) {
      var err = xhr.responseText;
      alert(err.Message + ":لقد حصل خطأ");
    },
  });
}
//Log out user
function logOut() {
  var urllog = "";
  var urllogin = "";

  if (sPage == "index.html") {
    urllog = "./pages/author/logout.php";
    urllogin = "./index.html";
  } else {
    urllog = "../../pages/author/logout.php";
    urllogin = "../../index.html";
  }
  $.ajax({
    type: "POST",
    url: urllog,
    success: function (result) {
      window.location.href = urllogin;
      history.pushState(null, null, location.href);
      window.onpopstate = function () {
        history.go(1);
      };
    },
    error: function (xhr, status, error) {
      var err = xhr.responseText;
      alert(err.Message + ":لقد حصل خطأ");
    },
  });
}

/*=================================
	Register Page
 ================================= */

$(document).ready(function () {
  if (
    sPage == "settingpage.php" ||
    sPage == "reset.php" ||
    sPage == "cart.php" ||
    sPage == "profile.php" ||
    sPage == "edit_bank_page.php" ||
    sPage == "edit_book_page.php" ||
    sPage == "register.html" ||
    sPage == "reset.php" ||
    sPage == "add_book.php" ||
    sPage == "add_bankAccount.php"
  ) {
    getCountriesState("");
    getphoneCode("");

    //Validate repeated password
    $("#re-password").on("keyup", function (e) {
      var words = $.trim(this.value);
      var parent = $(this).closest(".form-group");
      if (words != $.trim($("#password").val())) {
        $(".error", parent).html("<p> كلمة السر لاتطابق الاخرى </p>").css({ color: "red", "font-size": "12px" });
      } else {
        $(".error", parent).html("<p> كلمة السر مطابقة  </p>").css({ color: "green", "font-size": "12px" });
      }
    });
    // Valide phone number
    $("#phone").on("keyup", function (e) {
      var parent = $(this).closest(".form-group");
      var phone = $.trim($("#phone").val());
      var regex = /^[0-9]{3,11}$/;
      if (regex.test(phone) == false) {
        $(".error", parent).html("<p> غير صحيح </p>").css({ color: "red", "font-size": "12px" });
      } else {
        $(".error", parent).html("<p> صحيح </p>").css({ color: "green", "font-size": "12px" });
      }
    });

    // Validate IBAN
    $("#IBAN").on("keyup", function (e) {
      var parent = $(this).closest(".form-group");
      var iban = $.trim($("#IBAN").val());

      if (isValidIBANNumber(iban) == false) {
        $(".error", parent).html("<p> غير صحيح IBAN</p>").css({ color: "red", "font-size": "12px" });
      } else {
        $(".error", parent).html("<p> صحيح IBAN </p>").css({ color: "green", "font-size": "12px" });
      }
    });

    $("#IBAN").change(function () {
      var parent = $(this).closest(".form-group");
      var iban = $.trim($("#IBAN").val());
      if (isValidIBANNumber(iban) == false) {
        $(".error", parent).html("<p> غير صحيح IBAN</p>").css({ color: "red", "font-size": "12px" });
        $("#IBAN").val("");
      } else {
        $(".error", parent).html("<p> صحيح IBAN </p>").css({ color: "green", "font-size": "12px" });
      }
    });
    // Discount and date
    $("#discount").change(function () {
      var parent = $(this).closest(".form-group");
      var dis = $.trim($("#discount").val());
      if (dis != 0) {
        $("#dateFrom").prop("disabled", false);
        $("#dateTo").prop("disabled", false);
      } else {
        $("#dateFrom").prop("disabled", true);
        $("#dateTo").prop("disabled", true);
      }
    });
    //validate cart payement
    $("#card-number").change(function () {
      var parent = $(this).closest(".field-row");
      var cardNumber = $.trim($("#card-number").val());
      if (cardNumber != "") {
        if (!validateCard(cardNumber)) {
          $(".error", parent).html("<p>  رقم البطاقة غير صحيح  </p>").css({ color: "red", "font-size": "12px" });
        } else $(".error", parent).html("<p>  رقم البطاقة  صحيح </p>").css({ color: "green", "font-size": "12px" });
      }
    });
    $("#cvc").change(function () {
      var parent = $(this).closest(".form-group");
      var cvv = $.trim($("#cvc").val());
      var cvvRegex = /^[0-9]{3,3}$/;
      if (!cvvRegex.test(cvv)) {
        $(".error", parent).html("<p>  رقم غير صحيح  </p>").css({ color: "red", "font-size": "12px" });
      } else $(".error", parent).html("<p>  رقم   صحيح </p>").css({ color: "green", "font-size": "12px" });
    });
    $("#name").change(function () {
      var parent = $(this).closest(".form-group");
      var cvv = $.trim($("#name").val());
      var cardHolderNameRegex = /^[a-z ,.'-]+$/i;
      if (!cardHolderNameRegex.test(cvv)) {
        $(".error", parent).html("<p>   غير صحيح  </p>").css({ color: "red", "font-size": "12px" });
      } else $(".error", parent).html("<p> صحيح </p>").css({ color: "green", "font-size": "12px" });
    });
    $("#month").change(function () {
      var parent = $(this).closest(".form-group");
      var m = parseInt($.trim($("#month").val()));
      if (m > 12 || m < 1) {
        $(".error", parent).html("<p>   الشهر غير صحيح </p>").css({ color: "red", "font-size": "12px" });
      } else $(".error", parent).html("");
    });
    $("#year").change(function () {
      var parent = $(this).closest(".form-group");
      var y = parseInt($.trim($("#year").val()));
      var currentTime = new Date().getFullYear();
      if (y < currentTime) {
        $(".error", parent).html("<p>   البطاقة منتهية الصلاحية   </p>").css({ color: "red", "font-size": "12px" });
        $("#year").val();
      } else $(".error", parent).html("");
    });
    // validate boock description

    // ------------------- [ Email blur function ] -----------------
    $("#email").blur(function () {
      var email = $("#email").val();
      // if email is empty then return
      if (email == "") {
        return;
      }
      // send ajax request if email is not empty
      $.ajax({
        url: "checkExistMail.php",
        type: "POST",
        data: {
          email: email,
          email_check: 1,
        },
        success: function (response) {
          // clear span before error message
          $("#email_error").remove();
          //$("#email").value('');
          // adding span after email textbox with error message
          if (!response.trim() == "") {
            $("#email").after("<span id='email_error' class='text-danger'>" + response + "</span>");
            $("#email").val("");
          }
        },
        error: function (e) {
          $("#result").html("Something went wrong");
        },
      });
    });
  }
});
// credit card validation

function validateCard(ccnum) {
  var ccCheckRegExp = /[^\d\s-]/;
  var isValid = !ccCheckRegExp.test(ccnum);
  var i;

  if (isValid) {
    var cardNumbersOnly = ccnum.replace(/[\s-]/g, "");
    var cardNumberLength = cardNumbersOnly.length;

    var arrCheckTypes = ["visa", "mastercard", "amex", "discover", "dinners", "jcb"];
    for (i = 0; i < arrCheckTypes.length; i++) {
      var lengthIsValid = false;
      var prefixIsValid = false;
      var prefixRegExp;

      switch (arrCheckTypes[i]) {
        case "mastercard":
          lengthIsValid = cardNumberLength === 16;
          prefixRegExp = /5[1-5][0-9]|(2(?:2[2-9][^0]|2[3-9]|[3-6]|22[1-9]|7[0-1]|72[0]))\d*/;
          break;
        case "visa":
          lengthIsValid = cardNumberLength === 16 || cardNumberLength === 13;
          prefixRegExp = /^4/;
          break;
        case "amex":
          lengthIsValid = cardNumberLength === 15;
          prefixRegExp = /^3([47])/;
          break;
        case "discover":
          lengthIsValid = cardNumberLength === 15 || cardNumberLength === 16;
          prefixRegExp = /^(6011|5)/;
          break;

        case "dinners":
          lengthIsValid = cardNumberLength === 14;
          prefixRegExp = /^(300|301|302|303|304|305|36|38)/;
          break;

        case "jcb":
          lengthIsValid = cardNumberLength === 15 || cardNumberLength === 16;
          prefixRegExp = /^(2131|1800|35)/;
          break;

        default:
          prefixRegExp = /^$/;
      }
      prefixIsValid = prefixRegExp.test(cardNumbersOnly);
      isValid = prefixIsValid && lengthIsValid;
      // Check if we found a correct one
      if (isValid) {
        break;
      }
    }
  }
  if (!isValid) {
    return false;
  }

  // Remove all dashes for the checksum checks to eliminate negative numbers
  ccnum = ccnum.replace(/[\s-]/g, "");
  // Checksum ("Mod 10")
  // Add even digits in even length strings or odd digits in odd length strings.
  var checksum = 0;
  for (i = 2 - (ccnum.length % 2); i <= ccnum.length; i += 2) {
    checksum += parseInt(ccnum.charAt(i - 1));
  }
  // Analyze odd digits in even length strings or even digits in odd length strings.
  for (i = (ccnum.length % 2) + 1; i < ccnum.length; i += 2) {
    var digit = parseInt(ccnum.charAt(i - 1)) * 2;
    if (digit < 10) {
      checksum += digit;
    } else {
      checksum += digit - 9;
    }
  }
  return checksum % 10 === 0;
}
function validateForm() {
  // removing span text before message
  $("#error").remove();
  var isOk = true;
  //Validate repeated password
  var password = $.trim($("#password").val());
  var repassword = $.trim($("#re-password").val());
  if (repassword != password) {
    alert("كلمة السر لا تطابق ");
    isOk = false;
  } else {
    isOk = true;
  }
  return isOk;
}
//Check passwords register
function checkRegisterForm() {
  var isOk = true;
  var password = $.trim($("#password").val());
 /* var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
  if (regex.test(password)) {
    isOk = true;
  } else {
    alert("كلمة السر لاتحتوي على احدى الشروط");
    isOk = false;
  }*/

  //Validate repeated password
  var repassword = $.trim($("#re-password").val());
  if (repassword != password) {
    alert("كلمة السر لا تطابق ");
    isOk = false;
  } else {
    isOk = true;
  }
  return isOk;
}
// check phone
function validatePhoneForE164(phoneNumber) {
  var regEx = /^\+[1-9]\d{10,14}$/;
  return regEx.test(phoneNumber);
}
// IBAN validation

function isValidIBANNumber(input) {
  var CODE_LENGTHS = {
    AD: 24,
    AE: 23,
    AT: 20,
    AZ: 28,
    BA: 20,
    BE: 16,
    BG: 22,
    BH: 22,
    BR: 29,
    CH: 21,
    CR: 21,
    CY: 28,
    CZ: 24,
    DE: 22,
    DK: 18,
    DO: 28,
    EE: 20,
    ES: 24,
    FI: 18,
    FO: 18,
    FR: 27,
    GB: 22,
    GI: 23,
    GL: 18,
    GR: 27,
    GT: 28,
    HR: 21,
    HU: 28,
    IE: 22,
    IL: 23,
    IS: 26,
    IT: 27,
    JO: 30,
    KW: 30,
    KZ: 20,
    LB: 28,
    LI: 21,
    LT: 20,
    LU: 20,
    LV: 21,
    MC: 27,
    MD: 24,
    ME: 22,
    MK: 19,
    MR: 27,
    MT: 31,
    MU: 30,
    NL: 18,
    NO: 15,
    PK: 24,
    PL: 28,
    PS: 29,
    PT: 25,
    QA: 29,
    RO: 24,
    RS: 22,
    SA: 24,
    SE: 24,
    SI: 19,
    SK: 24,
    SM: 27,
    TN: 24,
    TR: 26,
  };
  var iban = String(input)
      .toUpperCase()
      .replace(/[^A-Z0-9]/g, ""), // keep only alphanumeric characters
    code = iban.match(/^([A-Z]{2})(\d{2})([A-Z\d]+)$/), // match and capture (1) the country code,
    //(2) the check digits, and (3) the rest
    digits;
  // check syntax and length
  if (!code || iban.length !== CODE_LENGTHS[code[1]]) {
    return false;
  }
  // rearrange country code and check digits, and convert chars to ints
  digits = (code[3] + code[1] + code[2]).replace(/[A-Z]/g, function (letter) {
    return letter.charCodeAt(0) - 55;
  });
  // final check
  return mod97(digits);
}

function mod97(string) {
  var checksum = string.slice(0, 2),
    fragment;
  for (var offset = 2; offset < string.length; offset += 7) {
    fragment = String(checksum) + string.substring(offset, offset + 7);
    checksum = parseInt(fragment, 10) % 97;
  }
  return checksum;
}
//Get phone code
function getphoneCode(value) {
  $.getJSON("../../js/countryCode.json", function (result) {
    stateOptions = '<option value="" disabled selected> إختر الدولة  </option>';
    $.each(result.phones, function (index, country) {
      //<option value='stateCode'>stateName</option>
      stateOptions += "<option value='" + country.dialCode + "'>" + country.name + " " + country.dialCode + "</option>";
    });
    $("#phonecode").html(stateOptions);
    if (sPage == "profile.php") {
      $("#phonecode").val($.trim($("#phcode").val()));
    }
  });
}
//Get Countries and city list
function getCountriesState(value) {
  $.getJSON("../../js/countries.json", function (result) {
    //<option value="" disabled selected hidden> اختيار الدولة </option>
    stateOptions = '<option value="" disabled selected>  اختيار الدولة </option>';
    $.each(result.countries, function (index, country) {
      stateOptions += "<option value='" + country.country + "'>" + country.country + "</option>";
    });
    $("#country").html(stateOptions);
    if (sPage == "edit_book_page.php" || sPage == "edit_bank_page.php" || sPage == "profile.php") {
      $("#country").val($.trim($("#count").val()));
    }
    if (sPage == "edit_bank_page.php" || sPage == "profile.php") {
      $.getJSON("../../js/countries.json", function (result) {
        stateOptions = '<option value="" disabled selected> إختر</option>';
        $.each(result.countries, function (index, country) {
          if (country.country == $("#country").val()) {
            country.states.forEach((element) => {
              stateOptions += "<option value='" + element + "'>" + element + "</option>";
            });
          }
        });
        $("#state").html(stateOptions);
        $("#state").val($.trim($("#st").val()));
      });
    }
  });
  $("#country").change(function () {
    $.getJSON("../../js/countries.json", function (result) {
      stateOptions = '<option value="" disabled selected>إختر</option>';
      $.each(result.countries, function (index, country) {
        if (country.country == $("#country").val()) {
          country.states.forEach((element) => {
            //<option value='stateCode'>stateName</option>
            stateOptions += "<option value='" + element + "'>" + element + "</option>";
          });
        }
      });
      $("#state").html(stateOptions);
      if (sPage == "edit_bank_page.php") {
        $("#state").val($.trim($("#st").val()));
      }
    });
  });
}
/*=================================
	Add Book Page
 ================================= */
// price slider
$(document).ready(function () {
  const $valueSpan = $(".valueSpan2");
  const $value = $("#price");
  $valueSpan.html($value.val());
  $value.on("input change", () => {
    $valueSpan.html($value.val());
  });

  //$('#dateFrom').val(new Date().toISOString().slice(0, 10));
  //$('#dateTo').val(new Date().toISOString().slice(0, 10));
});

//Check Word count in description textarea
$(document).ready(function () {
  $("#description").on("keydown", function (e) {
    var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
    $("#display_count").text(words);
  });
  $("#dateTo").change(function () {
    //var parent = $(this).closest('.form-group');
    var dateTo = new Date($.trim($("#dateTo").val())).setHours(0, 0, 0, 0);
    var dateFrom = new Date($.trim($("#dateFrom").val())).setHours(0, 0, 0, 0);
    $("#date_error").remove();
    if (dateTo < dateFrom) {
      $("#dateTo").after("<span id='date_error' class='text-danger'> تاريخ  من يجب ان يكون اصغر من  تاريخ  الى</span>");
      $("#dateTo").val("");
      //$("#dateFrom").val("");
    }
  });
});

//add word to keywords list
function addToKeywords() {
  var keyword = $("#word").val();

  if (keyword.length > 0) {
    $("#keywords").append(
      '<li style="display:inline;" onclick="removeFromKeywords(this)" id="' +
        keyword +
        ">" +
        "<span>" +
        '<i class="fas fa-times" style="color: green; cursor: pointer;"> </i>' +
        "</span> " +
        keyword +
        "</li>"
    );

    $("#word").val("");
  }
}
//delete word from keywords list
function removeFromKeywords(id) {
  id.parentNode.removeChild(id);
}
//Alert if words
function checkWordCount() {
  var words = $.trim($("#description").val()).length ? $("#description").val().match(/\S+/g).length : 0;
  if (words < 200) {
    alert("يجب كتابة 200 كلمة على الاقل في وصف الكتاب ".$("#description").val());
    return false;
  } else {
    return true;
  }
}

/*=================================
	Author Books Page	
 ================================= */
//Search Book
function searchBook() {
  var keyword = $("#keyword").val().toUpperCase();
  var cards = document.getElementsByClassName("card");
  if (sPage !== "author.php") {
    var selectedOption = $("#sort").val(); // selected option
    if (parseInt(selectedOption) == 1) {
      console.log(selectedOption);
      for (var i = 0; i < cards.length; i++) {
        var small = cards[i].getElementsByTagName("p")[0];
        var txtValue = small.textContent || small.innerText;
        if (txtValue.toUpperCase().indexOf(keyword) > -1) {
          cards[i].style.display = "";
        } else {
          cards[i].style.display = "none";
        }
      }
    } else {
      for (var i = 0; i < cards.length; i++) {
        var h5 = cards[i].getElementsByTagName("h5")[0];
        var txtValue = h5.textContent || h5.innerText;
        if (txtValue.toUpperCase().indexOf(keyword) > -1) {
          cards[i].style.display = "";
        } else {
          cards[i].style.display = "none";
        }
      }
    }
  } else {
    for (var i = 0; i < cards.length; i++) {
      var h5 = cards[i].getElementsByTagName("h5")[0];
      var txtValue = h5.textContent || h5.innerText;
      if (txtValue.toUpperCase().indexOf(keyword) > -1) {
        cards[i].style.display = "";
      } else {
        cards[i].style.display = "none";
      }
    }
  }
}
// Search book by  publication date
$(document).ready(function () {
  $("#year").blur(function () {
    var cards = document.getElementsByClassName("card");
    for (var i = 0; i < cards.length; i++) {
      var pp = cards[i].getElementsByTagName("p")[2];
      var txtValue = pp.textContent || pp.innerText;
      var date = new Date(txtValue);
      var year = $("#year").val();
      if (date.getFullYear() == year) {
        cards[i].style.display = "";
      } else {
        cards[i].style.display = "none";
      }
    }
  });
});
//Delete Book
function deleteBook(bookId) {
  loading(true);
  $.ajax({
    type: "POST",
    url: "delete_book.php",
    data: { id: bookId },
    success: function (result) {
      loading(false);
      alert(result);
      location.reload();
    },
    error: function (xhr, status, error) {
      var err = xhr.responseText;
      alert(err.Message + ":لقد حصل خطأ");
    },
  });
}

//on Card Click Edit Book
function editBook(id) {
  loading(true);
  window.location = "edit_book_page.php?id=" + id;
}
// on clicj edit bank account
function editBank() {
  loading(true);
  window.location = "edit_bank_page.php";
}
function getEventTarget(e) {
  e = e || window.event;
  return e.target || e.srcElement;
}

// prevent back button from going back
function preventBack() {
  window.history.forward();
}

function loading(boolean) {
  if (boolean) {
    $("#loading").css("display", "block");
    $("#book-list").css("display", "none");
  } else {
    $("#loading").css("display", "none");
    $("#book-list").css("display", "block");
  }
}
