new Vue({
	el: "#con",
	components: {
		'select-own': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/select-own.vue'),
		'choice-modal-img': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/choice-modal-img.vue'),
		'img-select': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/img-select.vue'),
      	'input-file-own': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/input-file-own.vue'),
	}
});