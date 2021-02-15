$(document).on('ready', function() {
	var section = document.createElement('section');
	section.className = "regular slider";
	section.innerHTML = '<div>' +
			'<div class="good-descr">' +
				'<a href="product/Telescope_Bresser_Messier_NANO_NT-114500_AZ" class="good-a"><img src="img/sale1.png"></a>' +
				'<p>Telescope Bresser Messier NANO NT-114500 AZ</p>' +
			'</div>' +
		'</div>' +
		'<div>' +
		'	<a href="product/Telescope_Sky-Watcher_SKYMAX_BK_MAK90EQ1" class="good-a"><img src="img/sale2.png"></a>' +
		'</div>' +
		'<div>' +
			'<a href="product/Telescope_LUNT_LS60_THACPT"  class="good-a"><img src="img/sale3.png"></a>' +
		'</div>' +
		'<div>' +
			'<a href="prosuct/Telescope_Levenhuk_Skyline_Pro_127_MAK" class="good-a"><img src="img/sale4.png"></a>' +
		'</div>';
	document.getElementById("header").appendChild(section);
	$(".regular").slick({
		dots: true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		centerMode: true,
		variableWidth: true,
		autoplay: true,
		autoplaySpeed: 4000,
		pauseOnHover: true, 
		prevArrow: '<button type="button" class="slick-prev"><i class="fal fa-chevron-left fa-3x"></i></button>',
		nextArrow: '<button type="button" class="slick-next"><i class="fal fa-chevron-right fa-3x"></i></button>'
	});
  });