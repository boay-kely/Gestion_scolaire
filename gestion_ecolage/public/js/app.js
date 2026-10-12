import './bootstrap';

// Simple live search for the etudiants table
document.addEventListener('DOMContentLoaded', function(){
	const search = document.querySelector('#search');
	if(search){
		search.addEventListener('input', function(e){
			const q = e.target.value.toLowerCase();
			document.querySelectorAll('table tbody tr').forEach(tr=>{
				const text = tr.innerText.toLowerCase();
				tr.style.display = text.includes(q) ? '' : 'none';
			});
		});
	}
	// Better delete confirmation with toast
	function showToast(msg, timeout=2500){
		const t = document.getElementById('toast');
		if(!t) return;
		t.textContent = msg; t.classList.remove('hidden');
		setTimeout(()=> t.classList.add('hidden'), timeout);
	}

	document.querySelectorAll('form[data-confirm]').forEach(form=>{
		form.addEventListener('submit', function(e){
			e.preventDefault();
			const msg = form.getAttribute('data-confirm') || 'Confirmer ?';
			if(confirm(msg)){
				showToast('Suppression en cours...');
				form.submit();
			} else {
				showToast('Annulé');
			}
		});
	});
});
