function hintOff (element) {
	if (element.value == "Title here") {
		element.value = "";
		$(element).css("color", "#333");
	}
}

function hintOn (element, text) {
	if(element.value.length == 0) {
		element.value = text.toString();
		$(element).css ("color", "#ddd");
	}
}


// Slideshow
$(function () {
	$("#slideshow li:gt(0), #item_slideshow li:gt(0)").hide();
	$($("#slidebuttons li:first img, #item_slideshow li:first img").attr("src", "img/slide_on.png"));
});

var counter = 0;

function changePictures() {
	var images = $("#slideshow li, #item_slideshow li").length;

	$($("#slideshow li, #item_slideshow li").get(counter)).fadeOut(1000);
	$($("#slideshow li, #item_slideshow li").get((counter + 1)%images)).fadeIn(1000).end();
	
	$($("#slidebuttons li").get(counter)).find('img').attr("src", "img/slide_off.png");
	$($("#slidebuttons li").get((counter + 1)%images)).find('img').attr("src", "img/slide_on.png");
	
	counter++;
	if (counter > images - 1)
		counter = 0;
}

var timer = setInterval(changePictures, 5000);

// Click butttons
function chooseSlide (slide) {
	$($("#slideshow li, #item_slideshow li").get(counter)).fadeOut(1000);
	$($("#slidebuttons li").get(counter)).find('img').attr("src", "img/slide_off.png");
	
	counter = slide;
	
	$($("#slideshow li, #item_slideshow li").get(counter)).fadeIn(1000).end();
	$($("#slidebuttons li").get(counter)).find('img').attr("src", "img/slide_on.png");
	
	clearInterval(timer);
	timer = setInterval(changePictures, 5000);
}

// Hover buttons
$(function () { 
	$("#slidebuttons li").hover (
		function () {
			if ($(this).find('img').attr("src") == "img/slide_off.png")
				$(this).find('img').attr("src", "img/slide_hover.png");
		},
		function () {
			if ($(this).find('img').attr("src") == "img/slide_hover.png")
				$(this).find('img').attr("src", "img/slide_off.png");
		}
	);
});


// SHOW ITEM INFOS ON SLIDESHOW
$(function () {
	$("#slideshow li").hover (
		function () {
			$(this).find(".slide_text_content").animate({"bottom": "+=45px"}, "fast");
			$(this).find(".slide_soldout").animate({"left": "-=205px"}, "fast");
			$(this).find(".slide_pricetag").animate({"left": "-=205px"}, "fast");
		},
		function () {
			$(this).find(".slide_text_content").animate({"bottom": "-=45px"}, "medium");
			$(this).find(".slide_soldout").animate({"left": "+=205px"}, "fast");
			$(this).find(".slide_pricetag").animate({"left": "+=205px"}, "fast");
		}
	);
});

//TOGGLE ITEM PRICE
var showItemInfo = true;
$(function () {
	$(".item_slide_button").click ( function () {
		if(showItemInfo) {
			showItemInfo = false;
			$(".item_down_space").animate({"bottom": "-=50px"}, "slow");
			$(".item_slide_button").html("show");
		} else {
			showItemInfo = true;
			$(".item_down_space").animate({"bottom": "+=50px"}, "slow");
			$(".item_slide_button").html("hide");
		}
	});
});



//FORM NEW ITEM
$(function () {
	$("#more_imgs").click ( function () {
		$("#new_imgs").append('<input type="file" name="img[]" /><br/>');
	});
	$("#less_imgs").click ( function () {
		if ($("#new_imgs input").length > 1) {
			$("#new_imgs input").last().remove();
			$("#new_imgs br").last().remove();
		}
	});
	$("#more_rows").click ( function () {
		$("#item_nutritional table").append('<tr><td><input type="text" name="compound[]" /></td><td><input type="text" name="quantity[]" /></td></tr>');
	});
	$("#less_rows").click ( function () {
		if ($("#item_nutritional table tr").length > 1)
			$("#item_nutritional table tr").last().remove();
	});
});

//LIGHT BOX
$(function () {
	$("#gallery a").click( function () {
		var captRaw = $(this).attr("title").split(";");
		
		var caption = '<a target="_blank" href="/item.php?id=' + captRaw[1] + '">' + captRaw[0] + '</a>';
		$("#lightbox").fadeIn(600);
		$("#black").fadeIn();
		
		var img = new Image();
		img.src = $(this).find("img").attr("src");
		$("#imgBig").html('<a href="/item.php?id=' + captRaw[1] + '">' + '<img src="' + img.src + '" /></a>');
		
		//console.log(document.getElementById("imgBig"));
		
		//console.log('<a href="/item.php?id=' + captRaw[1] + '">''</a>');
		
		if ($("#imgBig img")[0].width > 900) {
			$("#imgBig img")[0].height = ($("#imgBig img")[0].height*900)/$("#imgBig img")[0].width;
			$("#imgBig img")[0].width = 900;
		}
		
		$("#imgAttr").html(caption);
		
		//CSS
		$("#lightbox").css("width", $("#imgBig img")[0].width + 8);
		$("#lightbox").css("height", $("#imgBig img")[0].height + 38);
		$("#lightbox").css("left", "5o%");
		$("#lightbox").css("top", "50%");
		$("#lightbox").css("margin-left", -($("#imgBig img")[0].width + 8)/2);
		$("#lightbox").css("margin-top", -($("#imgBig img")[0].height + 38)/2);
		
		$("#black, #closeButton").click( function () {
			$("#black").fadeOut();
			$("#lightbox").fadeOut(400, function () {
				$("#lightbox").css("width", "400px");
				$("#lightbox").css("height", "400px");
				$("#lightbox").css("left", "50%");
				$("#lightbox").css("top", "50%");
				$("#lightbox").css("margin-left", "-200px");
				$("#lightbox").css("margin-top", "-200px");
			});
		});
		
	});
});