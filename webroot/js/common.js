$(document).ready(function ($) {
	$(document).on('click', 'table a.remove', function (e) {
		e.preventDefault();
		$('#modal-confirm').data('related', $(this)).modal('show');
		Ajax._process = false;
	}).on('click.ajax', 'div.container a:not(.remove,[href="#"])', function (e) {
		e.preventDefault();
		Ajax.send('GET', $(this).attr('href'));
	}).on('click', '#modal-confirm button.yes', function () {
		var a = $('#modal-confirm').data('related'),
			url = location.href;
		if (a.length && a.data('csrf')) {
			Ajax.push_state = false;
			Ajax.send('POST', a.data('href'), {_csrfToken: a.data('csrf')}, function () {
				$('#modal-confirm').modal('hide');
				Ajax.push_state = true;
			});
		}
	}).on('submit.ajax', 'form', function (e) {
		var form = $(this);
		e.preventDefault();
		Ajax.send('POST', form.attr('action'), form.serialize());
	}).on('hidden.bs.modal', '#modal-confirm', function () {
		Ajax._process = true;
	});
	if (!$('body').data('ajax')) {
		$(document).off('.ajax');
	}
	
	$(window).on('popstate', function (e) {
		location.reload();
	});
});
Ajax = (function () {
	var is_ajax = $('body').data('ajax');
	return {
		push_state: true,
		_process: true,
		send: function (method, url, data, callback) {
			$.ajax({
				url: url,
				method: method,
				data: data || {}
			}).done(function (data) {
				Ajax.render(data);
			}).fail(function (xhr) {
				Ajax.render(xhr.responseText);
			}).always(function () {
				if (!is_ajax) {
					location.reload(true);
					return ;
				}
				if (Ajax.push_state === true) {
					history.pushState(null, null, url);
				}
				if (typeof (data) == 'function') {
					callback = data;
				}
				if (typeof (callback) == 'function') {
					callback();
				}
			});
		},
		render: function (response) {
			var int;
			if (typeof (response) == 'object' && response.url != undefined) {
				Ajax._process = false;
				$.get(response.url, {}, function (_response) {
					window.history.pushState(null, null, response.url);
					response = _response;
					Ajax._process = true;
				});
			}
			int = setInterval(function () {
				if (Ajax._process === false) {
					return;
				}
				$('div.container').replaceWith(response);
				clearInterval(int);
			}, 100);
		}
	};
}());
