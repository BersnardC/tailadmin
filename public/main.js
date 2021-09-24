window.onload = () => {
	//alert('Cargado');
}

$(() => {
	$('#form_peoples').on('submit', (event) => {
		event.preventDefault();
		let _this = $(event.target);
		$.ajax({
			url: _this.attr('action'),
			type: _this.attr('method'),
			data: _this.serialize(),
			beforeSend: () => {
				$('#bn-save').text('Guardando').attr('disabled', true);
			},
			success: (resp) => {
				console.log(resp);
				if (resp.code != 'success') {
					Swal.fire({
					  title: 'Error',
					  text: resp.message,
					  icon: resp.code
					})
				} else {
					let item = resp.item;
					let tail = resp.tail;
					$('#tail_peoples_' + item.tail_id).html(`(${tail.total_items + 1})`);
					if (tail.total_items == 0)
						$('#list_items_' + item.tail_id).html(``);
					$('#list_items_' + item.tail_id).append(`<li class="list-group-item text-center" id="li_item_${item.id}" data-process='00'><b>${item.code}</b> - ${item.name} 
						<button class="tbtn btn" onclick="process_item('${item.id}', '${item.tail_id}')" title="Atender"><span class="fas fa-clock"></span></button>
						</li>`);
					_this[0].reset();
					let action_text = `Hora inicio: <b>${tail.start_time}</b>. Tiempo estimado de atencion: <b>${tail.minutes}</b> minutos con <b>${tail.seconds}</b> segundos a las <b>${tail.final_time}</b>`;
					$('#text_accions').html(action_text).fadeIn();
					setTimeout(() => {$('#text_accions').fadeOut().html('')}, 5000);
				}
				$('#bn-save').text('Guardar').removeAttr('disabled');
			},
			error: () => {
				$('#bn-save').text('Guardar').removeAttr('disabled', true);
			}
		})
	})
})

function process_item(item, tail_id) {
	let lii = $(`#li_item_${item}`);
	let tail = $(`#list_items_${tail_id}`);
	let status = lii.attr('data-process');
	$.ajax({
		url: './api/items/' + item,
		type: 'PUT',
		data: {'status': status},
		success: (resp) => {
			let item = resp.item;
			// Atendiendo
			if (item.status == 1) {
				lii.attr('data-process', '11').addClass('active')
					.children().children()
					.removeClass('fa-clock')
					.addClass('fa-check');
			} else {
				lii.fadeOut(200);
				setTimeout(() => {
					lii.remove();
					let tail_items = tail.children().length;
					if (tail_items == 0) {
						$(`#tail_peoples_${tail_id}`).html(tail_items);
						tail.append('<li class="list-group-item text-center text-danger">Cola vacía</li>');
					}
					else
						$(`#tail_peoples_${tail_id}`).html(tail_items);
				}, 250);
			}
			console.log(resp);
		}
	});

}